@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')
<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-file-invoice"></i> รายการสั่งซื้อสินค้า</h3>
    <div class="row mb-3">
      <div class="col-12">
        <a href="/dashboard/orders/product/status/all" role="button"class="btn btn-light btn-sm border mt-1">
          ทั้งหมด <span class="badge badge-light"><?php echo DashboardController::countAllProductOrdersbyUserid(); ?></span>
        </a>
      <?php if(!empty($statuses)){  ?>
        <?php ksort($statuses);
          foreach(array_keys($statuses) as $status_id){ ?>
          <?php if($status_id==1){ ?>
            <a href="/dashboard/orders/product/status/1" role="button" class="btn btn-warning btn-sm mt-1">
          <?php } elseif($status_id==2){ ?>
            <a href="/dashboard/orders/product/status/2" role="button" class="btn btn-primary btn-sm mt-1">
          <?php } elseif($status_id==3){ ?>
            <a href="/dashboard/orders/product/status/3" role="button" class="btn btn-info btn-sm mt-1">
          <?php } elseif($status_id==4){ ?>
            <a href="/dashboard/orders/product/status/4" role="button" class="btn btn-success btn-sm mt-1">
          <?php } elseif($status_id==5){ ?>
            <a href="/dashboard/orders/product/status/5" role="button" class="btn btn-danger btn-sm mt-1">
          <?php } elseif($status_id==6){ ?>
            <a href="/dashboard/orders/product/status/6" role="button" class="btn btn-secondary btn-sm mt-1">
          <?php } elseif($status_id==7){ ?>
            <a href="/dashboard/orders/product/status/7" role="button" class="btn btn-dark btn-sm mt-1">
          <?php } ?>
              <?php echo DashboardController::getProductOrderStatusNamebyid($status_id); ?> <span class="badge badge-light"><?php echo DashboardController::countProductOrderbystatus($status_id); ?></span>
            </a>
        <?php } ?>
      <?php }  ?>

      </div>
    </div>
    <table class="table table-hover">
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
                  <td><img class="d-inline"  style="display: block; width: 24px; height: 24px; object-fit: cover;" src="/images/{{ $order->store->photo->file }}"> <?php echo $order->store['name']; ?></td>
                  <td><?php echo number_format($order->order_total, 0, '.', ',');  ?> ฿</td>
                  <td>
                    <?php if($order->status['id']==1){ ?>
                      <span class="badge badge-pill badge-warning"><?php echo $order->status['name']; ?></span>
                    <?php } elseif($order->status['id']==2){ ?>
                      <span class="badge badge-pill btn-primary"><?php echo $order->status['name']; ?></span>
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
                    <?php } ?>
                  </td>
                  <td><?php if($order->status['id']==1){ ?><a href="/order-payment/<?php echo $order->id; ?>/<?php echo $order->order_hash; ?>/">ชำระเงิน</a> |<?php } ?> <a href="/dashboard/order/<?php echo $order->id; ?>/">ดูรายละเอียด</a></td>
                </tr>

          <?php } ?>
        </tbody>
      </table>
      {{ $orders->links() }}


  </div>
</div>



@endsection
