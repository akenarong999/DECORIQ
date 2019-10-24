<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_variations extends Model
{
  protected $fillable = [
      'name','price','discount_price','weight','stock','product_id','photo_id'
  ];

  public function photo(){
    return $this->belongsTo('App\Photo', 'photo_id');
  }
}
