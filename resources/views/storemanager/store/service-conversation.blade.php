<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'บริการของร้าน')

@section('sidebar')
    @parent


@endsection
<?php use \App\Http\Controllers\StoreManager\ServiceMessageController; ?>

@section('content')


<section id="seller-dashboard-service-message-main">
<div class="container bg-white border mt-3 mb-3 pl-0 pr-0 pt-3">
  <div class="pl-3"><h4>ข้อความบริการของร้าน {{$store->name}}</h4></div>
  <div class="row mt-3">
    <div class="col-12">

      <table class="table border-bottom table table-hover">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col"></th>
              <th class="text-muted" scope="col">ผู้ติดต่อ</th>
              <th class="text-muted" scope="col">ข้อความล่าสุด</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php
              foreach($service_conversations as $service_conversation){ ?>
                <tr>
                  <td class="pb-1"><img class="d-inline text-center ml-3"  style="display: block; width: 50px; height: 50px; object-fit: cover;" src="/images/<?php echo $service_conversation->service->service_photos[0]->name; ?>"></td>
                  <td><strong><?php echo $service_conversation->service->name; ?></strong></td>
                  <td><?php echo $service_conversation->user->name; ?></td>
                  <td><?php echo $service_conversation->messages[count($service_conversation->messages) - 1]->message; ?></td>
                  <td><a href="/storemanager/store/{{$store->username}}/service/messages/<?php echo $service_conversation->id; ?>" class="btn btn-success">อ่านข้อความ</a></td>

                </tr>

          <?php
              }
          ?>

          </tbody>
        </table>
    </div>
  </div>
</div>
</section>



@endsection
