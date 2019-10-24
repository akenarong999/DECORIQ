@extends('layouts.frontend')

@section('description')
{{$category->description}}
@endsection

@section('title')
หมวดหมู่ {{$category->name}} - DECORIQ
@endsection

@section('content')

<div class="container mb-4">
  <div class="row mt-3">
    <div class="col-12 mb-0">
      <div class="gradient">
        <?php if($category->cover_photo) { ?><img src="/images/<?php echo $category->service_category_cover_photo->file; ?>" alt="test" class="img-responsive w-100" style="display: block; z-index:-1; position:relative; height:300px; object-fit: cover;"><?php }else{ ?> <img src="https://via.placeholder.com/1110x300.png?text=No+Cover" alt="test" class="img-responsive w-100" style="display: block; z-index:-1; position:relative; height:300px; object-fit: cover;">  <?php } ?>
      </div>
      <div class="carousel-caption" style="bottom:0;">
        <?php if(isset($category->Category)){ ?><span><a href="/category/service/<?php echo $category->Category->slug; ?>" class="text-white"><i class="fas fa-angle-right"></i> หมวดหมู่หลัก:  <?php echo $category->Category->name; ?></a></span><?php } ?>
        <h1 class="mb-0"><?php if($category->icon_photo) { ?><img src="/images/<?php echo $category->service_category_icon_photo->file; ?>" style="width:50px;" class="d-inline"><?php }else{ ?> <img src="https://via.placeholder.com/50x50.png?text=No+image" width="50">  <?php } ?> <?php echo $category->name; ?></h1>
        <span><?php echo $category->description; ?></span>
      </div>
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-md-3 col-sm-12 mt-2 pt-2">
       <?php if(isset($subcategories)){ ?>
        <div class="container mb-3">
        <h5>หมวดหมู่ย่อย</h5>
          <div class="list-group">
           <?php foreach($subcategories as $subcategory){ ?>
              <a href="/category/service/<?php echo $subcategory->slug; ?>" class="list-group-item list-group-item-action"><i class="fas fa-caret-right"></i> <?php echo $subcategory->name; ?></a>
            <?php } ?>
          </div>
        </div>
        <?php } ?>

        <div class="container">
          <h5>ช่วงราคา</h5>

        </div>
    </div>
    <div class="col-md-9 col-sm-12 mt-2 pt-2">
      <div class="container">
        <h3>บริการในหมวดนี้</h3>
        <div class="row pt-2">

         @foreach($services as $service)

           <div class="col-6 col-md-4 col-lg-3 mt-2">
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
</div>



@endsection
