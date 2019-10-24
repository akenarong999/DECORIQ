<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_timeline_post_comments extends Model
{
  protected $fillable = [
      'user_timeline_post_id', 'commentator_user_id','message'
  ];

  public function commentator(){
    return $this->belongsTo('App\User','commentator_user_id');
  }
}
