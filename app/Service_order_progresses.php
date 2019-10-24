<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order_progresses extends Model
{
  protected $fillable = [
    'service_order_id','service_order_status_id','updater_user_id','description'
  ];

  public function photos(){
      return $this->belongsToMany('App\Photo', 'service_order_progress_photos','service_order_progress_id','photo_id');
    }

    public function status(){
      return $this->belongsTo('App\Service_order_progress_statuses','service_order_progress_status_id');
    }
}
