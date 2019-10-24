@extends('layouts.frontend')
@section('title')
Dashboard - DECORIQ
@endsection

@section('content')

<div class="container mt-5">
  <div class="row mb-2 border-bottom mb-4">
    <div class="col-12">
      <h1>Dashboard</h1>
    </div>
  </div>

  <div class="row mb-4">
      <div class="accordion col-md-3 mb-4" id="accordionExample">
        <div class="card">
          <div class="card-header bg-white p-2" id="heading1">
            <h5 class="mb-0">
              <button class="btn" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
               <i class="fas fa-user"></i> แดชบอร์ดของคุณ
              </button>
            </h5>
          </div>

          <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordionExample">
            <div class="card-body p-0">
              <ul class="list-group">
                <a href="/dashboard" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- หน้าหลัก</li></a>
                <a href="/dashboard/follow" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- การติดตาม/ถูกติดตาม</li></a>
                <a href="/dashboard/collection" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- คอลเลคชั่นที่เก็บไว้</li></a>
               </ul>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header bg-white p-2" id="heading2">
            <h5 class="mb-0">
              <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapse2"  aria-controls="collapse2">
              <i class="fas fa-file-invoice"></i> รายการสั่งซื้อ
              </button>
            </h5>
          </div>

          <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
            <div class="card-body p-0">
              <ul class="list-group">
                <a href="/dashboard/orders/product/status/all" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- รายการสั่งซื้อของสินค้า</li></a>
                <a href="/dashboard/orders/service/status/all" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- รายการสั่งซื้อของบริการ</li></a>
               </ul>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header bg-white p-2" id="heading3">
            <h5 class="mb-0">
              <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-controls="collapse3">
               <i class="fas fa-star"></i> รีวิว
              </button>
            </h5>
          </div>

          <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
            <div class="card-body p-0">
              <ul class="list-group">
                <a href="/dashboard/review/" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- รีวิวสินค้า</li></a>
                <a href="/dashboard/service-review/" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- รีวิวบริการ</li></a>
               </ul>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header bg-white p-2" id="heading4">
            <h5 class="mb-0">
              <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapse4" aria-controls="collapse3">
               <i class="fas fa-home"></i> ที่อยู่รับสินค้า
              </button>
            </h5>
          </div>

          <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
            <div class="card-body p-0">
              <ul class="list-group">
                <a href="/dashboard/address/" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- ที่อยู่ในการรับสินค้า</li></a>
                <a href="#" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- เพิ่มที่อยู่ในการรับสินค้า</li></a>
               </ul>
            </div>
          </div>
        </div>

        <div class="card border-bottom">
          <div class="card-header bg-white p-2" id="heading5">
            <h5 class="mb-0">
              <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-controls="collapse4">
              <i class="fas fa-cogs"></i> ตั้งค่า
              </button>
            </h5>
          </div>
          <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
            <div class="card-body p-0">
              <ul class="list-group">
                <a href="/dashboard/settings/profile/" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- แก้ไขโปรไฟล์</li></a>
                <a href="/dashboard/settings/profilephoto/" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- แก้ไขรูปโปรไฟล์</li></a>
                <a href="/dashboard/settings/privacy" class="text-muted"><li class="list-group-item border-top-0 border-left-0 border-right-0 border-bottom pr-1 pt-1 pb-1 pl-4">- ความเป็นส่วนตัว</li></a>
               </ul>
            </div>
          </div>
        </div>
        <div class="p-3"><a href="/logout/" class="text-red"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></div>
      </div>

    <div class="col-md-9 border pl-0 pr-0 pb-5">
      @yield('dashboardcontent')

    </div>
  </div>
</div>
<br>
<br>
<br>

<br>

</div>


@endsection
