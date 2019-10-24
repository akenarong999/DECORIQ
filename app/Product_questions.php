<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_questions extends Model
{
  protected $fillable = [
      'name', 'resized_name','product_id','user_id', 'question_message','is_approve'
  ];

  public function Products(){
    return $this->belongsTo('App\Products');
  }

  public function user(){
    return $this->belongsTo('App\User','usersId');
  }
}
