<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletePayment extends Model
{
    use HasFactory;

    protected $table = 'completepayment';

    protected $fillable = [
        'order_number',
        'txn_id',
        'total_payment',
        'payment_status',
    ];
}
