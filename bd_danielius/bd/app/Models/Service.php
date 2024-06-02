<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // paslaugų klasė
    use HasFactory;
    protected $table = 'services';
    protected $guarded = [];
}
