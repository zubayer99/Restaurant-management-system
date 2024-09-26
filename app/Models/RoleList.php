<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleList extends Model
{
    use HasFactory;

    protected $table = 'role_list';

    protected $fillable = [
        'role_name',
        'description',
     
    ];
}
