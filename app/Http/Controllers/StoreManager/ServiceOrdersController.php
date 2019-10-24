<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service_orders;
use Crypt;
use FileUploader;
use App\Photo;
use App\Service_conversations;
use App\Service_messages;
use App\Services;
use App\Service_order_progresses;
use App\Service_order_statuses;
use Auth;
use App\Store;
use Carbon\Carbon;
use DateTime;
use App\Service_order_progress_edit_requests;
use App\Service_order_progress_edit_responses;

class ServiceOrdersController extends Controller
{

  public function index($store_username,$order_status_id)
  {
    $store = Store::where('username',$store_username)->firstOrFail();
    if($order_status_id!='all'){
      $orders = Service_orders::where('service_order_store_id',$store->id)->where('service_order_status_id', $order_status_id)->orderBy('id', 'desc')->get();
    }else{
      $orders = Service_orders::where('service_order_store_id',$store->id)->orderBy('id', 'desc')->get();
    }
    $all_orders = Service_orders::where('service_order_store_id',$store->id)->orderBy('id', 'desc')->get();

    $i = 0;
    foreach($all_orders as $all_order){
      $statuses[$i] = $all_order->service_order_status_id;
      $i++;
    }
    if(isset($statuses)){
      $statuses = array_count_values($statuses);
    }
    return view('storemanager.store.service-orders',compact('store','orders','statuses'));
  }

  public static function getServiceOrderstatusnamebyid($status_id){
    $status_name = Service_order_statuses::find($status_id)->name;
    return $status_name;
  }

  public static function countServiceOrderbystatus($status_id,$store_id){
    $orders = Service_orders::where('service_order_status_id',$status_id)->where('service_order_store_id', $store_id)->get();
    return count($orders);
  }

  public static function countAllServiceOrdersbystoreid($store_id){
    $orders = Service_orders::where('service_order_store_id',$store_id)->orderBy('id', 'desc')->get();
    return count($orders);
  }

  public function showOrderDetail(Request $request,$store_username,$service_order_id){
    $service_order = Service_orders::where('id',$service_order_id)->first();
    $store = Store::find($service_order->service->store->id);
    $service_order_progresses = Service_order_progresses::where('service_order_id',$service_order->id)->orderBy('id','desc')->get();
    return view('storemanager.store.service-order-detail',compact('service_order','store','service_order_progresses'));

  }

  public function CreateServiceQuote(Request $request){
    $input = $request->all();
    $input['service_id']=Crypt::decrypt($request->input('service_id'));
    $input['user_id']=Crypt::decrypt($request->input('user_id'));

    $service = Services::find($input['service_id'])->first();

    $duedate = new DateTime();
    $input['service_order_duedate']=$duedate->format('Y-m-d H:i:s');


    $input['service_order_status_id']=1;
    $input['service_order_hash']=substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 6);
    $input['service_order_revision_times'] = $service->revision_time;
    $service_order = new Service_orders($input);
    $service_order->save();

    $public_path = public_path();
    $uploadDir = $public_path.'/images/';

    // Set up FileUploader
    $FileUploader = new FileUploader('service-order-photo-'.$input['service_id'] , array(
      'limit' => null,
      'maxSize' => null,
      'fileMaxSize' => null,
      'extensions' => null,
      'required' => false,
      'uploadDir' => $uploadDir,
      'title' => 'service_'.$input['service_id'].'_{timestamp}_{random}',
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
             $service_order->photos()->attach($upload->id);
          }
        }

     } else {
       $warnings = $upload['warnings'];
       var_dump($warnings);
     }

     $service_conversation = Service_conversations::where('id',Crypt::decrypt($request->conversation_id))->first();
     $service_message = new Service_messages();
     $service_message->service_conversations_id = $service_conversation->id;
     $service_message->user_id = Auth::user()->id;
     $service_message->message = "ฉันได้เสนอราคา ".$input['service_order_quote_price']." บาท (งานหมายเลข #".$service_order->id.") สำหรับบริการ".$service->name."นี้ กรุณาตอบรับการเสนอราคานี้";
     $service_message->save();
     $service_conversation->message_update_date = Carbon::now();
     $service_conversation->save();
     return redirect()->back();
  }

  public function cancelServiceQuote(Request $request,$store_username,$service_order_id){
    $service_order = Service_orders::where('id',$service_order_id)->first();
    if($service_order->service_order_status_id==1){
      $service_order->service_order_status_id = 8;
      $service_order->save();
      $service_conversation = Service_conversations::where('id',$request->conversation_id)->first();
      $service_message = new Service_messages();
      $service_message->service_conversations_id = $service_conversation->id;
      $service_message->user_id = Auth::user()->id;
      $service_message->message = "ฉันได้ยกเลิกการเสนอราคางานหมายเลข #".$service_order->id." ของบริการนี้แล้ว";
      $service_message->save();
      $service_conversation->message_update_date = Carbon::now();
      $service_conversation->save();
      }
    return json_encode("TRUE");
  }


  public function acceptCustomerEditRequest(Request $request,$store_username,$service_order_id){
    $service_order = Service_orders::where('id',$service_order_id)->first();
    if($service_order->service_order_status_id==4){
      $service_order->service_order_revision_times = $service_order->service_order_revision_times-1;
      $service_order->service_order_status_id = 5;
      $service_order->save();
      $service_conversation = Service_conversations::where('id',$request->conversation_id)->first();
      $service_message = new Service_messages();
      $service_message->service_conversations_id = $service_conversation->id;
      $service_message->user_id = Auth::user()->id;
      $service_message->message = "ฉันตกลงแก้ไขงานหมายเลข #".$service_order->id." นี้ กรุณารออัพเดทการแก้ไข";
      $service_message->save();
      $service_conversation->message_update_date = Carbon::now();
      $service_conversation->save();
      }
    return json_encode("TRUE");
  }

  public function rejectCustomerEditRequest(Request $request,$store_username,$service_order_id){
    $service_order = Service_orders::where('id',$service_order_id)->first();
    $service_order_progress_edit_request = Service_order_progress_edit_requests::where('service_order_id',$service_order->id)->orderBy('id','desc')->first();
    $service_order_progress_edit_request->delete();
    if($service_order->service_order_status_id==4){
      $service_order->service_order_status_id = 3;
      $service_order->save();
      $service_conversation = Service_conversations::where('id',$request->conversation_id)->first();
      $service_message = new Service_messages();
      $service_message->service_conversations_id = $service_conversation->id;
      $service_message->user_id = Auth::user()->id;
      $service_message->message = "ฉันขอปฏิเสธแก้ไขงานหมายเลข #".$service_order->id." นี้ ด้วยเหตุผลคือ ".$request->text['value'];
      $service_message->save();
      $service_conversation->message_update_date = Carbon::now();
      $service_conversation->save();
      }
    return json_encode("TRUE");
  }


  public static function getServiceConversationIdbyServiceIdandUserId($service_id,$user_id){
    $conversation = Service_conversations::where('service_id',$service_id)->where('user_id',$user_id)->first();
    return $conversation->id;
  }

  public function updateServiceOrderProgress(Request $request){

    $input = $request->all();
    $input['service_order_id']=Crypt::decrypt($request->input('service_order_id'));

    $service_order_progress = new Service_order_progresses();
    $service_order_progress->service_order_id = $input['service_order_id'];
    $service_order_progress->service_order_progress_status_id	 = $input['service_order_progress_status_id'];
    $service_order_progress->updater_user_id = Auth::user()->id;
    $service_order_progress->description =  $input['description'];
    $service_order_progress->save();

    $service_order = Service_orders::where('id',$input['service_order_id'])->first();



    $public_path = public_path();
    $uploadDir = $public_path.'/images/';

    // Set up FileUploader
    $FileUploader = new FileUploader('service-order-progress-photo' , array(
      'limit' => null,
      'maxSize' => null,
      'fileMaxSize' => null,
      'extensions' => null,
      'required' => false,
      'uploadDir' => $uploadDir,
      'title' => 'service_progress_'.$input['service_order_id'].'_{timestamp}_{random}',
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
             $service_order_progress->photos()->attach($upload->id);
          }
        }

     } else {
       $warnings = $upload['warnings'];
       var_dump($warnings);
     }



     if($input['service_order_progress_status_id']==2){
       $service_order->service_order_status_id = 3;
       $service_order->save();

       /* Send message on service conversation about update progress */
       $service_conversation = Service_conversations::where('id',Crypt::decrypt($request->conversation_id))->first();
       $service_message = new Service_messages();
       $service_message->service_conversations_id = $service_conversation->id;
       $service_message->user_id = Auth::user()->id;
       $service_message->message = "ฉันทำงานหมายเลข #".$input['service_order_id']." เสร็จเรียบร้อยแล้ว กรุณากดดูรายละเอียด เพื่อตรวจสอบผลงาน";
       $service_message->save();
       $service_conversation->message_update_date = Carbon::now();
       $service_conversation->save();
       return redirect()->back();
     }else{
       /* Send message on service conversation about update progress */
       $service_conversation = Service_conversations::where('id',Crypt::decrypt($request->conversation_id))->first();
       $service_message = new Service_messages();
       $service_message->service_conversations_id = $service_conversation->id;
       $service_message->user_id = Auth::user()->id;
       $service_message->message = "ฉันได้อัพเดทความคืบหน้าของงานหมายเลข #".$input['service_order_id']." กรุณากดดูรายละเอียด เพื่อตรวจสอบงาน";
       $service_message->save();
       $service_conversation->message_update_date = Carbon::now();
       $service_conversation->save();
       return redirect()->back();
     }

  }

  public function responseServiceOrderProgressforEdit(Request $request,$store_username,$service_order_id){
    $input = $request->all();
    $input['service_order_id'] = Crypt::decrypt($request->input('service_order_id'));
    $service_order_progress_edit_response = new Service_order_progress_edit_responses();
    $service_order_progress_edit_response->service_order_progress_edit_request_id = Crypt::decrypt($request->input('service_order_progress_edit_request_id'));
    $service_order_progress_edit_response->updater_user_id = Auth::user()->id;
    $service_order_progress_edit_response->description = $request->input('description');
    $service_order_progress_edit_response->save();

    $service_order = Service_orders::where('id',$input['service_order_id'])->first();
    $service_order->service_order_status_id = 3;
    $service_order->save();

    $public_path = public_path();
    $uploadDir = $public_path.'/images/';

    // Set up FileUploader
    $FileUploader = new FileUploader('service-order-progress-edit-request-photo' , array(
      'limit' => null,
      'maxSize' => null,
      'fileMaxSize' => null,
      'extensions' => null,
      'required' => false,
      'uploadDir' => $uploadDir,
      'title' => 'service_order_progress_edit_request_'.$input['service_order_id'].'_{timestamp}_{random}',
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
             $service_order_progress_edit_response->photos()->attach($upload->id);
          }
        }

     } else {
       $warnings = $upload['warnings'];
       var_dump($warnings);
     }

     $service_conversation = Service_conversations::where('id',Crypt::decrypt($request->conversation_id))->first();
     $service_message = new Service_messages();
     $service_message->service_conversations_id = $service_conversation->id;
     $service_message->user_id = Auth::user()->id;
     $service_message->message = "ฉันได้แก้ไขงานหมายเลข ".$input['service_order_id']." แล้ว กรุณากด 'ดูรายละเอียด' เพื่อดูสิ่งที่ฉันได้แก้ไข";
     $service_message->save();
     $service_conversation->message_update_date = Carbon::now();
     $service_conversation->save();
     return redirect()->back();
  }

  public function acceptServiceOrderEdit(){

  }

  public static function getServiceOrderEditResponse($request_id){
    return Service_order_progress_edit_responses::where('service_order_progress_edit_request_id',$request_id)->get();
  }

}
