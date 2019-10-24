<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
  protected $fillable = [
      'message','is_seen','deleted_from_sender','deleted_from_receiver','user_id','conversation_id'
  ];

  public function Message_photos(){
    return $this->hasMany('App\Message_photos','id','message_id');
  }
}
