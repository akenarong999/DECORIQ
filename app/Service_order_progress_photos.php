<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order_progress_photos extends Model
{
  protected $fillable = [
    'service_order_progress_id','photo_id'
  ];
}
