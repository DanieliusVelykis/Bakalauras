<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // vartotojų rolių klasė
    use HasFactory;
    protected $table = 'roles';
    protected $guarded = [];
}
