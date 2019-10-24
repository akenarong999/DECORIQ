<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_shippings extends Model
{
  protected $fillable = [
      'shipping_id', 'product_id'
  ];
}
