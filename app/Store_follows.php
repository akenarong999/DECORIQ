<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_follows extends Model
{

  protected $fillable = [
      'store_id','follower_id'
  ];
  public $table = "store_follow";

  public function follower(){
    return $this->belongsTo('App\User','follower_id');
  }
  
}
