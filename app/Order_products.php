<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_products extends Model
{
  protected $fillable = [
      'name','price','qty','product_id','order_id'
  ];

  public function Product(){
    return $this->belongsTo('App\Products');
  }

  public function Variation(){
    return $this->belongsTo('App\Product_variations');
  }

  public function Product_photos(){
    return $this->hasMany('App\Product_photos','id','product_id');
  }
}
