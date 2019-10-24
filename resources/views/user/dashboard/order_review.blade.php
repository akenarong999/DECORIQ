@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')

<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-star"></i> รีวิวรายการสั่งซื้อที่ #<?php echo $order->id ?></h3>
    <div class="container mt-3">

    <?php if($order->status->id==4){ ?>
      <?php $order_reviews = DashboardController::orderHasReview($order->id); ?>
      <?php if($order_reviews->isEmpty()){  ?>
      {{Form::open(['method'=>'POST', 'action'=>array('User\DashboardController@addOrderReview',$order->id),'files'=>true,'id'=>'orderreviewform'])}}
        <?php $products = $order->products; ?>
          <?php foreach($products as $product){ ?>
            <input type="hidden" name="productidarray[]" value="<?php echo $product->product_id; ?>">
         <div class="row border-bottom pt-4">
            <div class="col-2">
              <img src="/images/<?php echo DashboardController::getProductPhoto($product->product_id); ?>" class="w-100">
            </div>
            <div class="col-10">
              <h4><?php echo $product->name; ?> <span class="text-muted">(<?php echo $product->product_id; ?>)</span></h4>
              ให้คะแนน:
              <div class="rating">
                <label>
                  <input type="radio" name="review-rating-<?php echo $product->product_id ?>" value="1"  required>
                  <span class="icon">★</span>
                </label>
                <label>
                  <input type="radio" name="review-rating-<?php echo $product->product_id ?>" value="2" />
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                </label>
                <label>
                  <input type="radio" name="review-rating-<?php echo $product->product_id ?>" value="3" />
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                </label>
                <label>
                  <input type="radio" name="review-rating-<?php echo $product->product_id ?>" value="4" />
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                </label>
                <label>
                  <input type="radio" name="review-rating-<?php echo $product->product_id ?>" value="5" />
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                  <span class="icon">★</span>
                </label>
              </div><br>
              เขียนความคิดเห็น: <br>
              <textarea class="form-control" name="review-message-<?php echo $product->product_id ?>" placeholder="เขียนความคิดเห็นของคุณที่นี่"></textarea>
              <input type="file" class="review-photos" name="review-photo-<?php echo $product->product_id ?>" class="mb-5" required>
              </div>
            </div>


          <?php } ?>

                <div class="row">
                  <div class="col-12 pt-3">
                    <button type="submit" class="btn btn-primary col-12" name="button">ส่งรีวิว</button>
                  </div>
                </div>
              </form>


          </div>
        <?php }else{  ?>
            <?php foreach($order_reviews as $order_review){ ?>

           <div class="row border-bottom pt-4 pb-4">
              <div class="col-2">
                <img src="/images/<?php echo DashboardController::getProductPhoto($order_review->product_id); ?>" class="w-100">
              </div>
              <div class="col-10">
                <?php $product_type = $order_review->products->product_type; ?>
                <?php if($product_type=="variable"){
                   $product_variation = DashboardController::getVariationDetail($order_review->product_variation_id);
                 }
                 ?>
                <h4><?php echo $order_review->products->name; ?> <?php if($product_type=="variable"){ echo " - " .$product_variation->name;} ?> <span class="text-muted">(<?php echo $order_review->product_id; if($product_type=="variable"){ echo "-" .$product_variation->id;} $order_review->product_variation_id ?>)</span></h4>

                <strong>คะแนน:</strong>
                <div class="rating">
                  <label>
                    <?php $rating = $order_review->rating; ?>
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
                    <?php echo $order_review->review_message; ?>
                  </div>
                </div>

                <div class="row">
                  <?php $order_review_photos = $order_review->photos;
                    foreach ($order_review_photos as $order_review_photo) {  ?>
                    <div class="col-4"><img src="/images/<?php echo $order_review_photo->file; ?>" alt="" class="img-fluid img-thumbnail"></div>
                  <?php } ?>
                </div>
                </div>
              </div>


            <?php } ?>
          <?php } ?>
    <?php }else{  ?>
      <h3>รายการสั่งซื้อนี้ไม่สามารถให้รีวิวได้</h3>
    <?php } ?>






@endsection
