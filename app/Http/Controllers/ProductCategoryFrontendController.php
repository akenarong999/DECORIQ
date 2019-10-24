<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Products;

class ProductCategoryFrontendController extends Controller
{
  public function index($slug)
  {
    $category = Category::where('slug',$slug)->first();
    if($category->category_id==0){
      $subcategory_id = Category::where('category_id',$category->id)->pluck('id');
      $subcategories = Category::where('category_id',$category->id)->get();
      $products = Products::whereIn('category_id',$subcategory_id)->where('product_status_id',2)->where('is_publish',1)->orderBy('id','desc')->get();
      return view('category',compact('category','products','subcategories'));
    }else{
      $products = Products::where('category_id',$category->id)->where('product_status_id',2)->where('is_publish',1)->orderBy('id','desc')->get();
      return view('category',compact('category','products'));
    }
 //   $subCategory = Category::where('slug',$slug)->get();
  }
}
