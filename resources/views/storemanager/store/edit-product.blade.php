<!-- Stored in resources/views/child.blade.php -->
<?php include_once(app_path().'/includes/class.fileuploader.php'); ?>
@extends('layouts.backend')

@section('title')
แก้ไข {{$product->name}} - DECORIQ
@endsection


@section('sidebar')
    @parent

@endsection
<?php use \App\Http\Controllers\StoreManager\ProductsController; ?>

@section('content')
  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5 mb-3">
       <div class="mb-4"><a href="/storemanager/store/{{$store->username}}/products"><i class="fas fa-reply"></i> กลับไปหน้ารายการสินค้า</a></div>
       <h2>แก้ไข {{$product->name}}</h2><br>

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

       {!! Form::model($product,['method'=>'PATCH', 'action'=>['StoreManager\ProductsController@update',$store->username,$product->id],'files'=>true,'id'=>'editproductform','novalidate']) !!}
       <div class="form-group">
         <label for="product name">ชื่อสินค้า</label>
         {!! Form::text('name',null,['class'=>'form-control']) !!}
       </div>
       <div class="form-group mb-4 mt-4">
         <label for="product name">รูปภาพสินค้า <span class="text-muted">(*รูปภาพแรกจะเป็นหน้าปกสินค้า)</span></label><br>
         <?php
          // define uploads path
          $public_path = public_path();
          $uploadDir = $public_path.'/images/';
				  // create an empty array
          // we will add to this array the files from directory below
          // here you can also add files from MySQL database
   				// add files to our array with
	  			// made to use the correct structure of a file

      		foreach($product_photos as $product_photo) {
					// add file to our array
					$preloadedFiles[] = array(
						"name" => $product_photo->name,
						"type" => 'image/*',
						"size" => filesize($uploadDir . $product_photo->name),
						"file" => url('images/') .'/'. $product_photo->name,
						"data" => array(
							"url" => url('images/').'/'. $product_photo->name,
              "thumbnail" => $uploadDir. $product_photo->name ? url('images/').'/'.  $product_photo->name : null,
						 ),);
				     }
    				// convert our array into json string
            if(!empty($preloadedFiles)){
    				      $preloadedFiles = json_encode($preloadedFiles);
            }
            else{
              $preloadedFiles = '';
            }

            ?>
          <input type="file" name="productfile" data-fileuploader-files='<?php echo $preloadedFiles;?>'>

          <input type="hidden" name="product_id" value="{{$product->id}}" id="product_id">
          <input type="hidden" name="store_id" value="{{$store->id}}">
          <input type="hidden" name="product_status_id" value="1">

        </div>
        <div class="form-group">
          <label for="short-description">รายละเอียดโดยย่อ</label>
          {!! Form::textarea('short_description',null,['class'=>'form-control','rows'=>'2']) !!}
        </div>
        <div class="form-group">
            <label for="product-long-description">รายละเอียดทั้งหมด</label>
            {!! Form::textarea('long_description',null,['class'=>'form-control','id'=>'summernote']) !!}
        </div>

        <div class="form-group mb-5">
            <div class="row">
              <div class="col-sm-4">
                {!! Form::label('category_id','หมวดหมู่:')!!}
                {!! Form::select('parent_category_id', $parent_categories, null, ['class'=>'form-control','id'=>'parentcategories']) !!}

              </div>
              <div class="col-sm-4">
                {!! Form::label('subcategory_id','หมวดหมู่ย่อย:')!!}
                {!! Form::select('category_id', $all_categories, null, ['class'=>'form-control','id'=>'subcategories']) !!}

              </div>
              <div class="col-sm-4">
                <label for="SKU">SKU รหัสสินค้าของร้าน (ถ้ามี)</label>
                {!! Form::text('sku',null,['class'=>'form-control']) !!}
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



          <hr>

          <div class="form-group mt-5">
          <ul  class="nav nav-pills" id="producttypetab">
              <li class="pr-3 pt-1">ชนิดสินค้า</li>
              <li>
                <a class="btn btn-secondary" id="singletab" class="text-black" href="#single-product" style="border-radius : 0;" data-toggle="tab">
                 รูปแบบเดียว
                </a>
              </li>
              <li>
                <a class="btn btn-secondary" id="variabletab" class="text-black" href="#variable-product" style="border-radius : 0;" data-toggle="tab">
                 หลายรูปแบบ
                </a>
              </li>
               {!! Form::hidden('product_type',null,['id'=>'producttype']) !!}
            </ul>
            <div class="tab-content clearfix p-4 border mb-4">
                  <div class="tab-pane" id="single-product">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label>ราคา</label>
                            {!! Form::text('price',null,['class'=>'form-control','required' => 'required']) !!}
                          </div>
                          <div class="col-sm-4">
                            <label>น้ำหนัก (kg)</label>
                            {!! Form::text('weight',null,['class'=>'form-control','required' => 'required']) !!}
                          </div>
                          <div class="col-sm-4">
                            <label>จำนวนในสต็อก</label>
                            {!! Form::text('stock',null,['class'=>'form-control','required' => 'required']) !!}
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane" id="variable-product">
                    <div class="form-group">

                      <?php if(count($product_variations)==NULL){ ?>
                        <?php $variable_array_count = 1;  ?>
                          <div class="row mb-2 mt-3 variation-row border-bottom">
                            <div class="col-sm-2">
                              <label for="product"><label><input type="file" onchange="readURL(this,1);" style="display:none" name="file[]" /><img id="image-preview-1" src="/images/product-variation-placeholder.png" class="img-fluid" src="" alt="your image" /></label></label>
                            </div>
                            <div class="col-sm-3">
                                <label>รูปแบบที่ #1</label><input type="text" name="variationname[]" class="form-control" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                <label>ราคา</label><input type="text" name="variationprice[]" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label>น้ำหนัก(kg)</label><input name="variationweight[]" type="text" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label>จำนวนในสต็อก</label><input name="variationstock[]" type="text" class="form-control">
                            </div>
                          </div>
                        <div id="VariableBoxContainer"></div>
                     <?php
                       }
                       else{ ?>


                         <div id="VariableBoxContainer">
                         <?php $variable_array_count = count($product_variations);  ?>
                         <?php $j = 1 ?>
                         @foreach($product_variations as $product_variation)
                           <div class="row mb-2 mt-3 variation-row border-bottom">
                             <input type="hidden" name="variationid[]" value="<?php echo $product_variation->id ?>">
                             <div class="col-sm-2">
                                 <?php $product_variation_photo = ProductsController::getVariationPhoto($product_variation->photo_id) ?>
                                 <label for="product"><label><input type="file" onchange="readURL(this,<?php echo $j ?>);" style="display:none" name="file[]" /><img id="image-preview-<?php echo $j ?>" class="img-fluid" src="/images/<?php  if(empty($product_variation_photo)){ echo 'product-variation-placeholder.png';} else { echo $product_variation_photo;} ?>" /></label></label>
                             </div>
                             <div class="col-sm-3">
                                 <label>รูปแบบที่ #<?php echo $j ?></label><input type="text" name="variationname[]" class="form-control" placeholder="" value="{{$product_variation->name}}" required>
                             </div>
                             <div class="col-sm-2">
                                 <label>ราคา</label><input type="text" name="variationprice[]" value="{{$product_variation->price}}" class="form-control" required>
                             </div>
                             <div class="col-sm-2">
                                 <label>น้ำหนัก(kg)</label><input name="variationweight[]" type="text" class="form-control" value="{{$product_variation->weight}}" required>
                             </div>
                             <div class="col-sm-2">
                                 <label>จำนวนในสต็อก</label><input name="variationstock[]" type="text" class="form-control" value="{{$product_variation->stock}}" required>
                             </div>
                             @if(($j==$variable_array_count) && ($variable_array_count!=1))
                             <div class="col-sm-1">
                                 <label>&nbsp;</label><br><div class="startremove"><button type="button" class="btn btn-danger remove">x</button></div>
                             </div>
                             @else
                             <div class="col-sm-1">
                                 <label>&nbsp;</label><br><div class="startremove"></div>
                             </div>
                             @endif
                             </div>
                             <?php $j++;  ?>
                          @endforeach
                        </div>

                       <?php } ?>
                     <button  id="btnAdd" type="button" class="btn btn-sm btn-secondary mt-2" data-toggle="tooltip"><i class="themify ti ti-plus"></i>&nbsp; เพิ่มรูปแบบสินค้า&nbsp;</button>




                   </div>
            </div>
          </div>

 </div>
            <button type="submit" class="btn btn-primary btn-lg col-12" name="submit">แก้ไขข้อมูลสินค้า</button>
      </form>

 </div>
   </section>






@endsection
