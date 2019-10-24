<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service_orders;
use App\Service_conversations;
use App\Service_messages;
use Auth;
use Carbon\Carbon;
use App\Service_order_proof_of_payments;
use App\Service_order_progress_edit_requests;
use App\Service_order_progress_edit_responses;
use Crypt;
use FileUploader;
use App\Photo;

class ServiceOrdersController extends Controller
{
  public function declineServiceQuote(Request $request,$service_order_id){
    $service_order = Service_orders::where('id',$service_order_id)->first();
    if($service_order->user_id==Auth::user()->id){
        if($service_order->service_order_status_id==1){
          $service_order->service_order_status_id = 7;
          $service_order->save();
          $service_conversation = Service_conversations::where('id',$request->conversation_id)->first();
          $service_message = new Service_messages();
          $service_message->service_conversations_id = $service_conversation->id;
          $service_message->user_id = Auth::user()->id;
          $service_message->message = "ฉันได้ปฏิเสธการเสนอราคางานหมายเลข #".$service_order->id." ของบริการนี้แล้ว";
          $service_message->save();
          $service_conversation->message_update_date = Carbon::now();
          $service_conversation->save();
          }
        }
    return json_encode('true');
  }

  public function acceptServiceQuoteGotoPayment(Request $request,$service_order_id,$order_hash){
    $order = Service_orders::where('id',$service_order_id)->where('service_order_hash',$order_hash)->first();
    return view('service-order-payment',compact('order'));
  }

  public function makeServiceOrderPayment($service_order_id,$order_hash){

    $payment = new Service_order_proof_of_payments();
    $payment->service_order_id = $service_order_id;
    $payment->payment_method_id = 1;
    $payment->amount = 5000;
    $payment->key = "efklfewfewf";
    $payment->payment_datetime = Carbon::now();
    $payment->save();

    $order = Service_orders::where('id',$service_order_id)->where('service_order_hash',$order_hash)->first();
    $order->service_order_status_id = 2;
    $order->save();
    $conversation_id = DashboardController::getServiceConversationId($order->service->id);
    $service_conversation = Service_conversations::where('id',$conversation_id)->first();
    $service_message = new Service_messages();
    $service_message->service_conversations_id = $service_conversation->id;
    $service_message->user_id = Auth::user()->id;
    $service_message->message = "ฉันได้ทำการชำระเงินสำหรับงานหมายเลข #".$service_order_id. " เรียบร้อยแล้ว กรุณาดำเนินงาน".$order->service->name;
    $service_message->save();
    $service_conversation->message_update_date = Carbon::now();
    $service_conversation->save();
    return redirect('/service/messages/'.$conversation_id.'/');
  }

  public function requestServiceOrderProgressforEdit(Request $request){
    $input = $request->all();
    $input['service_order_id']=Crypt::decrypt($request->input('service_order_id'));
    $service_order_progress_edit_request = new Service_order_progress_edit_requests($input);
    $service_order_progress_edit_request->save();

    $service_order = Service_orders::where('id',$input['service_order_id'])->first();
    $service_order->service_order_status_id = 4;
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
             $service_order_progress_edit_request->photos()->attach($upload->id);
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
     $service_message->message = "ฉันต้องการให้แก้ไขงานหมายเลข ".$input['service_order_id']." ของบริการนี้ กรุณากด <a href='/dashboard/service-order/".$input['service_order_id']."' target='_blank'>ดูรายละเอียด</a> เพื่อดูสิ่งที่ฉันต้องการแก้ไข";
     $service_message->save();
     $service_conversation->message_update_date = Carbon::now();
     $service_conversation->save();
     return redirect()->back();
  }

  public static function getServiceOrderEditResponse($request_id){
    return Service_order_progress_edit_responses::where('service_order_progress_edit_request_id',$request_id)->get();
  }

  public function acceptServiceOrderFinalResult(Request $request){
    $service_order_id = Crypt::decrypt($request->enc_order_id);
    $service_order = Service_orders::where('id',$service_order_id)->first();

    if($service_order->user_id==Auth::user()->id){
        if($service_order->service_order_status_id==3){
          $service_order->service_order_status_id = 6;
          $service_order->save();
          $service_conversation = Service_conversations::where('id',$request->conversation_id)->first();
          $service_message = new Service_messages();
          $service_message->service_conversations_id = $service_conversation->id;
          $service_message->user_id = Auth::user()->id;
          $service_message->message = "ฉันยอมรับงานหมายเลข #".$service_order->id." งานนี้เสร็จสิ้นเรียบร้อยแล้ว";
          $service_message->save();
          $service_conversation->message_update_date = Carbon::now();
          $service_conversation->save();
          }
        }
    return json_encode('true');
  }



}
