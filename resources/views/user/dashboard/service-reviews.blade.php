@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')
<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-star"></i> รีวิวบริการ</h3>
    <div class="row mb-3">
      <div class="col-12">



      </div>
    </div>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ร้าน</th>
            <th scope="col">บริการ</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>

          <?php foreach($service_orders as $service_order){ ?>

                <tr>
                  <th scope="row"><?php echo $service_order->id; ?></th>
                  <td><?php echo $service_order->service->store->name; ?></td>
                  <td class="p-2">
                    <img class="d-inline"  style="display: block; width: 48px; height: 48px; object-fit: cover;"  src="/images/<?php echo $service_order->service->service_photos[0]->name ?>">  <?php echo $service_order->service->name; ?>
                  </td>

                  <td>
                    <?php if($service_order->review){ ?>
                      <a href="/dashboard/service-review/order/<?php echo $service_order->id; ?>/">ดูรีวิวที่เขียน</a>
                    <?php }else{ ?>
                      <a href="/dashboard/service-review/order/<?php echo $service_order->id; ?>/">เขียนรีวิว</a>
                    <?php } ?>
                  </td>
                </tr>

          <?php } ?>
        </tbody>
      </table>
      {{ $service_orders->links() }}


  </div>
</div>



@endsection
