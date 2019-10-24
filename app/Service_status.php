<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_status extends Model
{
  protected $table = 'service_status';

  protected $fillable = [
       'store_id'
  ];
}
