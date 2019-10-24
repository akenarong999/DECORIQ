<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_conversations extends Model
{
  protected $fillable = [
      'service_id','user_id','store_id'
  ];

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

  public function store(){
    return $this->belongsTo('App\Store','store_id');
  }

  public function service(){
    return $this->belongsTo('App\Services','service_id');
  }

  public function messages(){
    return $this->hasMany('App\Service_messages','service_conversations_id');
  }

  public function service_conversation(){
    return $this->belongsTo('App\Services','service_id');
  }

}
