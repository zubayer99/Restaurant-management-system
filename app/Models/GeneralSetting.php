<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'general_settings';

    // protected $fillable = [
    //     'application_title',
    //     'address',
    //     'email',
    //     'phone',
    //     'favicon',
    //     'logo',
    //     'available_on',
    //     'closing_time',
    //     'min_delivery_time',
    //     'powered_by_text',
    //     'footer_text',
    // ];
}
