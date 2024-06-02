<?php
namespace App\Http\Controllers;

use App\Models\WorkersServices;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\reservations;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller{

    // Klasė skirta valdyti bendrinį puslapį (rezervacijų užsakymui)
    public function index(){
        $services = Service::all();    
        $workerServices = WorkersServices::all();
        return view('index', [
            'services' => $services,
            'workerServices' => $workerServices
        ]);
    }

    // Metodas leidžiantis išgauti dar neužimtus laikus pagal kiekvieną konkrečią paslaugą
    public function getAvailability($selectedDate, $serviceId)
    {
        // Pagal konkrečią parinktą datą išgaunami konkrečios paslaugos laisvi laikai
        $reservations = reservations::whereDate('reservedDate', $selectedDate)
        ->where('serviceId', $serviceId)
        ->get();
    
        // Pagal nutylėjimą yra 4 laisvi laikai kiekvienai paslaugai (kliento pusėje yra palyginama užimti ir laisvi laikai)
        // kad tinkamai atvaizduoti
        $availableTimes = [
            '10:00', '12:00', '14:00', '16:00'
        ];
    
        $takenTimes = [];
    
        // Iteruojama per kiekvieną rezervaciją ir pridedama į užimtus laikus, jei tokių rasta
        foreach ($reservations as $reservation) {
            $timeSlot = $reservation->reservedTime;
            if ($timeSlot) {
                $takenTimes[] = $timeSlot;
            }
        }
    
        // Grąžinami laisvi bei užimti laikai konkrečios rezervacijos
        return response()->json([
            'availableTimes' => $availableTimes,
            'takenTimes' => $takenTimes
        ]);
    }
    

    // Išgaunamas kalendorius kliento generavimui
    public function getCalendar($year, $month)
    {
        // Pagal konkretų mėnesį išgaunamos visos dienos dinamiškai
        $monthStartDate = date('Y-m-01', strtotime("$year-$month-01"));
        $daysInMonth = date('t', strtotime($monthStartDate));
        
        // Sugeneruojami HTML elementai kiekvienai mėnesio dienai
        $daysHtml = '';
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $daysHtml .= '<div class="day">' . $day . '</div>';
        }

        // Metodas grąžina mėnesį, jo pavadinimą, taip pat metus ir visas to mėnesio dienas
        return response()->json([
            'monthName' => date('F', strtotime($monthStartDate)),
            'month' => $month,
            'year' => $year,
            'daysHtml' => $daysHtml,
        ]);
    }

    // *********** CRUD operacijos paslaugoms ************* //

    // Metodas skirtas pridėti naują paslaugą
    public function addService(Request $request){
        // Pagal pateiktus duomenis sugeneruojami duomenų bazės elementai
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $data['detailed_description'] = $request->detailed_description;
        $data['image'] = "images/" . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $data['image']);
        // Pridėta nuotrauka prie paslaugos perkeliama į sisteminius failus bei sukuriamas elementas duomenų bazėje
        $service = Service::create($data);
        if(!$service){
            return new JsonResponse(['errors' => "Netikėta klaida kuriant paslaugą..."], 422);
        }
        // Po patikros, jei viskas gerai, grąžiname sukurtą paslaugą kaip patvirtinimą
        return response()->json($service);
    }

    // Metodas skirtas koreguoti paslaugą
    public function editService(Request $request){
        // Pagal pateiktus duomenis  (konkrečiai paslaugos ID iš kliento pusės) išgaunama paslauga iš duomenų bazės
        // tuomet perrašomos senos vertės naujomis ir išsaugoma informacija duomenų bazėje
        $service = Service::find($request->id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->detailed_description = $request->detailed_description;
        $service->save();
        if(!$service){
            return new JsonResponse(['errors' => "Toks vartotojas jau egzistuoja"], 422);
        }
        return response()->json($service);
    }

    // Paslaugos ištrynimas
    public function deleteService(Request $request){
        // Pagal trinamos paslaugos ID yra randamas elementas duomenų bazėje
        $service = Service::find($request->serviceId);
        // tuomet elementas ištrinamas
        $service->delete();
        // galiausiai grąžinamas boolean tipo kintamasis "true" kaip įrodymas, kad elementas buvo pašalintas
        return response()->json(['success' => true]);
    }

    // Paslaugos detali peržiūra
    public function showService(Request $request){
        // Surandama paslauga pagal konkretų ID bei grąžinamas JSON formatu kliento pusei užkrovimui
        $service = Service::find($request->serviceId);
        return new JsonResponse($service);
    }
}