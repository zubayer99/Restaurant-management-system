<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riders extends Model
{
    use HasFactory;

    protected $table = 'riders';

    protected $fillable = [
        'rider_name',
        'email',
        'phone',
        'city',
        'status',
        'approved_date',
    ];
}
