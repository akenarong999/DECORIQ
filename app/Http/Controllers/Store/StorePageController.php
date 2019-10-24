<?php

namespace App\Http\Controllers\Store;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Store_follows;
use App\User;
use App\Products;
use FileUploader;
use App\Store_timeline_posts;
use App\Store_timeline_post_comments;
use App\Store_timeline_post_photos;
use Crypt;
use App\Photo;
use App\Services;
use App\Conversations;
use App\Messages;
use App\Store_articles;

class StorePageController extends Controller
{
  public function index($store_username){
   $store = Store::where('username',$store_username)->first();
   if($store){
     $timeline_posts = Store_timeline_posts::where('store_id',$store->id)->orderBy('id', 'DESC')->get();
     $products = Products::where('store_id',$store->id)->where('is_publish',1)->where('product_status_id',2)->orderBy('id','DESC')->get();
     $services = Services::where('store_id',$store->id)->orderBy('id','DESC')->get();
     $articles = Store_articles::where('store_id',$store->id)->get();
      return view('store.public-storepage.index',compact('store','products','services','timeline_posts','articles'));
    }
    else{
      return abort(404);
    }
  }

  public function article($store_username,$article_id){
   $store = Store::where('username',$store_username)->first();
   if($store){
     if($article_id){
      $article = Store_articles::where('id',$article_id)->first();
      return view('store.public-storepage.article',compact('store','article'));
      }
      else{
        return abort(404);
      }
    }
    else{
      return abort(404);
    }
  }

  public function addNewPost(Request $request,$store_username){
    if(Auth::user()){
      $store = Store::where('username',$store_username)->first();
      $message = $request->message;

      if(!empty($message)){
      $public_path = public_path();
      $uploadDir = $public_path.'/images/';
      // Set up FileUploader
      $FileUploader = new FileUploader('post_photos', array(
        'limit' => null,
        'maxSize' => null,
        'fileMaxSize' => null,
        'extensions' => null,
        'required' => false,
        'uploadDir' => $uploadDir,
        'title' => '{timestamp}_{random}_{random}',
        'replace' => false,
        'editor' => array(
          'maxWidth' => 640,
          'maxHeight' => 480,
          'quality' => 100
        ),
        'listInput' => true,
        'files' => null,
        ));
       $upload = $FileUploader->upload();

       $store_timeline_post = new Store_timeline_posts();
       $store_timeline_post->store_id = $store->id;
       $store_timeline_post->poster_user_id = Auth::user()->id;
       $store_timeline_post->message = $message;
       $store_timeline_post->save();

      if($upload['isSuccess']) {
        $photos = $upload['files'];

        if(!empty($photos[0])){
          for ($i = 0; $i < count($photos); $i++) {
              $photo = $photos[$i];
              $upload = new Photo();
              $upload->file = $photo['name'];
              $upload->save();
              DB::table('store_timeline_post_photos')->insert(
                  ['store_timeline_post_id' => $store_timeline_post->id, 'photo_id' => $upload->id]
                );

          }
        }
      }
      return back();

    }else {
      return back();
    }
  }
}

public function addNewPostComment(Request $request,$post_id){
  if(Auth::user()){
    $post_id = Crypt::decrypt($request->post_id);
    $message = $request->message;
    if($message){
      $store_timeline_post_comments = new Store_timeline_post_comments();
      $store_timeline_post_comments->store_timeline_post_id = $post_id;
      $store_timeline_post_comments->commentator_user_id = Auth::user()->id;
      $store_timeline_post_comments->message = $message;
      $store_timeline_post_comments->save();
      return back();
    }else{
      return back();
    }

  }
}

  public static function checkIfFollowThisStore($store_id){
    if(Auth::user()){
          $user = DB::table('store_follow')->where('follower_id', Auth::user()->id)->where('store_id', $store_id)->first();
          if($user){
            return TRUE;
          }else{
            return FALSE;
          }
      }else{
        return FALSE;
      }
  }

  public static function countFollower($store_id){
    $store_follower =  DB::table('store_follow')->where('store_id',$store_id)->get();
    return count($store_follower);
  }

  public static function getFollower($store_id){
    $store_followers =  Store_follows::where('store_id',$store_id)->get();
    return $store_followers;
  }

  public function doFollow($store_username){
    if(Auth::user()){
      $user_id = Auth::user()->id;
      $user = User::where('id', $user_id)->first();
      $store = Store::where('username', $store_username)->first();
      if(!$user->isFollowingStore($store_username)){
        DB::table('store_follow')->insert(
            ['store_id' => $store->id, 'follower_id' => $user_id]
        );
        return back();
      }
      else{
        return back();
      }
    }else{
      return redirect('/login');
    }
  }

  public function doUnFollow($store_username){
    if(Auth::user()){
      $user_id = Auth::user()->id;
      $user = User::where('id', $user_id)->first();
      $store = Store::where('username', $store_username)->first();
      if($user->isFollowingStore($store_username)){
        DB::table('store_follow')->where('store_id',$store->id)->where('follower_id',$user_id)->delete();
        return back();
      }
      else{
        return back();
      }
    }else{
      return redirect('/login');
    }
  }

  public static function getPostComments($post_id){
    $comments =  Store_timeline_post_comments::where('store_timeline_post_id',$post_id)->get();
    return $comments;
  }

  public static function countAllTimelinePhotos($store_id){
    $posts = Store_timeline_posts::where('store_id',$store_id)->get();
    $i = 0;
    foreach($posts as $post){
      foreach($post->photos as $post_photo){
        $i++;
      }
    }
    return $i;
  }

  public function sendMessage($store_username){

    if(Auth::user()){
      $user = User::where('id', Auth::user()->id)->first();
      $store = Store::where('username', $store_username)->first();

      if($user->checkConversationWithStore($store_username)=="bothempty"){
       $conversation = new Conversations();
       $conversation->user_one = $user->id;
       $conversation->user_two = 0;
       $conversation->store_id = $store->id;
       $conversation->status = 0;
       $conversation->save();
       $messages = new Messages();
       $messages->message = "เริ่มต้นการสนทนา";
       $messages->is_seen = 0;
       $messages->deleted_from_sender	= 0;
       $messages->deleted_from_receiver	= 0;
       $messages->user_id	= $user->id;
       $messages->conversation_id	= $conversation->id;
       $messages->save();
       return redirect('/messenger');
      }
      elseif($user->checkConversationWithStore($store_username)=="haveconversation"){
        $conversation = $user->getConversationWithStore($store_username);
        $messages = new Messages();
        $messages->message = "เริ่มต้นการสนทนา";
        $messages->is_seen = 0;
        $messages->deleted_from_sender	= 0;
        $messages->deleted_from_receiver	= 0;
        $messages->user_id	= $user->id;
        $messages->conversation_id	= $conversation->id;
        $messages->save();
        return redirect('/messenger');
      }else{
        $conversation = $user->getConversationWithStore($store_username);
        $conversation = Conversations::where('id',$conversation->id)->first();
        $conversation->touch();
        return redirect('/messenger');
      }
    }else{
      return redirect('/login');
    }
  }


}
