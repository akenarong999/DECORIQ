<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order_progress_edit_responses extends Model
{
  protected $fillable = [
      'service_order_progress_edit_request_id	','description','updater_user_id'
  ];

  public function photos(){
      return $this->belongsToMany('App\Photo', 'service_order_progress_edit_response_photos','service_order_progress_edit_response_id','photo_id');
  }
}
