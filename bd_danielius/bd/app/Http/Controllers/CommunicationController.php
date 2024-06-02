<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Communication;
use App\Models\User;

class CommunicationController extends Controller
{
    // Klasė skirta valdyti komentarus rezervacijose

    // Pridedamas komentaras kartu su rezervacijos ID bei vartotojo ID, kuris paliko komentarą bei pačiu komentaru
    // jei nepavyksta išsaugoti į veiksmų žurnalą išsaugoma klaida
    public function addComment(Request $request){
        $data['reservationId'] = $request->reservationId;
        $data['userId'] = $request->userId;
        $data['comment'] = $request->comment;
        // Move the uploaded file to the desired directory
        $comment = Communication::create($data);
        if(!$comment){
            return new JsonResponse(['errors' => "Nepavyko pridėti komentaro, netikėta klaida..."], 422);
        }
        return response()->json($comment);
    }

    // Metodas skirtas gauti komentarus pagal konkretų rezervacijos ID (atvaizdavimui susirašynėjimo prie rezervacijų)
    // Pagal rezervacijos ID išgaunamas vartotojo ID, kuris paliko komentarą, tuomet ieškomas jo vardas pagal ID
    // taip pat identifikuojama, ar tai buvo pačio fotografo komentaras ar kliento
    public function getComments(Request $request)
    {
        // Retrieve specific comments based on reservationId
        $specificComments = Communication::where('reservationId', $request->reservationId)
            ->get();
    
        // Add the new field to each comment
        $modifiedComments = $specificComments->map(function ($comment) {
            $user = User::find($comment->userId);
            if ($user && $user->role === 'Fotografas') {
                $comment->admin = 'yes'; // Add the additional field
            } else {
                $comment->admin = 'no'; // Add the additional field
            }
            return $comment;
        });
    
        // Return the modified comments as JSON response
        return response()->json($modifiedComments);
    }
    
}
