<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use App\Store;
use App\Service_photos;
use App\Service_conversations;
use Auth;

class ServiceFrontendController extends Controller
{
  public function index($slug)
  {
    $service = Services::where('slug',$slug)->first();
    $store = Store::where('id',$service->store_id)->first();
    $service_photos = Service_photos::where('service_id',$service->id)->orderBy('photo_order','asc')->get();

    return view('service',compact('service','store','service_photos'));
  }

  public static function getServiceConversationId($service_order_id){
    $conversation = Service_conversations::where('service_id',$service_order_id)->where('user_id',Auth::user()->id)->first();
    return $conversation->id;
  }

  public function showServiceMainPage(){
    $new_services = Services::orderBy('id','desc')->where('service_status_id','2')->where('is_publish','1')->limit(20)->get();
    return view('service-main-page',compact('new_services'));
  }
}
