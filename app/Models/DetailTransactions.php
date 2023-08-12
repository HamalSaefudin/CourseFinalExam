<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'course_id',
        'instructor_id',
        'start_date',
        'price',
        'discount'
    ];
}
