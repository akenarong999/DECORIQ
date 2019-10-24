<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Store;
use Auth;
use DB;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','is_active','photo_id','cover_photo_id','status_message','tel_number','firstname','lastname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
      return $this->belongsTo('App\Role');
    }

    public function photo(){
      return $this->belongsTo('App\Photo','photo_id');
    }

    public function cover_photo(){
      return $this->belongsTo('App\Photo','cover_photo_id');
    }

    public function stores(){
      return $this->belongsToMany('App\Store');
    }


    public function isAdmin(){
      $adminrole = strtolower($this->role->name);
      if($adminrole=='administrator'){
        return true;
      }else{
        return false;
      }
    }

    public function isStoreManager(){
      $storemanagerrole_id = strtolower($this->role->id);
      if($storemanagerrole_id=='2'){
        return true;
      }else{
        return false;
      }
    }



    public function isOwnStore($store_username){
      $store_id = Store::where('username',$store_username)->first()->id;
      $user_id = Auth::id();
      $check = DB::table('store_user')->where('store_id',$store_id)->where('user_id',$user_id)->first();
      if($check){
        return true;
      }
      else{
        return false;
      }
    }

    public function isFollowing($user_name){
      $user = User::where('name',$user_name)->first();
      $user_id = $user->id;
      $follower_id = Auth::id();
      $check = DB::table('user_follow')->where('user_id',$user_id)->where('follower_id',$follower_id)->first();
      if($check){
        return true;
      }
      else{
        return false;
      }

    }

    public function isFollowingStore($store_username){
      $store = Store::where('username',$store_username)->first();
      $store_id = $store->id;
      $follower_id = Auth::id();
      $check = DB::table('store_follow')->where('store_id',$store_id)->where('follower_id',$follower_id)->first();
      if($check){
        return true;
      }
      else{
        return false;
      }

    }

    public function checkConversationWithStore($store_username){
      $store = Store::where('username',$store_username)->first();
      $user_id = Auth::id();
      $conversation = DB::table('conversations')->where('user_one',$user_id)->where('store_id',$store->id)->first();
      if($conversation!=NULL){
        $message = DB::table('messages')->where('conversation_id',$conversation->id)->first();
        if($message){
          return "haveboth";
        }else{
          return "haveconversation";
        }
      }else{
        return "bothempty";
      }

    }



    public function getConversationWithStore($store_username){
      $store = Store::where('username',$store_username)->first();
      $user_id = Auth::id();
      $conversation = DB::table('conversations')->where('user_one',$user_id)->where('store_id',$store->id)->first();
      return $conversation;
    }

    public function checkConversationWithUser($user_2_name){
      $user_1 = User::where('id',Auth::id())->first();
      $user_2 = User::where('name',$user_2_name)->first();

      $conversation1 = DB::table('conversations')->where('user_one',$user_1->id)->where('user_two',$user_2->id)->first();
      $conversation2 = DB::table('conversations')->where('user_one',$user_2->id)->where('user_two',$user_1->id)->first();
      if($conversation1!=NULL){
        $message = DB::table('messages')->where('conversation_id',$conversation1->id)->first();
        if($message){
          return "haveboth";
        }else{
          return "haveconversation-1";
        }
      }elseif($conversation2!=NULL){
        $message = DB::table('messages')->where('conversation_id',$conversation2->id)->first();
        if($message){
          return "haveboth";
        }else{
          return "haveconversation-2";
        }
      }
      else{
        return "bothempty";
      }

    }

    public function getConversationWithUserOne($user_name){
      $user_1 = User::where('id',Auth::id())->first();
      $user_2 = User::where('name',$user_name)->first();
      $conversation = DB::table('conversations')->where('user_one',$user_1->id)->where('user_two',$user_2->id)->first();
      return $conversation;
    }

    public function getConversationWithUserTwo($user_name){
      $user_1 = User::where('id',Auth::id())->first();
      $user_2 = User::where('name',$user_name)->first();
      $conversation = DB::table('conversations')->where('user_one',$user_2->id)->where('user_two',$user_1->id)->first();
      return $conversation;
    }


}
