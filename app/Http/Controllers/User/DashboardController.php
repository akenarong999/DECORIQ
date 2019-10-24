<?php

namespace App\Http\Controllers\User;

use DB;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Controller;
use Auth;
use App\Shipping_addresses;
use App\Orders;
use App\Products;
use App\Product_variations;
use App\Order_statuses;
use Illuminate\Support\Facades\Input;
use App\Order_timelines;
use App\Order_reviews;
use App\Photo;
use App\User;
use FileUploader;
use Hash;
use App\Service_orders;
use App\Service_order_statuses;
use App\Service_conversations;
use App\Service_order_progresses;
use App\Service_order_reviews;


class DashboardController extends Controller
{
  public function index()
  {
    //check if user logged in or not
      if(Auth::check()){
        return view('user.dashboard.profile',compact('$statuses'));
      }
      else{
        return redirect('/login');
      }
  }

  public function address()
  {
    //check if user logged in or not
      if(Auth::check()){
       $shipping_addresses = Shipping_addresses::where('user_id',Auth::user()->id)->get();
        return view('user.dashboard.address', compact('shipping_addresses'));
      }
      else{
        return redirect('/login');
      }
  }

  public function ProductOrders($order_status_id)
  {
    //check if user logged in or not
      if(Auth::check()){
        if($order_status_id!='all'){
          $orders = Orders::where('user_id',Auth::user()->id)->where('order_status_id', $order_status_id)->orderBy('id', 'desc')->paginate(10);
        }else{
          $orders = Orders::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        }
        $all_orders = Orders::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();

          $statuses = NULL;
          $i = 0;
          foreach($all_orders as $all_order){
            $statuses[$i] = $all_order->order_status_id;
            $i++;
          }
          if($statuses!=NULL){
            $statuses = array_count_values($statuses);
            }

        return view('user.dashboard.product-orders', compact('orders','statuses'));
      }
      else{
        return redirect('/login');
      }
  }

  public function reviews()
  {
    //check if user logged in or not
      if(Auth::check()){

        $orders = Orders::where('user_id',Auth::user()->id)->where('order_status_id', 4)->orderBy('id', 'desc')->paginate(10);

        return view('user.dashboard.reviews', compact('orders'));
      }
      else{
        return redirect('/login');
      }
  }

  public function addOrderReview(Request $request,$order_id){
    $product_ids = $request->input('productidarray');
    foreach($product_ids as $product_id){
        $input['order_id'] = $order_id;

        if(strpos($product_id, '-') !== false){
          $temp_product_id = explode("-",$product_id);
          $input['product_id'] = $temp_product_id[0];
          $input['product_variation_id'] = $temp_product_id[1];
        }else{
          $input['product_id'] = $product_id;
        }
        $input['rating'] = $request->input('review-rating-'.$product_id);
        $input['review_message'] = $request->input('review-message-'.$product_id);
        $order_review = Order_reviews::create($input);
        $product_name = Products::find($product_id)->name;

        $public_path = public_path();
        $uploadDir = $public_path.'/images/';

        // Set up FileUploader
        $FileUploader = new FileUploader('review-photo-'.$product_id , array(
          'limit' => null,
          'maxSize' => null,
          'fileMaxSize' => null,
          'extensions' => null,
          'required' => false,
          'uploadDir' => $uploadDir,
          'title' => 'product_order_review_'.$order_id.'_'.$product_name.'_{timestamp}_{random}',
          'replace' => false,
          'editor' => array(
            'maxWidth' => 1200,
            'maxHeight' => 800,
            'quality' => 100
          ),
          'listInput' => true,
          'files' => null,
          ));
         $upload = $FileUploader->upload();
         if($upload['isSuccess']) {
              // get the uploaded files
           $photos = $upload['files'];

           if(!empty($photos[0])){
             for ($i = 0; $i < count($photos); $i++)
             {
                 $photo = $photos[$i];
                 $name = $photo['name'];
                 $upload = new Photo();
                 $upload->file = $name;
                 $upload->save();
                 $order_review->photos()->attach($upload->id);
              }
            }

         } else {
           $warnings = $upload['warnings'];
           var_dump($warnings);
         }
    }

    return redirect()->back();

  }

  public function addServiceOrderReview(Request $request,$service_order_id){

        $service_order = Service_orders::find($service_order_id)->first();
        $input['service_id'] = $service_order->id;
        $input['service_name'] = $service_order->name;
        $input['service_order_id'] = $service_order_id;
        $input['rating'] = $request->input('review-rating-'.$service_order_id);
        $input['review_message'] = $request->input('review-message-'.$service_order_id);
        $service_order_review = Service_order_reviews::create($input);


        $public_path = public_path();
        $uploadDir = $public_path.'/images/';

        // Set up FileUploader
        $FileUploader = new FileUploader('review-photo-'.$service_order_id , array(
          'limit' => null,
          'maxSize' => null,
          'fileMaxSize' => null,
          'extensions' => null,
          'required' => false,
          'uploadDir' => $uploadDir,
          'title' => 'service_order_review_'.$service_order_id.'_{timestamp}_{random}',
          'replace' => false,
          'editor' => array(
            'maxWidth' => 1200,
            'maxHeight' => 800,
            'quality' => 100
          ),
          'listInput' => true,
          'files' => null,
          ));
         $upload = $FileUploader->upload();
         if($upload['isSuccess']) {
              // get the uploaded files
           $photos = $upload['files'];

           if(!empty($photos[0])){
             for ($i = 0; $i < count($photos); $i++)
             {
                 $photo = $photos[$i];
                 $name = $photo['name'];
                 $upload = new Photo();
                 $upload->file = $name;
                 $upload->save();
                 $service_order_review->photos()->attach($upload->id);
              }
            }

         } else {
           $warnings = $upload['warnings'];
           var_dump($warnings);
         }

    return redirect()->back();

  }



  public function ServiceReviews()
  {
    //check if user logged in or not
      if(Auth::check()){

        $service_orders = Service_orders::where('user_id',Auth::user()->id)->where('service_order_status_id', 6)->orderBy('id', 'desc')->paginate(10);

        return view('user.dashboard.service-reviews', compact('service_orders'));
      }
      else{
        return "Not Login";
      }
  }

  public static function getVariationDetail($product_variation_id)
  {
     $product_variation = Product_variations::where('id',$product_variation_id)->first();
     return $product_variation;

  }

  public static function countAllProductOrdersbyUserid(){
    $orders = Orders::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
    return count($orders);
  }

  public static function countAllServiceOrdersbyUserid(){
    $orders = Service_orders::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
    return count($orders);
  }

  public static function countProductOrderbystatus($status_id){
    $orders = Orders::where('order_status_id',$status_id)->where('user_id',Auth::user()->id)->get();
    return count($orders);
  }

  public static function countServiceOrderbystatus($status_id){
    $orders = Service_orders::where('service_order_status_id',$status_id)->where('user_id',Auth::user()->id)->get();
    return count($orders);
  }

  public static function getProductOrderStatusNamebyid($status_id){
    $status_name = Order_statuses::find($status_id)->name;
    return $status_name;
  }

  public static function getServiceOrderStatusNamebyid($status_id){
    $status_name = Service_order_statuses::find($status_id)->name;
    return $status_name;
  }

  public function showOrderDetail($order_id)
  {
    //check if user logged in or not
      if(Auth::check()){

        $order = Orders::where('id',$order_id)->first();

        if(Auth::user()->id==$order->user_id){
          return view('user.dashboard.order-detail', compact('order'));
        }else{
          return "you dont have permission to enter this page";
        }


      }
      else{
        return redirect('/login');
      }
  }

  public function showServiceOrderDetail($service_order_id)
  {
    //check if user logged in or not
      if(Auth::check()){

        $service_order = Service_orders::where('id',$service_order_id)->first();
        $service_order_progresses =Service_order_progresses::where('service_order_id',$service_order->id)->get();

        if(Auth::user()->id==$service_order->user_id){
          return view('user.dashboard.service-order-detail', compact('service_order','service_order_progresses'));
        }else{
          return "you dont have permission to enter this page";
        }


      }
      else{
        return redirect('/login');
      }
  }

  public function SettingsProfile()
  {
    //check if user logged in or not
    if(Auth::check()){

      $user = User::find(Auth::user()->id);
      return view('user.dashboard.settings-profile', compact('user'));
    }
      else{
        return redirect('/login');
      }
  }

  public function SettingsProfilePrivacy()
  {
    //check if user logged in or not
    if(Auth::check()){

      $user = User::find(Auth::user()->id);
      return view('user.dashboard.settings-profile-privacy', compact('user'));
    }
      else{
        return redirect('/login');
      }
  }

  public function changePassword(Request $request)
  {
    //check if user logged in or not
    if(Auth::check()){
      $input = $request->all();
      if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","รหัสผ่านปัจจุบันที่คุณกรอกมาไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","ไม่สามารถใช้รหัสผ่านใหม่ที่ซ้ำกับรหัสผ่านปัจจุบันได้ กรุณาเลือกรหัสผ่านใหม่อีกครั้ง");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","คุณได้เปลี่ยนรหัสผ่านเรียบร้อยแล้ว");
    }
      else{
        return redirect('/login');
      }
  }

  public function updateProfile(Request $request){
    if(Auth::check()){
      $input = $request->all();
      $user = User::find(Auth::user()->id);
      $user->firstname = $input['firstname'];
      $user->lastname = $input['lastname'];
      $user->tel_number = $input['tel_number'];
      $user->save();
      return redirect()->back()->with('success','อัพเดทโปรไฟล์นี้เรียบร้อยแล้ว!');

    }
      else{
        return "Cant update. No authorize to update this profile.";
      }
  }

  public function SettingsProfilePhoto()
  {
    //check if user logged in or not
    if(Auth::check()){

      $user = User::find(Auth::user()->id);
      return view('user.dashboard.settings-profile-photo', compact('user'));
    }
      else{
        return redirect('/login');
      }
  }

  public function updateProfilePhoto(Request $request){
    if(Auth::check()){
      $input = $request->all();
      $profile_photo = $request->file('profilephoto');
      $cover_photo = $request->file('coverphoto');

      $public_path = public_path();
      $uploadDir = $public_path.'/images/';

      if(!is_null($profile_photo)){

      // Set up FileUploader
      $profilephoto = new FileUploader('profilephoto', array(
        'limit' => null,
        'maxSize' => null,
        'fileMaxSize' => null,
        'extensions' => null,
        'required' => false,
        'uploadDir' => $uploadDir,
        'title' => Auth::user()->name.'_{random}',
        'replace' => false,
        'editor' => array(
          'minWidth' => 400,
          'minHeight' => 400,
          'quality' => 80,
          'crop' => true,
        ),
        'listInput' => true,
        'files' => null,
        ));
       $upload = $profilephoto->upload();
       if($upload['isSuccess']) {
            // get the uploaded files
         $photos = $upload['files'];

         if(!empty($photos[0])){
           for ($i = 0; $i < count($photos); $i++) {
               $photo = $photos[$i];
               $upload = new Photo();
               $upload->file = $photo['name'];
               $upload->save();
               $user = User::find(Auth::user()->id);
               $user->photo_id = $upload->id;
               $user->save();
            }
          }

       } else {
         $warnings = $upload['warnings'];
         var_dump($warnings);
       }
     }

      if(!is_null($cover_photo)){
        // Set up FileUploader
        $coverphoto = new FileUploader('coverphoto', array(
          'limit' => null,
          'maxSize' => null,
          'fileMaxSize' => null,
          'extensions' => null,
          'required' => false,
          'uploadDir' => $uploadDir,
          'title' => Auth::user()->name.'_{random}_cover',
          'replace' => false,
          'editor' => array(
            'minWidth' => 1024,
            'minHeight' => 341,
            'quality' => 80,
            'crop' => true,
          ),
          'listInput' => true,
          'files' => null,
          ));
         $upload = $coverphoto->upload();
         if($upload['isSuccess']) {
              // get the uploaded files
           $photos = $upload['files'];

           if(!empty($photos[0])){
             for ($i = 0; $i < count($photos); $i++) {
                 $photo = $photos[$i];
                 $upload = new Photo();
                 $upload->file = $photo['name'];
                 $upload->save();
                 $user = User::find(Auth::user()->id);
                 $user->cover_photo_id = $upload->id;
                 $user->save();
              }
            }

         } else {
           $warnings = $upload['warnings'];
           var_dump($warnings);
         }

      }


      return redirect()->back()->with('success','อัพเดทโปรไฟล์นี้เรียบร้อยแล้ว!');

    }
      else{
        return "Cant update. No authorize to update this profile.";
      }
  }

  public function updateStatusMessage(Request $request){
    if(Auth::check()){
      $user = User::find(Auth::user()->id);
      $user->status_message = $request->input('status_message');
      $user->save();
      return redirect()->back();
    }
  }

  public function showOrderReview($order_id)
  {
    //check if user logged in or not
      if(Auth::check()){

        $order = Orders::where('id',$order_id)->first();

        if(Auth::user()->id==$order->user_id){
          return view('user.dashboard.order_review', compact('order'));
        }else{
          return "you dont have permission to enter this page";
        }


      }
      else{
        return redirect('/login');
      }
  }

  public function showServiceOrderReview($service_order_id)
  {
    //check if user logged in or not
      if(Auth::check()){

        $service_order = Service_orders::where('id',$service_order_id)->first();

        if(Auth::user()->id==$service_order->user_id){
          return view('user.dashboard.service-order-review', compact('service_order'));
        }else{
          return "you dont have permission to enter this page";
        }


      }
      else{
        return redirect('/login');
      }
  }

  public static function orderHasReview($order_id){
    $order_reviews = Order_reviews::where('order_id',$order_id)->get();
    return $order_reviews;
  }

  public static function serviceorderHasReview($service_order_id){
    $service_order_review = Service_order_reviews::where('service_order_id',$service_order_id)->first();
    return $service_order_review;
  }

  public static function getProductPhoto($product_id){
    if(strpos($product_id, '-') !== false){
      //variation product
      $product_id = explode('-', $product_id);
      $product_variation_id = $product_id[1];
      $product_variation = Product_variations::where('id',$product_variation_id)->first();
      if($product_variation->photo){
        return $product_variation->photo->file;
      }else{
        return "no_product_photo.png";
      }
    }
    else{
      //single product
      $product = Products::where('id',$product_id)->first();
      return $product->Product_photos[0]->name;
    }
  }

  public function setOrderreceived($order_id){
    Orders::find($order_id)->update(['order_status_id'=>4]);
    $order_timeline['order_id']=$order_id;;
    $order_timeline['message']='ผู้ซื้อได้รับสินค้าเรียบร้อยแล้ว';
    Order_timelines::create($order_timeline);
    return json_encode("success");
  }

  public function cancelOrder($order_id,$order_hash){
    $order = Orders::where('id',$order_id)->where('order_hash',$order_hash)->where('order_status_id','1')->first();
    if(sizeof($order)!=0){
      $order_timeline['order_id']=$order->id;;
      $order_timeline['message']='ได้ถูกยกเลิกแล้ว';
      Order_timelines::create($order_timeline);

      Orders::find($order_id)->update(['order_status_id'=>5]);
      return redirect()->back();
    }else{
      echo "this order can't be cancel";
    }
  }



  public function ServiceOrders($service_order_status_id)
  {
    //check if user logged in or not
      if(Auth::check()){
        if($service_order_status_id!='all'){
          $orders = Service_orders::where('user_id',Auth::user()->id)->where('service_order_status_id', $service_order_status_id)->orderBy('id', 'desc')->paginate(10);
        }else{
          $orders = Service_orders::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        }
        $all_orders = Service_orders::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();

          $statuses = NULL;
          $i = 0;
          foreach($all_orders as $all_order){
            $statuses[$i] = $all_order->service_order_status_id;
            $i++;
          }
          if($statuses!=NULL){
            $statuses = array_count_values($statuses);
            }
        return view('user.dashboard.service-orders', compact('orders','statuses'));
      }
      else{
        return redirect('/login');
      }
  }


  public static function getServiceConversationId($service_order_id){
    $conversation = Service_conversations::where('service_id',$service_order_id)->where('user_id',Auth::user()->id)->first();
    return $conversation->id;
  }



}
