@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')

<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-star"></i> รีวิวรายการสั่งซื้อของบริการที่ #<?php echo $service_order->id ?></h3>
    <div class="container mt-3">

    <?php if($service_order->status->id==6){ ?>
      <?php if(!isset($service_order->review)){  ?>
      {{Form::open(['method'=>'POST', 'action'=>array('User\DashboardController@addServiceOrderReview',$service_order->id),'files'=>true,'id'=>'orderreviewform'])}}
        <?php $service = $service_order->service; ?>
            <input type="hidden" name="productidarray[]" value="<?php echo $service->product_id; ?>">
         <div class="row border-bottom pt-4">
            <div class="col-2">
              <img src="/images/<?php echo $service_order->service->service_photos[0]->name; ?>" class="w-100">
            </div>
            <div class="col-10">
              <h4><?php echo $service->name; ?></h4>
              ให้คะแนน:
              <div class="rating">
                <label>
                  <input type="radio" name="review-rating-<?php echo $service_order->id ?>" value="1"  required>
                  <span class="icon">★</span>
                </label>
                <label>
                  <input type="radio" name="review-rating-<?php echo $service_order->id ?>" value="2" />
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                </label>
                <label>
                  <input type="radio" name="review-rating-<?php echo $service_order->id ?>" value="3" />
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                </label>
                <label>
                  <input type="radio" name="review-rating-<?php echo $service_order->id ?>" value="4" />
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                </label>
                <label>
                  <input type="radio" name="review-rating-<?php echo $service_order->id ?>" value="5" />
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                </label>
              </div><br>
              เขียนความคิดเห็น: <br>
              <textarea class="form-control" name="review-message-<?php echo $service_order->id ?>" placeholder="เขียนความคิดเห็นของคุณที่นี่"></textarea>
              <input type="file" class="review-photos" name="review-photo-<?php echo $service_order->id ?>" class="mb-5">
              </div>
            </div>


                <div class="row">
                  <div class="col-12 pt-3">
                    <button type="submit" class="btn btn-primary col-12" name="button">ส่งรีวิว</button>
                  </div>
                </div>
              </form>


          </div>
        <?php }else{  ?>
           <?php $service_order_review = DashboardController::serviceorderHasReview($service_order->id); ?>

           <div class="row border-bottom pt-4 pb-4">
              <div class="col-2">
                <img src="/images/<?php echo $service_order->service->service_photos[0]->name; ?>" class="w-100">
              </div>
              <div class="col-10">

                <h4><?php echo $service_order_review->service_name; ?> </span></h4>

                <strong>คะแนน:</strong>
                <div class="rating">
                  <label>
                    <?php $rating = $service_order_review->rating; ?>
                    <span class="icon" style="color:#e51d02">★</span>
                    <span class="icon" <?php if(in_array($rating, [2,3,4,5])){ ?> style="color:#e51d02" <?php } ?>>★</span>
                    <span class="icon" <?php if(in_array($rating, [3,4,5])){ ?> style="color:#e51d02" <?php } ?>>★</span>
                    <span class="icon" <?php if(in_array($rating, [4,5])){ ?> style="color:#e51d02" <?php } ?>>★</span>
                    <span class="icon" <?php if(in_array($rating, [5])){ ?> style="color:#e51d02" <?php } ?>>★</span>
                  </label>

                </div><br>
                <div class="row pl-2 pr-2">
                  <strong>ความคิดเห็น:</strong>
                  <div class="col-12 alert alert-secondary" >
                    <?php echo $service_order_review->review_message; ?>
                  </div>
                </div>

                <div class="row">
                  <?php
                   $service_order_review_photos = $service_order_review->photos;
                    foreach ($service_order_review_photos as $photo) {  ?>
                    <div class="col-4"><img src="/images/<?php echo $photo->file; ?>" alt="" class="img-fluid img-thumbnail"></div>
                  <?php } ?>
                </div>
                </div>
              </div>


          <?php } ?>
    <?php }else{  ?>
      <h3>รายการสั่งซื้อนี้ไม่สามารถให้รีวิวได้</h3>
    <?php } ?>






@endsection
