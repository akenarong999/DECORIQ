<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_payment_inform extends Model
{
  protected $table = 'order_payment_inform';

  protected $fillable = [
      'order_id','email','paymentamount','paymentdate','paymenttime','paymentinformnote','photo_1'
  ];
}
