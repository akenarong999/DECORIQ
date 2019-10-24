<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message_photos extends Model
{
  protected $fillable = [
      'message_id', 'photo_id'
  ];
}
