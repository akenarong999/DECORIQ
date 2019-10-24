@extends('layouts.frontend')

@section('title')
โปรไฟล์ร้าน <?php echo $store->name; ?> - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\Store\StorePageController; ?>
<?php use \App\Http\Controllers\ProductFrontendController; ?>

<div class="container border p-0 pb-1 mt-4">
  <div class="container p-3" style="height:300px;background-image:url(/images/{{ $store->cover_photo ? $store->cover_photo->file : 'cover_photo.jpg'}}); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>

  <div class="container" >
    <div class="row" >
      <div class="col-2"  style="margin-top:-100px;">
        <img class="d-inline border"  style="display: block; width: 160px; height: 160px; object-fit: cover;" src="/images/{{$store->photo ? $store->photo->file : 'store_no_avatar.png'}}">
      </div>
      <div class="col-md-10 col-xs-12 pl-4 pt-3">
        <h4 class="d-inline">ร้าน <?php  echo $store->name ; ?></h4> <span class="text-muted">(@<?php echo $store->username  ?>)</span><br>
      </div>
    </div>
  </div>

  <div class="container mb-4">
    <div class="row">
      <div class="col-10 offset-2">
       <?php if(Auth::check()){ ?>
        <?php if($store->id!=Auth::user()->id){ ?>
        <a href="/store/<?php echo $store->username; ?>/sendmessage" class="btn btn-light"><i class="far fa-comments" aria-hidden='true'></i> ส่งข้อความ</a>
          <?php if(StorePageController::checkIfFollowThisStore($store->id)){ ?>
            <a href="/store/<?php echo $store->username; ?>/dounfollow" class="follow btn btn-success" onmouseover="change_follow_btn();" onmouseout="normal_follow_btn();"><i class='fa fa-check' aria-hidden='true'></i> ติดตามแล้ว</a>
          <?php }else{ ?>
            <a href="/store/<?php echo $store->username; ?>/dofollow" class="btn btn-primary"><i class='fa fa-user-plus' aria-hidden='true'></i> ติดตาม</a>
       <?php
           }
        }
      }
         ?>
        <span class="d-inline  ml-2 pl-2 border-left"><i class="fas fa-user-friends"></i> จำนวนผู้ติดตาม <?php echo StorePageController::countFollower($store->id); ?> </span>
      </div>

    </div>
 </div>

</div>

  <div class="container mt-5 mb-3 ">
    <div class="row">
      <div class="col-md-3 col-xs-12 p-4 border">

        <h5 class="border-bottom pb-2">เกี่ยวกับฉัน</h5>
        <?php if(!empty($store->description)){ echo '<span class="text-muted">'.$store->description.'</span>'; } ?>

        <h5 class="border-bottom pb-2 mt-4">รูปภาพ</h5>
        <?php
        $i=0;
        foreach($timeline_posts as $timeline_post){ ?>
          <?php
            $count_all_photos = StorePageController::countAllTimelinePhotos($store->id);
            foreach($timeline_post->photos as $photo){
              if($i<8){ ?>
                <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="gallery-<?php echo $store->id; ?>-gallery">
                  <img class="d-inline mt-1" style="display: block; width: 65px; height: 65px; object-fit: cover;" src="/images/{{ $photo->file }}"></a>
                </a>
            <?php $i++;
          }elseif($i==8){?>
            <div class="image d-inline" style="position: relative; width: 100%;">
              <a href="#">
                <img class="d-inline mt-1" style="display: block; width: 65px; height: 65px; object-fit: cover; background-color: black; opacity: 0.5; filter: alpha(opacity=50);" src="/images/{{ $photo->file }}">
                <h4 style="position: absolute; top: 0; left: 0; padding-left: 25px;width: 100%; color:white; font-weight:bolder">+<?php $count_all_photos-=9;echo $count_all_photos; ?></h4>
              </a>
            </div>
            <?php $i++;
          }
              } ?>
        <?php } ?>

        <h5 class="border-bottom pb-2 mt-4">ผู้ติดตาม</h5>
            <?php $store_followers = StorePageController::getFollower($store->id);
            foreach($store_followers as $store_follower){ ?>
              <a href="/user/<?php echo $store_follower->follower->name; ?>" title="<?php echo $store_follower->follower->name; ?>"><img class="d-inline"  style="display: block; width: 55px; height: 55px; object-fit: cover;" src="/images/{{$store_follower->follower->photo ? $store_follower->follower->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"></a>
            <?php   }  ?>
      </div>
      <div class="col-md-9 col-xs-12 ">
        <div class="row mb-5">
          <div class="col-12 pl-1 pr-1">
            <div id="product-tab" class="container">
              <ul class="nav nav-pills">
                <li class="active p-2 pr-4 pl-4"><a data-toggle="tab" href="#timeline"><h6>ไทม์ไลน์</h6></a></li>
                <li class="p-2 pr-4 pl-4"><a data-toggle="tab" href="#product"><h6>สินค้า (<?php echo count($products); ?>)</h6></a></li>
                <li class="p-2 pr-4 pl-4"><a data-toggle="tab" href="#service"><h6>บริการ (<?php echo count($services); ?>)</h6></a></li>
                <li class="p-2 pr-4 pl-4"><a data-toggle="tab" href="#review"><h6>รีวิว</h6></a></li>
                <li class="p-2 pr-4 pl-4"><a data-toggle="tab" href="#articles"><h6>บทความ (<?php echo count($articles); ?>)</h6></a></li>

              </ul>

              <div class="tab-content border-top p-3 pt-2">
                <div id="timeline" class="tab-pane active">

                  <?php if(Auth::user()){ ?>

                  <?php if(Auth::user()->isOwnStore($store->username)){ ?>
                    <div class="container">
                      <div class="row">
                          <div class="col-12 p-0">
                            <div class="panel panel-default">

                             <form action="/store/<?php echo $store->username ?>/addnewpost" method="post"  enctype="multipart/form-data">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <div class="panel-body p-2">
                                   <input type="text" name="message" class="form-control" placeholder="เขียนข้อความได้ที่นี่..." required>
                                 </div>
                                 <div class="panel-footer p-2">
                                   <div class="btn-group">
                                   <!--  <button type="button" class="btn btn-link btn-icon"><i class="fa fa-users"></i></button> -->
                                     <button type="button" onclick="showPostUploadPhotoInput()" class="btn btn-link btn-icon"><i class="fa fa-camera"></i></button>

                                   </div>
                                   <div class="float-right">
                                     <button type="submit" class="btn btn-primary">โพสต์</button>
                                   </div>
                                   <div id="post-upload-photo-input" style="display:none">
                                      <input type="file" name="post_photos">
                                   </div>
                                 </div>
                              </form>

                         </div>
                       </div>
                      </div>
                    </div>
                    <?php } ?>
                  <?php } ?>

                    <?php foreach($timeline_posts as $timeline_post){ ?>
                      <div class="row mt-2">
                        <div class="col-12  p-3 border">
                          <div class="row">
                            <div class="col-1">
                              <a href="/store/<?php echo $timeline_post->store->username; ?>" title="<?php echo $timeline_post->store->name; ?>"><img class="d-inline border"  style="display: block; width: 50px; height: 50px; object-fit: cover;" src="/images/{{ $timeline_post->store->photo ? $timeline_post->store->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"></a>
                            </div>
                            <div class="col-11">
                              <h6><a href="/store/<?php echo $timeline_post->store->username; ?>"><?php if(!$timeline_post->store->firstname){echo $timeline_post->store->name;}else{ echo $timeline_post->store->firstname.' '.$timeline_post->store->lastname; } ?></a></strong><br>
                              <small class="text-muted"><?php echo $timeline_post->created_at->diffForHumans(); ?></small></h6>
                              <?php echo $timeline_post->message; ?><br>
                              <?php foreach($timeline_post->photos as $photo){ ?>
                                <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="timeline-post-<?php echo $timeline_post->id; ?>-gallery">
                                  <img class="d-inline p-1" style="display: block; width: 150px; height: 150px; object-fit: cover;" src="/images/<?php echo $photo->file; ?>"></a>
                                </a>
                              <?php } ?>


                              <?php if(Auth::check()){ ?>

                              <div class="mt-2 p-2"><a class="text-primary  border pl-1 pr-1" style="cursor: pointer;" onclick="showCommentform(<?php echo $timeline_post->id; ?>)"><small><i class="themify ti ti-comment"></i> ตอบกลับ</small></a></span>

                              <?php $comments = StorePageController::getPostComments($timeline_post->id);  ?>

                              <?php  foreach($comments as $comment){ ?>
                                  <div class="row mt-2 pt-2 border-top">
                                    <div class="col-1">
                                      <a href="/user/<?php echo $comment->commentator->name; ?>" title="<?php echo $comment->commentator->name; ?>"><img class="d-inline"  style="display: block; width: 50px; height: 50px; object-fit: cover;" src="/images/{{  $comment->commentator->photo ? $comment->commentator->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"></a>
                                    </div>
                                    <div class="col-11 pt-1">
                                      <h6 class="mb-0"><a href="/user/<?php echo $comment->commentator->name; ?>"><?php if(!$comment->commentator->firstname){echo $comment->commentator->name;}else{ echo $comment->commentator->firstname.' '.$comment->commentator->lastname; } ?></a></strong><br>
                                      <small class="text-muted"><?php echo $comment->created_at->diffForHumans(); ?></small></h6>
                                      <span><?php echo $comment->message; ?></span>
                                    </div>
                                  </div>
                               <?php } ?>
                              <div id="post-<?php echo $timeline_post->id; ?>" style="display:none;">
                                <form action="/store/<?php echo $store->username ?>/addnewpostcomment" method="get">
                                <div class="row mt-2">
                                  <div class="col-1">
                                    <img class="d-inline"  style="display: block; width: 40px; height: 40px; object-fit: cover;" src="/images/{{ Auth::user()->photo ? Auth::user()->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}">
                                  </div>
                                    <div class="col-9">
                                      {{ Form::hidden('post_id', Crypt::encrypt($timeline_post->id)) }}
                                      <input class="form-control" type="text" name="message" value="">
                                    </div>
                                    <div class="col-1">
                                      <button type="submit" class="btn btn-primary">ตอบ</button>
                                    </div>

                                </div><!-- row -->
                              </form>
                              </div>
                            </div>
                            <?php } ?>

                          </div>
                        </div>
                      </div>

                    </div>
                    <?php } ?>
              </div>

              <div id="product" class="tab-pane">
                <div class="row">
                <?php foreach($products as $product){ ?>
                  <div class="col-6 col-md-4 col-lg-3 mt-2">
                    <a href="/product/{{$product->slug}}" style="text-decoration:none;">
                    <div class="product-card">
                        <div id="product-front">
                        	<div class="shadow"></div>
                          <div class="product-thumb">
                            @if(!empty($product->name))
                          <div class="product-thumb">
                             <img src="/images/{{$product->Product_photos[0]->name}}">
                             <?php $stock = ProductFrontendController::checkProductStock($product->id);
                              if($stock==0){ ?>
                                <div class="product-empty-label">สินค้าหมด</div>
                              <?php } ?>
                           </div>
                            @else
                             <img src="https://static.umotive.com/img/product_image_thumbnail_placeholder.png" class="img-fluid">
                            @endif
                          </div>


                          <div class="stats p-1">
                              <div class="stats-container">
                                  <p><img class="d-inline rounded-circle"  style="display: block; width: 15px; height: 15px; object-fit: cover;" src="/images/{{$product->store->photo->file}}"> {{$product->store->name}}</p>
                                  <span class="product_name">{{$product->name}}</span>
                                  <span class="product_price">
                                    @php
                                    if($product->product_type=='single'){
                                      echo $product->price.' ฿';
                                    }
                                    else{
                                         $variationlowestprice = ProductFrontendController::getVariationLowestPrice($product->id);
                                         $variationhighestprice = ProductFrontendController::getVariationHighestPrice($product->id);
                                         if($variationlowestprice!=$variationhighestprice)
                                         {
                                           echo $variationlowestprice;
                                           echo " - ";
                                           echo $variationhighestprice.' ฿';
                                         }
                                         else{
                                           echo $variationlowestprice.' ฿';
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
                <?php } ?>
                </div>
              </div>

              <div id="service" class="tab-pane">
                <div class="row">
                <?php foreach($services as $service){ ?>
                  <div class="col-6 col-md-4 col-lg-3 mt-2">
                    <a href="/service/{{$service->slug}}" style="text-decoration:none;">
                    <div class="product-card">
                        <div id="product-front">
                         <div class="shadow"></div>
                          <div class="product-thumb">
                            @if(!empty($service->name))
                            <div class="product-thumb">
                             <img src="/images/{{$service->Service_photos[0]->name}}">
                           </div>
                            @else
                             <img src="https://static.umotive.com/img/product_image_thumbnail_placeholder.png" class="img-fluid">
                            @endif
                          </div>


                          <div class="stats p-1">
                              <div class="stats-container">
                                  <p>{{$store->name}}</p>
                                  <span class="product_name">{{$service->name}}</span>
                                  <span class="product_price">เริ่มต้น {{$service->start_price}}฿</span>
                              </div>
                          </div>
                      </div>

                    </div>
                  </a>
                  </div>
                <?php } ?>
                </div>
              </div>

              <div id="review" class="tab-pane">
                <div class="row">
                <?php foreach($products as $product){ ?>
                  <div class="col-6 col-md-4 col-lg-3 mt-2">
                    <a href="/product/{{$product->slug}}" style="text-decoration:none;">
                    <div class="product-card">
                        <div id="product-front">
                         <div class="shadow"></div>
                          <div class="product-thumb">
                            @if(!empty($product->name))
                            <div class="product-thumb">
                             <img src="/images/{{$product->Product_photos[0]->name}}">
                             <?php $stock = ProductFrontendController::checkProductStock($product->id);
                              if($stock==0){ ?>
                                <div class="product-empty-label">สินค้าหมด</div>
                              <?php } ?>
                           </div>
                            @else
                             <img src="https://static.umotive.com/img/product_image_thumbnail_placeholder.png" class="img-fluid">
                            @endif
                          </div>


                          <div class="stats p-1">
                              <div class="stats-container">
                                <p><img class="d-inline rounded-circle"  style="display: block; width: 15px; height: 15px; object-fit: cover;" src="/images/{{$product->store->photo->file}}"> {{$product->store->name}}</p>
                                  <span class="product_name">{{$product->name}}</span>
                                  <span class="product_price">
                                    @php
                                    if($product->product_type=='single'){
                                      echo $product->price.'฿';
                                    }
                                    else{
                                         $variationlowestprice = ProductFrontendController::getVariationLowestPrice($product->productsId);
                                         $variationhighestprice = ProductFrontendController::getVariationHighestPrice($product->productsId);
                                         if($variationlowestprice!=$variationhighestprice){
                                           echo $variationlowestprice.'฿';
                                           echo " - ";
                                           echo $variationhighestprice.'฿';
                                         }
                                         else{
                                           echo $variationlowestprice.'฿';
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
                <?php } ?>
                </div>
              </div>


              <div id="articles" class="tab-pane">
                <div class="row">
                <?php foreach($articles as $article){ ?>
                  <div class="col-6">
                    <div class="row mb-4 pl-4 pr-4">
                     <div class="col-5">
                       <img src="/images/<?php echo $article->photo->file; ?>" class="d-inline w-100" style="display: block;  object-fit: cover;">
                     </div>
                     <div class="col-7">
                       <h5><a href="/store/<?php echo $store->username; ?>/articles/<?php echo $article->id ?>/" class="text-black"><?php echo $article->title; ?></a></h5>
                       <span>
                     <?php if (strlen($article->content) > 100)
                           {
                           $maxLength = 99;
                           $content = substr($article->content, 0, $maxLength);
                           echo $content.'...';
                         } ?><a href="/store/<?php echo $store->username; ?>/articles/<?php echo $article->id ?>/">(อ่านทั้งหมด)</a>
                       </span>
                     </div>
                     </div>
                  </div>
                <?php } ?>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
