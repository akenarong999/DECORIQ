<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_addresses extends Model
{
  protected $fillable = [
      'store_id','address1','address2','thai_city_id','thai_city','postal_code','tel_number'
  ];


}
