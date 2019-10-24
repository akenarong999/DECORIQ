<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_timeline_posts extends Model
{
  protected $fillable = [
      'owner_user_id', 'poster_user_id','message'
  ];

  public function owner(){
    return $this->belongsTo('App\User','owner_user_id');
  }

  public function poster(){
    return $this->belongsTo('App\User','poster_user_id');
  }

  public function photos(){
    return $this->belongsToMany('App\Photo', 'user_timeline_post_photos', 'user_timeline_post_id', 'photo_id');
  }

}
