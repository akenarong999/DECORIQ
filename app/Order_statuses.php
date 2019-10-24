<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_statuses extends Model
{
  protected $fillable = [
      'name','description'
  ];
}
