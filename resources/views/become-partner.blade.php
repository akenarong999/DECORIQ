@extends('layouts.frontend')

@section('description')
หากคุณมีสินค้าหรือบริการเกี่ยวกับบ้าน และต้องการหาผู้ซื้อจากทั่วประเทศ สามารถนำเสนอให้กับเราเพื่อร่วมเป็นส่วนหนึ่งของพาร์ทเนอร์กับเดคคอริคได้
@endsection

@section('title')
พาร์ทเนอร์ มาร่วมเป็นส่วนหนึ่งของความสำเร็จไปกับเรา - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\ProductFrontendController; ?>

 <div class="container mt-4 mb-2">
   <div class="row">
     <div class="col-md-12 col-md-offset-3">
       <h1 class="text-center">ร่วมกับเรา</h1>
       <h5 class="text-center text-gray">มาร่วมเป็นส่วนหนึ่งในการเป็นผู้ขายหรือผู้ให้บริการมืออาชีพเกี่ยวกับบ้าน</h5>
     </div>
   </div>
 </div>

@if(session()->has('success_message'))
 <div class="container mb-3" style="background-color:#d4edda;color:#155724;border:#c3e6cb;">
   <div class="row p-2">
    <i class="fas fa-check"></i> {{ session()->get('success_message') }}
   </div>
 </div>
@endif

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="/images/become-a-seller-1-slide.jpg">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="/images/become-a-seller-2-slide.jpg">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="/images/become-a-seller-3-slide.jpg">
      </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container mt-5 mb-5">
  <div class="row mb-3">
    <div class="col-12">
      <h5>เข้าร่วมกับเราหากคุณมี...</h5>
    </div>
  </div>
  <div class="row">
    <div class="col-4">
        <h2><i class="themify ti ti-package"></i> สินค้า</h2>
        <span class="text-muted">หากคุณเป็นเจ้าของร้านค้าที่ขายสินค้าที่เกี่ยวกับบ้าน อาทิ ของแต่งบ้าน เฟอร์นิเจอร์ ของใช้ภายในบ้าน วัสดุเกี่ยวกับบ้าน มาร่วมสร้างโอกาสในการขายสินค้าให้กับลูกค้าจากทั่วประเทศ</span>
    </div>
    <div class="col-4">
        <h2><i class="themify ti ti-hummer"></i> ทักษะ</h2>
        <span class="text-muted">หากคุณมีความสามารถ ทักษะของคุณเพื่อทำสิ่งที่สร้างสรรค์และมีประโยชน์กับผู้คน นอกจากนี้ยังสามารถทำเงินให้กับคุณได้อีกด้วย</span>
    </div>
    <div class="col-4">
        <h2><i class="themify ti ti-heart"></i> บริการ</h2>
        <span class="text-muted">หากคุณอยู่ในสายงานบริการแล้วล่ะก็ คุณสามารถเป็นพาร์ทเนอร์กับเราเพื่อสร้างฐานลูกค้า ซึ่งจะช่วยสร้างรายได้ให้กับคุณอย่างมั่นคงและยั่งยืน</span>
    </div>
  </div>
</div>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-8 offset-2 pl-5 pr-5 pt-5 pb-3 border">
     <h2 id="partner-form"> <i class="themify ti ti-pencil-alt"></i> กรอกข้อมูลเพื่อเข้าร่วม</h2>
     <span class="text-muted">นำเสนอสินค้าหรือบริการที่คุณมีเพื่อเข้าร่วมกับทาง DECORIQ</span><br>
     @if(session()->has('success_message'))
      <div class="alert alert-success mt-3 mb-3  p-2">
         <i class="fas fa-check"></i> {{ session()->get('success_message') }}
      </div>
     @endif
    <form class="mt-4" action="/partner/apply" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group row">
        <label for="name" class="col-4 col-form-label">ชื่อของคุณ</label>
        <div class="col-8">
          <input id="name" name="name" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="telnumber" class="col-4 col-form-label">เบอร์โทรศัพท์</label>
        <div class="col-8">
          <input id="telnumber" name="telnumber" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-4 col-form-label">อีเมล์</label>
        <div class="col-8">
          <input id="email" name="email" type="email" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="storename" class="col-4 col-form-label">ชื่อร้านค้า</label>
        <div class="col-8">
          <input id="storename" name="storename" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="products" class="col-4 col-form-label">รายละเอียดของสินค้า/บริการ</label>
        <div class="col-8">
          <textarea id="description" name="description" cols="40" rows="4" class="form-control" required="required"></textarea>
        </div>
      </div>
      <div class="form-group row">
        <label for="products" class="col-4 col-form-label">รูปภาพสินค้า 1 (ถ้ามี)</label>
        <div class="col-8">
          <input type="file" name="photo_1" class="form-control p-2 pb-5">
        </div>
      </div>
      <div class="form-group row">
        <label for="products" class="col-4 col-form-label">รูปภาพสินค้า 2 (ถ้ามี)</label>
        <div class="col-8">
          <input type="file" name="photo_2" class="form-control p-2 pb-5">
        </div>
      </div>
      <div class="form-group row">
        <label for="products" class="col-4 col-form-label">รูปภาพสินค้า 3 (ถ้ามี)</label>
        <div class="col-8">
          <input type="file" name="photo_3" class="form-control p-2 pb-5">
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-4 col-8  mt-4">
          <button name="submit" type="submit" class="btn btn-primary w-100">ส่งข้อมูล</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection
