<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_weightbase extends Model
{
  protected $fillable = [
      'minweight','maxweight','cost','shipping_id'
  ];
}
