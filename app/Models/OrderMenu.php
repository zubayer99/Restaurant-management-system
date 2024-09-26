<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItems;

class OrderMenu extends Model
{
    use HasFactory;


    protected $table = 'order_list';

    // protected $fillable = [
    //     'price',
    //     'cat_qty',
    //     'food_status',
    //     'shipping_method',
    //     'payment_method',
    //     'allfoodready',
    // ];

    public function order_items()
    {
        return $this->hasMany(OrderItems::class,'order')->with('name');
    }
}
