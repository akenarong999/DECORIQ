<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Service_conversations;
use App\Service_messages;
use App\Service_orders;
use DB;
use Auth;
use Carbon\Carbon;

class ServiceMessageController extends Controller
{
  public function index($store_username)
  {
    $store  = Store::where('username',$store_username)->first();
    $service_conversations = Service_conversations::where('store_id',$store->id)->orderBy('message_update_date','desc')->get();
    return view('storemanager.store.service-conversation',compact('store','service_conversations'));
  }

  public function show($store_username,$service_conversation_id)
  {
    $store  = Store::where('username',$store_username)->first();
    $service_conversation = Service_conversations::where('id',$service_conversation_id)->first();
    $user_id = $service_conversation->user->id;
    $service_orders = Service_orders::where('user_id', $user_id)->orderBy('id','desc')->get();
    return view('storemanager.store.service-message',compact('store','service_conversation','service_orders'));
  }

  public function sendMessage(Request $request){
    $service_conversation = Service_conversations::where('id',$request->conversation_id)->first();
    $service_message = new Service_messages();
    $service_message->service_conversations_id = $service_conversation->id;
    $service_message->user_id = Auth::user()->id;
    $service_message->message = $request->message;
    $service_message->save();
    $service_conversation->message_update_date = Carbon::now();
    $service_conversation->save();
    return "true";
  }



  public static function getNewChatMessage(){
    if(isset($_GET['last_message_id'])){

      $last_message_id = $_GET['last_message_id'];
      $conversation_id = $_GET['conversation_id'];
      $result['messages'] = Service_messages::where('service_conversations_id',$conversation_id)->where('id','>',$last_message_id)->get();
      $store_id = Service_conversations::find($conversation_id)->service->store->id;
      if(!empty($result['messages'][0])){
        $result['isstoreowner'] = ServiceMessageController::isOwnStorebyId($store_id,$result['messages'][0]['user_id']);
        if($result['isstoreowner']==true){
          $result['store_photo'] = Service_conversations::find($conversation_id)->store->photo->file;
          $result['store_name'] = Service_conversations::find($conversation_id)->store->name;
        }else{
          $result['user_photo'] = Service_conversations::find($conversation_id)->user->photo->file;
          $result['firstname'] = Service_conversations::find($conversation_id)->user->firstname;
          $result['lastname'] = Service_conversations::find($conversation_id)->user->lastname;
          $result['user_name'] = Service_conversations::find($conversation_id)->user->name;
        }
      }

      return json_encode($result);

    }
  }

  public static function isOwnStorebyId($store_id,$user_id){
    $check = DB::table('store_user')->where('store_id',$store_id)->where('user_id',$user_id)->first();
    if(!empty($check)){
      return true;
    }
    else{
      return false;
    }
  }



}
