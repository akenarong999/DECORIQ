@extends('layouts.frontend')

@section('description')
{{$product->short_description}}
@endsection

@section('title')
{{$product->name}} - DECORIQ
@endsection
<?php use \App\Http\Controllers\ProductFrontendController; ?>

<?php
  $rating=0;
  $review_amount = 0;
  foreach($order_reviews as $order_review){
    $rating +=$order_review->rating;
    $review_amount +=1;
  }
  if($review_amount!=0){
    $star_rating  = $rating/$review_amount;
  }else{
    $star_rating = 0;
  }
?>

<script class="" type="application/ld+json">
{
    "@context": "http://schema.org/",
    "@type": "Product",
    "name": "https://www.decoriq.com/images/<?php echo $first_product_photo; ?>",
    "image": "some-amazing-product.png",
    "description": "ร้าน {{$store->name}} - {{$product->short_description}}",
    "sku": "p-{{$product->id}}",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{$star_rating}}",
        "reviewCount": "{{$review_amount}}"
    },
    "offers": {
        "@type": "Offer",
        "priceCurrency": "THB",
        "price": "<?php
         if($product->product_type=='single'){
           if(is_null($product->discount_price)||$product->discount_price<=0){
             echo number_format($product->price);
           }else{
             echo number_format($product->discount_price);
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
                    echo number_format($lowestprice);
                  }else{
                    echo number_format($lowestprice);
                  }
                }else{
                  echo number_format($lowestprice)."-".number_format($highestprice);
                }
              }else{
                if($variationlowestprice==$variationhighestprice){
                  echo number_format($variationlowestprice);
                }else{
                  echo number_format($variationlowestprice)."-".number_format($variationhighestprice);
                }
              }
         }

         ?>",
        "availability": "http://schema.org/InStock"
    }
}
</script>

@section('content')

<?php use \App\Http\Controllers\CheckoutController; ?>



<div class="container mt-3 mb-4">
  <div class="row">
      <div class="col-12">
        <img src="/images/free-shipping-month-banner.png" class="w-100 mb-4">
      </div>

    <?php if(Session::get('not-enough-stock')!==NULL){ ?>
    <div class="container mt-2">
      <div class="row">
        <div class="col">
          <div class="alert alert-warning">
            {{ Session::get('not-enough-stock') }}
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(Session::get('not-numeric')!==NULL){ ?>
    <div class="container mt-2">
      <div class="row">
        <div class="col">
          <div class="alert alert-warning">
            {{ Session::get('not-numeric') }}
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(Session::get('added-to-cart')!==NULL){ ?>
    <div class="container mt-2">
      <div class="row">
        <div class="col">
          <div class="alert alert-success">
              สินค้าได้ถูกเพิ่มลงสู่ตะกร้าเรียบร้อยแล้ว ไปหน้า <strong><a href="/cart"><i class="themify ti ti-shopping-cart"></i>ตะกร้าสินค้า</a></strong>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="row">
	<div class="col-md-6">

  <div id="myCarousel" class="carousel slide" data-interval="false">

  <div class="carousel-inner" role="listbox">
    <?php
    $i=0;
    foreach($product_photos as $product_photo) { ?>
      <div class="carousel-item <?php if($i==0){ echo 'active';} ?>" id="product-photo" >
        <a href="/images/<?php echo $product_photo->name ?>" data-toggle="lightbox" data-gallery="product-gallery"><img src="/images/<?php echo $product_photo->name ?>" id="img-product-photo" style="display: block; width: 100%; object-fit: cover;"></a>
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
    foreach($product_photos as $product_photo) { ?>
      <div data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="thumb active"><img src="/images/<?php echo $product_photo->name ?>" style="width: 120px; height: 130px"></div>

    <?php $i++;
    } ?>
    </div>

  </div>
   	</div>

    			<div class="details col-md-6 pt-3 pr-4">
                <div class="pl-1 pb-3">
                <small class="text-muted"><a href="/category/product/<?php echo $product->subCategory->Category->slug;  ?>"><?php echo $product->subCategory->Category->name;  ?></a> <i class="fas fa-angle-right"></i>  <a href="/category/product/<?php echo $product->subCategory->slug;  ?>"><?php echo $product->subCategory->name;  ?></a></small>
    						<h3 class="product-title mt-2 mb-0">{{$product->name}}</h3>
                จากร้าน <a href="/store/<?php echo $store->username; ?>" target="_blank"><img class="d-inline rounded-circle"  style="border:white 8px solid;display: block; width: 36px; height: 36px; object-fit: cover;" src="/images/{{$store->photo->file}}"></a><a href="/store/<?php echo $store->username; ?>" target="_blank"><h6 class="font-weight-bold mb-0 pr-2 d-inline">{{$store->name}}</h6></a>
    						<div class="product-rating mt-1">
                  <?php
                    $rating=0;
                    $review_amount = 0;
                    foreach($order_reviews as $order_review){
                      $rating +=$order_review->rating;
                      $review_amount +=1;
                    }
                    if($review_amount!=0){
                      $star_rating  = $rating/$review_amount;
                    }else{
                      $star_rating = 0;
                    }
                  ?>
                  <script type="text/javascript">
                    var rating = <?php echo $star_rating; ?>;
                  </script>
                  <div id="product-rating">
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
                      <?php if($star_rating){ ?><span class="pl-2 review-no"> <?php echo number_format((float)$star_rating, 1, '.', ''); ?> คะแนน (<?php echo count($order_reviews); ?> รีวิวจากผู้ซื้อ)</span><?php }else{ echo "  <span class='text-muted'>(สินค้านี้ยังไม่มีรีวิว)</span>";} ?><br>
                      <!-- <small>( <strong>413</strong> ชิ้นได้ถูกจำหน่ายไปแล้ว! )</small> -->
                  </div>


    						</div>
              </div>

                <div class="border-top pt-3 pl-1">
    						        <p class="product-description"><strong>รายละเอียดอย่างย่อ:</strong><br><span class="text-muted">{{$product->short_description}}</span><br></p>
                </div>
                <div class="border-top pt-3 pl-1">
    						        <p class="product-id"><strong>รหัสสินค้า:</strong> <span class="text-muted">p-{{$product->id}}</span><br></p>
                </div>
                <div class="qa border-top pt-3 pb-3 pl-1">
   							<span class="question"><i class="far fa-comments text-muted"></i> <?php echo count($product_questions); ?> คำถาม / <?php echo ProductFrontendController::countProductQuestionAnswersByProductId($product->id); ?> คำตอบ</span>
    						</div>
                <div class="border-top pt-3 pl-1 pb-3">
                  	<h3 class="price d-inline">
                      <td>
                       <?php
                        if($product->product_type=='single'){
                          if(is_null($product->discount_price)||$product->discount_price<=0){
                            echo number_format($product->price)." ฿";
                          }else{
                            echo number_format($product->discount_price)." ฿ <small class='text-muted'><del>จากปกติ ".number_format($product->price)." ฿</del></small> <small class='bg-danger text-white'>&nbsp;ลด ".(100-(int)((($product->discount_price)/$product->price)*100))."%&nbsp;</small><br>";
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
                                   echo number_format($lowestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา </small>";
                                 }else{
                                   echo number_format($lowestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา </small>";
                                 }
                               }else{
                                 echo number_format($lowestprice)."-".number_format($highestprice)." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา </small>";
                               }
                             }else{
                               if($variationlowestprice==$variationhighestprice){
                                 echo number_format($variationlowestprice)." ฿";
                               }else{
                                 echo number_format($variationlowestprice)."-".number_format($variationhighestprice)." ฿";
                               }
                             }
                        }

                        ?>
                      </td>

                    </h3>
                    <?php
                    if(!$product->product_type=='single'){
                        if((!is_null($variationlowestdiscountprice))||(!is_null($variationhighestdiscountprice))){
                          echo "<br><small><mark class='text-danger'>สินค้านี้มีการ<u>ลดราคา</u> เลือกรูปแบบสินค้าเพื่อดูรายละเอียด<mark></small>";
                        }
                    }
                    ?>
                    <br>
                    <br>

                    <img src="/images/free-shipping-month-badge.png" width="106" height="22" alt="หยิบสินค้าใส่ตะกร้า และรับการจัดส่งฟรีทันที!">
                    (<span class="stock">จำนวนในสต็อก <strong><?php echo CheckoutController::checkProductStock($product->id);  ?></strong> ชิ้น</span>)
              </div>



              <div class="border-top pt-3 pl-1">

                <?php
                  if($product->product_type=='single'){  ?>

                    <?php $stock = ProductFrontendController::checkProductStock($product->id);
                    if(!$stock==0){ ?>
                        <p>
                          {{Form::open(['method'=>'POST', 'action'=>array('ProductFrontendController@AddToCart'),'id'=>'addtocartform'])}}
                             {!! csrf_field() !!}
                             <div>เลือกจำนวนสินค้า: </div>
                            <div class="count-input space-bottom">
                               <a class="increase-button text-black" data-action="decrease" href="#">–</a>
                               <input class="quantity" type="text" name="quantity" value="1"/>
                               <a class="increase-button text-black" data-action="increase" href="#">&plus;</a>
                             </div>
                             <input type="hidden" name="product_id" value="{{$product->id}}">
                           </form>
                         </p>
            						<div class="action">
            							<button class="add-to-cart btn btn-default" type="submit" form="addtocartform"><i class="fas fa-shopping-cart"></i> เพิ่มลงตะกร้า</button>
            							<button class="like btn btn-default" type="button"><span class="fa fa-heart active"></span></button>
            						</div>

                     <?php }else{ ?>
                        <h5 class="text-danger">ต้องขออภัยด้วย, สินค้าหมดแล้ว!</h5>
                     <?php } ?>

               <?php } else{ ?>

                   <?php $stock = ProductFrontendController::checkProductStock($product->id);
                   if(!$stock==0){ ?>
                          {{Form::open(['method'=>'POST', 'action'=>array('ProductFrontendController@AddVariationProductToCart'),'id'=>'addtocartform'])}}
                             {!! csrf_field() !!}
                            <div class="d-inline">เลือกรูปแบบสินค้า: </div>
                            <div class="product-variation-container">
                              <div class="radio-tile-group">
                          <?php
                              $product_variations = ProductFrontendController::getVariationDetail($product->id);
                              foreach($product_variations as $product_variation)
                              {
                                 ?>
                                <div class="input-container shippingradiogroup" style="height:35px;">
                                  <input type="hidden" name="variation_photo" value="<?php echo $product_variation["file"] ?>">
                                  <input class="radio-button" type="radio" name="product_variation_id" value="<?php echo $product_variation["product_variationsId"]; ?>" <?php if($product_variation->stock==0){ ?> disabled <?php } ?>  required>
                                  <div class="radio-tile" <?php if($product_variation->stock==0){ ?> style="background-color:lightgray;color:white;border:solid lightgray 1px;" <?php } ?>>
                                    <label class="radio-tile-label"   >
                                     <?php if($product_variation["file"]){ ?>
                                      <img class="d-inline"  style="display: block; width: 30px; height: 30px; object-fit: cover;" src="/images/<?php echo $product_variation["file"]; ?>">
                                     <?php } ?>
                                      <span style="font-size:12px;"><?php echo $product_variation["name"] ?></span></label>
                                  </div>
                                </div>
                              <?php } ?>
                              </div>
                            </div><br>
                            <div class="variation-product-price mt-5"></div><br>
                            <div>เลือกจำนวนสินค้า: </div>
                            <div class="count-input space-bottom">
                              <a class="increase-button text-black" data-action="decrease" href="#">–</a>
                              <input class="quantity" type="text" name="quantity" value="1"/>
                              <a class="increase-button text-black" data-action="increase" href="#">&plus;</a>
                            </div>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <br>
                            <div class="action">
                							<button class="add-to-cart btn btn-default" type="submit" form="addtocartform"><i class="fas fa-shopping-cart"></i> หยิบใส่ตะกร้าสินค้า</button>
                							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                						</div>
                          </form>
                        <?php }else{ ?>
                          <h5 class="text-danger">ต้องขออภัยด้วย, สินค้าหมดแล้ว!</h5>
                        <?php } ?>
                <?php } ?><br>
              </div>
    					</div>
      </div>


      <div class="row border mt-4 pt-4 pb-4 pl-4 pr-4">
        <div class="col-md-1 padding-right-0 text-center">
            <div>
               <a href="/store/<?php echo $store->username; ?>" target="_blank"><img class="d-inline rounded-circle"  style="border:white 8px solid;display: block; width: 75px; height: 75px; object-fit: cover;" src="/images/{{$store->photo->file}}"></a>
            </div>
        </div>
        <div class="col-md-2 padding-0 pt-2 text-md-center text-sm-center text-center text-lg-left">
         <div class="d-inline">
           <a href="/store/<?php echo $store->username; ?>" target="_blank"><h6 class="font-weight-bold mb-0 pr-2 d-inline">{{$store->name}}</h6></a><span class="text-danger" id="store-open" data-toggle="tooltip" title="ร้านนี้ได้ถูกสร้างเมื่อ <?php echo $store->created_at->diffForHumans(); ?>"><i class="fas fa-store"></i></span><a class="text-dark ml-2" id="send-message-to-store" data-toggle="tooltip"  title="ส่งข้อความหาร้านนี้" href="/store/<?php echo $product->store->username; ?>/sendmessage"><i class="far fa-comments" aria-hidden='true'></i></a><br><small class="text-muted">ร้านค้ารับรองแล้ว</small><br>
          </div>
        </div>
        <div class="col-md-4 text-muted">
          <div class="wrap">
          <div class="read-more" onclick="this.classList.add('expanded')">
            <div class="content">
              <span class="font-weight-bold">เกี่ยวกับร้าน</span>
                <p>
                  {{$store->description}}
                </p>
            </div><div class="d-block d-sm-none"><br></div>
            <span class="trigger">ดูเพิ่มเติม...</span>
          </div>
          </div>
        </div>

      </div>


<!-- Tab 1 Content -->

<div class="row mb-5">
  <div class="col-12 mt-4 pl-0 pr-0">
    <div id="product-tab" class="container">
      <ul class="nav nav-pills">
        <li class="active pt-3 pl-3 pr-3 pb-0 h6"><a data-toggle="tab" href="#description_main">รายละเอียด</a></li>
        <li class="pt-3 pl-3 pr-3 pb-0 h6"><a data-toggle="tab" href="#review">รีวิวสินค้า</a></li>
        <li class="pt-3 pl-3 pr-3 pb-0 h6"><a data-toggle="tab" href="#shipping_warranty">การจัดส่งและรับประกัน</a></li>
        <li class="pt-3 pl-3 pr-3 pb-0 h6"><a data-toggle="tab" href="#question_answer">คำถาม-คำตอบ (<?php echo count($product_questions); ?>/<?php echo ProductFrontendController::countProductQuestionAnswersByProductId($product->id); ?>)</a></li>
      </ul>

  <div class="tab-content">
    <div id="description_main" class="tab-pane active">
          <div class="long_description border-top pt-5">
          @php
             echo $product->long_description;
          @endphp
        </div>
        <div class="review_description border-top mt-5 pt-5">
         <h3>รีวิวสินค้า</h3>
         <?php if(!$order_reviews->isEmpty()){ ?>
         <?php foreach($order_reviews as $order_review){ ?>
         <div class="row">
           <div class="col-md-12">
               <div class="media g-mb-30 mt-3">
                 <div class="media-body border p-4">
                  <div class="row">
                     <div class="col-1">
                       <?php if(!$order_review->orders->user_id=="-"){ ?>
                         <a href="/user/<?php echo $order_review->orders->user->name; ?>" target="_blank"><img class="d-flex width-60 height-60 rounded-circle text-right" src="/images/<?php echo $order_review->orders->user->photo->file; ?>" alt="<?php echo $order_review->orders->user->name; ?>"></a>
                       <?php }else{ ?>
                         <img class="d-flex width-60 height-60 rounded-circle text-right" src="/images/no_avatar.png">
                       <?php } ?>
                     </div>
                     <div class="col-11">
                         <div class="g-mb-15">
                          <?php if(!$order_review->orders->user_id=="-"){ ?>
                            <h6 class="text-black mb-0"><a href="/user/<?php echo $order_review->orders->user->name; ?>" target="_blank"><?php echo $order_review->orders->user->firstname.' '.$order_review->orders->user->lastname; ?></a></h6>
                          <?php }else{ ?>
                            <h6 class="text-black mb-0"><?php echo $order_review->orders->billing_address->firstname; ?></h6>
                          <?php } ?>

                           <small class="text-muted"><?php echo $order_review->created_at->diffForHumans(); ?></small>
                         </div>
                         <div class="stars">
                           <?php $rating = $order_review->rating; ?>
                           <span class="fa fa-star checked"></span>
                           <?php if(in_array($rating, [2,3,4,5])){ ?><span class="fa fa-star checked"></span><?php }else{ ?> <span class="fa fa-star"></span> <?php } ?>
                           <?php if(in_array($rating, [3,4,5])){ ?><span class="fa fa-star checked"></span><?php }else{ ?> <span class="fa fa-star"></span> <?php } ?>
                           <?php if(in_array($rating, [4,5])){ ?><span class="fa fa-star checked"></span><?php }else{ ?> <span class="fa fa-star"></span> <?php } ?>
                           <?php if(in_array($rating, [5])){ ?><span class="fa fa-star checked"></span><?php }else{ ?> <span class="fa fa-star"></span> <?php } ?>
                         </div>
                       </div>
                     </div>
                     <p class="mt-2"><?php echo $order_review->review_message; ?></p>

                     <div class="container">
                       <div class="row">
                          <?php foreach($order_review->photos as $photo){ ?>
                            <div class="col-md-2">
                              <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox">
                                <img style="width:100%; height:auto;" src="/images/<?php echo $photo->file; ?>">
                              </a>
                            </div>
                          <?php } ?>
                      </div>
                    </div>

                    <ul class="list-inline d-sm-flex my-0">
                      <li class="list-inline-item ml-auto">
                        <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover showreviewanswerform" href="#">
                          <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                          ตอบกลับรีวิว
                        </a>
                      </li>
                    </ul>

                    <?php if(!ProductFrontendController::getOrderProductReviewAnswers($order_review->id)->isEmpty()){
                      $review_answers = ProductFrontendController::getOrderProductReviewAnswers($order_review->id);
                      foreach($review_answers as $review_answer){
                      ?>
                      <div class="m-2 p-3 bg-gray">
                          <strong class="text-black mb-0"><a href="/user/<?php echo $review_answer->user->name; ?>" target="_blank"><img class="d-inline rounded-circle"  style="border:white 8px solid;display: block; width: 45px; height: 45px; object-fit: cover;" src="/images/{{$review_answer->user->photo->file}}"><?php echo $review_answer->user->firstname.' '.$review_answer->user->lastname; ?></a></strong><br>
                          <small class="g-color-gray-dark-v4 text-muted">{{$review_answer->created_at->diffForHumans()}}</small>
                          <p class="mb-0">{{$review_answer->message}}</p>
                      </div>
                    <?php }
                        } ?>

                     <div class="reviewanswerform row">
                          <?php
                           if (Auth::check()){ ?>
                          <div class="col-md-12 mt-3">
                           {{ Form::open(['method'=>'POST', 'action'=>'ProductFrontendController@storeOrderProductReviewAnswer','id'=>'storeorderproductreviewanswerform'])}}

                            {{csrf_field()}}
                            {{ Form::hidden('order_review_id', Crypt::encrypt($order_review->id)) }}
                            <textarea class="form-control" name="message" id="answer-review-input" rows="4" cols="80">{{ old('message') }}</textarea>
                            <input type="submit" name="button" class="btn btn-primary btn-block mt-2" value="ตอบกลับ">
                          {{ Form::close()}}
                          </div>
                        <?php  } ?>
                    </div>


                   </div>
               </div>
           </div>
       </div>


     <?php } ?>
   <?php }else{ ?>
     <span class="m-4">สินค้านี้ยังไม่มีรีวิว คุณสามารถสั่งซื้อสินค้านี้ และให้รีวิวหลังจากได้รับสินค้าแล้ว</span>
   <?php } ?>

   </div><!-- Shipping and Warranty in description -->
      <div class="warranty_description">
        <div class=" border-top mt-5 pt-5">
          <h3>การจัดส่ง</h3>
          <span>สินค้านี้ใช้การจัดส่งในรูปแบบ...</span>
          <p>
            <table class="table table-sm">
              <thead style="background-color:lightgray;">
                <tr>
                  <th>ชื่อการจัดส่ง</th>
                  <th>รูปแบบ</th>
                  <th>สถานที่จัดส่ง</th>
                  <th>ราคา</th>
                </tr>
              </thead>
              <tbody>
            <?php foreach($product->shippings as $shipping){ ;?>

                  <tr>
                    <td><?php echo $shipping->name; ?></td>
                    <td><?php if($shipping->type=="flat"){
                      echo "ค่าจัดส่งแบบราคาเดียว";
                    }elseif($shipping->type=="free"){
                      echo "ค่าจัดส่งฟรี";
                    }else{
                      echo "ค่าจัดส่งแบบคิดตามน้ำหนัก";
                    } ?>

                    </td>
                    <td>
                      <?php if(!empty($shipping->allowlocations)){
                       echo "<strong>สินค้านี้จัดส่งเฉพาะในพื้นที่</strong> ";
                       $allows = explode(",",$shipping->allowlocations); ?>
                        <?php foreach($allows as $allow){
                          $allowlocation = ProductFrontendController::getLocationbyid($allow);
                          echo $allowlocation->name." (".$allowlocation->postal_code.")"."  ";

                      }
                      }else{ ?>
                          สินค้านี้จัดส่งทุกพื้นที่
                      <?php }?>

                      <?php if(!is_null($shipping->notallowlocations)){
                       echo "<br><strong>แต่ไม่จัดส่งในพื้นที่</strong> ";
                       $notallows = explode(",",$shipping->notallowlocations); ?>
                        <?php foreach($notallows as $notallow){
                          $notallowlocation = ProductFrontendController::getLocationbyid($notallow);
                          echo $notallowlocation->name." (".$notallowlocation->postal_code.")"."  ";
                      }
                    } ?>

                    </td>
                    <td>
                      <?php if($shipping->type=="flat"){
                        echo $shipping->cost." ฿";
                      }elseif($shipping->type=="free"){
                        echo "0 ฿";
                      }else{
                        $weightbaselowestprice = ProductFrontendController::getWeightbaseLowestCost($shipping->id);
                        $weightbasehighestprice = ProductFrontendController::getWeightbaseHighestCost($shipping->id);
                        echo $weightbaselowestprice."-".$weightbasehighestprice." ฿";
                      } ?>
                    </td>
                  </tr>
            <?php } ?>
            </tbody>
          </table>

          </p>
        </div>
     </div><!-- End Shipping and Warranty in description -->

     <div class="qa_description border-top mt-5 pt-5">
       <div class="row">
         <div class="col-md-10">
           <h3>คำถาม-คำตอบ</h3>
         </div>
         <div class="col-md-2 text-right">
           <label for="ask-question-input" class="askquestion text-primary"><a>ถามคำถาม?</a></label>
         </div>
       </div>

     @foreach($product_questions as $product_question)
      <div class="row">
        <div class="col-md-12">
            <div class="media g-mb-30 mt-3">
                <?php
                if(isset($product_question->user->photo->file)){
                  $user_profile_photo = '/images/'.$product_question->user->photo->file;
                } ?>
                <img class="rounded-circle d-inline mr-3"  style="display: block; width: 36px; height: 36px; object-fit: cover;" src="{{ $user_profile_photo ?? 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}">
                <div class="media-body border pt-3 pl-4 pr-4">

                  <div class="g-mb-15">
                    <h6 class="text-black mb-0"><a href="/user/<?php echo $product_question->user->name; ?>" target="_blank"><?php if(empty($product_question->user->firstname)){ echo $product_question->user->name; }else{ echo $product_question->user->firstname.' '.$product_question->user->lastname; } ?></a></h6>
                    <small class="g-color-gray-dark-v4 text-muted">{{$product_question->created_at->diffForHumans()}}</small>
                  </div>
                  <p>{{$product_question->question_message}}</p>

                 <?php
                 if (Auth::check()){
                 if(ProductFrontendController::checkIfUserOwnProductorOwnQuestion(Auth::user()->id,$product_question->questionId)){ ?>
                  <ul class="list-inline d-sm-flex my-0">
                    <li class="list-inline-item ml-auto">
                      <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover showanswerform" href="#">
                        <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                        ตอบกลับคำถามนี้
                      </a>
                    </li>
                  </ul>
                <?php }} ?>
                </div>
            </div>
        </div>
    <?php  $answers = ProductFrontendController::getProductQuestionAnswers($product_question->questionId); ?>

    @foreach($answers as $answer)

        <div class="offset-md-1 col-md-11">
          <div class="media g-mb-30 mt-3">

            <?php
            if(isset($answer->user->photo->file)){
              $user_profile_photo = '/images/'.$answer->user->photo->file;
            } ?>
            <img class="rounded-circle d-inline mr-3"  style="display: block; width: 36px; height: 36px; object-fit: cover;" src="{{ $user_profile_photo ?? 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}">
              <div class="media-body border pt-3 pl-4 pr-4">
                <div class="g-mb-15">
                  <h6 class="text-black mb-0"><a href="/user/<?php echo $answer->user->name; ?>" target="_blank"><?php if(empty($answer->user->firstname)){ echo $answer->user->name; }else{ echo $answer->user->firstname.' '.$answer->user->lastname; } ?></a></h6>
                  <small class="g-color-gray-dark-v4 text-muted">{{$answer->created_at->diffForHumans()}}</small>
                </div>
                <p>{{$answer->answer_message}}</p>
              </div>
          </div>
        </div><!-- Answer Section-->
    @endforeach


    </div><!-- End Question list -->

    <div class="answerform row">
      <?php
       if (Auth::check()){
         if(ProductFrontendController::checkIfUserOwnProductorOwnQuestion(Auth::user()->id,$product_question->questionId)){ ?>
      <div class="offset-md-1 col-md-11 mt-3">
        {{Form::open(['method'=>'POST', 'action'=>'ProductFrontendController@storeProductQuestionAnswer','id'=>'createproductionquestionanswerform'])}}
        {{csrf_field()}}
        {{ Form::hidden('product_question_id', Crypt::encrypt($product_question->questionId)) }}
        {{ Form::hidden('store_id', Crypt::encrypt($store->id)) }}
        {{ Form::hidden('user_id', Crypt::encrypt(Auth::user()->id)) }}
        <textarea class="form-control" name="answer_message" id="answer-question-input" rows="4" cols="80">{{ old('answer_message') }}</textarea>
        <button type="submit" name="button" class="btn btn-secondary btn-block mt-2">โพสต์คำตอบ</button>
      </form>
      </div>
    <?php } } ?>
    </div>



    @endforeach

    <div class="row mt-4 pt-4 border-top">
     <h5>โพสต์ถามคำถามเกี่ยวกับสินค้าที่นี่</h5>
    <?php   if (Auth::check())
      {   ?>
      <div class="col-12 mt-3">
        {{Form::open(['method'=>'POST', 'action'=>'ProductFrontendController@storeProductQuestion','id'=>'createproductionquestionform'])}}
        {{csrf_field()}}
        {{ Form::hidden('product_id', Crypt::encrypt($product->id)) }}
        {{ Form::hidden('user_id', Crypt::encrypt(Auth::user()->id)) }}
        <textarea class="form-control" name="question_message" id="ask-question-input" rows="4" cols="80">{{ old('question_message') }}</textarea>
        <button type="submit" name="button" class="btn btn-secondary float-right mt-2">โพสต์คำถาม</button>
      </form>
      </div>
    <?php } else {
      echo "<div><h4>กรุณา<a href='/login'>เข้าสู่ระบบเพื่อถามคำถาม</a></h4></div>";
    } ?>
    </div>

    </div><!-- Question and Answer in description -->
  </div><!-- End Tab 1 -->


<!-- Tab 2 : Review -->
    <div id="review" class="tab-pane fade">
      <div class="review_description border-top pt-5">
       <h3>รีวิวสินค้า</h3>
       <?php if(!$order_reviews->isEmpty()){ ?>
       <?php foreach($order_reviews as $order_review){ ?>
       <div class="row">
         <div class="col-md-12">
             <div class="media g-mb-30 mt-3">
               <div class="media-body border p-4">
                <div class="row">
                  <div class="row">
                     <div class="col-2">
                       <?php if(!$order_review->orders->user_id=="-"){ ?>
                         <a href="/user/<?php echo $order_review->orders->user->name; ?>" target="_blank"><img class="d-flex width-60 height-60 rounded-circle text-right" src="/images/<?php echo $order_review->orders->user->photo->file; ?>" alt="<?php echo $order_review->orders->user->name; ?>"></a>
                       <?php }else{ ?>
                         <img class="d-flex width-60 height-60 rounded-circle text-right" src="/images/no_avatar.png">
                       <?php } ?>
                     </div>
                     <div class="col-10">
                         <div class="g-mb-15">
                          <?php if(!$order_review->orders->user_id=="-"){ ?>
                            <h6 class="text-black mb-0"><a href="/user/<?php echo $order_review->orders->user->name; ?>" target="_blank"><?php echo $order_review->orders->user->firstname.' '.$order_review->orders->user->lastname; ?></a></h6>
                          <?php }else{ ?>
                            <h6 class="text-black mb-0"><?php echo $order_review->orders->billing_address->firstname; ?></h6>
                          <?php } ?>

                           <small class="text-muted"><?php echo $order_review->created_at->diffForHumans(); ?></small>
                         </div>
                         <div class="stars">
                           <?php $rating = $order_review->rating; ?>
                           <span class="fa fa-star checked"></span>
                           <?php if(in_array($rating, [2,3,4,5])){ ?><span class="fa fa-star checked"></span><?php }else{ ?> <span class="fa fa-star"></span> <?php } ?>
                           <?php if(in_array($rating, [3,4,5])){ ?><span class="fa fa-star checked"></span><?php }else{ ?> <span class="fa fa-star"></span> <?php } ?>
                           <?php if(in_array($rating, [4,5])){ ?><span class="fa fa-star checked"></span><?php }else{ ?> <span class="fa fa-star"></span> <?php } ?>
                           <?php if(in_array($rating, [5])){ ?><span class="fa fa-star checked"></span><?php }else{ ?> <span class="fa fa-star"></span> <?php } ?>
                         </div>
                       </div>
                     </div>
                   </div>
                   <br>
                   <p><?php echo $order_review->review_message; ?></p>


                   <div class="modal fade" id="enlargeImageModal-2" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal-2" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <img src="" class="enlargeImageModalSource-2" style="width: 100%;">
                          </div>
                        </div>
                      </div>
                   </div>


                   <div class="container">
                     <div class="row">
                        <?php foreach($order_review->photos as $photo){ ?>
                          <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox">
                            <div class="col-md-2"><img class="review-photo-2" style="width:100%; height:auto;" src="/images/<?php echo $photo->file; ?>"></div>
                          </a>
                        <?php } ?>
                    </div>
                  </div>

                  <ul class="list-inline d-sm-flex my-0">
                    <li class="list-inline-item ml-auto">
                      <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover showreviewanswerform" href="#!">
                        <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                        ตอบกลับรีวิว
                      </a>
                    </li>
                  </ul>

                  <?php if(!ProductFrontendController::getOrderProductReviewAnswers($order_review->id)->isEmpty()){
                    $review_answers = ProductFrontendController::getOrderProductReviewAnswers($order_review->id);
                    foreach($review_answers as $review_answer){
                    ?>
                    <div class="m-2 p-3 bg-gray">
                        <strong class="text-black mb-0"><a href="/user/<?php echo $review_answer->user->name; ?>" target="_blank"><img class="d-inline rounded-circle"  style="border:white 8px solid;display: block; width: 45px; height: 45px; object-fit: cover;" src="/images/{{$review_answer->user->photo->file}}"><?php echo $review_answer->user->firstname.' '.$review_answer->user->lastname; ?></a></strong><br>
                        <small class="g-color-gray-dark-v4 text-muted">{{$review_answer->created_at->diffForHumans()}}</small>
                        <p class="mb-0">{{$review_answer->message}}</p>
                    </div>
                  <?php }
                      } ?>

                   <div class="reviewanswerform row">
                        <?php
                         if (Auth::check()){ ?>
                        <div class="col-md-12 mt-3">
                         {{ Form::open(['method'=>'POST', 'action'=>'ProductFrontendController@storeOrderProductReviewAnswer','id'=>'storeorderproductreviewanswerform'])}}

                          {{csrf_field()}}
                          {{ Form::hidden('order_review_id', Crypt::encrypt($order_review->id)) }}
                          <textarea class="form-control" name="message" id="answer-review-input" rows="4" cols="80">{{ old('message') }}</textarea>
                          <input type="submit" name="button" class="btn btn-primary btn-block mt-2" value="ตอบกลับ">
                        {{ Form::close()}}
                        </div>
                      <?php  } ?>
                  </div>

                 </div>
             </div>
         </div>
     </div>


   <?php } ?>
 <?php }else{ ?>
   <span class="m-4">สินค้านี้ยังไม่มีรีวิว คุณสามารถสั่งซื้อสินค้านี้ และให้รีวิวหลังจากได้รับสินค้าแล้ว</span>
 <?php } ?>

    </div>
    </div> <!-- End Tab 2 -->

    <!-- Tab 3: Shipping -->
    <div id="shipping_warranty" class="tab-pane fade">
      <div class=" border-top pt-5">
        <h3>การจัดส่ง</h3>
        <span>สินค้านี้ใช้การจัดส่งในรูปแบบ...</span>
        <p>
          <table class="table table-sm">
            <thead style="background-color:lightgray;">
              <tr>
                <th>ชื่อการจัดส่ง</th>
                <th>รูปแบบ</th>
                <th>สถานที่จัดส่ง</th>
                <th>ราคา</th>
              </tr>
            </thead>
            <tbody>
          <?php foreach($product->shippings as $shipping){ ;?>

                <tr>
                  <td><?php echo $shipping->name; ?></td>
                  <td><?php if($shipping->type=="flat"){
                    echo "ค่าจัดส่งแบบราคาเดียว";
                  }elseif($shipping->type=="free"){
                    echo "ค่าจัดส่งฟรี";
                  }else{
                    echo "ค่าจัดส่งแบบคิดตามน้ำหนัก";
                  } ?>

                  </td>
                  <td>
                    <?php if(!empty($shipping->allowlocations)){
                     echo "<strong>สินค้านี้จัดส่งเฉพาะในพื้นที่</strong> ";
                     $allows = explode(",",$shipping->allowlocations); ?>
                      <?php foreach($allows as $allow){
                        $allowlocation = ProductFrontendController::getLocationbyid($allow);
                        echo $allowlocation->name." (".$allowlocation->postal_code.")"."  ";

                    }
                    }else{ ?>
                        สินค้านี้จัดส่งทุกพื้นที่
                    <?php }?>

                    <?php if(!is_null($shipping->notallowlocations)){
                     echo "<br><strong>แต่ไม่จัดส่งในพื้นที่</strong> ";
                     $notallows = explode(",",$shipping->notallowlocations); ?>
                      <?php foreach($notallows as $notallow){
                        $notallowlocation = ProductFrontendController::getLocationbyid($notallow);
                        echo $notallowlocation->name." (".$notallowlocation->postal_code.")"."  ";
                    }
                  } ?>

                  </td>
                  <td>
                    <?php if($shipping->type=="flat"){
                      echo $shipping->cost." ฿";
                    }elseif($shipping->type=="free"){
                      echo "0 ฿";
                    }else{
                      $weightbaselowestprice = ProductFrontendController::getWeightbaseLowestCost($shipping->id);
                      $weightbasehighestprice = ProductFrontendController::getWeightbaseHighestCost($shipping->id);
                      echo $weightbaselowestprice."-".$weightbasehighestprice." ฿";
                    } ?>
                  </td>
                </tr>
          <?php } ?>
          </tbody>
        </table>

        </p>
      </div>
    </div><!-- End Tab 3 -->

    <!-- Tab 4: Question -->
    <div id="question_answer" class="tab-pane fade">
      <div class="qa_description border-top pt-5">
        <div class="row">
          <div class="col-md-10">
            <h3>คำถาม-คำตอบ</h3>
          </div>
          <div class="col-md-2 text-right">
            <label for="ask-question-tab-input" class="askquestion text-primary"><a>ถามคำถาม?</a></label>
          </div>
        </div>

      @foreach($product_questions as $product_question)
       <div class="row">
         <div class="col-md-12">
             <div class="media g-mb-30 mt-3">

                 <?php
                 if(isset($product_question->user->photo->file)){
                   $user_profile_photo = '/images/'.$product_question->user->photo->file;
                 } ?>
                 <img class="rounded-circle d-inline mr-3"  style="display: block; width: 36px; height: 36px; object-fit: cover;" src="{{ $user_profile_photo ?? 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}">
                 <div class="media-body border pt-3 pl-4 pr-4">

                   <div class="g-mb-15">
                     <h6 class="text-black mb-0"><a href="/user/<?php echo $product_question->user->name; ?>" target="_blank"><?php if(empty($product_question->user->firstname)){ echo $product_question->user->name; }else{ echo $product_question->user->firstname.' '.$product_question->user->lastname; } ?></a></h6>
                     <small class="g-color-gray-dark-v4 text-muted">{{$product_question->created_at->diffForHumans()}}</small>
                   </div>
                   <p>{{$product_question->question_message}}</p>

                  <?php
                  if (Auth::check()){
                  if(ProductFrontendController::checkIfUserOwnProductorOwnQuestion(Auth::user()->id,$product_question->questionId)){ ?>
                   <ul class="list-inline d-sm-flex my-0">
                     <li class="list-inline-item ml-auto">
                       <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover showanswerform" href="#">
                         <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                         ตอบคำถามนี้
                       </a>
                     </li>
                   </ul>
                 <?php }} ?>
                 </div>
             </div>
         </div>
     <?php  $answers = ProductFrontendController::getProductQuestionAnswers($product_question->questionId); ?>

     @foreach($answers as $answer)

         <div class="offset-md-1 col-md-11">
           <div class="media g-mb-30 mt-3">

             <?php
             if(isset($answer->user->photo->file)){
               $user_profile_photo = '/images/'.$answer->user->photo->file;
             } ?>
             <img class="rounded-circle d-inline mr-3"  style="display: block; width: 36px; height: 36px; object-fit: cover;" src="{{ $user_profile_photo ?? 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}">
               <div class="media-body border pt-3 pl-4 pr-4">
                 <div class="g-mb-15">
                   <h6 class="text-black mb-0"><a href="/user/<?php echo $answer->user->name; ?>" target="_blank"><?php if(empty($answer->user->firstname)){ echo $answer->user->name; }else{ echo $answer->user->firstname.' '.$answer->user->lastname; } ?></a></h6>
                   <small class="g-color-gray-dark-v4 text-muted">{{$answer->created_at->diffForHumans()}}</small>
                 </div>
                 <p>{{$answer->answer_message}}</p>

               </div>
           </div>
         </div><!-- Answer Section-->
     @endforeach

     </div><!-- End Question list -->

     <div class="answerform row">
       <?php
        if (Auth::check()){
          if(ProductFrontendController::checkIfUserOwnProductorOwnQuestion(Auth::user()->id,$product_question->questionId)){ ?>
       <div class="offset-md-1 col-md-11 mt-3">
         {{Form::open(['method'=>'POST', 'action'=>'ProductFrontendController@storeProductQuestionAnswer','id'=>'createproductionquestionanswerform'])}}
         {{csrf_field()}}
         {{ Form::hidden('product_question_id', Crypt::encrypt($product_question->questionId)) }}
         {{ Form::hidden('store_id', Crypt::encrypt($store->id)) }}
         {{ Form::hidden('user_id', Crypt::encrypt(Auth::user()->id)) }}
         <textarea class="form-control" name="answer_message" id="answer-question-input" rows="4" cols="80">{{ old('answer_message') }}</textarea>
         <button type="submit" name="button" class="btn btn-secondary btn-block mt-2">โพสต์คำตอบ</button>
       </form>
       </div>
     <?php } } ?>
     </div>


     @endforeach

     <div class="row mt-4 pt-4 border-top">
      <h5>โพสต์ถามคำถามเกี่ยวกับสินค้าที่นี่</h5>
     <?php   if (Auth::check())
       {   ?>
       <div class="col-12 mt-3">
         {{Form::open(['method'=>'POST', 'action'=>'ProductFrontendController@storeProductQuestion','id'=>'createproductionquestionform'])}}
         {{csrf_field()}}
         {{ Form::hidden('product_id', Crypt::encrypt($product->id)) }}
         {{ Form::hidden('user_id', Crypt::encrypt(Auth::user()->id)) }}
         <textarea class="form-control" name="question_message" id="ask-question-tab-input" rows="4" cols="80">{{ old('question_message') }}</textarea>
         <button type="submit" name="button" class="btn btn-secondary float-right mt-2">โพสต์คำถาม</button>
       </form>
       </div>
     <?php } else {
       echo "<div><h4>กรุณา<a href='/login'>เข้าสู่ระบบเพื่อถามคำถาม</a></h4></div>";
     } ?>
     </div>

     </div>
    </div>
    <!-- End Tab 4 -->
  </div>
  </div>
</div>

</div>

<style>
@media only screen and (max-width: 600px) {
  .long_description img{
    max-width:100%;
    height:auto;
  }
}
</style>

@endsection
