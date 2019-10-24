<?php

namespace App;
use App\photos;
use App\products;
use App\Orders;

use Illuminate\Database\Eloquent\Model;

class Order_reviews extends Model
{
  protected $fillable = [
      'order_id','product_id','product_variation_id','rating','review_message'
  ];

  public function photos()
    {
      return $this->belongsToMany('App\Photo', 'order_reviews_photos','order_review_id','photo_id');
    }

    public function products()
      {
        return $this->belongsTo('App\Products', 'product_id');
      }

    public function orders()
      {
        return $this->belongsTo('App\Orders','order_id');
      }


}
