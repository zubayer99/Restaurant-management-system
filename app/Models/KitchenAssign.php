<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenAssign extends Model
{
    use HasFactory;

    protected $table = 'kitchen_assign';

    protected $fillable = [
        'kitchen_name',
        'user_id',
    ];
}
