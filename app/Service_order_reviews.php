<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order_reviews extends Model
{
  protected $fillable = [
     'service_order_id','service_id','service_name','rating','review_message'
  ];

  public function photos()
    {
      return $this->belongsToMany('App\Photo', 'service_order_review_photos','service_order_review_id','photo_id');
    }

}
