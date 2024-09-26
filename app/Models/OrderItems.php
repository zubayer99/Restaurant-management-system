<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManageFood;

class OrderItems extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    public function name()
    {
        return $this->hasOne(ManageFood::class,'food_id','item');
    }
}
