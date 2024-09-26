<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableList extends Model
{
    use HasFactory;

    protected $table = 'table_list';

    protected $fillable = [
        'table_name',
        'capacity',
        'status',
     
    ];
}
