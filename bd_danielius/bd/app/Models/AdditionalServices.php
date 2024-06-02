<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalServices extends Model
{
    // Papildomų paslaugų klasė

    // nurodoma lentelė duomenų bazėje
    protected $table = 'additional_services';

    // nurodomi visi atributai toje lentelėje
    protected $fillable = [
        "workerServiceId",
        "reservationId"
    ];
}
