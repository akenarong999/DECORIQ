@extends('layouts.frontend')

@section('title')

ชำระเงินให้งานบริการ<?php echo $order->service->name; ?> (#<?php echo $order->id; ?>) - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="container mt-5 mb-3">
  <div class="row">
    <div class="col">
        <h3><i class="themify ti ti-credit-card font-weight-bold mt-1"></i> ชำระเงิน</h3>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mb-4 border">
    <div class="col-12">

      <?php if($order->service_order_status_id==1){ ?>

        <div class="m-4">
         <h3 class="text-warning"><i class="far fa-clock"></i> ออเดอร์ #<?php echo $order['id']; ?> รอการชำระเงิน (สถานะ: <?php echo $order->status['name']; ?>)</h3>
         <div style="text-indent:40px;">คุณได้รับการเสนอราคาจากบริการ <a href="/service/<?php echo $order->service->slug; ?>" target="_blank"><?php echo $order->service->name; ?></a> จากร้าน <img class="rounded-circle d-inline" style="display: block; width: 20px; height: 20px; object-fit: cover;" src="/images/<?php echo $order->service->store->photo->file;  ?>"> <?php echo $order->service->store->name; ?></div>
         <div style="text-indent:40px;">​ซึ่งมีรายละเอียด คือ <strong><?php echo $order->service_order_conclusion ?></strong> กำหนดส่งงานภายในวันที่ <strong><?php echo date_format(date_create($order->service_order_duedate),"d F Y"); ?></strong></div>

         <?php if(isset($order->photos)){ ?>
           <div style="text-indent:40px;">รูปภาพอ้างอิง:
           <?php foreach($order->photos as $photo){ ?>
              <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="example-gallery" class="mt-1">
                  <img class="d-inline" style="display: block; width: 48px; height: 48px; object-fit: cover;" src="/images/<?php echo $photo->file; ?>">
              </a>
              <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="example-gallery" class="mt-1">
                  <img class="d-inline" style="display: block; width: 48px; height: 48px; object-fit: cover;" src="/images/<?php echo $photo->file; ?>">
              </a>
              <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="example-gallery" class="mt-1">
                  <img class="d-inline" style="display: block; width: 48px; height: 48px; object-fit: cover;" src="/images/<?php echo $photo->file; ?>">
              </a>
            <?php } ?>
            </div>
          <?php } ?>
         <div class="row">
         <div class="mt-3 col-12">
           <ul class="list-group">
              <li class="list-group-item p-3"><h4>o ยอดที่ต้องชำระ:  <?php echo number_format($order->service_order_quote_price, 0, '.', ',');  ?> บาท </h4></li>
              <li class="list-group-item p-3">
                <h5>ช่องทางการชำระเงิน:</h5>
                <div class="p-3">
                  <a href="/order/service/make-service-order-payment/<?php echo $order->id; ?>/<?php echo $order->service_order_hash; ?>" class="btn btn-primary">ชำระเงิน</a>
                </div>
              </li>
            </ul>
          </div>
         </div>
        </div>

      <?php } ?>
      <div class="container mt-4 mb-4">
        <div class="row">
          <div class="col-12">
            <a href="/service/messages/<?php echo DashboardController::getServiceConversationId($order->service->id); ?>"><i class="fas fa-arrow-left"></i> กลับไปหน้าพูดคุยเกี่ยวกับบริการนี้</a>
          </div>
        </div>
      </div>
     </div>
   </div>
</div>



<!-- End EditShipping Modal -->
@endsection
