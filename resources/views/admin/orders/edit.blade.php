<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'แก้ไขรายการสั่งซื้อ')

@section('sidebar')
    @parent


@endsection

@section('content')
<?php use \App\Http\Controllers\Customer\DashboardController; ?>
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row">

            <div class="col-10">
              <h3><i class="fas fa-file-invoice"></i> รายการสั่งซื้อที่ #<?php echo $order->id ?></h3>
              <div class="container mt-3">


                <div class="row border-bottom">
                  <div class="col-4 p-3 border-right">
                     <h5>รายละเอียด</h5>
                     <ul style="list-style-type: square;">
                       <li><strong>เลขที่การสั่งซื้อ:</strong> #<?php echo $order->id; ?></li>
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
                       <li><strong>ร้าน:</strong> <?php echo $order->store['name']; ?></li>
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
                <div class="row mt-4">
                  <div class="col-12" style="border-bottom:1px solid #dee2e6;">
                  <h4>รายการสินค้า</h4>
                  <?php $products = $order->products; ?>
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
                           <?php foreach($order->products as $product){ ?>
                                  <tr>
                                    <td class="pr-0 pl-0 text-center"><img src="/images/<?php echo DashboardController::getProductPhoto($product->product_id); ?>" width="48"></td>
                                    <td><?php echo $product->name; ?> <span class="text-muted">(<?php echo $product->product_id; ?>)</span></td>
                                    <td>x<?php echo $product->qty; ?></td>
                                    <td><?php echo $product->price; ?> ฿</td>
                                  </tr>
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
                  <small <?php if($i==count($timelines)){ ?> class="text-muted" <?php } ?>>ออเดอร์ #<?php echo $order->id; ?><br><?php echo $timeline->message; ?></small>
                </div>
             <?php $i++; } ?>
              </div>
            </div>

        </div>
    </section>
@endsection
