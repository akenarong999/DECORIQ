<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;

class GuestOrderController extends Controller
{
    public function index($order_id,$order_hash){
       $order = Orders::where('id',$order_id)->where('order_hash',$order_hash)->first();
       if($order){
         if($order->user_id=="-"){
            return view('guest.order.verify',compact('order_id','order'));
          }
          else{
            return "กรุณาเข้าสู่ระบบเพื่อดูรายการสั่งซื้อนี้";
          }
        }else{
          return "ไม่มีรายการสั่งซื้อนี้ หรือคุณใส่ข้อมูลไม่ถูกต้อง";
        }
    }

    public function showOrderDetail(Request $request,$order_id,$order_hash){
        $input = $request->all();
        $order = Orders::where('id',$input['order_id'])->where('order_email',$input['order_email'])->where('order_hash',$input['order_hash'])->first();
        if(!is_null($order)){
          return view('guest.order.detail',compact('order_id','order'));
        }else{
          return "ไม่มีรายการสั่งซื้อนี้หรือข้อมูลที่กรอกไม่ถูกต้อง";
        }
    }

    public function OrderReview($order_id,$order_hash){
        $order = Orders::where('id',$order_id)->where('order_hash',$order_hash)->first();
        if(!is_null($order)){
          return view('guest.order.review',compact('order_id','order'));
        }else{
          return "ไม่มีรายการสั่งซื้อนี้หรือข้อมูลที่กรอกไม่ถูกต้อง";
        }
    }
}
