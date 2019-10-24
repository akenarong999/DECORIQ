@extends('layouts.frontend')

@section('title')
การชำระเงิน - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\PaymentController; ?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
        <h2><i class="themify ti ti-credit-card font-weight-bold mt-1"></i> การชำระเงิน</h2>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col">
      @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
      @endif

      @if(session()->has('unsuccess_message'))
        <div class="alert alert-danger">
            {{ session()->get('unsuccess_message') }}
        </div>
      @endif
    </div>
  </div>
</div>

<div class="container">
  <div class="row mb-4 border">
    <div class="col-12">
      <div class="m-4">
       <h3 class="text-primary"><i class="fa fa-check" aria-hidden="true"></i> ออเดอร์ #<?php echo $order['id']; ?> <span class="text-black">(สถานะ: <?php echo $order->status['name']; ?>)</span></h3>
       <div style="text-indent:40px;">ข้อมูลการสั่งซื้อได้ถูกส่งไปยังอีเมลที่ท่านได้ให้ไว้กับเรา ท่านสามารถชำระเงินภายหลังได้ โดยคลิ๊กลิงค์ที่อยู่ภายในอีเมล</div>
       <div class="row">
       <div class="mt-3 col-12">
         <ul class="list-group">
            <li class="list-group-item p-3"><h4>o ยอดที่ต้องชำระ: <span class="text-red h2"><?php echo $order['order_total']; ?> บาท</span> </h4></li>


            <li class="list-group-item p-3">
              <h5>o ช่องทางการชำระเงิน (<a href="#inform">แจ้งโอนเงิน</a>):</h5>
              <div class="p-3">
                <img src="/images/decoriq-payment-account.jpg" class="img-fluid">
              </div>
            </li>

            <li class="list-group-item p-5">
              <h5>o การโอนที่แจ้งแล้ว:</h5>
              <div>
                <?php if($order_payment_informs){ ?>
                       <table class="table">
                         <thead>
                             <tr>
                               <th>วันที่โอน</th>
                               <th>เวลาที่โอน</th>
                               <th>จำนวนเงิน</th>
                               <th>ข้อความเพิ่มเติม</th>
                             </tr>
                         </thead>
                         <tbody>
                         <?php foreach($order_payment_informs as $payment){ ?>
                         <tr>
                             <td><?php echo $payment->paymentdate; ?></td>
                             <td><?php echo $payment->paymenttime; ?></td>
                             <td><?php echo $payment->paymentamount; ?> ฿</td>
                             <td><?php echo $payment->paymentinformnote; ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>

                       </table>
                <?php }else{ ?>
                        ยังไม่มีการแจ้งชำระเงิน
                <?php } ?>
              </div>
            </li>

            <li class="list-group-item p-4" id="inform">
              <h5>o แจ้งโอนเงิน:</h5>
              <div class="p-3">
                <form action="/order-payment/{{$order->id}}/{{$order->order_hash}}/payment-inform" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <div class="form-group row">
                      <label for="email" class="col-4 col-form-label">อีเมล์ (Email)</label>
                      <div class="col-8">
                        <input id="email" name="email" type="text" required="required" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="paymentamount" class="col-4 col-form-label">จำนวนเงินที่ชำระ</label>
                      <div class="col-8">
                        <input id="paymentamount" name="paymentamount" type="text" class="form-control" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="paymentdate" class="col-4 col-form-label">วันที่ชำระ</label>
                      <div class="col-8">
                        <input id="paymentdate" name="paymentdate" type="date" required="required" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="paymenttime" class="col-4 col-form-label">เวลาที่ชำระ</label>
                      <div class="col-8">
                        <input id="paymenttime" name="paymenttime" type="time" class="form-control" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="textarea" class="col-4 col-form-label">ข้อความเพิ่มเติม</label>
                      <div class="col-8">
                        <textarea id="textarea" name="paymentinformnote" cols="40" rows="5" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="textarea" class="col-4 col-form-label">หลักฐานการโอน (ถ้ามี)</label>
                      <div class="col-8">
                        <input type="file" class="form-control" name="photo_1">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-primary">แจ้งชำระเงิน</button>
                      </div>
                    </div>
                    </form>


              </div>
            </li>
          </ul>
        </div>
       </div>
      </div>
     </div>
   </div>
</div>



<!-- End EditShipping Modal -->
@endsection
