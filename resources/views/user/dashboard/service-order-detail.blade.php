@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')

<?php use \App\Http\Controllers\User\DashboardController; ?>
<?php use \App\Http\Controllers\User\ServiceOrdersController; ?>


<div class="container mt-3 p-5">
<div class="row">
  <div class="col-12">
    <h3><i class="fas fa-file-invoice"></i> รายการสั่งซื้อของบริการที่ #<?php echo $service_order->id ?></h3>
    <div class="container mt-3">

    <?php if($service_order->order_status_id==1){ ?>
      <div class="row">
        <div class="alert alert-warning w-100">
          ออเดอร์นี้อยู่ในสถานะรอการชำระเงิน กรุณารอลูกค้าชำระเงิน<br>หรือทางร้านสามารถยกเลิกรายการสั่งซื้อนี้ได้หากไม่ต้องการให้มีการชำระเงินก่อนจัดส่ง<br>
          <a href="/dashboard/order/cancel/<?php echo $service_order->id ?>/<?php echo $service_order->order_hash ?>/" class="border btn mt-2 small text-muted">ยกเลิกการสั่งซื้อ</a>
        </div>
        </div>
    <?php }elseif($service_order->order_status_id==2){ ?>
      <div class="row">
        <div class="alert alert-warning w-100">
          ลูกค้าชำระเงินเรียบร้อยแล้ว คุณสามารถพิมพใบส่งของและ์ใบปะหน้ากล่อง และนำสินค้าไปจัดส่งได้แล้ว<br>
           <a href="/ship-order/<?php echo $service_order->id; ?>/<?php echo $service_order->order_hash; ?>/" class="btn btn-primary mt-2" role="button" data-toggle="modal" data-target="#ordertrackModal">ใส่เลขพัสดุเพื่อส่งสินค้า</a> <a href="/storemanager/store/<?php echo $store->username; ?>/order/<?php echo $service_order->id; ?>/print-packing-list/" target="_blank" class="btn btn-secondary mt-2" role="button">พิมพ์ใบรายการสินค้า</a> <a href="/storemanager/store/<?php echo $store->username; ?>/order/<?php echo $service_order->id; ?>/print-packing-slip/" class="btn btn-secondary mt-2" role="button" target="_blank">พิมพ์ใบปะหน้ากล่อง</a>&nbsp;<a href="/dashboard/order/cancel/<?php echo $service_order->id ?>/<?php echo $service_order->order_hash ?>/" class="border btn mt-2 small text-muted">ยกเลิกการสั่งซื้อ</a>
         </div>
        </div>
  <?php }elseif($service_order->order_status_id==3){ ?>
    <div class="row">
      <div class="alert alert-info w-100">
        คุณได้จัดส่งสินค้าแล้ว กรุณารอลูกค้ารับสินค้า ถ้าคุณตรวจสอบแล้วว่าลูกค้าได้รับแล้ว สามารถแจ้งเตือนให้ลูกค้ากดรับสินค้าได้<br>
         <a href="#" class="btn btn-primary mt-2" role="button">แจ้งเตือนให้กดรับสินค้า</a>
       </div>
      </div>
  <?php } ?>
  </div>
  <div class="row">
    <div class="col-12 p-2">
      <h5 class="d-inline"><img class="d-inline" style="display: block; width: 48px; height: 48px; object-fit: cover;" src="/images/{{ $service_order->service->service_photos[0]->name }}">  <?php echo $service_order->service->name; ?></h5> <a href="/service/messages/<?php echo DashboardController::getServiceConversationId($service_order->service->id); ?>" target="_blank" class="btn btn-button btn-light btn-sm border"><i class="themify  ti-comments"></i> พูดคุยเกี่ยวกับบริการนี้</a>
    </div>
  </div>
      <div class="row border-bottom">
        <div class="col-4 p-3 border-right">
           <ul style="list-style-type: square;">
             <li><strong>เลขที่การสั่งซื้อ:</strong> #<?php echo $service_order->id; ?></li>
             <li><strong>สถานะ:</strong> <?php if($service_order->status['id']==1){ ?>
               <span class="badge badge-pill badge-warning"><?php echo $service_order->status['name']; ?></span>
             <?php } elseif($service_order->status['id']==2){ ?>
               <span class="badge badge-pill badge-info"><?php echo $service_order->status['name']; ?></span>
             <?php } elseif($service_order->status['id']==3){ ?>
               <span class="badge badge-pill badge-primary"><?php echo $service_order->status['name']; ?></span>
             <?php } elseif($service_order->status['id']==4){ ?>
               <span class="badge badge-pill badge-secondary"><?php echo $service_order->status['name']; ?></span>
             <?php } elseif($service_order->status['id']==5){ ?>
               <span class="badge badge-pill badge-info"><?php echo $service_order->status['name']; ?></span>
             <?php } elseif($service_order->status['id']==6){ ?>
               <span class="badge badge-pill badge-success"><?php echo $service_order->status['name']; ?></span>
             <?php } elseif($service_order->status['id']==7){ ?>
               <span class="badge badge-pill badge-danger"><?php echo $service_order->status['name']; ?></span>
             <?php } elseif($service_order->status['id']==8){ ?>
               <span class="badge badge-pill badge-dark"><?php echo $service_order->status['name']; ?></span>
             <?php }?></li>
             <li><strong>วันที่เสนองาน:</strong> <?php echo $service_order->created_at->format('d-M-Y'); ?></li>
             <li><strong>วันส่งงาน:</strong> <?php echo $service_order->created_at->format('d-M-Y'); ?></li>
             <li><strong>ร้าน:</strong> <img class="rounded-circle d-inline" style="display: block; width: 20px; height: 20px; object-fit: cover;" src="/images/<?php echo $service_order->service->store->photo->file;  ?>"> <?php echo $service_order->service->store->name; ?></li>

             <?php if($service_order->service_order_total==NULL){ ?>
               <li><strong>ราคาที่เสนอ:</strong> <?php echo number_format($service_order->service_order_quote_price, 0, '.', ',');  ?> ฿</li>
             <?php }else{ ?>
               <li><strong>ยอดรวม:</strong> <?php echo number_format($service_order->service_order_total, 0, '.', ',');  ?> ฿</li>
              <?php } ?>



           </ul>
        </div>

        <div class="col-4 p-3 border-right">
          <h5> ที่อยู่สำหรับออกใบเสร็จ</h5>

          <?php if(!empty($service_order->billing_address['firstname'])){ ?>
            <strong>ชื่อ:</strong> <?php echo $service_order->billing_address['firstname']; ?> <?php echo $service_order->billing_address['lastname']; ?><br>
            <strong>ที่อยู่:</strong>
            <?php echo $service_order->billing_address['address1']; ?>, <?php echo $service_order->billing_address['address2']; ?><br>
            <?php echo $service_order->billing_address['thai_city']; ?> <?php echo $service_order->billing_address['postal_code']; ?><br>
            <strong>โทร:</strong> <?php echo $service_order->billing_address['tel_number']; ?>
          <?php }else{ ?>
            ยังไม่ได้ระบุข้อมูล
          <?php } ?>

        </div>
        <div class="col-4 p-3 border-right">
          <h5>รูปภาพอ้างอิง</h5>
          <div class="row ">
              <div class="col-12">
                  <div class="row">
                   <?php if(isset($service_order->photos)){ ?>
                     <?php foreach($service_order->photos as $photo){ ?>
                        <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4  mt-1">
                            <img src="/images/<?php echo $photo->file; ?>" class="img-fluid">
                        </a>
                      <?php } ?>
                    <?php }else{ ?>
                        <div class="col">
                            ไม่มีรูปภาพ
                        </div>
                     <?php } ?>

                  </div>
              </div>
          </div>


        </div>

      </div>

      <?php  ?>
      <div class="row mt-3 mb-3 ">
        <div class="col-6">
          <div class="p-3 border">
            <h5 class="border-bottom pb-2">รายละเอียดของงาน</h5>
            <?php if(!empty($service_order->service_order_conclusion)){
              echo $service_order->service_order_conclusion;
            }else{ echo "-<br>";} ?>
          </div>
        </div>
        <div class="col-6">
          <div class="p-3 border bg-gray">
            <h5 class="border-bottom pb-2">ข้อความจากลูกค้า</h5>
            <?php if(!empty($service_order->service_order_customer_note)){
              echo $service_order->service_order_customer_note;
            }else{ echo "-<br>";} ?>
          </div>
        </div>
      </div>




            <?php if(!$service_order->edit_requests->isEmpty()){?>
              <div class="row mt-4">

                <div class="col-12" style="border-bottom:1px solid #dee2e6;">
                <h4>การขอแก้ไขงาน (แก้ไขได้อีก <?php echo $service_order->service_order_revision_times; ?> ครั้ง)</h4>
                </div>

                <div class="container mt-2">
                 <?php foreach($service_order->edit_requests as $service_order_edit_request){ ?>
                   <?php $service_order_edit_response = ServiceOrdersController::getServiceOrderEditResponse($service_order_edit_request->id);  ?>
                  <div class="row border mb-2">
                    <div class="col-1 p-3">
                     <?php if($service_order_edit_response->isEmpty()){ ?>
                      <h2 class="text-warning" title="รอการแก้ไข"><i class="fas fa-clock"></i></h2>
                      <?php }else{ ?>
                        <h2 class="text-success" title="แก้ไขแล้ว"><i class="fas fa-check-circle"></i></h2>
                     <?php } ?>
                    </div>
                    <div class="col-2 border-right p-3">
                      <?php echo date_format($service_order_edit_request->created_at,"d F Y H:i"); ?>
                    </div>

                    <div class="col-6 p-3">
                      <?php  echo strlen($service_order_edit_request->description) > 150 ? substr($service_order_edit_request->description,0,150)."..." : $service_order_edit_request->description; ?>
                    </div>
                    <div class="col-3 p-3 text-right">
                      <a class="btn btn-light btn-sm" data-toggle="collapse" href="#collapse-<?php echo $service_order_edit_request->id ?>" role="button" aria-expanded="false" aria-controls="EditRequestCollapse">
                        ดูรายละเอียด <i class="fas fa-sort-down"></i>
                      </a>
                    </div>
                  </div>

                  <div class="collapse p-3 border mb-2" id="collapse-<?php echo $service_order_edit_request->id ?>">
                    <h5>สิ่งที่ต้องการให้แก้ไข</h5>
                    <div class="row">
                      <div class="col-2">
                        <strong>วันที่อัพเดท</strong>:<br><?php echo date_format($service_order_edit_request->created_at,"d F Y H:i"); ?>
                      </div>
                      <div class="col-6">
                        <strong>รายละเอียด</strong>:<br><?php echo $service_order_edit_request->description; ?>
                      </div>
                      <div class="col-4">
                        <div class="row">
                          <?php if(isset($service_order_edit_request->photos)){ ?>
                            <?php foreach($service_order_edit_request->photos as $photo){ ?>
                               <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="service-order-progress-gallery-<?php echo $service_order_edit_request->id; ?>" class="col-sm-3  mt-1">
                                   <img class="d-inline"  style="display: block; width:75px; height:75px; object-fit: cover;" src="/images/<?php echo $photo->file; ?>">
                               </a>
                             <?php } ?>
                           <?php }else{ ?>
                               <div class="col">
                                   ไม่มีรูปภาพ
                               </div>
                            <?php } ?>
                        </div>
                      </div>
                    </div>

                    <?php if(!$service_order_edit_response->isEmpty()){ ?>
                      <div class="container border bg-gray mt-2 p-3">
                        <h5>การแก้ไข</h5>
                        <div class="row">
                          <div class="col-2">
                            <strong>วันที่อัพเดท</strong>:<br><?php echo date_format($service_order_edit_response[0]->created_at,"d F Y H:i"); ?>
                          </div>
                          <div class="col-6">
                            <strong>รายละเอียด</strong>:<br><?php echo $service_order_edit_response[0]->description; ?>
                          </div>
                          <div class="col-4">
                            <div class="row">
                              <?php if(isset($service_order_edit_response[0]->photos)){ ?>
                                <?php foreach($service_order_edit_response[0]->photos as $photo){ ?>
                                   <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="service-order-progress-gallery-<?php echo $service_order_edit_response[0]->id; ?>" class="col-sm-3  mt-1">
                                       <img class="d-inline"  style="display: block; width:75px; height:75px; object-fit: cover;" src="/images/<?php echo $photo->file; ?>">
                                   </a>
                                 <?php } ?>
                               <?php }else{ ?>
                                   <div class="col">
                                       ไม่มีรูปภาพ
                                   </div>
                                <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                 <?php } ?>
                </div>

              </div>
            <?php } ?>




      <div class="row mt-4">
        <div class="col-12" style="border-bottom:1px solid #dee2e6;">
        <h4>การดำเนินงาน</h4>
        </div>
        <div class="container ">
         <?php foreach($service_order_progresses as $service_order_progress){ ?>
          <div class="row border mt-2">
            <div class="col-2 border-right p-2">
              <?php echo date_format($service_order_progress->created_at,"d F Y H:i"); ?>
            </div>
            <div class="col-2 p-2">
              <?php  if($service_order_progress->status->id == 1){ ?>
                <div class="text-warning">
                  <strong>
                    <?php echo $service_order_progress->status->name; ?>
                  </strong>
                </div>
              <?php }elseif($service_order_progress->status->id == 2){ ?>
                <div class="text-success">
                  <strong>
                    <?php echo $service_order_progress->status->name; ?>
                  </strong>
                </div>
              <?php }else{ ?>
                <div>
                  <strong>
                    <?php echo $service_order_progress->status->name; ?>
                  </strong>
                </div>
              <?php } ?>
            </div>
            <div class="col-6 p-2">
              <?php  echo strlen($service_order_progress->description) > 40 ? substr($service_order_progress->description,0,80)."..." : $service_order_progress->description; ?>
            </div>
            <div class="col-2 p-1 text-right">
              <a class="btn btn-light btn-sm" data-toggle="collapse" href="#collapse-<?php echo $service_order_progress->id ?>" role="button" aria-expanded="false" aria-controls="OrderprogressCollapse">
                ดูรายละเอียด <i class="fas fa-sort-down"></i>
              </a>
            </div>
          </div>

          <div class="collapse p-2" id="collapse-<?php echo $service_order_progress->id ?>">
            <div class="row">
              <div class="col-2">
                <strong>วันที่อัพเดท</strong>:<br><?php echo date_format($service_order_progress->created_at,"d F Y H:i"); ?>
              </div>
              <div class="col-6">
                <strong>รายละเอียด</strong>:<br><?php echo $service_order_progress->description; ?>
              </div>
              <div class="col-4">
                <div class="row">
                  <?php if(isset($service_order_progress->photos)){ ?>
                    <?php foreach($service_order_progress->photos as $photo){ ?>
                       <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="service-order-progress-gallery-<?php echo $service_order_progress->id; ?>" class="col-sm-3  mt-1">
                           <img class="d-inline"  style="display: block; width:75px; height:75px; object-fit: cover;" src="/images/<?php echo $photo->file; ?>">
                       </a>
                     <?php } ?>
                   <?php }else{ ?>
                       <div class="col">
                           ไม่มีรูปภาพ
                       </div>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
         <?php } ?>
        </div>

      </div>
    </div>
  </div>
</div>





@endsection
