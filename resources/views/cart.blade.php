@extends('layouts.frontend')

@section('title')
ตะกร้าสินค้า - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\CartController; ?>

<div class="container mt-4">
  <div class="row">
    <div class="col">
        <h3><i class="themify ti ti-shopping-cart" ></i> ตะกร้าสินค้า</h3>
    </div>
  </div>
</div>

<?php if(Session::get('empty-cart')!==NULL){ ?>
<div class="container mt-2">
  <div class="row">
    <div class="col">
      <div class="alert alert-warning">
        {{ Session::get('empty-cart') }}
      </div>
    </div>
  </div>
</div>
<?php } ?>

<div class="container">
  <div class="row">
    <div class="col-md-12 mb-3">
  <div class="pt-4 pb-4 pr-5 pl-5 bg-light border" style="background:url('/images/cart-address-bg.png') no-repeat right;">
    <h5 class="w-100"  class="d-inline"><i class="fa fa-truck"></i> สถานที่รับสินค้า</h5>
      @guest
        <span class="d-inline text-muted">เพิ่มสถานที่รับสินค้าเพื่อแสดงค่าจัดส่ง หรือ<a href="/login">เข้าสู่ระบบ</a> เพื่อจัดการสถานที่รับสินค้าของคุณ</span>
      @endguest
    <div class="table-responsive">
        @guest
        <div class="col">
        <div id="guestaddress">
          <div class="row">
              <div class="shipping-address">
                  <div class="shipping-address-success">
                     <input type="radio" name="address" checked />
                     <label for="radio" class="pl-5 pr-1 pt-1 pb-1 mt-1 bg-white">
                       <strong>ชื่อผู้รับ :</strong>&nbsp;&nbsp;
                       <span class="firstname"><?php echo Session::get('shipping_address.firstname'); ?></span> <span class="lastname"><?php echo Session::get('shipping_address.lastname'); ?></span>,&nbsp;
                       <strong>ที่อยู่ :</strong>&nbsp;&nbsp;<span class="address1"><?php echo Session::get('shipping_address.address1'); ?></span>&nbsp;
                       <span class="address2"><?php echo Session::get('shipping_address.address2'); ?></span>,&nbsp;
                       <input type="hidden" class="thai-city-id" value="<?php echo Session::get('shipping_address.thai_city_id'); ?>">
                       <span class="thai-city"><?php echo Session::get('shipping_address.thai_city'); ?></span> <span class="postal-code"><?php echo Session::get('shipping_address.postal_code'); ?></span>
                       <strong>เบอร์โทร :</strong>&nbsp;&nbsp;<span class="tel_number"><?php echo Session::get('shipping_address.tel_number'); ?></span>
                     </label>
                </div>
              </div>
          </div>
          </div>
        </div>
      <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#AddShippingModal">เปลี่ยนสถานที่รับสินค้า</button>
        @endguest
        @auth
        <div class="col">
          <div class="row">
              <div class="shipping-address">

                <?php $addresses = CartController::getloggedincustomeraddresses(Auth::id());
                    $i = 1;
                   foreach($addresses as $address){
                ?>
                    <div class="shipping-address-success">
                         <input type="radio" name="address" value="<?php echo $i; ?>" id="radio-<?php echo $i; ?>" checked />
                         <label for="radio-<?php echo $i; ?>" class="pl-5 pr-1 pt-1 pb-1 mt-1 bg-white">
                           <strong>ที่อยู่ <span class="address-no"><?php echo $i; ?> : </span></strong>
                           <span class="firstname"><?php echo $address->firstname; ?></span> <span class="lastname"><?php echo $address->lastname; ?></span>,&nbsp;
                           <span class="address1"><?php echo $address->address1; ?></span>&nbsp;
                           <span class="address2"><?php echo $address->address2; ?></span>,&nbsp;
                           <input type="hidden" class="thai-city-id" value="<?php echo $address->thai_city_id; ?>">
                           <span class="thai-city"><?php echo $address->thai_city; ?></span> <span class="postal-code"><?php echo $address->postal_code; ?></span>
                           <strong>เบอร์โทร :</strong>&nbsp;&nbsp;<span class="tel_number"><?php echo $address->tel_number; ?></span>
                           &nbsp;&nbsp;<a data-toggle="modal" data-address-id="<?php echo Crypt::encrypt($address->id); ?>" data-firstname="<?php echo $address->firstname; ?>" data-lastname="<?php echo $address->lastname; ?>" data-address1="<?php echo $address->address1; ?>" data-address2="<?php echo $address->address2; ?>" data-postal_code="<?php echo $address->postal_code; ?>" data-thai_city_id="<?php echo $address->thai_city_id; ?>" data-tel_number="<?php echo $address->tel_number; ?>" class="openeditshippingmodal" href="#EditShippingModal">[แก้ไข]</a>&nbsp;<a class="text-red" href="javascript:deleteAddress(<?php echo $i; ?>,<?php echo $address->id; ?>);">[ลบ]</a>
                         </label>
                    </div>
                <?php
                  $i++;
                   }
                 ?>

              </div>
          </div>
        </div>
      <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#AddShippingModal"><i class="fas fa-plus"></i> เพิ่มที่อยู่ในการรับสินค้า</button>
          @endauth
  </div>
</div>
</div>
</div>
</div>

<div class="container">
  <div class="row mb-4">
    <div class="col-md-8">
      <div class="mt-2 mb-3">
     <?php $product_id_array = array(); ?>
      @if(Session::has('cart'))
        <?php
        /* arrange product by shop */
         $store_id=0;
         $newkey=0;
         $arrproducts[$store_id]="";
         foreach ($products as $product) {

                if ($store_id==$product['store_id']){
                  $arrproducts[$store_id][$product['id']]=$product;
                } else {
                  $arrproducts[$product['store_id']][$product['id']]=$product;
                }
             }
             arsort($arrproducts);
             unset($arrproducts[0]);


         foreach($arrproducts as $k1 => $inner) {
           $store = CartController::getStorebyid($k1);
          ?>
          <div class="p-2 mb-2 border store-cart">
            <label class="checkbox-inline">
              {!! Form::token() !!}
                <input type="radio" value="{{$store->id}}" name="store_id" class="mr-2 store_id" data-smth="parent_{{$store->id}}" required>
                <img class="rounded-circle d-inline" width="22" src="/images/{{$store->file}}">
                {{$store->name}}
          </label>
          <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" width="5%"></th>
                <th scope="col" width="57%">รายการสินค้า</th>
                <th scope="col" width="10%">ราคา</th>
                <th scope="col" width="13%">จำนวน</th>
                <th scope="col" width="10%">รวม</th>
              </tr>
            </thead>
            <tbody>

           <span class="storeproductlistcount-{{$store->id}} d-none">{{count($arrproducts[$k1])}}<span>
          <?php
             $storesubtotalprice = 0;
             foreach($inner as $k2 => $value) {
               array_push($product_id_array,$arrproducts[$k1][$k2]['id']);
               $product_id = $k2;
               ?>

               <tr>
                 <?php if($arrproducts[$k1][$k2]['type']=="single"){ ?>
                   <td><a href="/product/<?php echo CartController::getProductDetail($product_id)[0]->slug; ?>"><img width="64" height="64" src="<?php echo "/images/".CartController::getFirstProductPhoto($product_id); ?>"></a></td>
                   <td><a href="/product/<?php echo CartController::getProductDetail($product_id)[0]->slug; ?>"><?php echo CartController::getProductDetail($product_id)[0]->name; ?></a><span class="text-muted"> (#{{ $arrproducts[$k1][$k2]['id'] }})</span><br>
                     <?php // $shippings = CartController::getProductShippingMethod($arrproducts[$k1][$k2]['id']);  ?>
                     <div class="shipping-container">
                       <small style="font-weight:bold;">เลือกการจัดส่ง:  </small>
                        <div class="radio-tile-group shipping-list shipping-list-<?php echo $product_id; ?>">
                          <p style="margin-bottom:1px !important; margin-left:5px !important;"><small>กรุณาเพิ่ม/เลือกที่อยู่เพื่อแสดงการจัดส่ง</small></p>
                        </div>
                      </div>
                   </td>
                 <?php } else {  ?>
                   <td><a href="/product/<?php echo CartController::getProductDetail(explode('-', $product_id)[0])[0]->slug; ?>"><img width="64" height="64" src="<?php echo "/images/".CartController::getVariationPhoto(explode("-",$arrproducts[$k1][$k2]['id'])[1]); ?>"></a></td>
                   <td><a href="/product/<?php echo CartController::getProductDetail(explode('-', $product_id)[0])[0]->slug; ?>"><?php echo CartController::getProductDetail($product_id)[0]->name; ?><?php echo " - ".CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->name; ?></a><span class="text-muted"> (#{{ $arrproducts[$k1][$k2]['id'] }})</span><br>
                     <?php // $shippings = CartController::getProductShippingMethod($arrproducts[$k1][$k2]['id']);   ?>
                     <div class="shipping-container">
                       <small style="font-weight:bold;">เลือกการจัดส่ง:  </small>
                        <div class="radio-tile-group shipping-list shipping-list-<?php echo $arrproducts[$k1][$k2]['id']; ?>">
                          <p style="margin-bottom:1px !important; margin-left:5px !important;"><small>กรุณาเพิ่ม/เลือกที่อยู่เพื่อแสดงการจัดส่ง</small></p>
                        </div>
                      </div>
                   </td>
                 <?php } ?>


                 <td class="product-price">
                   <?php if($arrproducts[$k1][$k2]['type']=="single"){
                     if(is_null(CartController::getProductDetail(explode('-', $product_id)[0])[0]->discount_price)||CartController::getProductDetail(explode('-', $product_id)[0])[0]->discount_price<=0){
                        echo "<span>".CartController::getProductDetail(explode('-', $product_id)[0])[0]->price."</span> ฿";
                     }else{
                       echo "<small><del>".CartController::getProductDetail(explode('-', $product_id)[0])[0]->price." ฿</del></small> <span>".CartController::getProductDetail(explode('-', $product_id)[0])[0]->discount_price."</span> ฿";
                     }
                   }else{
                     if(is_null(CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->discount_price)||CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->discount_price<=0){
                       echo "<span>".CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->price.'</span> ฿';
                     }else{
                       echo "<small><del>".CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->price." ฿</del></small> <span>".CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->discount_price."</span> ฿";
                     }
                   } ?>
                 </td>

                 <td class="amount">
                   <span class="input-number-decrement" data-parent="parent_{{$store->id}}" id="increment-decrement-of-<?php echo $product_id; ?>" >–</span><input class="input-number" onkeypress="return isNumber(event)" type="text" data-parent="parent_{{$store->id}}" value="{{ old('amount-'.$product_id, $arrproducts[$k1][$k2]['qty']) }}" min="1" max="100" id="amount-<?php echo $product_id; ?>" name="amount-<?php echo $product_id; ?>"><span class="input-number-increment" data-parent="parent_{{$store->id}}" id="increment-decrement-of-<?php echo $product_id; ?>" >+</span>
                 </td>

                 <td class="product-cart-price product-subtotal-of-store-{{$store->id}}" data-parent="parent_{{$store->id}}" id="cart-price-of-<?php echo $product_id; ?>">
                  <?php if($arrproducts[$k1][$k2]['type']=="single"){
                      if(is_null(CartController::getProductDetail(explode('-', $product_id)[0])[0]->discount_price)||CartController::getProductDetail(explode('-', $product_id)[0])[0]->discount_price<=0){
                        echo (int)CartController::getProductDetail(explode('-', $product_id)[0])[0]->price*(int)$arrproducts[$k1][$k2]['qty'];
                      }else{
                        echo (int)CartController::getProductDetail(explode('-', $product_id)[0])[0]->discount_price*(int)$arrproducts[$k1][$k2]['qty'];
                      }
                    }else{
                      if(is_null(CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->discount_price)||CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->discount_price<=0){
                        echo (int)CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->price*(int)$arrproducts[$k1][$k2]['qty'];
                      }else{
                        echo (int)CartController::getProductVariationDetail(explode("-",$arrproducts[$k1][$k2]['id'])[0],explode("-",$arrproducts[$k1][$k2]['id'])[1])[0]->discount_price*(int)$arrproducts[$k1][$k2]['qty'];
                      }

                    } ?> ฿</td>

                 <td class="amount"><a href="{{ route('cart.removeFromCart',['id'=> $arrproducts[$k1][$k2]['id']]) }}" onClick="alert('สินค้าได้ถูกลบเรียบร้อยแล้ว')" class="text-red">x</a></td>
               </tr>
               <tr>
               </tr>
            <?php
             }
             ?>
             <span class="storesubtotalprice-{{$store->id}} d-none"><?php echo $storesubtotalprice; ?></span>
             </tbody>
           </table>
         </div>
       </div>

          <?php
        }

         ?>
         @else

         <div class="p-3 mb-2 border">
          <h5><i class="far fa-frown"></i> ไม่มีสินค้าในตะกร้า</h5>
         </div>

         @endif
      </div>

    </div>

    <div class="col-md-4">

       <div class="border p-3 mt-2 bg-gray">
         <h4 class="w-100">รายละเอียดตะกร้าสินค้า</h4>
         <div class="table-responsive">
         <table class="table mb-0">
             <tr class="border-bottom">
               <td class="pt-2 pb-2">ยอดรวมสินค้า</td>

               <td class="pt-2 pb-2 pr-0 white-space-nowrap text-right">
                 @if(Session::has('cart'))
                 <span id="subtotal">0</span> ฿
                 @else
                 0 ฿
                 @endif
               </td>
             </tr>
             <tr class="pb-4">
               <td class="pb-0 font-weight-bold">ค่าจัดส่ง</td>
               <table class="table mb-0" id="shippingdetailtable"></table>
             </tr>
           </table>
           <table class="table">
             <tr class="border-bottom font-weight-bold">
               <td>ยอดรวมทั้งหมด</td>
               <td class="padding-right-0 white-space-nowrap text-right">
                 @if(Session::has('cart'))
                 <span id="total">0</span> ฿
                 @else
                 0 ฿
                 @endif
               </td>
             </tr>
           </table>
         <button type="button" name="button" class="btn btn-success btn-block" id="checkout-button"><i class="fas fa-money-check-alt"></i> ไปหน้าชำระเงิน</button>
       </div>
     </div>
    </div>
  </div>
</div>

<!-- AddShipping Modal -->
<div class="modal fade" id="AddShippingModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มการจัดส่งใหม่</h5>&nbsp;@guest<p class="text-muted">(จัดการที่อยู่ โดยการ<a href="/login">เข้าสู่ระบบ</a>ที่นี่)</p>@endguest
      </div>
      <div class="modal-body">

        @guest
        {{ Form::open(['method'=>'GET','id'=>'addaddressform','action'=>'CartController@setguestaddresssession']) }}
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="Shipping method name">ชื่อ</label>
              <input type="text" class="form-control" id="ShippingAddressFirstname" name="firstname" value="<?php echo session('shipping_address.firstname'); ?>" required>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="Shipping method name">นามสกุล</label>
              <input type="text" class="form-control" id="ShippingAddressLastname" name="lastname" value="<?php echo session('shipping_address.lastname'); ?>" required>
            </div>
          </div>
        </div>
         <div class="form-group">
           <label for="Shipping type">ที่อยู่</label>
           <input type="text" class="form-control" id="ShippingAddressAddress1" name="address1" value="<?php echo session('shipping_address.address1'); ?>" required>
         </div>
         <div class="form-group">
           <input type="text" class="form-control" id="ShippingAddressAddress2" name="address2" value="<?php echo session('shipping_address.address2'); ?>">
         </div>

         <div class="row">
           <div class="col-4">
             <div class="form-group">
               <label for="Shipping method name">รหัสไปรษณีย์</label>
               <input type="text" class="form-control" id="ShippingAddressPostalcode" name="postal_code" pattern="\d*" maxlength="5" required>
             </div>
           </div>
           <div class="col-8">
             <div class="form-group">
               <label for="Shipping method name">ตำบล(แขวง), อำเภอ(เขต), จังหวัด</label>
               <select class="form-control" name="thai_city_id" id="thai_city" required>
               </select>
             </div>
           </div>
         </div>

         <div class="row">
           <div class="col-12">
             <div class="form-group">
               <label for="Telephone number">เบอร์โทรศัพท์</label>
               <input type="text" class="form-control" name="tel_number" value="<?php echo session('shipping_address.tel_number'); ?>">
             </div>
           </div>
         </div>
        @endguest

        @auth
        {{ Form::open(['method'=>'GET','id'=>'addaddressform','action'=>'CartController@addnewloggedincustomeraddresses']) }}
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="Shipping method name">ชื่อ</label>
              <input type="text" class="form-control" id="ShippingAddressFirstname" name="firstname"  required>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="Shipping method name">นามสกุล</label>
              <input type="text" class="form-control" id="ShippingAddressLastname" name="lastname" required>
            </div>
          </div>
        </div>
         <div class="form-group">
           <label for="Shipping type">ที่อยู่</label>
           <input type="text" class="form-control" id="ShippingAddressAddress1" name="address1" required>
         </div>
         <div class="form-group">
           <input type="text" class="form-control" id="ShippingAddressAddress2" name="address2">
         </div>

         <div class="row">
           <div class="col-4">
             <div class="form-group">
               <label for="Shipping method name">รหัสไปรษณีย์</label>
               <input type="text" class="form-control" id="ShippingAddressPostalcode" name="postal_code" pattern="\d*" maxlength="5" required>
             </div>
           </div>
           <div class="col-8">
             <div class="form-group">
               <label for="Shipping method name">ตำบล(แขวง), อำเภอ(เขต), จังหวัด</label>
               <select class="form-control" name="thai_city_id" id="thai_city" required>
               </select>
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-12">
             <div class="form-group">
               <label for="Telephone number">เบอร์โทรศัพท์</label>
               <input type="text" class="form-control" name="tel_number">
             </div>
           </div>
         </div>
        @endauth

      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-block btn-primary" id="addaddressbutton" form="addaddressform">เพิ่มที่อยู่</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!-- End AddShipping Modal -->


<!-- EditShipping Modal -->
<div class="modal fade" id="EditShippingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขที่อยู่จัดส่ง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        @guest
        {{ Form::open(['method'=>'GET','id'=>'editaddressform','action'=>'CartController@setguestaddresssession']) }}
        @endguest
        @auth
        {{ Form::open(['method'=>'GET','id'=>'editaddressform','action'=>'CartController@editcustomeraddresses']) }}
        @endauth
         <div class="row">
           <div class="col-6">
             <div class="form-group">
               <label for="Shipping method name">ชื่อ</label>
               <input type="hidden" class="form-control" id="ShippingAddressAddressIdEdit" name="id">
               <input type="text" class="form-control" id="ShippingAddressFirstnameEdit" name="firstname">
             </div>
           </div>
           <div class="col-6">
             <div class="form-group">
               <label for="Shipping method name">นามสกุล</label>
               <input type="text" class="form-control" id="ShippingAddressLastnameEdit" name="lastname">
             </div>
           </div>
         </div>
          <div class="form-group">
            <label for="Shipping type">ที่อยู่</label>
            <input type="text" class="form-control" id="ShippingAddressAddress1Edit" name="address1" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="ShippingAddressAddress2Edit" name="address2">
          </div>

          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="Shipping method name">รหัสไปรษณีย์</label>
                <input type="text" class="form-control" id="ShippingAddressPostalcodeEdit" name="postal_code" pattern="\d*" maxlength="5" required>
              </div>
            </div>
            <div class="col-8">
              <div class="form-group">
                <label for="Shipping method name">ตำบล(แขวง), อำเภอ(เขต), จังหวัด</label>
                <select class="form-control" name="thai_city_idEdit" id="thai_cityEdit" required>
                </select>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="Telephone number">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" id="ShippingAddressTelNumberEdit" name="tel_number">
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-block btn-primary" id="editaddressbutton" form="editaddressform">แก้ไขที่อยู่</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End EditShipping Modal -->
@endsection
