<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title')
เพิ่มสินค้าใหม่ - DECORIQ
@endsection


@section('sidebar')
    @parent
@endsection

@section('content')
<?php use \App\Http\Controllers\StoreManager\ProductsController; ?>
  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5">
       <h2>เพิ่มสินค้าใหม่</h2>
       {{Form::open(['method'=>'POST', 'action'=>array('StoreManager\ProductsController@store',$store->username),'files'=>true,'id'=>'createproductform'])}}
       <div class="form-group">
         @if(count($errors)>0)
         <div class="alert alert-danger pt-3 pb-1 mt-3" role="alert">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
         @endif

         <label for="product name">ชื่อสินค้า</label>
         <input type="text" name="name" class="form-control" id="producttitle" value="{{ old('name') }}" required>
       </div>
       <div class="form-group mb-4 mt-4">
         <label for="product name">รูปภาพสินค้า <span class="text-muted">(*รูปภาพแรกจะเป็นหน้าปกสินค้า)</span></label>
          <input type="file" name="productfile" class="mb-5" required>
          {{ Form::hidden('store_id', Crypt::encrypt($store->id)) }}
          <input type="hidden" name="product_status_id" value="1">
        </div>
        <div class="form-group">
          <label for="short-description">รายละเอียดโดยย่อ</label>
          <textarea class="form-control" name="short_description" id="short-description" rows="2" required>{{ old('short_description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">รายละเอียดทั้งหมด</label>
            <textarea name="long_description" id="summernote" required>{{ old('long_description') }}</textarea>
        </div>

        <div class="form-group mb-5">
            <div class="row">
              <div class="col-sm-4">
                {!! Form::label('category_id','หมวดหมู่:')!!}
                {!! Form::select('parent_category_id', [''=>'เลือกหมวดหมู่']+$categories, null, ['class'=>'form-control','id'=>'parentcategories']) !!}
              </div>
              <div class="col-sm-4">
                {!! Form::label('subcategory_id','หมวดหมู่ย่อย:')!!}
                {!! Form::select('category_id', [''=>'เลือกหมวดหมู่ย่อย'], null, ['class'=>'form-control']) !!}
              </div>
              <div class="col-sm-4">
                <label for="SKU">SKU รหัสสินค้าของร้าน (ถ้ามี)</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <h4>การจัดส่งสำหรับสินค้าชิ้นนี้</h4>
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
                    <input type="checkbox" name="shippings_switch[]" value="{{$shipping->shippingsId}}">
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

          <hr>

          <div class="form-group mt-5">
          <ul  class="nav nav-pills" id="producttypetab">
              <li class="pr-3 pt-1">ชนิดสินค้า</li>
              <li>
                <a class="btn btn-secondary active" id="single-product-pill" class="text-black" href="#single-product" style="border-radius : 0;" data-toggle="tab">
                 รูปแบบเดียว
                </a>
              </li>
              <li>
                <a class="btn btn-secondary" id="variable-product-pill" class="text-black" href="#variable-product" style="border-radius : 0;" data-toggle="tab">
                 หลายรูปแบบ
                </a>
              </li>
              <input type="hidden" name="product_type" id="producttype" value="<?php if(!empty(old('product_type'))){ echo old('product_type');}else{echo "single";}  ?>">
            </ul>
            <div class="tab-content clearfix p-4 border">
                  <div class="tab-pane active" id="single-product">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label>ราคา</label>
                            <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                          </div>
                          <div class="col-sm-4">
                            <label>น้ำหนัก (kg)</label>
                            <input type="text" name="weight" class="form-control" value="{{ old('weight') }}" >
                          </div>
                          <div class="col-sm-4">
                            <label>จำนวนในสต็อก</label>
                            <input type="text" name="stock" class="form-control" value="{{ old('stock') }}">
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane" id="variable-product">
                    <div class="form-group">
                      <div class="row mb-2 mt-3 variation-row border-bottom">
                        <div class="col-sm-2">
                          <label for="product"><label><input type="file" onchange="readURL(this,1);" style="display:none" name="file[]" /><img id="image-preview-1" class="img-fluid" src="/images/product-variation-placeholder.png" alt="your image" /></label>
                        </div>
                        <div class="col-sm-3">
                        <label>รูปแบบ #1</label><input type="text" name="variationname[]" class="form-control" placeholder=""></div><div class="col-sm-2"><label>ราคา</label><input type="text" name="variationprice[]" class="form-control"></div><div class="col-sm-2"><label>น้ำหนัก(kg)</label><input name="variationweight[]" type="text" class="form-control"></div>
                        <div class="col-sm-2"><label>จำนวนในสต็อก</label><input name="variationstock[]" type="text" class="form-control"></div></div>
                     <div id="VariableBoxContainer"></div>

                     <button  id="btnAdd" type="button" class="btn btn-sm btn-secondary mt-2" data-toggle="tooltip"><i class="themify ti ti-plus"></i>&nbsp; เพิ่มรูปแบบสินค้า&nbsp;</button>
                    </div>
                 </div>
             </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg col-12" name="submit">เพิ่มสินค้า</button>
      </form>

     </div>



   </section>






@endsection
