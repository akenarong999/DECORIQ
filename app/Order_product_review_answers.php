<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product_review_answers extends Model
{
  protected $fillable = [
      'order_review_id','user_id','message'
  ];

  public function user()
    {
      return $this->belongsTo('App\User','user_id');
    }
}
