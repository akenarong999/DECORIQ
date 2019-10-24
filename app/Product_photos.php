<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Products;

class Product_photos extends Model
{
  protected $fillable = [
      'name', 'resized_name', 'original_name','product_id','photo_order'
  ];

  public function Products(){
    return $this->belongsToMany('App\Products');
  }
}
