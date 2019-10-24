<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'บริการของร้าน')

@section('sidebar')
    @parent


@endsection
<?php use \App\Http\Controllers\StoreManager\ServicesController; ?>

@section('content')


<section id="seller-dashboard-service-alert-main">

  <div class="alert alert-success">
    <div class="container">
      <strong><i class="fa fa-envelope" aria-hidden="true"></i> คุณมี 360 ข้อความ</strong> สอบถามเกี่ยวกับบริการที่ยังไม่ได้อ่าน กดเพื่อ <a href="/storemanager/store/<?php echo $store->username; ?>/service/messages/"><strong>ดูข้อความทั้งหมด</strong></a>
    </div>
  </div>

</section>
  <section id="seller-dashboard-service-main">
    <div class="container bg-white border mt-3 mb-3 p-4">
      <div class="row mb-4 pl-4 pr-4">
       <div class="col-10">
          <h2>รายการบริการในร้าน {{$store->name}}</h2>
       </div>
       <div class="col-2 text-right">
          <a class="btn btn-primary" href="/storemanager/store/{{$store->username}}/services/create">
            <i class="themify ti ti-plus font-weight-bold"></i> เพิ่มบริการใหม่
          </a>
       </div>
       </div>
       <table class="table table-hover table-responsive-lg" id="table_id">
       <thead>
         <tr>
           <th scope="col" style="width:2%"></th>
           <th scope="col" style="width:5%">ID</th>
           <th scope="col" style="width:10%">รูปภาพ</th>
           <th scope="col" style="width:38%">ชื่อสินค้า</th>
           <th scope="col" style="width:10%">ราคาเริ่มต้น</th>
           <th scope="col" style="width:10%">อนุมัติ</th>
           <th scope="col" style="width:10%">แผยแพร่</th>
           <th scope="col" style="width:15%">คำสั่ง</th>
         </tr>
       </thead>
       <tbody>
         @foreach($services as $service)
         <tr>
           <td></td>
           <td>{{$service->id}}</td>
           <td>
             @if(!empty($service->service_photos))
              @foreach($service->service_photos as $service_photo)
                <img class="d-inline"  style="display: block; width: 80px; height: 80px; object-fit: cover;" src="/images/{{$service_photo->name}}">
                @break
              @endforeach
             @else
              <img src="http://placehold.it/80">
             @endif
           </td>
           <td>{{$service->name}}</td>
           <td>{{$service->start_price}} ฿</td>
           <td>{{$service->service_status->name}}</td>
           <td>
             <label class="onoff-switch">
                 <input type="checkbox" id="switch-{{$service->id}}" class="onoff-switch-input" name="onoff_switch" value="{{$service->id}}"
                 <?php
                 if($service->is_publish==1)
                 {
                   echo "checked";
                 }?>>
                 <span class="onoff-slider"></span>
             </label>
           </td>
          <td><meta name="csrf-token" content="{{ csrf_token() }}">
            <a href="/storemanager/store/{{$store->username}}/services/{{$service->id}}/edit" title="แก้ไขบริการ" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a>
            <a href="/service/{{$service->slug}}/" title="ดูหน้าบริการ" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-eye"></i></a>
            <a  data-service-id="{{$service->id}}" title="ลบบริการ" class="btn btn-sm btn-outline-danger delete-service-button"  id="delete-service-button-<?php echo $service->id; ?>"><i style="color:red;" class="themify ti ti-trash"></i></a></td>
         </tr>
         @endforeach

       </tbody>
     </table>
        <div class="d-flex justify-content-center">
       </div>
    </div>
   </section>



@endsection
