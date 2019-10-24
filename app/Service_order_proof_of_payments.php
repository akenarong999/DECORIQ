<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order_proof_of_payments extends Model
{
  protected $fillable = [
      'service_order_id','payment_method_id','amount','key','photo_id','user_id','payment_datetime'
  ];

  public function photo(){
    return $this->belongsTo('App\Photo','photo_id');
  }

  public function payment_method(){
    return $this->belongsTo('App\Payment_methods','payment_method_id');
  }

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }
}
