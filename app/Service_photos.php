<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_photos extends Model
{
  protected $fillable = [
      'name', 'resized_name', 'original_name','service_id','photo_order'
  ];


}
