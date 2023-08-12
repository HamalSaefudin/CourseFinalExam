<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_name',
        'age',
        'gender',
        'exp_year',
        'exp_desc'
    ];
}
