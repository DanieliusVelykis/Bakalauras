<?php

namespace App\Http\Controllers;
use App\Models\AdditionalServices;
use App\Models\reservations;
use App\Models\User;
use App\Models\Service;
use App\Models\Communication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    // Klasė skirta rezervacijų valdymui

    // Metodas, kuris sukuria elementą duomenų bazėje, kai yra įvykdomas apmokėjimas
    public function reservationDone($date, $time, $price, $paymentType, $serviceId, $userId,$comment,$additionalServices)
    {
        // Pagal nutylėjimą nustatyta, jog mokėjimas yra dalinis
        $paymentResume = 'Pateikta dalinai apmokėta';
        // jei mokėjimo tipas buvo apmokėti viską iš karto - pakeičiamas ir tipas
        if($paymentType === 'Apmokėta iš karto') $paymentResume = 'Pateikta apmokėta';
        // sugeneruojami gauti duomenys iš apmokėjimo sistemos su visais rezervacijos duomenimis
        // kadangi metodas aktyvuojamas tik po apmokėjimo - pagal nutylėjimą priskiriama apmokėjimo reikšmė "Taip"
        $data = [
            'name' => 'Rezervacija_' . date('Y-m-d_H'),
            'userId' => $userId,
            'serviceId' => $serviceId,
            'reservedDate' => $date,
            'reservedTime' => $time,
            'paid' => 'Taip',
            'price' => $price,
            'paymentType' => $paymentType,
            'reservationStatus' => $paymentResume,
            'file' => ''
        ];
    
        // siekiant išvengti sistemos klaidų, rezervacija kuriama try/catch struktūroje
        try {
            // sukuriama rezervacija
            $service = reservations::create($data);
    
            if (!$service) {
                Log::error('Problema kuriant rezervaciją - ' . $userId);
                return new JsonResponse(['errors' => "Netikėta klaida..."], 422);
            }
    
            // jei vartotojas neparinko papildomų paslaugų - jos nėra kuriamos ir duomenų bazėje
            if ($additionalServices !== 'NOT') {
            // jei vartotojas pasirinko papildomas paslaugas
            // gaunamas sąrašas yra "string" tipo atskirtas kableliais (,)
            // dėl to sugeneruojamas mąsyvas su visais elementais
            $additionalServicesArray = array_filter(explode(',', rtrim($additionalServices, ',')));
            // iteruojama per kiekvieną mąsyvo elementą (papildomą paslaugą)
            foreach ($additionalServicesArray as $additional) {
                // sugeneruojami elementai duomenų bazės sukūrimui
                // kur perduodamas papildomos paslaugos ID
                // bei konkrečios rezervacijos ID
                $additionalInfo = [
                    'workerServiceId' => $additional,
                    'reservationId' => $service->id 
                ];
                // sukuriamas elementas duomenų bazėje
                AdditionalServices::create($additionalInfo);
            }
        }
            // Paruošiami el. laiškai vartotojui ir fotografui su dinamiškomis detalėmis
            $userInfo = 'Sveiki! Gavome Jūsų apmokėjimą už paslaugą ID: ' . $service->id . ', kurios kaina ' . $price . 'eur. - Jūsų rezervacija yra patvirtinta. Lauksime atvykstant!';
            $adminInfo = 'Naujas klientas užsirezervavo paslaugą! Rezervacijos ID - ' . $service->id;
    
            $details = [
                'title' => 'Rezervacijos patvirtinimas',
                'body' => $userInfo
            ];
    
            $detailsForAdmin = [
                'title' => 'Nauja rezervacija',
                'body' => $adminInfo
            ];
    
            // surandamas konkretaus vartotojo el. paštas (to, kuris rezervavo)
            $userRecipient = User::find($userId);
    
            // siunčiami laiškai
            try {
                // išsiunčiamas laiškas klientui su detalėmis
                Mail::to($userRecipient->email)->send(new NotificationMail($details));
                // išsiunčiamas laiškas fotografui su detalėmis
                Mail::to("danielius32123@gmail.com")->send(new NotificationMail($detailsForAdmin));
            } catch (\Exception $e) {
                // nutikus klaidai - registruojama veiksmų žurnale
                Log::error('Problema siunčiant laišką: ' . $e->getMessage());
                return new JsonResponse(['errors' => 'Klaida siunčiant laišką...'], 500);
            }
    
            // jei neužpildytas komentaras rezervuojant - nekuriamas ir elementas duomenų bazėje
            if ($comment!== 'NOT') {
                // jei užpildomas - sugeneruojami duomenys su rezervacijos, kliento ID bei pačiu komentaru
                $commentInfo = [
                    'reservationId' => $service->id,
                    'userId' => $userId,
                    'comment' => $comment
                ];
                
                // kuriamas elementas duomenų bazėje su nurodytais duomenimis
                try {
                    $commentCreated = Communication::create($commentInfo);
                    // jei nutiko problema - informuojama veiksmų žurnale
                    if (!$commentCreated) {
                        Log::error('Problema kuriant komentaro elementą: ' . json_encode($commentInfo));
                        return new JsonResponse(['errors' => 'Netiketa klaida pridedant komentarą...'], 422);
                    } else {
                        // kitu atvėju informuojama veiksmų žurnale, kad viskas buvo tinkama grąžinant sukurtą elementą
                        Log::info('Sukurtas komentaras: ' . json_encode($commentInfo));
                    }
                } catch (\Exception $e) {
                    // Nutikus netikėtai klaidai taip pat registruojama veiksmų žurnale
                    Log::error('Netikėta klaida kuriant komentarą: ' . $e->getMessage());
                    return new JsonResponse(['errors' => 'Netiketa klaida pridedant komentara...'], 500);
                }
            }
            return view('reservation_done');
        } catch (\Exception $e) {
            // grąžinamos klaidos tiek į veiksmų žurnalą tiek kliento pusei
            Log::error('Klaida kuriant rezervaciją...: ' . $e->getMessage());
            return new JsonResponse(['errors' => 'Klaida kuriant rezervaciją'], 500);
        }
    }

    // metodas grąžinantis rezervacijų puslapį
        public function reservationDones(){
		return view('reservation_done');
	}

    // metodas valdantis artėjančius vizitus
	public function upcomingEvents(Request $request){
        // išgaunamos rezervacijos, kurių datos yra dar ne praėjusios
        $reservations = reservations::whereDate('reservedDate', '>=', now()->format('Y-m-d'))
        ->get();

    // Iteruojama per kiekvieną rezervaciją (kadangi saugomi tik ID šioje lentelėje, reikia išgauti kitų lentelių duomenis)
    foreach ($reservations as $reservation) {
        // Išgaunamas kiekvieno vartotojo vardas
        $user = User::find($reservation->userId);
        $reservation->userName = $user ? $user->name : 'Unknown';

        // Išgaunamas kiekvienos paslaugos pavadinimas
        $service = Service::find($reservation->serviceId);
        $reservation->serviceName = $service ? $service->name : 'Unknown';
    }
    // grąžinamas vaizdas vartotojui su artėjančiais vizitais
    return view('upcoming', [
        'reservations' => $reservations
    ]);
	}

    // metodas skirtas atvaizduoti jau įvykusius vizitus
    public function doneEvents(Request $request){
        // randami visi vizitai iš duomenų bazės, kurie jau yra įvykdyti pagal datą
        $reservations = reservations::whereDate('reservedDate', '<=', now()->format('Y-m-d'))
        ->get();

    // Taip pat kaip ir artėjančių vizitų atvėju - išgaunami papildomi duomenys iš susijusių lentelių duomenų bazėje
    foreach ($reservations as $reservation) {
        $user = User::find($reservation->userId);
        $reservation->userName = $user ? $user->name : 'Unknown';

        $service = Service::find($reservation->serviceId);
        $reservation->serviceName = $service ? $service->name : 'Unknown';
    }

    return view('done', [
        'reservations' => $reservations
    ]);
	}

    // Konkretaus kliento vizitai
    public function doneEventsSpecific($userId){
        // išgaunami vizitai pagal konkretaus vartotojo ID (to, kuris atsidarė savo vizitų puslapį, iš kliento pusės gaunamas jo ID)
        $reservations = reservations::where('userId', '=', $userId)
        ->get();

    // Taip pat kaip ir prieš tai buvusių metodų atvėju, iteruojama per visas rezervacijas ir užkraunami susiję duomenys
    foreach ($reservations as $reservation) {
        $user = User::find($reservation->userId);
        $reservation->userName = $user ? $user->name : 'Unknown';

        $service = Service::find($reservation->serviceId);
        $reservation->serviceName = $service ? $service->name : 'Unknown';
    }

    return view('doneSpecific', [
        'reservations' => $reservations
    ]);
	}

    // Metodas skirtas išgauti konkrečios rezervacijos duomenis
    public function getReservationById($userId)
    {
        // išgaunama konkreti rezervacija pagal ID
        $user = reservations::find($userId);
        if (!$user) {
            // neradus - grąžinama klaida kliento pusei
            return response()->json(['error' => 'Rezervacija nerasta'], 404);
        }

        // ieškomas konkretus vartotojas kad užkrauti vardą bei paslaugos pavadinimą
        $userToFind = User::find($user->userId);
        $user->userName = $userToFind ? $userToFind->name : 'Unknown';

        $service = Service::find($user->serviceId);
        $user->serviceName = $service ? $service->name : 'Unknown';

        // galiausiai grąžinama rasta rezervacija su papildomais duomenimis kliento pusei
        return response()->json($user);
    }


    // Metodas skirtas koreguoti rezervacijos duomenis
    public function editReservation(Request $request){
    // randama rezervacija pagal ID
    $reservation = reservations::find($request->id);
    // jei rezervacijos ID buvo pakeistas koreguojant - išsiunčiamas pranešimas klientui apie pakeistą statusą
    if($reservation->reservationStatus != $request->reservationStatus){
        $userRecipient = User::find($request->userId);
        $details = [
            'title' => 'Rezervacijos statuso pasikeitimas',
            'body' => 'Sveiki! Informuojame, kad jūsų rezervacijos (ID: ' . $request->id . ') statusas buvo pakeistas iš ' . $reservation->reservationStatus . ' į ' . $request->reservationStatus 
        ];
        Mail::to($userRecipient->email)->send(new NotificationMail($details));
        
    }
    // perrašomos pakoreguotos vertės į duomenų bazę
    $reservation->userId = $request->userId;
    $reservation->serviceId = $request->serviceId;
    $reservation->reservedDate = $request->reservedDate;
    $reservation->reservedTime = $request->reservedTime;
    $reservation->paymentType = $request->paymentType;
    $reservation->reservationStatus = $request->reservationStatus;
    // išsaugomi pakitimai
    $reservation->save();
    return response()->json($reservation);
    }


    // Metodas skirtas failo pridėjimui į duomenų bazę
    public function addFile(Request $request)
    {
        // sugeneruojamas kelias duomenų bazei iki failo (kad nesaugoti pačių failų duomenų bazėje vietos taupymo sumetimais)
        $filename = "files/" . $request->file('file')->getClientOriginalName();

        // surandame rezervaciją
        $reservation = reservations::find($request->id);
    
        // perkeliame pridėtą failą prie sisteminių failų
        $request->file('file')->move(public_path('files'), $filename);
        Log::info("failas".$filename);
    
        // atnaujinamas failo kelias į duomenų bazę (nuoroda į failą)
        $reservation->file = $filename;
        $reservation->save();
    
        // informuojamas klientas, kad failas buvo pridėtas, taip pat failas prisegamas prie siunčiamo laiško
        $userRecipient = User::find($reservation->userId);
        $details = [
            'title' => 'Suteiktų paslaugų atnaujinimas',
            'body' => 'Sveiki! Informuojame, kad prie Jūsų užsakytų paslaugų (ID: ' . $reservation->id . ') buvo pridėtas failas, kuriame rasite nuotraukas. Failas taip pat prisegtas su šiuo laišku.'
        ];
    
        try {
            Mail::to($userRecipient->email)->send(new NotificationMail($details, public_path($filename)));
        } catch (\Exception $e) {
            Log::error('Klaida siunčiant laišką: ' . $e->getMessage());
            return response()->json(['errors' => 'Klaida siunčiant laišką'], 500);
        }
    
        return response()->json($reservation);
    }

    // Rezervacijos atšaukimo metodas
    public function cancelReservation($serviceId){
        // surandame rezervaciją pagal konkretų ID
        $reservation = reservations::find($serviceId);
        // pašaliname ją
        $reservation->delete();
        $userRecipient = User::find($reservation->userId);

        // išsiunčiame pranešimus tiek klientui tiek fotografui, kad buvo atšaukta rezervacija
        // klientas gauna informaciją su konkrečios rezervacijos ID bei informacija, jei ne pats klientas atšaukė
        // fotografas gauna informaciją su konkrečios rezervacijos ID bei informacija, kiek pinigų reikia grąžinti klientui
        $details = [
            'title' => 'Rezervacijos statuso pasikeitimas',
            'body' => 'Sveiki! Informuojame, kad jūs atšaukėte rezervaciją (ID: ' . $reservation->id . '). Jei tai padarėte ne Jūs kreipkitės el. paštu: danielius@photo.lt' 
        ];

        $adminInfo = [
            'title' => 'Rezervacijos statuso pasikeitimas',
            'body' => 'Klientas ' . $userRecipient->name .' atšaukė rezervaciją (ID: ' . $reservation->id . '). Reikia grąžinti užsakymo sumą ' . $reservation->price . 'eur. per 5 d.d.'
        ];
        Mail::to($userRecipient->email)->send(new NotificationMail($details));
        Mail::to('danielius32123@gmail.com')->send(new NotificationMail($adminInfo));
        return response()->json($reservation);
    }
}
