<?php

namespace App;
use App\Store;
use App\Product_photos;
use App\Order;
use App\Order_reviews;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

use Sluggable;


  protected $fillable = [
      'name', 'short_description', 'long_description','category_id','sku','product_type','sku','price','discount_price','weight','stock','store_id','product_status_id','slug','is_publish'
  ];




    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */



    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }




  public function store(){
    return $this->belongsTo('App\Store');
  }

  public function Product_photos(){
    return $this->hasMany('App\Product_photos','product_id')->orderBy('photo_order');
  }

  public function Order_reviews(){
    return $this->hasMany('App\Order_reviews','product_id');
  }

  public function subCategory(){
    return $this->belongsTo('App\Category','category_id');
  }

  public function Product_shippings(){
    return $this->hasMany('App\Product_shippings','product_id');
  }

  public function shippings()
    {
      return $this->belongsToMany('App\Shipping', 'product_shippings','product_id','shipping_id');
    }

}
