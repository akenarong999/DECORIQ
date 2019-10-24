<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Orders;
use App\Order_statuses;
use App\Order_payment_inform;
use App\Photo;
use Validator;
use Mail;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order_id,$order_hash)
    {
      $order = Orders::where('id',$order_id)->where('order_hash',$order_hash)->first();
      $order_payment_informs = Order_payment_inform::where('order_id',$order->id)->get();
      return view('payment',compact('order','order_payment_informs'));
    }

    public static function getOrderStatus($order_id){
      $order_status = Order_statuses::join('orders','orders.order_status_id','=','order_statuses.id')->select('order_statuses.name','order_statuses.description')->first();
      return $order_status;
    }

    public static function orderPaymentInform(Request $request,$order_id){
      $input = $request->all();
      $input['order_id'] = $order_id;
      $validator = Validator::make($request->all(), [
                'photo_1' => 'mimes:jpeg,png,jpg|max:256',
            ]);
     if ($validator->fails()) {
           return redirect()->back()
                   ->withErrors($validator)
                   ->withInput();
      }
      else{

        $payment_inform = new Order_payment_inform($input);

        if($request->file('photo_1')!==NULL){
          $imageName = time().'_'.request()->file('photo_1')->getClientOriginalName();
          request()->file('photo_1')->move(public_path('images'), $imageName);
          $photo_1 = new Photo();
          $photo_1->file = $imageName;
          $photo_1->save();
          $payment_inform->photo_1 = $photo_1->id;
        }

        $order = Orders::where('id',$order_id)->first();

        if($order->order_email==$input['email']){

            $data = [
              'customer_email' => $input['email'],
              'order_id' => $order_id,
              'paymentamount' => $input['paymentamount'],
              'paymentdate' => $input['paymentdate'],
              'paymenttime' => $input['paymenttime'],
              'paymentinformnote' => $input['paymentinformnote']
            ];


            //send mail to admin
            Mail::send('email.payment-inform-email-admin', $data,
            function ($message) use ($data) {
                  $message->subject('ลูกค้าได้แจ้งชำระเงิน #'.$data['order_id'].' แล้ว');
                  $message->to("decoriq@gmail.com");
            });

            //send mail to customer
            Mail::send('email.payment-inform-email-customer', $data,
            function ($message) use ($data) {
                  $message->subject('ท่านได้แจ้งชำระเงิน #'.$data['order_id'].' แล้ว');
                  $message->to($data['customer_email']);
            });

            $payment_inform->save();
            return redirect()->back()->with('success_message', 'เราได้รับการแจ้งชำระเงินจากท่านแล้ว โปรดให้เวลาสำหรับทีมงานในการตรวจสอบ');
          }else{
            return redirect()->back()->with('unsuccess_message', 'ท่านกรอกอีเมลไม่ตรงกับอีเมล์ของรายการสั่งซื้อนี้ กรุณาลองดูใหม่อีกครั้ง');
          }

      }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
