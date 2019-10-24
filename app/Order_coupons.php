<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_coupons extends Model
{
  protected $fillable = [
      'order_id','coupon_id'
  ];
}
