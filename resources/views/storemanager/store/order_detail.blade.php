<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'รายละเอียดออเดอร์ '.$order->id.' ของร้าน '.$store->name)

@section('sidebar')
    @parent
@endsection


@section('content')
<?php use \App\Http\Controllers\StoreManager\OrdersController; ?>
<section>
<div class="container bg-white border mt-3 p-5">
<div class="row">
  <div class="col-10">
    <h3><i class="fas fa-file-invoice"></i> รายการสั่งซื้อที่ #<?php echo $order->id ?></h3>
    <div class="container mt-3">

    <?php if($order->order_status_id==1){ ?>
      <div class="row">
        <div class="alert alert-warning w-100">
          ออเดอร์นี้อยู่ในสถานะรอการชำระเงิน กรุณารอลูกค้าชำระเงิน<br>หรือทางร้านสามารถยกเลิกรายการสั่งซื้อนี้ได้หากไม่ต้องการให้มีการชำระเงินก่อนจัดส่ง<br>
          <a href="/dashboard/order/cancel/<?php echo $order->id ?>/<?php echo $order->order_hash ?>/" class="border btn mt-2 small text-muted">ยกเลิกการสั่งซื้อ</a>
        </div>
        </div>
    <?php }elseif($order->order_status_id==2){ ?>
      <div class="row">
        <div class="alert alert-warning w-100">
          ลูกค้าชำระเงินเรียบร้อยแล้ว คุณสามารถพิมพใบส่งของและ์ใบปะหน้ากล่อง และนำสินค้าไปจัดส่งได้แล้ว<br>
           <a href="/ship-order/<?php echo $order->id; ?>/<?php echo $order->order_hash; ?>/" class="btn btn-primary mt-2" role="button" data-toggle="modal" data-target="#ordertrackModal">ใส่เลขพัสดุเพื่อส่งสินค้า</a> <a href="/storemanager/store/<?php echo $store->username; ?>/order/<?php echo $order->id; ?>/print-packing-list/" target="_blank" class="btn btn-secondary mt-2" role="button">พิมพ์ใบรายการสินค้า</a> <a href="/storemanager/store/<?php echo $store->username; ?>/order/<?php echo $order->id; ?>/print-packing-slip/" class="btn btn-secondary mt-2" role="button" target="_blank">พิมพ์ใบปะหน้ากล่อง</a>&nbsp;<a href="/dashboard/order/cancel/<?php echo $order->id ?>/<?php echo $order->order_hash ?>/" class="border btn mt-2 small text-muted">ยกเลิกการสั่งซื้อ</a>
         </div>
        </div>
  <?php }elseif($order->order_status_id==3){ ?>
    <div class="row">
      <div class="alert alert-info w-100">
        คุณได้จัดส่งสินค้าแล้ว กรุณารอลูกค้ารับสินค้า ถ้าคุณตรวจสอบแล้วว่าลูกค้าได้รับแล้ว สามารถแจ้งเตือนให้ลูกค้ากดรับสินค้าได้<br>
         <a href="#" class="btn btn-primary mt-2" role="button">แจ้งเตือนให้กดรับสินค้า</a>
       </div>
      </div>
  <?php } ?>
  </div>
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

      <?php  ?>
      <div class="row mt-3 mb-3 ">
        <div class="col-6">
          <div class="p-3 border bg-gray">
            <h5 class="border-bottom pb-2">ข้อความจากลูกค้า</h5>
            <?php if(!empty($order->order_note)){
              echo $order->order_note;
            }else{ echo "-<br>";} ?>
          </div>
        </div>
        <div class="col-6">
          <div class="p-3 border">
            <h5 class="border-bottom pb-2"> การจัดส่ง <?php if($order->order_status_id==3||$order->order_status_id==4){ ?> <a href="/ship-order/<?php echo $order->id; ?>/<?php echo $order->order_hash; ?>/" class="btn btn-sm btn-primary" role="button" data-toggle="modal" data-target="#editordertrackModal">แก้ไข</a><?php } ?></h5>
            <?php if($order->order_status_id==3||$order->order_status_id==4){
              $order_track = OrdersController::getOrderTrackNo($order->id); ?>
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
                 <?php foreach($products as $product){ ?>
                        <tr>
                          <td class="pr-0 pl-0 text-center"><img src="/images/<?php echo OrdersController::getProductPhoto($product->product_id); ?>" width="48"></td>
                          <td><?php echo $product->name; ?> <span class="text-muted">(#<?php echo $product->product_id; ?>)</span></td>
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
</div>

</section>

<?php  if($order->order_status_id=="2"){ ?>

<!--  Modal -->
<div class="modal fade" id="ordertrackModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ใส่เลขพัสดุ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row pl-3 pr-3">
           <span class="text-muted">แจ้งให้ลูกค้าทราบว่าคุณได้จัดส่งสินค้าแล้ว โดยการกรอกเลขพัสดุ (tracking no.) เพื่อที่ทางลูกค้าจะได้ติดตามและรับสินค้าได้</span><br>
        </div>

        <div class="row">
          <div class="form-group col-4">
            <label for="exampleFormControlSelect1">การจัดส่ง</label>
            <select class="form-control" name="shipping_name" id="shipping_name">
              <option value="">กรุณาเลือก</option>
              <?php foreach($shipping_companies as $shipping_company){ ?>
                <option value="<?php echo $shipping_company->id; ?>"><?php echo $shipping_company->name; ?></option>
              <?php } ?>
              <option value="0">อื่นๆ (ระบุ)</option>
            </select>
          </div>
          <div class="form-group col-8">
            <label for="tracking_number"><strong>เลขพัสดุ (tracking no.)</strong></label>
            <input type="text" class="form-control" id="trackingno" name="trackingno" aria-describedby="trackingnoHelp" placeholder="กรุณากรอกเลขพัสดุ" required>
          </div>
        </div>

        <div class="row mb-3" style="display:none" id="customshippingcompany-input">
          <div class="col-12">
            <label for="tracking_number">ระบุชื่อการจัดส่ง</label>
            <input type="text" class="form-control" id="customshippingcompany" name="custom_shipping_company" aria-describedby="trackingnoHelp" placeholder="กรุณากรอกชื่อการจัดส่ง">
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="tracking_number">เว็บติดตามสถานะพัสดุ (ถ้ามี)</label>
            <input type="text" class="form-control" id="shippingtrackurl" name="shipping_track_url" aria-describedby="trackingnoHelp" placeholder="กรุณากรอกเว็บสำหรับติดตามพัสดุ">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="บันทึกการส่ง" id="submittrackno">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>


<?php  if($order->order_status_id!="1" && $order->order_status_id!="2"){ ?>
<!-- Edit Order Track Modal -->
<div class="modal fade" id="editordertrackModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขเลขพัสดุ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row pl-3 pr-3">
           <span class="text-muted">แก้ไขเลขพัสดุของรายการสั่งซื้อนี้</span><br><br>
        </div>
        <?php $order_track = OrdersController::getOrderTrackNo($order->id); ?>
        <div class="row">
          <div class="form-group col-4">
            <label for="exampleFormControlSelect1">การจัดส่ง</label>
            <select class="form-control" name="shipping_name" id="shipping_name">
              <option value="">กรุณาเลือก</option>
              <?php
               $i=0;
               foreach($shipping_companies as $shipping_company){ ?>
                <option value="<?php echo $shipping_company->id; ?>" <?php if($order_track){if($shipping_company->name==$order_track->shipping_name){ ?>selected="selected"<?php $i=1;}} ?>><?php echo $shipping_company->name; ?></option>
              <?php } ?>

                <option value="0" <?php if($i==0) { ?>selected="selected"<?php } ?>>อื่นๆ (ระบุ)</option>

            </select>
          </div>
          <div class="form-group col-8">
            <label for="tracking_number"><strong>เลขพัสดุ (tracking no.)</strong></label>
            <input type="text" class="form-control" id="trackingno" name="trackingno" value="<?php if($order_track){ echo $order_track->tracking_no; } ?>" aria-describedby="trackingnoHelp" placeholder="กรุณากรอกเลขพัสดุ" required>
          </div>
        </div>

        <div class="row mb-3" <?php if($i!=0){ ?> style="display:none" <?php }else{ ?> style="display:block;" <?php } ?> id="customshippingcompany-input">
          <div class="col-12">
            <label for="tracking_number">ระบุชื่อการจัดส่ง</label>
            <input type="text" class="form-control" id="customshippingcompany" name="custom_shipping_company" value="<?php if($order_track){echo $order_track->shipping_name;} ?>" aria-describedby="trackingnoHelp" placeholder="กรุณากรอกชื่อการจัดส่ง">
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="tracking_number">เว็บติดตามสถานะพัสดุ (ถ้ามี)</label>
            <input type="text" class="form-control" id="shippingtrackurl" name="shipping_track_url" value="<?php if($order_track){echo $order_track->shipping_track_url;} ?>" aria-describedby="trackingnoHelp" placeholder="กรุณากรอกเว็บสำหรับติดตามพัสดุ">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="บันทึกการส่ง" id="submittrackno">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php } ?>
@endsection
