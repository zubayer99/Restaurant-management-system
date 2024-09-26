<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageFood extends Model
{
    use HasFactory;

    protected $table = 'manage_food';

    protected $fillable = [
        'food_name',
        'category',
        'kitchen',
        'menu_type',
        'description',
        'cooking_time',
        'image',
        'status',
    ];
}
