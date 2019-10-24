<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_timeline_post_photos extends Model
{
  protected $fillable = [
      'user_timeline_post_id', 'photo_id'
  ];

}
