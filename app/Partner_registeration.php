<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner_registeration extends Model
{
  protected $fillable = [
      'name', 'telnumber','email','storename','description','photo_1','photo_2','photo_3'
  ];
}
