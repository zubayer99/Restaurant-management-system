<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsForm extends Model
{
    use HasFactory;

    protected $table = 'contactus_form';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'comment',
    ];
}
