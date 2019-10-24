@extends('layouts.frontend')
@section('title')

คุยกับ <?php echo $service_conversation->user->name; ?> งานบริการ<?php echo $service_conversation->service->name; ?> - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\User\ServiceMessageController; ?>

<div class="container mt-0">
  <div class="row border-right border-left">
    <div class="col-1 p-3">
      <img class="d-inline"  style="display: block; width: 100%; height: auto; object-fit: cover;" src="/images/<?php echo $service_conversation->service->service_photos[0]->name ?>">
    </div>
    <div class="col-7 border-right p-3">
      <h3 class="mt-2 d-inline"><?php echo $service_conversation->service->name; ?></h3> <a href="/service/<?php echo $service_conversation->service->slug; ?>"><i class="fas fa-external-link-alt"></i> ดูรายละเอียด</a><br>
      <img class="rounded-circle d-inline"  style="width: 30px; height: 30px; border:lightgray 1px solid; object-fit: cover;" src="/images/{{$service_conversation->store->photo->file}}">
      <strong>{{$service_conversation->store->name}}</strong>
    </div>

  <div class="col-4 p-2 text-right">
    <div class="m-2 mr-4 d-inline-block text-center">
      <small class="text-muted">ราคาเริ่มต้นที่</small><h2><?php echo $service_conversation->service->start_price; ?></h2>
    </div>
    <div class="m-2 mr-4 d-inline-block text-center">
      <small class="text-muted">ระยะเวลาทำงาน</small><h2><?php echo $service_conversation->service->work_duration; ?></h2>
    </div>

    <div class="m-2 mr-4 d-inline-block text-center">
      <small class="text-muted">แก้ไขงานได้(ครั้ง)</small><h2><?php echo $service_conversation->service->revision_time; ?></h2>
    </div>
  </div>
</div>
</div>

<div class="container d-flex flex-wrap align-content-between border p-0" style="height:68vh">
 <div class="col-8 pr-0">

 <div class="row w-100">
   <div class="border-right w-100" id="message-conversation-div"  style="overflow-y:scroll;overflow-x:hidden;height: 61vh;">
     <input type="hidden" id="conversation-id" value="<?php echo $service_conversation->id; ?>">
     <ul class="chat-section">
     <?php $customer_user_id = $service_conversation->user_id; ?>
     <?php foreach($service_conversation->messages as $service_message){
        $isownstore = ServiceMessageController::isOwnStorebyId($service_message->service_conversation->service->store->id,$service_message->user->id);
        if($isownstore==false){ ?>
         <li class="chatmessage" data-message-id="<?php echo $service_message->id; ?>" data-user-id="<?php echo $service_message->user->id; ?>">
           <div class="w-80 p-2">
             <div class="row">
               <div class="col-1 text-right">
                 <img class="rounded-circle d-inline"  style="width: 30px; height: 30px; border:lightgray 1px solid; object-fit: cover;" src="/images/<?php echo $service_message->user->photo->file; ?>">
               </div>
               <div class="col-11 bg-gray p-3">
                 <strong><span class="d-inline"><?php if(empty($service_message->user->firstname)){ echo $service_message->user->name; }else{ echo $service_message->user->firstname.' '.$service_message->user->lastname; } ?></span> </strong> <small class="text-muted">(<?php echo $service_message->created_at->diffForHumans(); ?>)</small><br>
                 <?php echo $service_message->message; ?>
               </div>
             </div>
           </div>
         </li>

       <?php }else{ ?>
       <li class="chatmessage" data-message-id="<?php echo $service_message->id; ?>" data-store-id="<?php echo $service_message->service_conversation->service->store->id; ?>">
         <div class="w-80 p-2">
           <div class="row">
             <div class="col-1 text-right">
               <img class="rounded-circle d-inline" style="width: 30px; height: 30px; border:lightgray 1px solid; object-fit: cover;" src="/images/<?php echo $service_message->service_conversation->service->store->photo->file; ?>">
             </div>
             <div class="col-11 bg-light p-3">
               <strong><?php echo $service_message->service_conversation->service->store->name; ?></strong> <small class="text-muted">(<?php echo $service_message->created_at->diffForHumans(); ?>)</small><br>
               <?php echo $service_message->message; ?>
             </div>
         </div>
         </div>
        </li>
       <?php } ?>
    <?php } ?>

  </ul>


   </div>
</div>
<div class="row w-100 border-right"  style="height: 6.5vh;">
      <div class="message-input  border-top" style="width:96%;">
  			<div class="wrap">
        <input type="hidden" class="service-id" value="<?php echo $service_conversation->service->id ?>" />
        <input type="hidden" class="conversation-id" value="<?php echo $service_conversation->id ?>" />
        <input type="hidden" class="store-username" value="<?php echo $service_conversation->store->username ?>" />
  			<input type="text" placeholder="เขียนข้อความของคุณที่นี่..." class="message-input-box" required>
  			<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
  			<button class="submit message-input-submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
  			</div>
  		</div>

</div>
</div>
<div class="col-4 pt-3" style="height:3vh">
  <div id="service-list">
        <span class="h6">การสั่งซื้อที่ดำเนินการอยู่</span><br>
        <div class="" style="overflow-y:scroll;overflow-x:hidden;height:61vh">
          <?php
           if(!$service_orders->isEmpty()){

             foreach($service_orders as $order){
                  ?>
              <div class="p-2 mt-2 border">
                <span>#<?php echo $order->id ?>:</span><h4 class="text-primary pl-1 d-inline"><?php echo number_format($order->service_order_quote_price,2); ?> ฿</h4> <small><?php if($order->status['id']==1){ ?>
                  <span class="badge badge-pill badge-warning"><?php echo $order->status['name']; ?></span>
                <?php } elseif($order->status['id']==2){ ?>
                  <span class="badge badge-pill badge-info"><?php echo $order->status['name']; ?></span>
                <?php } elseif($order->status['id']==3){ ?>
                  <span class="badge badge-pill badge-primary"><?php echo $order->status['name']; ?></span>
                <?php } elseif($order->status['id']==4){ ?>
                  <span class="badge badge-pill badge-secondary"><?php echo $order->status['name']; ?></span>
                <?php } elseif($order->status['id']==5){ ?>
                  <span class="badge badge-pill badge-info"><?php echo $order->status['name']; ?></span>
                <?php } elseif($order->status['id']==6){ ?>
                  <span class="badge badge-pill badge-success"><?php echo $order->status['name']; ?></span>
                <?php } elseif($order->status['id']==7){ ?>
                  <span class="badge badge-pill badge-danger"><?php echo $order->status['name']; ?></span>
                <?php } elseif($order->status['id']==8){ ?>
                  <span class="badge badge-pill badge-dark"><?php echo $order->status['name']; ?></span>
                <?php }?></small><br>
                <span><strong>รายละเอียดงาน: </strong><?php echo strlen($order->service_order_conclusion) > 170 ? substr($order->service_order_conclusion,0,170)."..." : $order->service_order_conclusion; ?></span><br>
                <span><strong>วันส่งงาน: </strong><?php echo date_format(date_create($order->service_order_duedate),"d F Y"); ?> <?php if($order->status['id']==3 || $order->status['id']==4 || $order->status['id']==5){ ?>| <strong>แก้ไขได้อีก:</strong> <?php echo $order->service_order_revision_times; ?> ครั้ง<?php } ?></span><br>
                <?php if($order->status->id==1){ ?>
                  <a href="/order/service/accept-payment/<?php echo $order->id; ?>/<?php echo $order->service_order_hash; ?>" class="btn btn-success btn-sm w-33 border">ยอมรับ, ไปชำระเงิน</a>
                  <a href="#" class="btn btn-danger btn-sm w-33 border"  id="decline-service-quote-button" data-order-id="<?php echo $order->id; ?>">ปฏิเสธ</a>
                  <a href="/dashboard/service-order/<?php echo $order->id; ?>" class="btn btn-light btn-sm w-33 border"  id="decline-service-quote" data-order-id="<?php echo $order->id; ?>" target="_blank">ดูรายละเอียด</a>
                <?php }elseif($order->status->id==3){ ?>
                    <?php if($order->service_order_revision_times>0){ ?>
                      <button class="btn btn-warning btn-sm w-33 border request-for-edit-button"  data-order-id="<?php echo $order->id; ?>" data-enc-order-id="<?php echo Crypt::encrypt($order->id); ?>" data-toggle="modal" data-target="#request-for-edit-modal">ขอแก้ไข</button>
                    <?php } ?>
                      <button class="btn btn-success btn-sm w-33 border" id="accept-final-result-button" data-order-id="<?php echo $order->id; ?>" data-enc-order-id="<?php echo Crypt::encrypt($order->id); ?>">ยอมรับงาน</button>
                      <a href="/dashboard/service-order/<?php echo $order->id; ?>" class="btn btn-light btn-sm w-33 border"  id="decline-service-quote" data-order-id="<?php echo $order->id; ?>" target="_blank">ดูรายละเอียด</a>
                <?php }else{ ?>
                  <a href="/dashboard/service-order/<?php echo $order->id; ?>" class="btn btn-light btn-sm w-33 border"  id="decline-service-quote" data-order-id="<?php echo $order->id; ?>" target="_blank">ดูรายละเอียด</a>

                <?php } ?>
              </div>
        <?php   }
          }else{
            echo "<div class='p-2 mt-2' style='border:lightgray 1px dashed'><span class='text-muted'>ไม่มีงานที่ดำเนินการอยู่ขณะนี้ กรุณาพูดคุยสอบถามร้านค้า เพื่อรับการเสนอราคา</span></div>";
          } ?>
          <div class="w-100 mt-4 text-center">
            <a href="/dashboard/orders/service/status/all" target="_blank">- ดูรายการสั่งซื้อบริการทั้งหมด -</a>
          </div>
        </div>
      </div>

</div>
</div>

<!-- Request for Edit Modal -->
  <div class="modal fade" id="request-for-edit-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form id="requestforeditform" method="post" enctype="multipart/form-data">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <div class="modal-header">
          <h4 class="modal-title">ขอแก้ไขงานของงานหมายเลข #<span id="order-id"></span> </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

            <div class="form-group">
              <label for="ServiceOrderProgressEditRequestTextarea">รายละเอียดสิ่งที่ต้องการการแก้ไข</label>
              <textarea class="form-control" name="description" id="service-order-progress-edit-request-description" rows="2" required></textarea>
              <small id="service-description-input-help" class="mt-0 pt-0 form-text text-muted">กรอกรายละเอียดสิ่งที่ต้องการการแก้ไขให้ชัดเจน และเพื่อให้เข้าใจตรงกันทั้ง 2 ฝ่าย กรุณาระบุรูปภาพของสิ่งที่ต้องการให้แก้ไข</small>
            </div>
            <div class="form-group">
              <label for="ServicePhotoFileInput">รูปภาพอ้างอิง (ถ้ามี)</label>
              <input type="file" class="service-order-progress-edit-request-photo" id="service-order-progress-photo-file-input" name="service-order-progress-edit-request-photo">
              <small id="service-photo-file-input-help" class="mt-0 pt-0 form-text text-muted">ใส่ภาพสิ่งที่ต้องการแก้ไข</small>
            </div>
            {{ Form::hidden('service_order_id') }}
            <input type="hidden" name="conversation_id" value="<?php echo Crypt::encrypt($service_conversation->id); ?>">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">ขอแก้ไขงาน</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        </div>
      </form>
      </div>
    </div>
  </div><!-- End Request for Edit Modal -->




@endsection
