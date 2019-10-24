<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Services extends Model
{

  use Sluggable;

  protected $fillable = [
      'id', 'store_id', 'name','start_price','service_category_id','description','requirement','work_duration','revision_time	','after_service_support_duration','after_service_support_description','allowlocations','notallowlocations','service_status_id','is_publish','slug'
  ];

  public function sluggable()
  {
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }


    public function subCategory(){
      return $this->belongsTo('App\Service_category','service_category_id');
    }

  public function service_photos(){
    return $this->hasMany('App\Service_photos','service_id')->orderBy('photo_order');
  }

  public function service_status(){
    return $this->belongsTo('App\Service_status');
  }

  public function store(){
    return $this->belongsTo('App\Store');
  }

  public function service_conversations(){
    return $this->hasMany('App\Service_conversations','service_id','id');
  }

}
