<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_question_answers extends Model
{
  protected $fillable = [
      'product_question_id', 'store_id','user_id','answer_message'
  ];

  public function Product_questions(){
    return $this->belongsTo('App\Products_questions');
  }

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }
}
