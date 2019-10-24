<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Shipping extends Model
{
  protected $fillable = [
      'name','type','cost','store_id','photo_id','allowlocations','notallowlocations','description','private_description'
  ];

  public function photo(){
    return $this->belongsTo('App\Photo');
  }
}
