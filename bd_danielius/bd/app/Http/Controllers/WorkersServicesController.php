<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkersServices;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class WorkersServicesController extends Controller
{
    // Klasė skirta valdyti papildomas darbuotojų (plaukų stilisto ir visažisto) paslaugas

    // metodas skirtas pridėti naują papildomą paslaugą
    public function addWorkerService(Request $request){
        $data['workerId'] = $request->workerId;
        $data['workerPrice'] = $request->workerPrice;
        $data['workerServiceTitle'] = $request->workerServiceTitle;
        $data['workserServiceDescription'] ='no data';
        $data['workerServiceType'] = $request->workerServiceType;
        $workerService = WorkersServices::create($data);
        if(!$workerService){
            return new JsonResponse(['errors' => "Nepavyko pridėti darbuotojo paslaugos, netikėta klaida..."], 422);
        }
        $workerServices = WorkersServices::all();
        foreach($workerServices as $worker){
            $user = User::find($worker->workerId);
            $worker->workerName = $user->name;
        }
        return response()->json($workerService);

    }

    // metodas skirtas ištrinti papildomą paslaugą
    public function deleteWorkerService($workerServiceId){
        $workerService = WorkersServices::find($workerServiceId);
        $workerService->delete();
        return response()->json($workerService);
    }

    // metodas skirtas koreguoti papildomą paslaugą
    public function editWorkerService(Request $request){
        $workerService = WorkersServices::find($request->workerServiceId);
        $workerService->workerId = $request->workerId;
        $workerService->workerPrice = $request->workerPrice;
        $workerService->workerServiceTitle = $request->workerServiceTitle;
        $workerService->workerServiceType = $request->workerServiceType;
        $workerService->save();
        return response()->json($workerService);
    }

    // metodas skirtas išgauti konkrečia papildomą paslaugą
    public function specificWorkerService($userId){
        $workerServices = WorkersServices::where('workerId', $userId)
        ->get();

        foreach($workerServices as $worker){
            $user = User::find($worker->userId);
            $worker->workerName = $user->name;
        }
        return view('worker-specific', [
            'workerServices' => $workerServices
        ]);
    }

    // metodas skirtas išgauti visą papildomų paslaugų sąrašą (puslapio užkrovimui)
    public function allWorkersServices()
    {
        $workerServices = WorkersServices::all();
        foreach($workerServices as $worker){
            $user = User::find($worker->workerId);
            $worker->workerName = $user->name;
        }
        return view('worker_services', ['workerServices' => $workerServices]);
    }
}
