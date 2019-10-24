@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')
<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-star"></i> รีวิวสินค้า</h3>
    <div class="row mb-3">
      <div class="col-12">



      </div>
    </div>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ร้าน</th>
            <th scope="col">สินค้า</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>

          <?php foreach($orders as $order){ ?>

                <tr>
                  <th scope="row"><?php echo $order->id; ?></th>
                  <td><?php echo $order->store['name']; ?></td>
                  <td class="p-2">
                    <ul class="m-0">
                    <?php  $products = $order->products;
                          foreach($products as $product){ ?>
                           <li class="border-bottom pb-1 pt-1" style="list-style:none;"><img class="d-inline"  style="display: block; width: 48px; height: 48px; object-fit: cover;" src="/images/<?php echo DashboardController::getProductPhoto($product->product_id); ?>"> <?php echo $product->name ?></li>
                    <?php } ?>

                  </ul>
                  </td>

                  <td>
                    <?php if($order->reviews){ ?>
                      <a href="/dashboard/review/order/<?php echo $order->id; ?>/">ดูรีวิวที่เขียน</a>
                    <?php }else{ ?>
                      <a href="/dashboard/review/order/<?php echo $order->id; ?>/">เขียนรีวิว</a>
                    <?php } ?>
                  </td>
                </tr>

          <?php } ?>
        </tbody>
      </table>
      {{ $orders->links() }}


  </div>
</div>



@endsection
