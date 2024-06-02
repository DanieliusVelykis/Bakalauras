<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FeedbackController extends Controller
{
    // Klasė skirta valdyti atsiliepimus apie paslaugas

    // Metodas skirtas išgauti visus komentarus, pagal kiekvienos paslaugos ID taip pat išgaunamas pavadinimas (nes saugoma tik ID duombazėje)
    // Išgavus grąžinamas visas sąrašas atsiliepimų bei užkraunamas puslapis
    public function feedback(){
        $feedbacks = Feedback::all();    

        foreach ($feedbacks as $feedback) {
            $service = Service::find($feedback->serviceId);
            $feedback->serviceName = $service ? $service->name : 'Unknown';
        }

        return view('feedback', [
            'feedbacks' => $feedbacks
        ]);
    }

    // Pridedant atsiliepimą yra išsaugomas paslaugos ID, atsiliepimo tekstas bei vartotojo ID, kuris paliko atsiliepimą
    // nutikus klaidai tai yra registruojama veiksmų žurnale
    // jei sėkmingai pridėta į duomenų bazę - išsiunčiamas patvirtinimas kaip atsakymas į užklausą
    public function addFeedback(Request $request){
        $data['serviceId'] = $request->serviceId;
        $data['feedback'] = $request->feedback;
        $data['user'] = $request->user;
        $service = Feedback::create($data);
        if(!$service){
            return new JsonResponse(['errors' => "Netikėta klaida pridedant atsiliepimą..."], 422);
        }
        return response()->json($service);
    }
}
