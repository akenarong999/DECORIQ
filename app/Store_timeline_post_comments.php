<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_timeline_post_comments extends Model
{
  public function commentator(){
    return $this->belongsTo('App\User','commentator_user_id');
  }
}
