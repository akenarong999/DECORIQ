<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Service_category extends Model
{

  use Sluggable;

  protected $fillable = [
      'name','description','slug','parent_category_id','profile_photo','cover_photo','icon_photo'
  ];

  public function sluggable()
  {
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }


  public function Category(){
    return $this->belongsTo('App\Service_category','parent_category_id');
  }

  public function service_category_profile_photo(){
    return $this->belongsTo('App\Photo','profile_photo');
  }

  public function service_category_cover_photo(){
    return $this->belongsTo('App\Photo','cover_photo');
  }

  public function service_category_icon_photo(){
    return $this->belongsTo('App\Photo','icon_photo');
  }


}
