<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title')
รายการสินค้าของร้าน {{$store->name}} - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection
<?php use \App\Http\Controllers\StoreManager\ProductsController; ?>

@section('content')

  <section id="seller-dashboard-product-main">
    <div class="container bg-white border mt-3 mb-3 pl-3 pr-3 pb-3 pt-4">
      <div class="row mb-4 pl-4 pr-4">
       <div class="col-10">
          <h2>รายการสินค้าในร้าน {{$store->name}}</h2>
       </div>
       <div class="col-2 text-right">
          <a class="btn btn-primary" href="/storemanager/store/{{$store->username}}/products/create">
            <i class="themify ti ti-plus font-weight-bold"></i> เพิ่มสินค้าใหม่
          </a>
       </div>
       </div>
       <table class="table table-hover table-responsive-lg" id="table_id">
       <thead>
         <tr>
           <th scope="col" style="width:2%">#</th>
           <th scope="col" style="width:10%"></th>
           <th scope="col" style="width:35%">ชื่อสินค้า</th>
           <th scope="col" style="width:8%">ราคา</th>
           <th scope="col" style="width:12%">ราคาพิเศษ</th>
           <th scope="col" style="width:8%">สต็อก</th>
           <th scope="col" style="width:10%">แผยแพร่</th>
           <th scope="col" style="width:15%">คำสั่ง</th>
         </tr>
       </thead>
       <tbody>
         @foreach($products as $product)
         <tr>
           <td>{{$product->productsId}}</td>
           <td>
             @if(!empty($product->productphotosName))
              <img width="80" src="/images/{{$product->productphotosName}}">
             @else
              <img src="http://placehold.it/80">
             @endif
           </td>
           <?php $has_shipping = ProductsController::IsProductAssignShippingMethod($product->productsId);  ?>
           <td>{{$product->productsName}}<br><?php if($has_shipping=="TRUE"){ ?><small class="text-success"><i class="fas fa-truck"></i> มีการจัดส่ง</small><?php }else{ ?><small class="text-secondary"><i class="fas fa-truck"></i> ยังไม่ได้ตั้งค่าการจัดส่ง</small><?php } ?> | <?php if($product->product_status_id==1 ){ ?><small class="text-warning"><i class="far fa-clock"></i> ยังไม่ได้รับการอนุมัติ</small><?php }elseif($product->product_status_id==2){ ?><small class="text-success"><i class="far fa-check-square"></i> ได้รับการอนุมัติแล้ว</small><?php } ?></td>
           <td>
             @php
             if($product->product_type=='single'){
               echo $product->price." ฿";
             }
             else{
                  $variationlowestprice = ProductsController::getVariationLowestPrice($product->productsId);
                  $variationhighestprice = ProductsController::getVariationHighestPrice($product->productsId);
                  if($variationlowestprice!=$variationhighestprice){
                    echo $variationlowestprice;
                    echo "-";
                    echo $variationhighestprice." ฿";
                  }
                  else{
                    echo $variationlowestprice." ฿";
                  }
             }
             @endphp
            </td>
            <td>
              <span id="single_product_discount_price_<?php echo $product->productsId; ?>" class="text-muted">
                <?php if($product->product_type=='single'){  ?>
                  <?php if(is_null($product->discount_price)||empty($product->discount_price)){ ?>
                    ยังไม่ได้ตั้ง
                  <?php }else{
                    echo $product->discount_price.' ฿';
                  } ?>
                  <a href="javascript:showEditSingleProductDiscountPriceForm(<?php echo $product->productsId; ?>)"><i class="themify ti ti-pencil"></i></a>

                <?php } ?>

              </span>
              <div id="single_product_discount_price_form_<?php echo $product->productsId; ?>" style="display:none;">
                <div class="form-inline">
                   <input class="form-control form-control-sm col-3" id="add-discount-price-input-product-<?php echo $product->productsId; ?>" name="status_message" type="number" value="<?php echo $product->discount_price; ?>" placeholder="ใส่ราคา.." type="text">&nbsp;<button value="<?php echo $product->productsId; ?>" class="add-discount-price-button">&nbsp;อัพเดท&nbsp;</button>
                </div>
             </div>
            </td>
           <td>
             <span class="stock"><?php echo ProductsController::checkProductStock($product->productsId);  ?> ชิ้น</span>
           </td>
           <td>
             <label class="onoff-switch">
                 <input type="checkbox" id="switch-{{$product->productsId}}" class="onoff-switch-input" name="onoff_switch" value="{{$product->productsId}}"
                 <?php
                 if($product->is_publish==1)
                 {
                   echo "checked";
                 }?>>
                 <span class="onoff-slider"></span>
             </label>

           </td>
          <td><a href="/storemanager/store/{{$store->username}}/products/{{$product->productsId}}/edit" title="แก้ไขสินค้า" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a> <a href="/storemanager/store/{{$store->username}}/products/{{$product->productsId}}/set-shipping" title="ตั้งค่าการจัดส่ง" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-truck"></i></a> <a href="/product/{{$product->slug}}" title="ดูสินค้า" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-eye"></i></a></td>
         </tr>
         @endforeach

       </tbody>
     </table>

    </div>
   </section>

@endsection
