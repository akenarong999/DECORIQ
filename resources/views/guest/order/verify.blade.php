@extends('layouts.frontend')

@section('description')
เข้าถึงข้อมูลการสั่งซื้อของคุณได้แม้ไม่เข้าระบบ
@endsection

@section('title')
เข้าระบบรายการสั่งซื้อของคุณ - DECORIQ
@endsection

@section('content')


 <div class="container mt-5 mb-5">
   <div class="row">
     <div class="col-md-12 col-md-offset-3">
       <h2 class="text-center">รายการสั่งซื้อของผู้ที่ไม่ได้เป็นสมาชิก</h2>
       <h5 class="text-center text-gray">เข้าดูการสั่งซื้อสินค้าแม้ไม่ได้เป็นสมาชิกได้ที่นี่</h5>

       <div>
         <form class="form-inline mt-3 p-4 border" method="post" action="/guest-order/<?php echo $order_id; ?>/<?php echo $order->order_hash; ?>/detail">
           @csrf
            <div class="form-group mb-2 offset-2">
              <label for="OrderId">รายการสั่งซื้อ</label>
              <input type="text" name="order_id" readonly class="form-control-plaintext" id="order-id" value="<?php echo $order_id; ?>">
              <input type="hidden" name="order_hash" value="<?php echo $order->order_hash; ?>">
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="inputEmail mr-2">อีเมลที่ใช้ในการสั่งซื้อ</label>
              <input type="email" name="order_email" class="form-control ml-3" id="inputEmail" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary mb-2">ดูรายละเอียด</button>
            </div>
          </form>
      </div>

     </div>
   </div>
 </div>


@endsection
