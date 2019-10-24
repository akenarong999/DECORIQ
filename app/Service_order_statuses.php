<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order_statuses extends Model
{
  protected $fillable = [
    'name','description'
  ];
}
