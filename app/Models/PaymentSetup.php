<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetup extends Model
{
    use HasFactory;

    protected $table = 'payment_setup';

    protected $fillable = [
        'payment_name',
        'marchant_id',
        'email',
        'password',
        'is_live',
        'status',
    ];
}
