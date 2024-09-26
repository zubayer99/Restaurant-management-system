<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenSetting extends Model
{
    use HasFactory;

    protected $table = 'kitchen_setting';

    protected $fillable = [
        'kitchen_name',
    ];

}
