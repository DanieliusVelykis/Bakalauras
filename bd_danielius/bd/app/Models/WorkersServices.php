<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkersServices extends Model
{
    // papildomų paslaugų klasė
    protected $table = 'workers_services';
    protected $fillable = [
        "workerId",
        "workerPrice",
        "workerServiceTitle",
        "workserServiceDescription",
        "workerServiceType"
    ];
}
