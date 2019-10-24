<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'แดชบอร์ด '.$store->name)

@section('sidebar')
    @parent


@endsection

@section('content')
<?php use \App\Http\Controllers\StoreManager\StoreDashboardController; ?>
    <section id="seller-dashboard-main">
        <div class="container border mt-3 pt-3" <?php if($store->cover_photo){ ?>style="background-image:url('/images/<?php echo $store->cover_photo->file; ?>'); background-size: cover;background-repeat: no-repeat; background-position: center center;" <?php } ?>>
            <div class="row bg-white ml-3 mr-3 mt-5">
              <div class="col-md-6 col-12" >
                <div class="wrapper" >
                  	<div class="p-4 text-center">
                      <img class="border" style="display: block; width: 100px; height: 100px; object-fit: cover;" src="/images/{{$photo->file}}">
                      <a href="/storemanager/store/{{$store->username}}/settings/storephoto"><i class="themify ti ti-pencil"></i> เปลี่ยนรูป</a>
                  	</div>
                  	<div class="p-4">
                    	<h4 class="d-inline">{{$store->name}}</h4> <a href="/store/{{$store->username}}" target="_blank"><i class="fas fa-external-link-alt"></i> ดูหน้าร้าน</a>
                    	<p class="text-muted">
                       <span>{{$store->description}}<br><a href="/storemanager/store/{{$store->username}}/settings/"><i class="themify ti ti-pencil"></i> แก้ไขรายละเอียด</a></span>
                      </p>
                  </div>
                  </div>
              </div>
              <div class="col-md-2 col-4 pt-3 dashboard-top-stat">
                <div class="text-center">
                  <p class="h1"><i class="themify ti ti-user text-primary"></i></p>
                  <span class="text-primary">ผู้ติดตาม</span>
                  <div>
                    <span class="lead"><?php echo StoreDashboardController::countFollower($store->id);  ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-4 pt-3 dashboard-top-stat">
                <div class="text-center">
                  <p class="h1"><i class="themify ti ti-package  text-success"></i></p>
                  <span class="text-success">สินค้าทั้งหมด</span>
                  <div>
                    <span class="lead"><?php echo count($store->products) ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-4 pt-3 dashboard-top-stat">
                <div class="text-center">
                  <p class="h1"><i class="themify ti ti-star text-warning"></i></p>
                  <span class="text-warning font-weight-bold">Rating</span>
                  <div>
                    <span class="lead"></span>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section>


    <div id="dashboard-main-2" class="container mt-3 pt-4 pb-4">
      <div class="row">
        <div class="col-md-8 bg-white border-top border-left border-bottom pt-4 pb-4">
           <h5>รายการสั่งซื้อ</h5><br>
           <div class="d-flex bd-highlight bg-light-blue text-white p-3">
              <div class="p-2 flex-grow-1 bd-highlight">
                <span class="h4 font-weight-bold"><?php echo date('F Y'); ?></span><br><br>
                <span class="">ยอดขายทั้งเดือน</span>
              </div>
              <div class="p-2 bd-highlight h2 align-self-center">30,000 ฿</div>
            </div>
            <table class="table table-hover mt-3">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ผู้สั่ง</th>
                  <th scope="col">วันที่สั่ง</th>
                  <th scope="col">ยอดขาย</th>
                  <th scope="col">สถานะ</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($latest_orders as $order){ ?>
                  <tr>
                    <th scope="row"><a href="/storemanager/store/<?php echo $store->username; ?>/order/<?php echo $order->id ?>">#<?php echo $order->id ?></a></th>
                    <td><?php echo $order->billing_address->firstname.' '.$order->billing_address->lastname; ?></td>
                    <td><?php echo $order->created_at->diffForHumans(); ?></td>
                    <td><?php echo $order->order_total; ?> ฿</td>
                    <td>
                      <?php if($order->status['id']==1){ ?>
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
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <div class="border-top text-center pt-4"><a href="/storemanager/store/<?php echo $store->username ?>/orders/all">— ดูรายการสั่งซื้อทั้งหมด —</a></div>
        </div>
        <div class="col-md-4 bg-white border pt-4 pb-4">
          <h5>รายการสั่งซื้อตามพื้นที่ (เดือนนี้)</h5><br>
          <div id="thailand-map" style="width:100%; height: 400px;"></div>
          <script>
          var gdpData = {
            "TH-21": 16.63,
            "TH-22": 11.58,
            "TH-10": 158.97,
            "TH-44": 22.58,
          };
          </script>
        </div>


        <div id="dashboard-main-3" class="container mt-3 pt-4 pb-4 pl-0 pr-0">
        <div class="card-columns">
          <div class="card p-4">
            <h5>รายการสั่งแบ่งตามวัน (เดือนนี้)</h5><br>
            <canvas id="myChart" width="400" height="400"></canvas>
          </div>

           <div class="card p-2">
             <div class="card-body">
               <h5 class="card-title">DECORIQ News Update</h5>
               <div id="demo1" class="scroll-text">
                 <ul class="list-group">
                  <li class="list-group-item">
                      <img alt="Bootstrap Image Preview" class="float-left mr-3" src="https://placeimg.com/140/140/tech" />
                      <h4><a href="#">DECORIQ IPO</a></h4>
                      <p><span class="text-muted">13 Dec 2018 - </span>
                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                      </p>
                  </li>
                  <li class="list-group-item">
                      <img alt="Bootstrap Image Preview" class="float-left mr-3" src="https://placeimg.com/140/140/animals" />
                      <h4><a href="#">zero Commision fee</a></h4>
                      <p><span class="text-muted">01 Nov 2018 - </span>
                        Donec id elit ravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                      </p>
                  </li>
                  <li class="list-group-item">
                      <img alt="Bootstrap Image Preview" class="float-left mr-3" src="https://placeimg.com/140/140/nature" />
                      <h4><a href="#">Studio tutorial</a></h4>
                      <p><span class="text-muted">09 Oct 2018 - </span>
                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                      </p>
                  </li>
                  <li class="list-group-item">
                      <img alt="Bootstrap Image Preview" class="float-left mr-3" src="https://placeimg.com/140/140/arch" />
                      <h4><a href="#">DECORIQ IPO</a></h4>
                      <p><span class="text-muted">22 Feb 2018 - </span>
                        Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                      </p>
                  </li>
                </ul>
                </div>
                <div class="border-top text-center pt-4"><a href="#">— Check all news —</a></div>
             </div>
           </div>

           <div class="card p-3">
             <div class="card-body">
               <h5 class="card-title">Card title</h5>
               <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
               <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
             </div>
           </div>
           <div class="card text-center">
             <div class="card-body">
               <h5 class="card-title">Card title</h5>
               <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
               <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
             </div>
           </div>

           <div class="card p-3 text-right">
             <blockquote class="blockquote mb-0">
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
               <footer class="blockquote-footer">
                 <small class="text-muted">
                   Someone famous in <cite title="Source Title">Source Title</cite>
                 </small>
               </footer>
             </blockquote>
           </div>
           <div class="card">
             <div class="card-body">
               <h5 class="card-title">Card title</h5>
               <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
               <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
             </div>
           </div>
         </div>
       </div>
     </div>
       </div><!--container-->



@endsection
