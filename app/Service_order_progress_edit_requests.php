<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order_progress_edit_requests extends Model
{
  protected $fillable = [
      'service_order_id','description'
  ];

  public function photos(){
      return $this->belongsToMany('App\Photo', 'service_order_progress_edit_request_photos','service_order_progress_edit_request_id','photo_id');
  }

  
}
