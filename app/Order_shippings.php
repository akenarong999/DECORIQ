<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_shippings extends Model
{
  protected $fillable = [
      'order_id','name','cost'
  ];
}
