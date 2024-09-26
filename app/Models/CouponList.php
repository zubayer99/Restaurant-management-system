<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponList extends Model
{
    use HasFactory;

    protected $table = 'coupon_list';

    protected $fillable = [
        'coupon_id',
        'coupon_code',
        'coupon_value',
    ];
}
