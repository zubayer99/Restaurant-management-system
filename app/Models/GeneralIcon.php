<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralIcon extends Model
{
    use HasFactory;

    protected $table = 'general_icon';

    protected $fillable = [
        'facebook',
        'instragram',
        'twitter',
        'linkedln',
        'you_tube',
    ];
}
