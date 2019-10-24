<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{

  use Sluggable;

  protected $fillable = [
      'name','description','category_id','profile_photo_id','cover_photo_id','icon_photo_id','slug'
  ];

  public function sluggable()
  {
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }

  public function profile_photo(){
    return $this->belongsTo('App\Photo','profile_photo_id');
  }

  public function cover_photo(){
    return $this->belongsTo('App\Photo','cover_photo_id');
  }

  public function icon_photo(){
    return $this->belongsTo('App\Photo','icon_photo_id');
  }

  public function Category(){
    return $this->belongsTo('App\Category','category_id');
  }

  public function parent_category(){
    return $this->hasOne('App\Category','category_id');
  }


}
