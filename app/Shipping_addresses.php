<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_addresses extends Model
{
  protected $fillable = [
    'user_id', 'firstname', 'lastname','address1','address2','thai_city_id','thai_city','postal_code','tel_number'
  ];
}
