@extends('layouts.frontend')

@section('description')
{{$service->description}}
@endsection


@section('title')
{{$service->name}} - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\ServiceFrontendController; ?>



<div class="container mt-5 mb-4">

  <div class="row">
    <div class="col-12 col-md-8">
      <small class="text-muted"><a href="/category/service/<?php echo $service->subCategory->Category->slug; ?>"><?php  echo $service->subCategory->Category->name;  ?></a> > <a href="/category/service/<?php echo $service->subCategory->slug;  ?>"><?php echo $service->subCategory->name;  ?></a></small>
      <h3 class="mt-2"><?php echo $service->name; ?> </h3>

      <div class="d-inline">

        <div id="product-rating d-inline">
        <?php
        $rating=0;
        $review_amount = 0;
        if(isset($order_reviews)){
          foreach($order_reviews as $order_review){
            $rating +=$order_review->rating;
            $review_amount +=1;
          }
        }else{
          $review_amount = 0;
          $order_reviews = [];
        }
        if($review_amount!=0){
          $star_rating  = $rating/$review_amount;
        }else{
          $star_rating = 0;
        }
        ?>
        <script type="text/javascript">
          var rating = 5;
        </script>
            <i class="star star-under fa fa-star">
              <i class="star star-over fa fa-star"></i>
            </i>
            <i class="star star-under fa fa-star">
              <i class="star star-over fa fa-star"></i>
            </i>
            <i class="star star-under fa fa-star">
              <i class="star star-over fa fa-star"></i>
            </i>
            <i class="star star-under fa fa-star">
              <i class="star star-over fa fa-star"></i>
            </i>
            <i class="star star-under fa fa-star">
              <i class="star star-over fa fa-star"></i>
            </i>
            <span class="pl-2 review-no d-inline"> <?php echo number_format((float)$star_rating, 1, '.', ''); ?> คะแนน (<?php echo count($order_reviews); ?> รีวิวจากผู้ซื้อ)</span> | รอคิว 0 คิว | <a class="d-inline" href="/store/{{$service->store->username}}"><img class="rounded-circle d-inline border" style="width: 30px; height: 30px; object-fit: cover;" src="/images/{{$service->store->photo->file}}"> <strong>{{$service->store->name}}</strong></a>
        </div>

      </div>
    </div>
    <div class="col-12 col-md-4 mt-3">

     <!-- <?php if(Auth::user()){ ?>
       <a href="/service/messages/<?php // echo ServiceFrontendController::getServiceConversationId($service->id); ?>" class="btn btn-primary btn-lg w-100"  target="_blank">พูดคุย/ขอรับการเสนอราคา<br>(เริ่มต้น {{$service->start_price}} ฿)</a><br>
     <?php }else{ ?>
       <a href="/login" class="btn btn-primary btn-lg w-100"  target="_blank">พูดคุย/ขอรับการเสนอราคา<br>(เริ่มต้น {{$service->start_price}} ฿)</a><br>
     <?php } ?> -->
      <button id="show-seller-contact" class="btn btn-primary btn-lg w-100" >พูดคุย/ขอรับการเสนอราคา<br>(เริ่มต้น {{number_format($service->start_price)}} ฿)</button><br>

    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12 col-md-8 p-0 m-0">

        <div id="myCarousel" class="carousel slide" data-interval="false" style="margin:0 !important; padding: 0 20px; max-width:100% !important;">

        <div class="carousel-inner" role="listbox">
          <?php
          $i=0;
          foreach($service_photos as $service_photo) { ?>
            <div class="carousel-item <?php if($i==0){ echo 'active';} ?>" id="service-photo" >
              <a href="/images/<?php echo $service_photo->name ?>" data-toggle="lightbox" data-gallery="service-gallery"><img class="d-inline"  style="display: block; width: 100%; height: 550px; object-fit: cover;" src="/images/<?php echo $service_photo->name ?>"></a>
            </div>

          <?php $i++; } ?>

      	  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      		  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      		  <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      		  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      		  <span class="sr-only">Next</span>
            </a>
          </div>

      <div id="thumbCarousel">
          <?php
          $i=0;
          foreach($service_photos as $service_photo) { ?>
            <div data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="thumb active"><img src="/images/<?php echo $service_photo->name ?>" style="width: 120px; height: 130px"></div>
          <?php $i++;
          } ?>
        </div>


      </div>
    </div>
    <div class="col-12 col-md-4 border-left p-4">
      <h4 class="d-inline">ราคาเริ่มต้น :</h4> <h2 class="d-inline">{{number_format($service->start_price)}} ฿</h2>
      <hr>
      <strong><i class="far fa-clock"></i> ระยะเวลาในการทำงาน :</strong> {{$service->work_duration}} วัน
      <hr>
      <strong><i class="fas fa-sync-alt"></i> แก้ไขงานได้ :</strong> {{$service->revision_time}} ครั้ง
      <hr>
      <strong><i class="fas fa-user-shield"></i> รับประกันงาน :</strong> {{$service->after_service_support_duration}} วัน
      <div class="mt-3">
        <strong><i class="fas fa-info-circle"></i> รายละเอียดการรับประกัน :</strong>
        <span>
          {{$service->after_service_support_description}}
        </span>
      </div>
      <hr>


    </div>
  </div>

  <div class="row mt-4 border-top p-2">
    <div class="col-md-8 col-12 pt-4">
      <h4>เกี่ยวกับบริการนี้</h4><br>
      <div class="mb-5">
        @php
           echo $service->description;
        @endphp
      </div>


    </div>
    <div class="col-md-4 col-12 border p-5">
      <a href="/store/{{$service->store->username}}">
        <img class="rounded-circle mx-auto d-block border"  style="display: block; width: 60px; height: 60px; object-fit: cover;" src="/images/{{$service->store->photo->file}}">
        <h6 class="text-center mt-2">{{$service->store->name}}</h6>
      </a>

      <span class="text-center">{{$service->store->description}}</span><br><br>
      <button type="button" class="btn btn-light btn-lg w-100 border">พูดคุย</button><br>
    </div>
  </div>
</div>
@endsection
