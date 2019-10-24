<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
  protected $fillable = [
      'user_id','order_email','order_shipping_address_id','order_billing_address_id','order_status_id','order_store_id','order_discount','order_fee','order_total','order_hash','order_note'
  ];

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

  public function status(){
    return $this->belongsTo('App\Order_statuses','order_status_id');
  }

  public function store(){
    return $this->belongsTo('App\Store','order_store_id');
  }

  public function shipping_address(){
    return $this->belongsTo('App\Order_addresses','order_shipping_address_id');
  }
  public function billing_address(){
    return $this->belongsTo('App\Order_addresses','order_billing_address_id');
  }

  public function order_status(){
    return $this->belongsTo('App\Order_statuses','order_status_id');
  }


  public function products(){
    return $this->hasMany('App\Order_products','order_id');
  }

  public function shippings(){
    return $this->hasMany('App\Order_shippings','order_id');
  }

  public function reviews(){
    return $this->hasMany('App\Order_reviews','order_id');
  }


  public function order_timelines(){
    return $this->hasMany('App\Order_timelines','order_id')->orderBy('id','DESC');
  }

  public function order_tracks(){
    return $this->hasOne('App\Order_tracks','order_id');
  }

  public function payments(){
    return $this->hasMany('App\Order_proof_of_payments','order_id');
  }


}
