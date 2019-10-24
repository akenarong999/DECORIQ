<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
  protected $fillable = [
      'title', 'content', 'photo_id','user_id','is_publish','slug'
  ];


  public function sluggable()
  {
      return [
          'slug' => [
              'source' => 'title'
          ]
      ];
  }

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

  public function photo(){
    return $this->belongsTo('App\Photo','photo_id');
  }



}
