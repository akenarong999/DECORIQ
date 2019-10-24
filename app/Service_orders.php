<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_orders extends Model
{
  protected $fillable = [
      'service_id','user_id','service_order_status_id','service_order_billing_address_id','service_order_quote_price','service_order_duedate','service_order_discount','service_order_fee','service_order_total','service_order_conclusion','service_order_hash','service_order_customer_note','service_order_revision_times'
  ];

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

  public function status(){
    return $this->belongsTo('App\Service_order_statuses','service_order_status_id');
  }

  public function service(){
    return $this->belongsTo('App\Services','service_id');
  }

  public function photos(){
      return $this->belongsToMany('App\Photo', 'service_order_photos','service_order_id','photo_id');
    }

    public function edit_requests(){
      return $this->hasMany('App\Service_order_progress_edit_requests','service_order_id')->orderBy('id','desc');
    }

    public function review(){
      return $this->hasOne('App\Service_order_reviews','service_order_id');
    }

    public function store(){
      return $this->belongsTo('App\Store','service_order_store_id');
    }

}
