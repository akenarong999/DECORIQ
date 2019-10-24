<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_follows extends Model
{
  public $table = "user_follow";

  protected $fillable = [
      'user_id', 'follower_id'
  ];

  public function following(){
    return $this->belongsTo('App\User','user_id');
  }

  public function follower(){
    return $this->belongsTo('App\User','follower_id');
  }


}
