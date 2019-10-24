<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'รายละเอียดการสั่งซื้อ')

@section('sidebar')
    @parent


@endsection

@section('content')
<?php use \App\Http\Controllers\Customer\DashboardController; ?>
<?php use \App\Http\Controllers\Admin\AdminOrdersController; ?>

    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row">

            <div class="col-10">
              <h3 class="d-inline"><i class="fas fa-file-invoice"></i> รายการสั่งซื้อที่ #<?php echo $order->id ?></h3> <a class="d-inline" href="/admin/order/<?php echo $order->id; ?>/edit">[แก้ไขรายการสั่งซื้อ]</a> <a class="d-inline text-danger" href="/admin/orders/<?php echo $order->id; ?>/delete" onclick="return confirm('คุณแน่ใจว่าต้องการลบคำสั่งซื้อนี้?');">[ลบการสั่งซื้อนี้]</a>
              <div class="container mt-3">


                <div class="row border-bottom">
                  <div class="col-4 p-3 border-right">
                     <h5>รายละเอียด</h5>
                     <ul style="list-style-type: square;">
                       <li><strong>เลขที่การสั่งซื้อ:</strong> #<?php echo $order->id; ?></li>
                       <li><strong>ผู้ที่สั่ง:</strong> <?php if($order->user!=NULL){ ?><?php if($order->user->photo){ ?><img src="/images/{{ $order->user->photo->file }}" class="d-inline rounded-circle" style="display: block; width: 24px; height: 24px; object-fit: cover;"> <?php } echo $order->user->name; }else{ echo $order->shipping_address['firstname'].' '.$order->shipping_address['lastname'];}?> (<?php echo $order->order_email; ?>)</li>
                       <li><strong>สถานะ:</strong> <?php if($order->status['id']==1){ ?>
                         <span class="badge badge-pill badge-warning"><?php echo $order->status['name']; ?></span>
                       <?php } elseif($order->status['id']==2){ ?>
                         <span class="badge badge-pill badge-primary"><?php echo $order->status['name']; ?></span>
                       <?php } elseif($order->status['id']==3){ ?>
                         <span class="badge badge-pill badge-info"><?php echo $order->status['name']; ?></span>
                       <?php } elseif($order->status['id']==4){ ?>
                         <span class="badge badge-pill badge-success"><?php echo $order->status['name']; ?></span>
                       <?php } elseif($order->status['id']==5){ ?>
                         <span class="badge badge-pill badge-danger"><?php echo $order->status['name']; ?></span>
                       <?php } elseif($order->status['id']==6){ ?>
                         <span class="badge badge-pill badge-secondary"><?php echo $order->status['name']; ?></span>
                       <?php } elseif($order->status['id']==7){ ?>
                         <span class="badge badge-pill badge-dark"><?php echo $order->status['name']; ?></span>
                       <?php } ?></li>
                       <li><strong>วันที่สั่ง:</strong> <?php echo $order->created_at->format('d-M-Y'); ?></li>
                       <li><strong>ร้าน:</strong> <img src="/images/{{ $order->store->photo->file }}" class="d-inline rounded-circle" style="display: block; width: 24px; height: 24px; object-fit: cover;"> <?php echo $order->store['name']; ?></li>
                       <li><strong>ยอดรวม:</strong> <?php echo number_format($order->order_total, 0, '.', ',');  ?> ฿</li>
                     </ul>
                  </div>
                  <div class="col-4 p-3 border-right">
                    <h5> ที่อยู่สำหรับรับสินค้า</h5>
                    <strong>ชื่อ:</strong> <?php echo $order->shipping_address['firstname']; ?> <?php echo $order->shipping_address['lastname']; ?><br>
                    <strong>ที่อยู่:</strong>
                    <?php echo $order->shipping_address['address1']; ?>, <?php echo $order->shipping_address['address2']; ?><br>
                    <?php echo $order->shipping_address['thai_city']; ?> <?php echo $order->shipping_address['postal_code']; ?><br>
                    <strong>โทร:</strong> <?php echo $order->shipping_address['tel_number']; ?>
                  </div>
                  <div class="col-4 p-3">
                    <h5> ที่อยู่สำหรับออกใบเสร็จ</h5>
                    <strong>ชื่อ:</strong> <?php echo $order->billing_address['firstname']; ?> <?php echo $order->billing_address['lastname']; ?><br>
                    <strong>ที่อยู่:</strong>
                    <?php echo $order->billing_address['address1']; ?>, <?php echo $order->billing_address['address2']; ?><br>
                    <?php echo $order->billing_address['thai_city']; ?> <?php echo $order->billing_address['postal_code']; ?><br>
                    <strong>โทร:</strong> <?php echo $order->billing_address['tel_number']; ?>
                  </div>
                </div>

                <div class="row mt-4 mb-4">
                  <div class="col-6 border bg-gray p-4">
                    <h3>ข้อความจากลูกค้า</h3>
                    <span><?php echo $order->order_note; ?></span>
                  </div>
                  <div class="col-6">
                    <div class="p-3 border">
                      <h5 class="border-bottom pb-2"> การจัดส่ง <?php if($order->order_status_id==3||$order->order_status_id==4){ ?> <a href="/ship-order/<?php echo $order->id; ?>/<?php echo $order->order_hash; ?>/" class="btn btn-sm btn-primary" role="button" data-toggle="modal" data-target="#editordertrackModal">แก้ไข</a><?php } ?></h5>
                      <?php if($order->order_status_id==3||$order->order_status_id==4){
                        $order_track = AdminOrdersController::getOrderTrackNo($order->id); ?>
                       <span><i class="fas fa-truck text-primary"></i> อยู่ในระหว่างการจัดส่ง</span><br>
                      <span><strong>เลขพัสดุ:</strong> <?php if($order_track){echo $order_track->tracking_no;} ?></span>
                      <span>(<strong>จัดส่งโดย:</strong> <?php if($order_track){echo $order_track->shipping_name;} ?>)</span><br>
                      <span><strong>ตรวจสอบสถานะ:</strong>
                      <?php if(!empty($order_track->shipping_track_url)){ ?>
                      <br><a target="_blank" href="<?php if($order_track){echo $order_track->shipping_track_url;} ?>"><?php if($order_track){echo $order_track->shipping_track_url;} ?></a></span>
                    <?php }
                      else{ echo "ไม่มี"; } ?>
                     <br>
                    <?php }else{ ?>
                      <span><i class="far fa-clock text-warning"></i> สินค้านี้ยังไม่ได้รับการจัดส่ง</span>
                    <?php } ?>
                    </div>
                  </div>
                </div>

                <div class="row mt-4 mb-4">
                  <div class="col-12 border bg-gray p-4">
                    <div class="mb-4 pb-2  border-bottom">
                      <h3>การชำระเงิน</h3>
                      <?php if(!empty($order->payments->order_id)){ ?>
                        <p>ยังไม่มีการชำระเงินสำหรับคำสั่งซื้อนี้</p>
                      <?php  }else{  ?>
                        <?php
                          $i=1;
                          foreach ($order->payments as $payment ){ ?>
                             <div class="pt-2 pb-2">
                               <h5>#<?php echo $i; ?> <span class="text-muted">(เพิ่มโดย <?php echo $payment->user->name; ?>)</span></h5>
                               <span><strong>ช่องทางการชำระเงิน:</strong> <?php echo $payment->payment_method->name; ?>&nbsp;&nbsp;&nbsp;
                                      <strong>จำนวนเงิน:</strong> <?php echo $payment->amount; ?> ฿</span><br>
                                      <strong>รหัสยืนยันการชำระเงิน:</strong> <?php echo $payment->key; ?></span>&nbsp;&nbsp;&nbsp;
                                      <strong>วันที่ชำระ:</strong> <?php echo $payment->payment_datetime; ?></span><br>
                                      <strong>รูปหลักฐานการชำระเงิน:</strong> <?php if(isset($payment->photo->file)){ ?><a target="_blank" href="/images/<?php echo $payment->photo->file; ?>"><?php echo $payment->photo->file; ?></a><?php }else{ ?>ไม่มีรูปหลักฐานการชำระเงิน<?php } ?></span><br>
                             </div>
                        <?php
                              $i++; } ?>
                      <?php  } ?>
                  </div>

                  <div class="row">
                    <div class="col-12">
                    <h4>เพิ่มข้อมูลการชำระเงินใหม่</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger pb-0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('error_message'))
                      <p class="alert alert-danger">{{ Session::get('error_message') }}</p>
                    @endif
                  </div>
                </div>
                  <div class="row" id="add-proof-of-payment-form" style="display:none;">
                    <div class="col-12">
                    <form action="/admin/orders/<?php echo $order->id ?>/addnewproofofpayment" method="post"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-row align-items-center mb-3">
                        <div class="col-4">
                          <label  for="PaymentMethodIdInput">ช่องทางการชำระเงิน:</label>
                          <select name="payment_method_id" class="custom-select mr-sm-2" id="payment-method-select" required>
                            <option value="" selected>กรุณาเลือก...</option>
                            <?php foreach($payment_methods as $payment_method){ ?>
                              <option value="<?php  echo $payment_method->id; ?>"><?php echo $payment_method->name; ?></option>
                            <?php  } ?>
                          </select>
                        </div>
                        <div class="col-4">
                          <label for="AmountInput">จำนวนเงิน:</label>
                          <div class="">
                            <input name="amount" type="text" class="form-control" id="payment-amount-input" required>
                          </div>
                        </div>
                      </div>


                      <div class="form-row align-items-center mb-3">
                        <div class="col-4">
                          <label  for="keyInput">รหัสยืนยันการชำระเงิน:</label>
                          <input type="text" name="key" class="form-control" id="payment-key-input">
                        </div>
                        <div class="col-4">
                          <label  for="inlineFormInput">วันที่-เวลาที่ชำระเงิน:</label>
                          <div class="">
                            <input  type="datetime-local" class="form-control" name="payment_datetime" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-row align-items-center mb-3">
                        <div class="col-4">
                          <label for="exampleFormControlFile1">รูปหลักฐานการชำระเงิน(ถ้ามี)</label>
                          <input type="file" name="proof_of_payment_photo" class="form-control-file" id="proof-of-payment-photo">
                        </div>
                      </div>
                      <button type="submit"  class="btn btn-success mb-2">ส่งข้อมูลการชำระเงิน</button>
                    </form>
                  </div>
                </div>




                  <button type="button" onClick="javascript:showAddProofofPaymentForm()" id="add-proof-of-payment-button" name="button" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูลการชำระเงิน</button>
                  </div>
                </div>


                <div class="row mt-4">
                  <div class="col-12" style="border-bottom:1px solid #dee2e6;">
                  <h4>รายการสินค้า</h4>
                      <table class="table"  style="margin-bottom:0px !important;">
                        <thead>
                          <tr>
                            <th></th>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($order->products as $order_product){
                             if($order_product->product->product_type=="single"){ ?>
                               <tr>
                                 <td class="pr-0 pl-0 text-center"><img src="/images/<?php echo $order_product->product->product_photos[0]->name; ?>" width="48"></td>
                                 <td><?php echo $order_product->name; ?> <span class="text-muted">(#<?php echo $order_product->product_id; ?>)</span></td>
                                 <td>x<?php echo $order_product->qty; ?></td>
                                 <td><?php echo $order_product->price; ?> ฿</td>
                               </tr>
                             <?php }else{?>
                               <tr>
                                 <td class="pr-0 pl-0 text-center"><img src="/images/<?php echo AdminOrdersController::getVariationPhoto($order_product->product_id); ?>" width="48"></td>
                                 <td><?php echo $order_product->name; ?> <span class="text-muted">(<?php echo $order_product->product_id; ?>)</span></td>
                                 <td>x<?php echo $order_product->qty; ?></td>
                                 <td><?php echo $order_product->price; ?> ฿</td>
                               </tr>
                         <?php } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-5 offset-7">
                    <table class="float-right">
                      <?php $shippings = $order->shippings;  ?>
                      <tr style="border-bottom:1px solid #dee2e6;">
                        <td class="p-2 pl-3">
                          <strong>ค่าจัดส่ง</strong>
                          <ul style="list-style:none; margin-bottom:2px;">
                            <?php
                            $shipping_cost = 0;
                            foreach($shippings as $shipping){ ?>
                            <li><small class="text-muted"><?php echo '- '.$shipping->name.': '.$shipping->cost; ?> ฿</small></li>
                            <?php
                            $shipping_cost += $shipping->cost;
                            } ?>
                          </ul>
                        </td>
                        <td class="p-2 pr-3 text-right">
                          <?php echo $shipping_cost; ?> ฿
                        </td>
                      </tr>
                      <tr style="border-bottom:1px solid #dee2e6;">
                        <td class="p-2 pl-3"><strong>ส่วนลด</strong></td>
                        <td class="p-2 pr-3 text-right"><?php echo $order->order_discount; ?> ฿</td>
                      </tr>
                      <tr style="border-bottom:1px solid #dee2e6;">
                        <td class="p-2 pl-3"><strong>ยอดรวม</strong></td>
                        <td class="p-2 pr-3 text-right"><?php echo number_format($order->order_total, 0, '.', ',');  ?> ฿</td>
                      </tr>
                    </table>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-2 border-left pl-3 pr-1 mt-3">
              <h5>ความคืบหน้า</h5>
              <div class="container" style="border-left:gray 1px solid;">

            <?php  $i = 1;
                   $timelines = $order->order_timelines;
                   foreach($timelines as $timeline){ ?>
                <div class="row pl-2 pt-3">
                  <small class="text-muted"><?php echo $timeline->created_at->format('d M Y - H:i'); ?></small>
                  <small <?php if($i!=1){ ?> class="text-muted" <?php } ?>>ออเดอร์ #<?php echo $order->id; ?><br><?php echo $timeline->message; ?></small>
                </div>
             <?php $i++; } ?>
              </div>
            </div>



        </div>
    </section>
@endsection
