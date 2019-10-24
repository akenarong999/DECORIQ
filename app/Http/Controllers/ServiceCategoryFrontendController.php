<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_category;
use App\Services;

class ServiceCategoryFrontendController extends Controller
{
  public function index($slug)
  {
    $category = Service_category::where('slug',$slug)->first();
    if($category->parent_category_id==0){
      $subcategory_id = Service_category::where('parent_category_id',$category->id)->pluck('id');
      $subcategories = Service_category::where('parent_category_id',$category->id)->get();
      $services = Services::whereIn('service_category_id',$subcategory_id)->where('service_status_id',2)->orderBy('id','desc')->get();
      return view('service-category',compact('category','services','subcategories'));
    }else{
      $services = Services::where('service_category_id',$category->id)->where('service_status_id',2)->orderBy('id','desc')->get();
      return view('service-category',compact('category','services'));
    }
  }
}
