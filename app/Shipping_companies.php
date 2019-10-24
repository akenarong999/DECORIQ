<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_companies extends Model
{
  protected $fillable = [
    'name','description','track_url'
  ];
}
