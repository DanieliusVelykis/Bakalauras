<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    // Komentarų klasė (tarp kliento ir fotografo)
    protected $table = 'communication_channel';
    protected $fillable = [
        "reservationId",
        "userId",
        "comment"
    ];
}
