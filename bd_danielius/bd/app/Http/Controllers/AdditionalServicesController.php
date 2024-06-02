<?php

namespace App\Http\Controllers;

use App\Models\AdditionalServices;
use Illuminate\Http\Request;
use App\Models\WorkersServices;
class AdditionalServicesController extends Controller
{
    // Metodas skirtas isgauti rezervacijos papildomas paslaugas -> isgaunama pagal rezervacijos ID
    public function getSpecificReservationAdditionals($reservationId){
        $additionalServices = AdditionalServices::where('reservationId', $reservationId)
        ->get();

        foreach($additionalServices as $additional){
            $service = WorkersServices::find($additional->workerServiceId);
            $additional->additionalServiceName = $service->workerServiceTitle;
        }
        return response()->json([
            'workerServices' => $additionalServices
        ]);
    }
}
