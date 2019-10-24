<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_tracks extends Model
{
  protected $fillable = [
      'order_id','shipping_name','shipping_track_url','tracking_no'
  ];
}
