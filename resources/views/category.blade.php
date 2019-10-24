@extends('layouts.frontend')

@section('description')
{{$category->description}}
@endsection

@section('title')
หมวดหมู่ {{$category->name}} - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\ProductFrontendController; ?>
<div class="container mb-4">
  <div class="row mt-3">
    <div class="col-12 mb-0">
      <div class="gradient">
        <?php if($category->cover_photo_id) { ?><img src="/images/<?php echo $category->cover_photo->file; ?>" alt="test" class="img-responsive w-100" style="display: block; z-index:-1; position:relative; height:300px; object-fit: cover;"><?php }else{ ?> <img src="https://via.placeholder.com/1110x300.png?text=No+Cover" alt="test" class="img-responsive w-100" style="display: block; z-index:-1; position:relative; height:300px; object-fit: cover;">  <?php } ?>
      </div>
      <div class="carousel-caption" style="bottom:0;">
        <?php if(isset($category->Category)){ ?><span><a href="/category/product/<?php echo $category->Category->slug; ?>" class="text-white"><i class="fas fa-angle-right"></i> หมวดหมู่หลัก:  <?php echo $category->Category->name; ?></a></span><?php } ?>

        <h1 class="mb-0"><?php if($category->icon_photo_id) { ?><img src="/images/<?php echo $category->icon_photo->file; ?>" style="width:50px;height:50px;" class="d-inline"><?php }else{ ?> <img src="https://via.placeholder.com/50x50.png?text=No+image" width="50">  <?php } ?> <?php echo $category->name; ?></h1>
        <span><?php echo $category->description; ?></span>
      </div>
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-md-3 col-sm-12 mt-2 pt-2">


       <?php if(isset($subcategories)){ ?>
        <div class="container mb-3">
        <h4>หมวดหมู่ย่อย</h4>
          <div class="list-group">
           <?php foreach($subcategories as $subcategory){ ?>
              <a href="/category/product/<?php echo $subcategory->slug; ?>" class="list-group-item list-group-item-action"><i class="fas fa-caret-right"></i> <?php echo $subcategory->name; ?></a>
            <?php } ?>
          </div>
        </div>
        <?php } ?>

        <?php if(!isset($subcategories)){ ?>
         <div class="container mb-3">
         <h4>หมวดหมู่หลัก</h4>
           <div class="list-group">
             <?php if(isset($category->Category)){ ?>
               <a href="/category/product/<?php echo $category->Category->slug; ?>" class="list-group-item list-group-item-action"><i class="fas fa-caret-right"></i> <?php echo $category->Category->name; ?></a>
             <?php } ?>
           </div>
         </div>
         <?php } ?>
    </div>
    <div class="col-md-9 col-sm-12 mt-2 pt-2">
      <div class="container">
        <h3>สินค้าในหมวดนี้</h3>
        <div class="row pt-2">
          @foreach($products as $product)
          <div class="col-6 col-md-4 col-lg-3 mt-2 mb-1">
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
                                echo $product->price.' ฿';
                              }else{
                                echo $product->discount_price."฿ <small class='text-muted'><del>".$product->price." ฿</del></small> <small class='bg-danger text-white'>&nbsp;ลด ".(100-(int)((($product->discount_price)/$product->price)*100))."%&nbsp;</small>";
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
                                    echo $lowestprice." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                                  }else{
                                    echo $lowestprice." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                                  }
                                }else{
                                  echo $lowestprice."-".$highestprice." ฿ <small class='bg-danger text-white'>&nbsp;ลดราคา&nbsp;</small>";
                                }
                              }else{
                                if($variationlowestprice==$variationhighestprice){
                                  echo $variationlowestprice." ฿";
                                }else{
                                  echo $variationlowestprice."-".$variationhighestprice." ฿";
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
      </div>
    </div>
  </div>
</div>



@endsection
