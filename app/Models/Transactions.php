<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'membership',
        'transaction_code',
        'transaction_date',
        'customer_name',
        'subtotal',
        'total',
        'discount',
        'user_id'
    ];
}
