@extends('layouts.frontend')
<meta property="og:image" content="https://www.decoriq.com/images/decoriq_facebook_post_image.jpg" />
@section('description')
เดคคอริค (DECORIQ) คือแพลตฟอร์มมาร์เก็ตเพลสที่รวบรวมสินค้าและบริการเกี่ยวกับบ้านจากร้านค้าที่หลากหลาย สำหรับผู้ที่ต้องการเนรมิตตกแต่งบ้าน คอนโด ที่อยู่อาศัยของคุณให้เป็นไปตามสไตล์ที่ต้องการในราคาที่ใครก็เป็นเจ้าของได้
@endsection

@section('title')
DECORIQ - แพลตฟอร์มมืออาชีพเกี่ยวกับบ้านที่เข้าถึงได้ทุกคน
@endsection

@section('content')

<?php use \App\Http\Controllers\ProductFrontendController; ?>


<div id="mainslider" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#mainslider" data-slide-to="0" class="active"></li>
    <li data-target="#mainslider" data-slide-to="1"></li>
    <li data-target="#mainslider" data-slide-to="2"></li>
    <li data-target="#mainslider" data-slide-to="3"></li>
    <li data-target="#mainslider" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <?php $i=0; ?>
    <?php foreach($slide_photos as $slide_photo){ ?>
      <div class="carousel-item <?php if($i==0){?> active <?php } ?>">
        <a href="<?php echo $slide_photo->link; ?>" title="<?php echo $slide_photo->description; ?>"><img class="d-block w-100" src="/images/<?php echo $slide_photo->photo_file ?>" alt="<?php echo $slide_photo->description; ?>"></a>
      </div>
    <?php $i++; } ?>
  </div>
  <a class="carousel-control-prev" href="#mainslider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#mainslider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container mt-5 pb-5 pt-5">
  <div class="row mb-2">
   <div class="col-md-4 mt-1">
     <a href="/category/product/%E0%B8%AA%E0%B8%95%E0%B8%B4%E0%B9%8A%E0%B8%81%E0%B9%80%E0%B8%81%E0%B8%AD%E0%B8%A3%E0%B9%8C%E0%B8%95%E0%B8%B4%E0%B8%94%E0%B8%9C%E0%B8%99%E0%B8%B1%E0%B8%87" target="_blank"><img src="/images/august-wall-sticker-promo.png" class="w-100"></a>
   </div>
   <div class="col-md-4 mt-1">
     <a href="/category/product/%E0%B8%9E%E0%B8%A3%E0%B8%A1%E0%B8%9B%E0%B8%B9%E0%B8%9E%E0%B8%B7%E0%B9%89%E0%B8%99" target="_blank"><img src="/images/august-carpet-lover-promo.png" class="w-100"></a>
   </div>
   <div class="col-md-4 mt-1">
     <a href="/category/product/%E0%B8%95%E0%B9%89%E0%B8%99%E0%B9%84%E0%B8%A1%E0%B9%89" target="_blank"><img src="/images/august-make-it-green-promo.png" class="w-100"></a>
   </div>
  </div>
</div>

<div class="container mt-2 pb-5">
  <div class="row border-bottom pb-2 mb-2">
    <h4>หมวดหมู่สินค้ายอดนิยม</h4>
    <span class="text-muted ml-auto pt-2"><a href="/products#category">ดูทั้งหมด</a></span>
  </div>
<div class="row">
  <?php foreach($featured_categories as $featured_category){ ?>
      <div class="col-lg-2 col-md-3 col-6 mt-3" style="height:30px;">
          <a href="/category/product/<?php echo $featured_category->slug; ?>/" target="_blank" title="<?php echo $featured_category->name; ?>">
              <div class="card text-white ">
                    <img class="card-img" src="/images/<?php echo $featured_category->cover_photo->file; ?>" alt="<?php echo $featured_category->name; ?>">
                    <div style="position: absolute; top: 0; left: 0; clear: float; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4); color: #ffffff; "></div>
                    <div class="card-img-overlay text-center p-2" style="vertical-align:center;">
                        <span class="card-title text-center"><strong><?php echo $featured_category->name; ?></strong></span>
                    </div>
              </div>
            </a>
          </div><!--.col-->
   <?php } ?>

</div>
</div>




<div class="container mt-5 pb-4">
  <div class="row pb-2 mb-3 border-bottom">
    <h4>สินค้าแนะนำ</h4>
  </div>
<div class="row">

@foreach($featured_products as $product)

  <div class="col-6 col-md-4 col-lg-2 mt-2 mb-1">
    <a href="/product/{{$product->slug}}" style="text-decoration:none;" target="_blank">
    <div class="product-card">
        <div id="product-front">
        	<div class="shadow"></div>
          <div class="product-thumb">
            @if(!empty($product->name))
            <div class="product-thumb">
             <img src="/images/{{$product->product_photos[0]->name}}">
             <?php $stock = ProductFrontendController::checkProductStock($product->id);
              if($stock==0){ ?>
                <div class="product-empty-label">สินค้าหมด</div>
              <?php } ?>
           </div>
            @else
             <img src="https://static.umotive.com/img/product_image_thumbnail_placeholder.png" class="img-fluid">
            @endif
          </div>


          <div class="stats p-1 h-25">
              <div class="stats-container">
                  <p><img class="d-inline rounded-circle"  style="display: block; width: 15px; height: 15px; object-fit: cover;" src="/images/{{$product->store->photo->file}}"> {{$product->store->name}}</p>
                  <span class="product_name">{{$product->name}}</span>
                  <span class="product_price">
                    @php
                    if($product->product_type=='single'){
                      if(is_null($product->discount_price)||$product->discount_price<=0){
                        echo number_format($product->price).' ฿';
                      }else{
                        echo number_format($product->discount_price)." ฿ <small class='text-muted'><del>".number_format($product->price)." ฿</del></small> <small class='bg-danger text-white'>&nbsp;ลด ".(100-(int)((($product->discount_price)/$product->price)*100))."%&nbsp;</small>";
                      }

                    }
                    else{
                      $variationlowestdiscountprice = ProductFrontendController::getVariationLowestDiscountPrice($product->id);
                      $variationhighestdiscountprice = ProductFrontendController::getVariationHighestDiscountPrice($product->id);
                      $variationlowestprice = ProductFrontendController::getVariationLowestPrice($product->id);
                      $variationhighestprice = ProductFrontendController::getVariationHighestPrice($product->id);
                      $price = array($variationlowestdiscountprice,$variationhighestdiscountprice,$variationlowestprice,$variationhighestprice);
                      asort($price);
                      $price = array_values(array_filter($price));
                      $lowestprice = reset($price);
                      $highestprice = end($price);

                      if(!(is_null($variationlowestdiscountprice)||$variationlowestdiscountprice<=0)||!(is_null($variationhighestdiscountprice)||$variationhighestdiscountprice<=0)){
                        if($lowestprice==$highestprice){
                          if($variationlowestprice==$variationhighestprice){
                            echo number_format($lowestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                          }else{
                            echo number_format($lowestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                          }
                        }else{
                          echo number_format($lowestprice)."-".number_format($highestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                        }
                      }else{
                        if($variationlowestprice==$variationhighestprice){
                          echo number_format($variationlowestprice)." ฿";
                        }else{
                          echo number_format($variationlowestprice)."-".number_format($variationhighestprice)." ฿";
                        }
                      }
                    }
                    @endphp

                  </span>
              </div>
          </div>
      </div>

    </div>
  </a>
  </div>
   @endforeach
</div>
</div> <!-- สินค้าแนะนำ -->



<div class="container mt-5 pb-4">
  <div class="row border-bottom pb-2 mb-3">
    <h4 class="">สินค้าใหม่</h4>
  </div>
<div class="row">

@foreach($new_products as $product)

<div class="col-6 col-md-4 col-lg-2 mt-2 mb-1">
  <a href="/product/{{$product->slug}}" style="text-decoration:none;" target="_blank">
  <div class="product-card">
      <div id="product-front">
        <div class="shadow"></div>
        <div class="product-thumb">
          @if(!empty($product->name))
          <div class="product-thumb">
           <img src="/images/{{$product->product_photos[0]->name}}">
           <?php $stock = ProductFrontendController::checkProductStock($product->id);
            if($stock==0){ ?>
              <div class="product-empty-label">สินค้าหมด</div>
            <?php } ?>
         </div>
          @else
           <img src="https://static.umotive.com/img/product_image_thumbnail_placeholder.png" class="img-fluid">
          @endif
        </div>


        <div class="stats p-1 h-25">
            <div class="stats-container">
                <p><img class="d-inline rounded-circle"  style="display: block; width: 15px; height: 15px; object-fit: cover;" src="/images/{{$product->store->photo->file}}"> {{$product->store->name}}</p>
                <span class="product_name">{{$product->name}}</span>
                <span class="product_price">
                  @php
                  if($product->product_type=='single'){
                    if(is_null($product->discount_price)||$product->discount_price<=0){
                      echo number_format($product->price).' ฿';
                    }else{
                      echo number_format($product->discount_price)." ฿ <small class='text-muted'><del>".number_format($product->price)." ฿</del></small> <small class='bg-danger text-white'>&nbsp;ลด ".(100-(int)((($product->discount_price)/$product->price)*100))."%&nbsp;</small>";
                    }

                  }
                  else{
                    $variationlowestdiscountprice = ProductFrontendController::getVariationLowestDiscountPrice($product->id);
                    $variationhighestdiscountprice = ProductFrontendController::getVariationHighestDiscountPrice($product->id);
                    $variationlowestprice = ProductFrontendController::getVariationLowestPrice($product->id);
                    $variationhighestprice = ProductFrontendController::getVariationHighestPrice($product->id);
                    $price = array($variationlowestdiscountprice,$variationhighestdiscountprice,$variationlowestprice,$variationhighestprice);
                    asort($price);
                    $price = array_values(array_filter($price));
                    $lowestprice = reset($price);
                    $highestprice = end($price);

                    if(!(is_null($variationlowestdiscountprice)||$variationlowestdiscountprice<=0)||!(is_null($variationhighestdiscountprice)||$variationhighestdiscountprice<=0)){
                      if($lowestprice==$highestprice){
                        if($variationlowestprice==$variationhighestprice){
                          echo number_format($lowestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                        }else{
                          echo number_format($lowestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                        }
                      }else{
                        echo number_format($lowestprice)."-".number_format($highestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                      }
                    }else{
                      if($variationlowestprice==$variationhighestprice){
                        echo number_format($variationlowestprice)." ฿";
                      }else{
                        echo number_format($variationlowestprice)."-".number_format($variationhighestprice)." ฿";
                      }
                    }
                  }
                  @endphp

                </span>
            </div>
        </div>
    </div>

  </div>
</a>
</div>
   @endforeach

</div>
<div class="row">
  <div class="col-md-4 offset-md-4 text-center mt-4"><a href="/products" class="btn btn-outline-danger col-12">ดูเพิ่มเติม</a></div>
</div>
</div> <!-- สินค้าใหม่ -->



<div class="border mt-2 bg-gray">
<div class="container mt-3 pt-4 pb-4">
  <div class="row">
      <h3 class="col-12 text-center pb-2"><a href="/services" class="text-black"><i class="themify ti ti-ruler-pencil"></i> บริการ</a></h3>
      <span class="col-12 text-center text-muted mb-4"><span class="border-top p-2">เลือกงานบริการเกี่ยวกับบ้านจากช่างผู้ชำนาญการของเรา</span></span>

          <!-- Card 5 -->
          <div class="col-6 col-lg-3 card-container service-content">
               <div class="card-flip h-100">
                 <!-- Card 5 Front -->
                 <div class="card front card-inverse">
                   <img class="card-img w-100 h-100" style="object-fit:cover" src="/images/home_decor_service.jpg" alt="Home Decor service">
                   <div style="position: absolute; top: 0; left: 0; clear: float; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); color: #ffffff; "></div>
                   <div class="card-img-overlay text-center text-white pt-4">
                     <img src="/images/home-decor-icon.png" style="margin:0 auto" class="w-25 d-none d-sm-block">
                     <img src="/images/home-decor-icon.png" style="margin:0 auto" class="w-50 d-block d-sm-none">
                     <h4 class="d-none d-sm-block" style="height:100px; line-height:50px;"><strong>ตกแต่งบ้าน</strong></h4>
                     <h5 class="d-block d-sm-none mt-4" style="height:100px;"><strong>ตกแต่งบ้าน</strong></h5>
                   </div>
                 </div>
                 <!-- End Card 5 Front -->
                 <!-- Card 5 Back -->
                 <div class="card back pt-3 pl-3 pr-3 text-center">
                   <h4>ตกแต่งบ้าน</h4>
                   <small class="text-muted d-none d-sm-block">ค้นหานักออกแบบผู้ชำนาญการสำหรับงานออกแบบ-ตกแต่งบ้าน เพื่อให้บ้านของคุณสวยงาม</small>
                   <a href="/category/service/ตกแต่งบ้าน" class="mt-2 btn btn-light border btn-sm">ดูบริการนี้</a>
                 </div>
                 <!-- End Card 5 Back -->
               </div>
           </div>
          <!-- End Card 5 -->

          <!-- Card 5 -->
          <div class="col-6 col-lg-3 card-container service-content">
               <div class="card-flip h-100">
                 <!-- Card 5 Front -->
                 <div class="card front card-inverse">
                   <img class="card-img w-100 h-100" style="object-fit:cover" src="/images/fix_service.jpg" alt="Reparing service">
                   <div style="position: absolute; top: 0; left: 0; clear: float; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); color: #ffffff; "></div>
                   <div class="card-img-overlay text-center text-white pt-4">
                     <img src="/images/repair-icon.png" style="margin:0 auto" class="w-25 d-none d-sm-block">
                     <img src="/images/repair-icon.png" style="margin:0 auto" class="w-50 d-block d-sm-none">
                     <h4 class="d-none d-sm-block" style="height:100px; line-height:50px;"><strong>ซ่อมแซม</strong></h4>
                     <h5 class="d-block d-sm-none mt-4" style="height:100px;"><strong>ซ่อมแซม</strong></h5>
                   </div>
                 </div>
                 <!-- End Card 5 Front -->
                 <!-- Card 5 Back -->
                 <div class="card back pt-3 pl-3 pr-3 text-center">
                   <h4>ซ่อมแซม</h4>
                   <small class="text-muted d-none d-sm-block">ให้ช่างของเราช่วยเหลือคุณในด้านการซ่อมแซมบ้าน แล้วทุกๆอย่างเกี่ยวกับบ้านจะเป็นเรื่องง่าย</small>
                   <a href="/category/service/ซ่อมแซม" class="mt-2 btn btn-light border btn-sm">ดูบริการนี้</a>
                 </div>
                 <!-- End Card 5 Back -->
               </div>
           </div>
          <!-- End Card 5 -->


          <!-- Card 5 -->
          <div class="col-6 col-lg-3 card-container service-content">
               <div class="card-flip h-100">
                 <!-- Card 5 Front -->
                 <div class="card front card-inverse">
                   <img class="card-img w-100 h-100" style="object-fit:cover" src="/images/assemble.jpg" alt="Assembly service">
                   <div style="position: absolute; top: 0; left: 0; clear: float; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); color: #ffffff; "></div>
                   <div class="card-img-overlay text-center text-white pt-4">
                     <img src="/images/furniture-assemble-icon.png" style="margin:0 auto" class="w-25 d-none d-sm-block">
                     <img src="/images/furniture-assemble-icon.png" style="margin:0 auto" class="w-50 d-block d-sm-none">
                     <h4 class="d-none d-sm-block" style="height:100px; line-height:50px;"><strong>ประกอบ/ติดตั้ง</strong></h4>
                     <h5 class="d-block d-sm-none mt-4" style="height:100px;"><strong>ประกอบ/ติดตั้ง</strong></h5>
                   </div>
                 </div>
                 <!-- End Card 5 Front -->
                 <!-- Card 5 Back -->
                <div class="card back pt-3 pl-3 pr-3 text-center">
                   <h4>ประกอบ/ติดตั้ง</h4>
                   <small class="text-muted d-none d-sm-block">ซื้อสินค้ามาแต่ประกอบ/ติดตั้งไม่เป็นใช่ไหม? ให้ช่างผู้เชี่ยวชาญของเราช่วยคุณได้</small>
                   <a href="/category/service/ประกอบ-ติดตั้ง" class="mt-2 btn btn-light border btn-sm">ดูบริการนี้</a>
                 </div>
                 <!-- End Card 5 Back -->
               </div>
           </div>
          <!-- End Card 5 -->

          <!-- Card 5 -->
          <div class="col-6 col-lg-3 card-container service-content">
               <div class="card-flip">
                 <!-- Card 5 Front -->
                 <div class="card front card-inverse">
                   <img class="card-img w-100 h-100" style="object-fit:cover" src="/images/clean.jpg" alt="Cleaning service">
                   <div style="position: absolute; top: 0; left: 0; clear: float; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); color: #ffffff; "></div>
                   <div class="card-img-overlay text-center text-white pt-4">
                     <img src="/images/cleaning-service-icon.png" style="margin:0 auto" class="w-25 text-center d-none d-sm-block">
                     <img src="/images/cleaning-service-icon.png" style="margin:0 auto" class="w-50 text-center d-block d-sm-none">
                     <h4 class="d-none d-sm-block" style="height:100px; line-height:50px;"><strong>ทำความสะอาด</strong></h4>
                     <h5 class="d-block d-sm-none mt-4" style="height:100px;"><strong>ทำความสะอาด</strong></h5>
                   </div>
                 </div>
                 <!-- End Card 5 Front -->
                 <!-- Card 5 Back -->
                <div class="card back pt-3 pl-3 pr-3 text-center">
                   <h4>ทำความสะอาด</h4>
                   <small class="text-muted d-none d-sm-block">ช่วยให้บ้านของคุณสะอาดได้ไม่ยาก ด้วยการบริการที่ดีที่สุดจากพนักงานของเรา</small>
                   <a href="/category/service/ทำความสะอาด" class="mt-2 btn btn-light border btn-sm">ดูบริการนี้</a>
                 </div>
                 <!-- End Card 5 Back -->
               </div>
           </div>
          <!-- End Card 5 -->

        </div>
  </div>
</div>

<div class="container mt-5 pb-4 border-bottom">
  <div class="row border-bottom pb-2 mb-3">
    <h4 class="">บริการแนะนำ</h4>
  </div>
 <div class="row">

  @foreach($featured_services as $service)

    <div class="col-6 col-md-4 col-lg-2 mt-2 mb-1">
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


            <div class="stats p-1 h-25">
                <div class="stats-container">
                    <p><img class="d-inline rounded-circle"  style="display: block; width: 15px; height: 15px; object-fit: cover;" src="/images/{{$service->store->photo->file}}"> {{$service->store->name}}</p>
                    <span class="product_name">{{$service->name}}</span>
                    <span class="product_price">
                      เริ่มต้น {{number_format($service->start_price)}} ฿
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


<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-sm-12">
      <div class="row">
        <h3>ลูกค้า<strong style="color:#e51d02">ผู้มีความสุข</strong> :]</h3><br>
      </div>
      <div class="row pb-2 text-muted">
        <span>เราช่วยลูกค้าให้พบสิ่งที่ต้องการ มาดูกันว่าลูกค้าพูดถึงเราว่าอย่างไร</span>
      </div>
			<div id="testimonial-carousel" class="carousel slide pt-3" data-ride="carousel">
				<!-- Carousel indicators -->
				<ol class="carousel-indicators">
					<li data-target="#testimonial-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#testimonial-carousel" data-slide-to="1"></li>
					<li data-target="#testimonial-carousel" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for carousel items -->
				<div class="carousel-inner">
					<div class="item carousel-item active">
						<div class="row">
							<div class="col-sm-6">
								<div class="testimonial-wrapper">
									<div class="testimonial">ได้รับสินค้าไวดีค่าาา สินค้าก็คุณภาพดี ทำให้การตกแต่งบ้านสนุกยิ่งขึ้นกว่าเดิม ^^</div>
									<div class="media">
										<div class="media-left d-flex mr-3">
											<img src="/images/testimonial_customer_1.jpg" alt="">
										</div>
										<div class="media-body">
											<div class="overview">
												<div class="name"><b>Jatupat AOff</b></div>
												<div class="details">on Facebook</div>
												<div class="star-rating">
													<ul class="list-inline">
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="testimonial-wrapper">
									<div class="testimonial">ของสวยถูกใจครับ สั่งง่ายส่งเร็ว ถ้าเจอของถูกใจจะกลับมาใช้บริการอีกแน่นอนครับ ☺️☺️</div>
									<div class="media">
										<div class="media-left d-flex mr-3">
                      <img src="/images/testimonial_customer_2.jpg" alt="">
										</div>
										<div class="media-body">
											<div class="overview">
												<div class="name"><b>Chayapat Sarawan</b></div>
												<div class="details">on Facebook</div>
												<div class="star-rating">
													<ul class="list-inline">
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item carousel-item">
						<div class="row">
							<div class="col-sm-6">
								<div class="testimonial-wrapper">
									<div class="testimonial">เอาไปเต็มห้าดาวค่าา ดีงามมากๆๆ ตอบไว ได้ทันใจ</div>
									<div class="media">
										<div class="media-left d-flex mr-3">
                      <img src="/images/testimonial_customer_3.jpg" alt="">
										</div>
										<div class="media-body">
											<div class="overview">
												<div class="name"><b>Sasarin</b></div>
												<div class="details">on Facebook</div>
												<div class="star-rating">
													<ul class="list-inline">
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="testimonial-wrapper">
									<div class="testimonial">ของมีคุณภาพมาก ส่งรวดเร็วทันใจ สั่งปุ๊บตอบปั๊บ ราคาดีๆกับสไตล์เกร๋ๆ อยากจะให้10ดาวเลย</div>
									<div class="media">
										<div class="media-left d-flex mr-3">
                      <img src="/images/testimonial_customer_4.jpg" alt="">
										</div>
										<div class="media-body">
											<div class="overview">
												<div class="name"><b>ธรนิศ</b></div>
												<div class="details">on Facebook</div>
												<div class="star-rating">
													<ul class="list-inline">
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item carousel-item">
						<div class="row">
							<div class="col-sm-6">
								<div class="testimonial-wrapper">
									<div class="testimonial">ทำให้ตรงที่ทานอาหารน่านั่งมากขึ้นเลยค้า ❤</div>
									<div class="media">
										<div class="media-left d-flex mr-3">
                      <img src="/images/testimonial_customer_5.jpg" alt="">
										</div>
										<div class="media-body">
											<div class="overview">
												<div class="name"><b>Earthy</b></div>
												<div class="details">on Line App</div>
												<div class="star-rating">
													<ul class="list-inline">
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="testimonial-wrapper">
									<div class="testimonial">ส่งของรวดเร็วทันใจ สินค้าสวยงาม 👍👍</div>
									<div class="media">
										<div class="media-left d-flex mr-3">
                      <img src="/images/testimonial_customer_6.jpg" alt="">
										</div>
										<div class="media-body">
											<div class="overview">
												<div class="name"><b>Sunida Meechookul</b></div>
												<div class="details">on Facebook</div>
												<div class="star-rating">
													<ul class="list-inline">
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if(!Auth::user())
{ ?>
<br>
<div class="container mt-4 pt-5 pb-5 mb-5 border">
    <div class="row">
      <div class="col-12 text-center">
        <h1><i class="themify ti ti-face-smile"></i></h1>
        <h4 class="">มาเป็นสมาชิกที่มีความสุขกับเรา</h4>
        <div class="pb-2 text-muted">
          <span><a href="/register">สมัครสมาชิก</a>หรือ<a href="/login">เข้าสู่ระบบ</a> เพื่อรับสิทธิพิเศษดังนี้...</span>
        </div>
        <div class="mt-2">
          <span class="mr-2"><i class="themify ti ti-tag font-weight-bold"></i> ทราบส่วนลดสิทธิประโยชน์ก่อนใคร</span>
          <span class="mr-2"><i class="themify ti ti-shopping-cart-full font-weight-bold"></i> สั่งซื้อได้ง่ายรวดเร็ว</span>
          <span class="mr-2"><i class="themify ti ti-home font-weight-bold"></i> มีส่วนร่วมในเครือข่ายสังคมเกี่ยวกับบ้าน</span>
          <span><i class="themify ti ti-id-badge font-weight-bold"></i> ช่วยเก็บประวัติการสั่งซื้อ</span>
        </div>
    </div>

</div>
</div>

<?php } ?>


<div class="container mt-4 pt-4 pb-5 border-top">
  <div class="row">
    <h3 class="">ร่วมขายกับเรา</h3><br>
  </div>
  <div class="row pb-2 text-muted">
    <span>ร่วมเป็นส่วนหนึ่งในการเป็นผู้ขายหรือผู้ให้บริการมืออาชีพเกี่ยวกับบ้าน</span>
  </div>

  <div class="row text-center w-100" style="width:100%;height:300px;display: flex; align-items: center;background-image:url('/images/join_us.jpg'); background-repeat: no-repeat; background-position: center center; background-size: cover; background-attachment: fixed;">
    <div class="col-8 offset-2 col-md-4  offset-md-4 text-center">
      <img class="w-75" src="/images/decoriq_white_logo.png"><br>
      <a href="/partner/become/" class="btn btn-secondary mt-4 border-white">ลงขายสินค้า/เสนอบริการ</a>
    </div>
  </div>
</div>






<style>
.card {
margin: 10px 10px;
}

/* Flip Cards CSS */
.card-container {
display: grid;
perspective: 700px;
}

.card-flip {
display: grid;
grid-template: 200px 1fr / 1fr;
grid-template-areas: "frontAndBack";
transform-style: preserve-3d;
transition: all 0.7s ease;
}

.card-flip div {
backface-visibility: hidden;
transform-style: preserve-3d;
}

.front {
grid-area: frontAndBack;
}

.back {
grid-area: frontAndBack;
transform: rotateY(-180deg);
}

.card-container:hover .card-flip {
transform: rotateY(180deg);
}


</style>

<style type="text/css">

#testimonial-carousel{
  max-width: 100%;
}

.carousel {
	margin: 0 auto;
}
.carousel .item {
	color: #999;
	overflow: hidden;
    min-height: 120px;
	font-size: 13px;
}
.carousel .media {
	position: relative;
	padding: 0 0 0 20px;
}
.carousel .media img {
	width: 75px;
	height: 75px;
	display: block;
	border-radius: 50%;
}
.carousel .testimonial-wrapper {
	padding: 0 10px;
}
.carousel .testimonial {
    color: #808080;
    position: relative;
    padding: 15px;
    background: #f1f1f1;
    border: 1px solid #efefef;
    border-radius: 3px;
	margin-bottom: 15px;
}
.carousel .testimonial::after {
	content: "";
	width: 15px;
	height: 15px;
	display: block;
	background: #f1f1f1;
	border: 1px solid #efefef;
	border-width: 0 0 1px 1px;
	position: absolute;
	bottom: -8px;
	left: 46px;
	transform: rotateZ(-46deg);
}
.carousel .star-rating li {
	padding: 0;
  margin-right: 0 !important;
}
.carousel .star-rating i {
	font-size: 16px;
	color: #ffdc12;
}
.carousel .overview {
	padding: 3px 0 0 15px;
}
.carousel .overview .details {
	padding: 5px 0 8px;
}
.carousel .overview b {
	text-transform: uppercase;
	color: #e51d02;
}
.carousel .carousel-indicators {
	bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 18px;
    height: 18px;
	border-radius: 50%;
	margin: 1px 2px;
}
.carousel-indicators li {
    background: #e2e2e2;
    border: 4px solid #fff;
}
.carousel-indicators li.active {
	color: #fff;
    background: #e51d02;
    border: 5px double;
}
</style>

@endsection
