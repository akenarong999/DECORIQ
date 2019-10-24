<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webelement_components extends Model
{
  protected $fillable = [
      'component_name', 'component_value','component_page'
  ];
}
