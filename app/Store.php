<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;
use App\User;
use App\Products;

class Store extends Model
{
  protected $fillable = [
      'name','username','description','photo_id','is_approve','main_address_id','return_address_id','tel_number','facebook_page_link','website'
  ];


public function photo(){
  return $this->belongsTo('App\Photo','photo_id');
}

public function cover_photo(){
  return $this->belongsTo('App\Photo','cover_photo_id');
}

public function main_address(){
  return $this->belongsTo('App\Store_addresses','main_address_id');
}

public function return_address(){
  return $this->belongsTo('App\Store_addresses','return_address_id');
}

public function users(){
  return $this->belongsToMany('App\User');
}

public function products(){
  return $this->hasMany('App\Products');
}

}
