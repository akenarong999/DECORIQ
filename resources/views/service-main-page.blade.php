@extends('layouts.frontend')

@section('title')
หน้าหลักบริการ - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\ProductFrontendController; ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
  </ol>
  <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="/images/service-main-slider-1.jpg">
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

<div class="container mt-5 mb-4">
    <div class="row">
      <div class="col-10 offset-1 text-center">
        <h3><i class="themify ti ti-ruler-pencil"></i> บริการเกี่ยวกับบ้าน</h3>
        <h6 class="text-muted">ค้นหาบริการจากนักออกแบบ ช่างผู้เชี่ยวชาญ หรือผู้ให้บริการด้านต่างๆ ได้ที่นี่</h6>
      </div>
    </div>
</div>



<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-12 p-4 border">
      <h5>เลือกบริการตามหมวดหมู่</h5>

          <div class="content">

                    <div class="row">
                      <div class="col-6 col-lg-3">
                         <a href="/category/service/ตกแต่งบ้าน">
                            <div class="grid">
                            <figure class="effect-ravi">
                                <img src="/images/home_decor_service.jpg" alt="Home Decor Thumbnail" />
                                <figcaption>
                                    <div>
                                        <h3 class="d-none d-sm-block">ตกแต่งบ้าน</h3>
                                        <h5 class="d-block d-sm-none">ตกแต่งบ้าน</h5>
                                        <p>ค้นหานักออกแบบผู้ชำนาญการสำหรับงานออกแบบ-ตกแต่งบ้าน เพื่อให้บ้านของคุณสวยงาม</p>
                                    </div>
                                </figcaption>
                            </figure>
                          </div>
                         </a>
                        </div>

                        <div class="col-6 col-lg-3">
                           <a href="/category/service/ซ่อมแซม">
                              <div class="grid">
                              <figure class="effect-ravi">
                                  <img src="/images/fix_service.jpg" alt="Fix Service Thumbnail" />
                                  <figcaption>
                                      <div>
                                          <h3 class="d-none d-sm-block">ซ่อมแซม</h3>
                                          <h5 class="d-block d-sm-none">ซ่อมแซม</h5>
                                          <p>ให้ช่างของเราช่วยเหลือคุณในด้านการซ่อมแซมบ้าน แล้วทุกๆอย่างเกี่ยวกับบ้านจะป็นเรื่องง่าย</p>
                                      </div>
                                  </figcaption>
                              </figure>
                            </div>
                           </a>
                          </div>

                          <div class="col-6 col-lg-3">
                             <a href="/category/service/ประกอบ-ติดตั้ง">
                                <div class="grid">
                                <figure class="effect-ravi">
                                    <img src="/images/assemble.jpg" alt="Assemble Thumbnail" />
                                    <figcaption>
                                        <div>
                                            <h3 class="d-none d-sm-block">ประกอบ/ติดตั้ง</h3>
                                            <h5 class="d-block d-sm-none">ประกอบ/ติดตั้ง</h5>
                                            <p>สั่งเฟอร์นิเจอร์มาแต่ประกอบไม่เป็นใช่ไหม? ช่างผู้เชี่ยวชาญของเราช่วยคุณได้</p>
                                        </div>
                                    </figcaption>
                                </figure>
                              </div>
                             </a>
                            </div>

                            <div class="col-6 col-lg-3">
                               <a href="/category/service/ทำความสะอาด">
                                  <div class="grid">
                                  <figure class="effect-ravi">
                                      <img src="/images/clean.jpg" alt="Clean Service Thumbnail" />
                                      <figcaption>
                                          <div>
                                              <h3 class="d-none d-sm-block">ทำความสะอาด</h3>
                                              <h5 class="d-block d-sm-none">ทำความสะอาด</h5>
                                              <p>ช่วยให้บ้านของคุณสะอาดได้ไม่ยาก ด้วยการบริการที่ดีที่สุดจากพนักงานของเรา</p>
                                          </div>
                                      </figcaption>
                                  </figure>
                                </div>
                               </a>
                              </div>

                      </div><!--row -->

              </div>

    </div>
  </div>
</div>



<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-12 pt-4 pl-4 pr-4 border">
      <h5>บริการใหม่</h5>

          <div class="product-list">
            @foreach($new_services as $service)

              <div class="pl-4 pr-4 mt-4">
                  <a href="/service/{{$service->slug}}" style="text-decoration:none;" target="_blank">
                  <div class="product-card">
                      <div id="product-front">
                       <div class="shadow"></div>
                        <div class="product-thumb">
                          @if(!empty($service->name))
                          <div class="product-thumb">
                           <img src="/images/{{$service->service_photos[0]->name}}">
                         </div>
                          @else
                           <img src="https://static.umotive.com/img/product_image_thumbnail_placeholder.png" class="img-fluid">
                          @endif
                        </div>


                        <div class="stats p-1">
                            <div class="stats-container">
                                <p><img class="d-inline rounded-circle"  style="display: block; width: 15px; height: 15px; object-fit: cover;" src="/images/{{$service->store->photo->file}}"> {{$service->store->name}}</p>
                                <span class="product_name">{{$service->name}}</span>
                                <span class="product_price">
                                  เริ่มต้น {{$service->start_price}} ฿
                                </span>
                            </div>
                        </div>
                    </div>

                  </div>
                </a>
              </div>
               @endforeach
      </div>
    </div>
  </div>
</div>


<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-12 p-5 text-center" style="border:dashed 1px lightgray;">
      <h5 style="color:gray;">ร่วมเป็นส่วนหนึ่งของความสำเร็จไปกับเรา</h5>
      <span class="text-muted">สร้างรายได้ในการขายสินค้าหรือให้บริการลูกค้าเกี่ยวกับบ้าน</span><br><br>
      <a href="/partner/become" class="btn btn-outline-dark"><i class="fas fa-plus"></i> ลงขายสินค้า/บริการ</a>
    </div>
  </div>
</div>


<style>
.slick-prev:before {
    color:black !important;
}
.slick-next:before {
    color:black !important;
}
</style>

@endsection
