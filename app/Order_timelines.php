<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_timelines extends Model
{
  protected $fillable = [
      'order_id','message'
  ];
}
