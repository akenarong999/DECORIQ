<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_timeline_posts extends Model
{
  protected $fillable = [
      'store_id', 'poster_user_id', 'message'
  ];

  public function store(){
    return $this->belongsTo('App\Store','store_id');
  }

  public function photos(){
    return $this->belongsToMany('App\Photo', 'store_timeline_post_photos', 'store_timeline_post_id', 'photo_id');
  }
}
