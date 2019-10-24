<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_messages extends Model
{
  protected $fillable = [
      'message','service_conversations_id','user_id','service_order_id'
  ];

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

  public function service_conversation(){
    return $this->belongsTo('App\Service_conversations','service_conversations_id');
  }
}
