<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Product_photos;
use App\Products;
use App\Product_questions;
use App\Http\Requests\AddProductQuestionRequest;
use App\Category;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product_variations;
use App\Product_question_answers;
use Illuminate\Support\Facades\Crypt;
use Session;
use App\Webelement_homepage_slider_photos;
use App\Webelement_components;
use App\Services;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    $new_products = Products::orderBy('id','desc')->where('product_status_id','2')->where('is_publish','1')->limit(6)->get();
         $slide_photos = Webelement_homepage_slider_photos::all();
         $featured_categories_id = Webelement_components::where('component_name','featured_product_categories')->where('component_page','homepage')->pluck('component_value');
         $featured_categories_ids = explode(',',$featured_categories_id[0]);
         $featured_categories = Category::whereIn('id',$featured_categories_ids)->get();
         $featured_product_id = Webelement_components::where('component_name','featured_products')->where('component_page','homepage')->pluck('component_value');
         $featured_product_ids = explode(',',$featured_product_id[0]);
         $featured_products = Products::whereIn('id',$featured_product_ids)->where('product_status_id','2')->where('is_publish','1')->get()->shuffle();
         $featured_service_id = Webelement_components::where('component_name','featured_services')->where('component_page','homepage')->pluck('component_value');
         $featured_service_ids = explode(',',$featured_service_id[0]);
         $featured_services = Services::whereIn('id',$featured_service_ids)->get();
         return view('home',compact('new_products','slide_photos','featured_categories','featured_products','featured_services'));
    }


}
