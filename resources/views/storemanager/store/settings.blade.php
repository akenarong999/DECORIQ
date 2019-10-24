<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'ตั้งค่าร้าน '.$store->name)

@section('sidebar')
    @parent
@endsection


@section('content')
    <section id="seller-dashboard-shipping">
       <div class="container bg-white border mt-3 p-5 mb-3">
         <div class="row">
           <div class="col-9 mb-3 border-right">
             <h3><i class="fas fa-store-alt"></i> ตั้งค่าร้านค้า  <img class="rounded-circle d-inline" src="/images/{{ $store->photo->file }}" style="display: block; width:36px; height: 36px; object-fit: cover;"> </h3><br>
             @if (Session::has('success'))
              <div class="alert alert-success alert-block mb-4">
               <button type="button" class="close" data-dismiss="alert">×</button>
                      {{ Session::get('success') }}
              </div>
              @endif
             <form action="/storemanager/store/<?php echo $store->username; ?>/settings/editstoreprofile">
              <div class="form-group">
                <label for="store-name">ชื่อร้านค้า</label>
                <input type="text" name="store_name" class="form-control" id="store-name" value="<?php echo $store->name; ?>"  placeholder="">
              </div>

              <div class="form-group">
                <label for="store-name">เกี่ยวกับร้านค้า</label>
                <textarea name="store_description" placeholder="กรอกรายละเอียดสั้นๆเกี่ยวกับร้านของคุณที่นี่" class="form-control" id="store-description"  placeholder=""><?php echo $store->description; ?></textarea>
              </div>

              <button type="submit" class="btn btn-primary">เปลี่ยนแปลง</button>
            </form>

           </div>
           <div class="col-3 mb-3 pt-4">
             <div class="list-group">
               <a href="/storemanager/store/{{$store->username}}/settings" class="list-group-item list-group-item-action active">ตั้งค่าโปรไฟล์ร้าน</a>
               <a href="/storemanager/store/{{$store->username}}/settings/storephoto" class="list-group-item list-group-item-action">ตั้งค่ารูปร้าน</a>
               <a href="/storemanager/store/{{$store->username}}/settings/address" class="list-group-item list-group-item-action">ตั้งค่าที่อยู่ร้าน</a>
               <a href="/storemanager/store/{{$store->username}}/settings/role" class="list-group-item list-group-item-action">ตั้งค่าผู้ดูแลร้าน</a>
               <a href="/storemanager/store/{{$store->username}}/settings/ads" class="list-group-item list-group-item-action">ตั้งค่าการโฆษณา</a>
               <a href="/storemanager/store/{{$store->username}}/settings/display" class="list-group-item list-group-item-action disabled">ตั้งค่าการแสดงผลร้าน</a>
              </div>
           </div>




       </div>
     </div>

    </section>
@endsection
