<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerList extends Model
{
    use HasFactory;

    protected $table = 'customer_list';

    protected $fillable = [
        'customer_name',
        'email',
        'password',
        'phone',
        'address',
    ];
}
