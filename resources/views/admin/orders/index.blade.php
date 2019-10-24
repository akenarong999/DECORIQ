<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'รายการสั่งซื้อ')

@section('sidebar')
    @parent


@endsection

@section('content')
<?php use \App\Http\Controllers\Admin\AdminOrdersController; ?>
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3 mt-3 pb-2 border-bottom">
             <div class="col-6">
                <h2>รายการสั่งซื้อ</h2>
             </div>
           </div>

           <div class="container">
             <div class="row">
               <div class="col-12">
                 @if ( Session::has('delete_success') )
                    <div class="alert alert-success">
                        <span>{{ Session::get('delete_success') }}</span>
                    </div>
                  @endif
               </div>
             </div>
           </div>

           <div class="row mb-3">
             <div class="col-12">
               <a href="/admin/orders/status/all" role="button"class="btn btn-light btn-sm border mt-1">
                 ทั้งหมด <span class="badge badge-light"><?php echo $count_all_orders; ?></span>
               </a>
             <?php if(!empty($statuses)){  ?>
               <?php ksort($statuses);
                 foreach(array_keys($statuses) as $status_id){ ?>
                 <?php if($status_id==1){ ?>
                   <a href="/admin/orders/status/1" role="button" class="btn btn-warning btn-sm mt-1">
                 <?php } elseif($status_id==2){ ?>
                   <a href="/admin/orders/status/2" role="button" class="btn btn-primary btn-sm mt-1">
                 <?php } elseif($status_id==3){ ?>
                   <a href="/admin/orders/status/3" role="button" class="btn btn-info btn-sm mt-1">
                 <?php } elseif($status_id==4){ ?>
                   <a href="/admin/orders/status/4" role="button" class="btn btn-success btn-sm mt-1">
                 <?php } elseif($status_id==5){ ?>
                   <a href="/admin/orders/status/5" role="button" class="btn btn-danger btn-sm mt-1">
                 <?php } elseif($status_id==6){ ?>
                   <a href="/admin/orders/status/6" role="button" class="btn btn-secondary btn-sm mt-1">
                 <?php } elseif($status_id==7){ ?>
                   <a href="/admin/orders/status/7" role="button" class="btn btn-dark btn-sm mt-1">
                 <?php } ?>
                     <?php echo AdminOrdersController::getOrderstatusnamebyid($status_id); ?> <span class="badge badge-light"><?php echo AdminOrdersController::countOrderbystatus($status_id); ?></span>
                   </a>
               <?php } ?>
             <?php }  ?>

             </div>
           </div>

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
              @if($orders)
                @foreach($orders as $order)
                  <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->created_at}}</td>
                    <td><img src="/images/{{ $order->store->photo->file }}" class="d-inline" style="display: block; width: 24px; height: 24px; object-fit: cover;"> {{$order->store->name}}</td>
                    <td><?php echo number_format($order->order_total, 0, '.', ',');  ?> ฿</td>
                    <td>
                      <?php if($order->order_status->id==1){ ?>
                        <span class="badge badge-pill badge-warning">{{$order->order_status->name}}</span>
                      <?php } elseif($order->order_status->id==2){ ?>
                        <span class="badge badge-pill btn-primary">{{$order->order_status->name}}</span>
                      <?php } elseif($order->order_status->id==3){ ?>
                        <span class="badge badge-pill badge-info">{{$order->order_status->name}}</span>
                      <?php } elseif($order->order_status->id==4){ ?>
                        <span class="badge badge-pill badge-success">{{$order->order_status->name}}</span>
                      <?php } elseif($order->order_status->id==5){ ?>
                        <span class="badge badge-pill badge-danger">{{$order->order_status->name}}</span>
                      <?php } elseif($order->order_status->id==6){ ?>
                        <span class="badge badge-pill badge-secondary">{{$order->order_status->name}}</span>
                      <?php } elseif($order->order_status->id==7){ ?>
                        <span class="badge badge-pill badge-dark">{{$order->order_status->name}}</span>
                      <?php } ?>
                    </td>
                    <td>
                      <a href="/admin/orders/{{$order->id}}/">รายละเอียด</a> | <a href="/admin/orders/{{$order->id}}/edit">จัดการ</a>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>

          <div class="row">
            <div class="col-sm-4 offset-sm-5">
            </div>
          </div>
        </div>
    </section>
@endsection
