<!-- Stored in resources/views/child.blade.php -->
<?php include_once(app_path().'/includes/class.fileuploader.php'); ?>
@extends('layouts.backend')

@section('title')
ตั้งค่าการจัดส่งสำหรับ {{$product->name}} - DECORIQ
@endsection


@section('sidebar')
    @parent

@endsection
<?php use \App\Http\Controllers\StoreManager\ProductsController; ?>

@section('content')
  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5 mb-3">
       <div class="mb-4"><a href="/storemanager/store/{{$store->username}}/products"><i class="fas fa-reply"></i> กลับไปหน้ารายการสินค้า</a></div>
       <h5><i class="fas fa-truck"></i> <i class="fas fa-arrow-left text-gray"></i> <img class="rounded-circle d-inline" style="display: block; width: 36px; height: 36px; object-fit: cover;" src="/images/<?php echo $product_photos[0]->name; ?>"> ตั้งค่าการจัดส่งสำหรับ {{$product->name}}</h5><br>

         @if(Session::has('edit_successful'))
          <div class="alert alert-success pb-0" role="edit successful alert">
            <p>{{session('edit_successful')}}</p>
          </div>
         @endif
         @if(count($errors)>0)
         <div class="alert alert-danger pt-3 pb-1 mt-3" role="alert">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
         @endif

       {!! Form::model($product,['method'=>'PATCH', 'action'=>['StoreManager\ProductsController@updateProductShipping',$store->username,$product->id],'files'=>true,'id'=>'editproductshippingform']) !!}


    <div class="container">
      <div class="row">
        <h5>การจัดส่งสำหรับสินค้าชิ้นนี้</h5>
      </div>
      <div class="row border">
        <div class="col-sm-2 p-3">

        </div>
        <div class="col-sm-3 p-3">
          ชื่อการจัดส่ง
        </div>
        <div class="col-sm-6 p-3">
          รายละเอียด
        </div>
        <div class="col-sm-1 p-3">
          เปิดใช้
        </div>
      </div>
    <?php if(!$shippings->isEmpty()){ ?>
      @foreach($shippings as $shipping)
      <div class="row border">
        <div class="col-sm-2 p-3">
          @if(is_null($shipping->file)) <img class="card-img-top img-fluid" height="250" src="/images/no-shipping-image.png"> @else <img class="card-img-top img-fluid" height="250" src="/images/{{$shipping->file}}" alt="{{$shipping->name}}" > @endif
        </div>
        <div class="col-sm-3 p-3">
            <span class="font-weight-bold">{{$shipping->name}}</span><br>
            ราคา: <?php
               if($shipping->type=='flat'){
                 echo $shipping->cost.' บาท';
               }
               elseif($shipping->type=='weight'){

                 $shipping_weightbase_lists = ProductsController::getShippingWeightBaseList($shipping->id);
                foreach ($shipping_weightbase_lists as $shipping_weightbase_list) {
                  echo "<br>".$shipping_weightbase_list->minweight." - ".$shipping_weightbase_list->maxweight." kg ราคา ".$shipping_weightbase_list->cost." บาท";
                }
               }
               else{
                 echo 'ส่งฟรี';
               }
             ?>
            <br><span class="text-muted">รูปแบบ :  <?php
               if($shipping->type=='flat'){
                 echo "ราคาเดียว";
               }
               elseif($shipping->type=='weight'){
                 echo "ราคาตามน้ำหนัก";
               }
               else{
                 echo "จัดส่งฟรี";
               }
             ?></span>
        </div>
        <div class="col-sm-6 p-3">
          {{$shipping->description}}
        </div>
        <div class="col-sm-1 ">
          <label class="product-shippings-switch">
              <input type="checkbox" name="shippings_switch[]" value="{{$shipping->shippingsId}}"
              <?php
              $new_product_shippings_array = array();
              for($i=0;$i<count($product_shippings);$i++){
                $new_product_shippings_array[$i] = $product_shippings[$i]->shipping_id;
              }
              if(in_array($shipping->shippingsId,$new_product_shippings_array))
              {
                echo "checked";
              }?>>
              <span class="product-shippings-slider"></span>
          </label>
        </div>
      </div>
      @endforeach
      <?php }else{  ?>
          <div class="row">
            <a href="/storemanager/store/<?php echo $store->username; ?>/shippings" class="col-12 text-center p-5 border">
              <div class="text-center">
                <i class="fas fa-plus"></i> ร้านของคุณจำเป็นต้องเพิ่มการจัดส่งก่อน
              </div>
            </a>
          </div>

      <?php } ?>


      </div>
    <div class="container pl-0 pr-0">
      <button type="submit" class="btn btn-primary btn-lg col-12 mt-4" name="submit">บันทึกการจัดส่งสำหรับสินค้านี้</button>
    </div>


      </form>

    </div>
   </section>






@endsection
