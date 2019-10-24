<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_articles extends Model
{
  protected $fillable = [
      'title','content','store_id','photo_id','is_approve'
  ];

  public function photo(){
    return $this->belongsTo('App\Photo','photo_id');
  }

  public function store(){
    return $this->belongsTo('App\Store','store_id');
  }
}
