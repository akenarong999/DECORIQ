<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Talk;
use Auth;
use App\Conversations;
use App\Messages;
use App\Message_photos;
use App\Store;
use App\User;
use App\Photo;
use Illuminate\Support\Facades\Crypt;
use DB;


class MessengerController extends Controller
{


  public function index()
  {
    $conversations = Talk::user(auth()->user()->id)->threads();
    return view('messenger',compact('conversations'));
  }

  public static function checkConversationStoreid($conversation_id)
  {
    return Conversations::find($conversation_id)->store_id;
  }

  public static function getStoredetail($store_id)
  {
    return Store::find($store_id);
  }

  public static function getConversationlatestmessage($conversation_id)
  {
    return Messages::where('conversation_id',$conversation_id)->orderby('id', 'desc')->first();
  }

  public static function getChatMessage()
  {
     $user_id = Auth::user()->id;
     $receiver_id = $_GET['receiver_id'];
     $store_id = $_GET['store_id'];
     if($store_id==0){
       $result['receiver'] = User::find($receiver_id);
       $result['receiver_id'] = User::find($receiver_id)->id;
       $result['receiver_username'] = User::find($receiver_id)->name;
       if(User::find($receiver_id)->firstname==NULL){
         $result['receiver_name'] = User::find($receiver_id)->name;
       }
       else{
         $result['receiver_name'] = User::find($receiver_id)->firstname.' '.User::find($receiver_id)->lastname.' ('.User::find($receiver_id)->name.')';
       }
       if(User::find($receiver_id)->photo){
         $result['receiver_photo'] = User::find($receiver_id)->photo->file;
       }else{
         $result['receiver_photo'] = "no_avatar.png";
       }
       $result['user_photo'] = Auth::user()->photo->file;

       $conversation = Conversations::where(function ($query) {  $user_id = Auth::user()->id; $receiver_id = $_GET['receiver_id']; $store_id = $_GET['store_id'];
                                                              $query->where('user_one', $user_id)
                                                                  ->where('user_two', $receiver_id);
                                                          })->orWhere(function($query) { $user_id = Auth::user()->id; $receiver_id = $_GET['receiver_id']; $store_id = $_GET['store_id'];
                                                              $query->where('user_one', $receiver_id)
                                                                  ->where('user_two', $user_id);
                                                          })->get();

       $result['messages'] = Messages::where('conversation_id',$conversation[0]->id)->leftjoin('message_photos', 'messages.id', '=', 'message_photos.message_id')->leftjoin('photos', 'photos.id', '=', 'message_photos.photo_id')->select('messages.*','message_photos.*','photos.*','messages.id as messageID','message_photos.id as message_photosID','photos.id as photosID')->get();
       $result['conv_id'] = $conversation[0]->id;
     }else{
       $result['store'] = Store::find($store_id);
       $result['store_id'] = Store::find($store_id)->id;
       $result['store_name'] = Store::find($store_id)->name;
       $result['store_username'] = Store::find($store_id)->username;
       $result['store_photo'] = Store::find($store_id)->photo->file;
       $result['user_photo'] = Auth::user()->photo->file;
       $conversation = Conversations::where(function ($query) {  $user_id = Auth::user()->id;$receiver_id = $_GET['receiver_id']; $store_id = $_GET['store_id'];
                                                              $query->where('user_one', $user_id)
                                                                  ->where('store_id', $store_id);
                                                          })->orWhere(function($query) { $user_id = Auth::user()->id; $receiver_id = $_GET['receiver_id']; $store_id = $_GET['store_id'];
                                                              $query->where('user_one', $receiver_id)
                                                                  ->where('store_id', $store_id);
                                                          })->get();
       $result['messages'] = Messages::where('conversation_id',$conversation[0]->id)->leftjoin('message_photos', 'messages.id', '=', 'message_photos.message_id')->leftjoin('photos', 'photos.id', '=', 'message_photos.photo_id')->select('messages.*','message_photos.*','photos.*','messages.id as messageID','message_photos.id as message_photosID','photos.id as photosID')->get();
       $result['conv_id'] = $conversation[0]->id;
     }

     return json_encode($result);
  }


  public static function sendMessage(Request $request){
    $message = $request->input('message');
    $conversation_id = $request->input('conversation_id');

    Talk::setAuthUserId(auth()->user()->id);
    $message = Talk::sendMessage($conversation_id, $message);

    if($request->file('message_photos')!==NULL){
      $rand = substr(md5(microtime()),rand(0,26),5);
      $imageName = 'message_'.time().'_'.$rand.'_'.$request->file('message_photos')->getClientOriginalName();
      request()->file('message_photos')->move(public_path('images'), $imageName);
      $message_photo = new Photo();
      $message_photo->file = $imageName;
      $message_photo->save();
      DB::table('message_photos')->insert(
        ['message_id' => $message->id, 'photo_id' => $message_photo->id]
      );
      if($message){
        $message="X";
      }
    }
    if ($message) {
      if(isset($imageName)){
        return response()->json(['status'=>'success', 'data'=>$message,'photo_name'=>$imageName], 200);
      }else{
        return response()->json(['status'=>'success', 'data'=>$message], 200);
      }
   }
  }

  public static function getNewChatMessage(){
    if(isset($_GET['last_message_id'])){
    $user_id = Auth::user()->id;
    $receiver_id = $_GET['receiver_id'];
    $store_id = $_GET['store_id'];
    $last_message_id = $_GET['last_message_id'];
    if($store_id==0){
      $result['receiver'] = User::find($receiver_id);
      $result['receiver_id'] = User::find($receiver_id)->id;
      $result['receiver_username'] = User::find($receiver_id)->name;
      if(User::find($receiver_id)->firstname==NULL){
        $result['receiver_name'] = User::find($receiver_id)->name;
      }
      else{
        $result['receiver_name'] = User::find($receiver_id)->firstname.' '.User::find($receiver_id)->lastname.' ('.User::find($receiver_id)->name.')';
      }
      if(User::find($receiver_id)->photo){
        $result['receiver_photo'] = User::find($receiver_id)->photo->file;
      }else{
        $result['receiver_photo'] = "no_avatar.png";
      }
      $result['user_photo'] = Auth::user()->photo->file;
      $conversation = Conversations::where(function ($query) {  $user_id = Auth::user()->id; $receiver_id = $_GET['receiver_id']; $store_id = $_GET['store_id'];
                                                             $query->where('user_one', $user_id)
                                                                 ->where('user_two', $receiver_id);
                                                         })->orWhere(function($query) { $user_id = Auth::user()->id; $receiver_id = $_GET['receiver_id']; $store_id = $_GET['store_id'];
                                                             $query->where('user_one', $receiver_id)
                                                                 ->where('user_two', $user_id);
                                                         })->get();
      $result['messages'] = Messages::where('conversation_id',$conversation[0]->id)->where('messages.id','>',$last_message_id)->leftjoin('message_photos', 'messages.id', '=', 'message_photos.message_id')->leftjoin('photos', 'photos.id', '=', 'message_photos.photo_id')->select('messages.*','message_photos.*','photos.*','messages.id as messageID','message_photos.id as message_photosID','photos.id as photosID')->get();
      $result['conv_id'] = $conversation[0]->id;
    }else{
      $result['store'] = Store::find($store_id);
      $result['store_id'] = Store::find($store_id)->id;
      $result['store_name'] = Store::find($store_id)->name;
      $result['store_username'] = Store::find($store_id)->username;
      $result['store_photo'] = Store::find($store_id)->photo->file;
      $result['user_photo'] = Auth::user()->photo->file;
      $conversation = Conversations::where(function ($query) {  $user_id = Auth::user()->id; $receiver_id = $_GET['receiver_id']; $store_id = $_GET['store_id'];
                                                             $query->where('user_one', $user_id)
                                                                 ->where('store_id', $store_id);
                                                         })->orWhere(function($query) { $user_id = Auth::user()->id; $receiver_id = $_GET['receiver_id']; $store_id = $_GET['store_id'];
                                                             $query->where('user_one', $receiver_id)
                                                                 ->where('store_id', $store_id);
                                                         })->get();
      $result['messages'] = Messages::where('conversation_id',$conversation[0]->id)->where('messages.id','>',$last_message_id)->leftjoin('message_photos', 'messages.id', '=', 'message_photos.message_id')->leftjoin('photos', 'photos.id', '=', 'message_photos.photo_id')->select('messages.*','message_photos.*','photos.*','messages.id as messageID','message_photos.id as message_photosID','photos.id as photosID')->get();
      $result['conv_id'] = $conversation[0]->id;
    }

        $count_new_messages = count($result['messages']);
        if ($count_new_messages!=0) {
          return json_encode($result);
        }
    }
  }

}
