<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use App\User_follows;
use App\User_timeline_posts;
use App\User_timeline_post_comments;
use App\Photo;
use Crypt;
use FileUploader;
use App\Conversations;
use App\Messages;

class UserPageController extends Controller
{
  public function index($user_name){
   $user = User::where('name',$user_name)->first();
   if($user){
    $timeline_posts = User_timeline_posts::where('owner_user_id',$user->id)->orderBy('id', 'DESC')->get();
    return view('user.public-userpage.index',compact('user','timeline_posts'));
    }
    else{
      return abort(404);
    }
  }

  public function addNewPost(Request $request,$user_name){
    if(Auth::user()){
      $user = User::where('name',$user_name)->first();
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


      $user_timeline_post = new User_timeline_posts();
      $user_timeline_post->owner_user_id = $user->id;
      $user_timeline_post->poster_user_id = Auth::user()->id;
      $user_timeline_post->message = $message;
      $user_timeline_post->save();

      if($upload['isSuccess']) {
        $photos = $upload['files'];

        if(!empty($photos[0])){
          for ($i = 0; $i < count($photos); $i++) {
              $photo = $photos[$i];
              $upload = new Photo();
              $upload->file = $photo['name'];
              $upload->save();
              DB::table('user_timeline_post_photos')->insert(
                  ['user_timeline_post_id' => $user_timeline_post->id, 'photo_id' => $upload->id]
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
        $user_timeline_post_comments = new User_timeline_post_comments();
        $user_timeline_post_comments->user_timeline_post_id = $post_id;
        $user_timeline_post_comments->commentator_user_id = Auth::user()->id;
        $user_timeline_post_comments->message = $message;
        $user_timeline_post_comments->save();
        return back();
      }else{
        return back();
      }

    }
  }

  public static function checkIfFollowThisUser($user_id){
    if(Auth::user()){
      $user = DB::table('user_follow')->where('follower_id', Auth::user()->id)->where('user_id',$user_id)->first();
      if($user){
        return TRUE;
      }else{
        return FALSE;
      }
  }else{
    return FALSE;
  }
  }

  public function doFollow($user_name){
    if(Auth::user()){
      $user = User::where('name',$user_name)->first();
      if(!$user->isFollowing($user_name)){
        DB::table('user_follow')->insert(
            ['user_id' => $user->id, 'follower_id' => Auth::user()->id]
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

  public function doUnFollow($user_name){
    if(Auth::user()){
      $user = User::where('name',$user_name)->first();
      if($user->isFollowing($user_name)){
        DB::table('user_follow')->where('user_id',$user->id)->where('follower_id',Auth::user()->id)->delete();
        return back();
      }
      else{
        return back();
      }
    }else{
      return redirect('/login');
    }
  }

  public static function countFollowing($user_id){
   $user_following = DB::table('user_follow')->where('follower_id',$user_id)->get();
   return count($user_following);
  }

  public static function countFollower($user_id){
    $user_follower =  DB::table('user_follow')->where('user_id',$user_id)->get();
    return count($user_follower);
  }

  public static function countAllTimelinePhotos($user_id){
    $posts = User_timeline_posts::where('owner_user_id',$user_id)->get();
    $i = 0;
    foreach($posts as $post){
      foreach($post->photos as $post_photo){
        $i++;
      }
    }
    return $i;
  }

  public static function getFollowing($user_id){
   $user_following = User_follows::where('follower_id',$user_id)->get();
   return $user_following;
  }

  public static function getFollower($user_id){
    $user_follower =  User_follows::where('user_id',$user_id)->get();
    return $user_follower;
  }

  public static function getPostComments($post_id){
    $comments =  User_timeline_post_comments::where('user_timeline_post_id',$post_id)->get();
    return $comments;
  }



  public function sendMessage($user_2_name){

    if(Auth::user()){
      $user_1 = User::where('id', Auth::user()->id)->first();
      $user_2 = User::where('name', $user_2_name)->first();

      if($user_1->checkConversationWithUser($user_2_name)=="bothempty"){
       $conversation = new Conversations();
       $conversation->user_one = $user_1->id;
       $conversation->user_two = $user_2->id;
       $conversation->store_id = 0;
       $conversation->status = 0;
       $conversation->save();
       $messages = new Messages();
       $messages->message = "เริ่มต้นการสนทนา";
       $messages->is_seen = 0;
       $messages->deleted_from_sender	= 0;
       $messages->deleted_from_receiver	= 0;
       $messages->user_id	= $user_1->id;
       $messages->conversation_id	= $conversation->id;
       $messages->save();
       return redirect('/messenger');
      }
      elseif($user_1->checkConversationWithUser($user_2_name)=="haveconversation-1"){
        $conversation = $user_1->getConversationWithUserOne($user_2_name);
        $messages = new Messages();
        $messages->message = "เริ่มต้นการสนทนา";
        $messages->is_seen = 0;
        $messages->deleted_from_sender	= 0;
        $messages->deleted_from_receiver	= 0;
        $messages->user_id	= $user_1->id;
        $messages->conversation_id	= $conversation->id;
        $messages->save();
        return redirect('/messenger');
      }
      elseif($user_1->checkConversationWithUser($user_2_name)=="haveconversation-2"){
        $conversation = $user_1->getConversationWithUserTwo($user_2_name);
        $messages = new Messages();
        $messages->message = "เริ่มต้นการสนทนา";
        $messages->is_seen = 0;
        $messages->deleted_from_sender	= 0;
        $messages->deleted_from_receiver	= 0;
        $messages->user_id	= $user_1->id;
        $messages->conversation_id	= $conversation->id;
        $messages->save();
        return redirect('/messenger');
      }
      else{
        $conversation_id = $this->getUserConversationId($user_1,$user_2);
        $conversation = Conversations::where('id',$conversation_id)->first();
        $conversation->touch();
        return redirect('/messenger');
      }
    }else{
      return redirect('/login');
    }
  }

  public static function getUserConversationId($user_1,$user_2){
    $conversation =  DB::table('conversations')->where('user_one',$user_1->id)->where('user_two',$user_2->id)->first();
    if($conversation==NULL){
      $conversation =  DB::table('conversations')->where('user_one',$user_2->id)->where('user_two',$user_1->id)->first();
      if($conversation!=NULL){
        return $conversation->id;
      }
    }else{
      return $conversation->id;
    }
  }


}
