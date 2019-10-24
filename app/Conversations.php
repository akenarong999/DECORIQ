<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
  protected $fillable = [
      'user_one','user_two','store_id','status'
  ];

  public function messages(){
    return $this->hasMany('App\Messages','conversation_id')->orderBy('id','DESC');
  }
}
