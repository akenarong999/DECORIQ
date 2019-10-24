<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'รายการสั่งซื้อของร้าน '.$store->name)

@section('sidebar')
    @parent
@endsection


@section('content')
<?php use \App\Http\Controllers\StoreManager\ServiceOrdersController; ?>

<section>
   <div class="container mt-3 mb-3">
     <div class="row">
     <div class="col-6 border">

       <a href="/storemanager/store/<?php echo $store->username; ?>/orders/all" class="text-dark">
         <div class="col-12  p-4 text-center">
           รายการสั่งซื้อสินค้า <i class="themify ti ti-package"></i>
         </div>
       </a>
     </div>
     <div class="col-6 border bg-secondary">

        <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/all"  class="text-white">
          <div class="col-12 p-4 text-center">
            <strong>รายการสั่งซื้อบริการ <i class="themify ti ti-ruler-pencil"></i></strong>
          </div>
        </a>
     </div>
   </div>
   </div>
</section>

    <section>
       <div class="container bg-white border p-5 mt-2 mb-4">

     <div class="row">
        <div class="col-12 mb-3"><h2><i class="themify ti ti-receipt" ></i> รายการสั่งซื้อของร้าน <?php echo $store->name; ?> (บริการ)</h2></div>
     </div>


        <div class="row mb-3">
          <div class="col-12">
            <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/all" role="button"class="btn btn-light btn-sm border mt-1">
              ทั้งหมด <span class="badge badge-light"><?php echo ServiceOrdersController::countAllServiceordersbystoreid($store->id); ?></span>
            </a>

            <?php
            if(isset($statuses)){
             ksort($statuses);
              foreach(array_keys($statuses) as $status_id){ ?>
              <?php if($status_id==1){ ?>
                <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/1" role="button" class="btn btn-warning btn-sm mt-1">
              <?php } elseif($status_id==2){ ?>
                <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/2" role="button" class="btn btn-info btn-sm mt-1">
              <?php } elseif($status_id==3){ ?>
                <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/3" role="button" class="btn btn-primary btn-sm mt-1">
              <?php } elseif($status_id==4){ ?>
                <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/4" role="button" class="btn btn-secondary btn-sm mt-1">
              <?php } elseif($status_id==5){ ?>
                <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/5" role="button" class="btn btn-info btn-sm mt-1">
              <?php } elseif($status_id==6){ ?>
                <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/6" role="button" class="btn btn-success btn-sm mt-1">
              <?php } elseif($status_id==7){ ?>
                <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/7" role="button" class="btn btn-danger btn-sm mt-1">
                <?php } elseif($status_id==8){ ?>
                  <a href="/storemanager/store/<?php echo $store->username; ?>/service-orders/8" role="button" class="btn btn-dark btn-sm mt-1">
                <?php } ?>
                  <?php echo ServiceOrdersController::getServiceOrderstatusnamebyid($status_id); ?> <span class="badge badge-light"><?php echo ServiceOrdersController::countServiceOrderbystatus($status_id,$store->id); ?></span>
                </a>
            <?php } }?>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <table class="table table-hover" id="table_id">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">วันที่สั่ง</th>
                    <th scope="col">ร้าน</th>
                    <th scope="col">ยอดรวม</th>
                    <th scope="col">สถานะ</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($orders as $order){ ?>

                        <tr>
                          <th scope="row"><?php echo $order->id; ?></th>
                          <td><?php echo $order->created_at->format('d-M-Y'); ?></td>
                          <td><?php echo $order->store->name; ?></td>
                          <td><?php echo number_format($order->order_total, 0, '.', ',');  ?> ฿</td>
                          <td>
                            <?php if($order->status['id']==1){ ?>
                              <span class="badge badge-pill badge-warning"><?php echo $order->status['name']; ?></span>
                            <?php } elseif($order->status['id']==2){ ?>
                              <span class="badge badge-pill btn-info"><?php echo $order->status['name']; ?></span>
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
                            <?php } ?>
                          </td>
                          <td><?php if($order->status['id']==1){ ?><a href="/order-payment/<?php echo $order->id; ?>/<?php echo $order->order_hash; ?>/">ชำระเงิน</a> |<?php } ?> <a href="/storemanager/store/<?php echo $store->username; ?>/service-order/<?php echo $order->id; ?>/">ดูรายละเอียด</a></td>
                        </tr>

                  <?php } ?>

                </tbody>
              </table>

          </div>
        </div>
      </div>





       </div>
    </section>
@endsection
