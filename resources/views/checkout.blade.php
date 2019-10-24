@extends('layouts.frontend')

@section('title')
Checkout - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\CheckoutController; ?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
        <h3><i class="themify ti ti-receipt" ></i> Checkout</h3>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mt-4 mb-4">
    <div class="col-lg-8">

      <div class="border p-4 mt-2 bg-gray">
          <h4>ข้อมูลลูกค้า</h4>
          <div class="form-group pl-4 pt-2">
            <h5><i class="fas fa-envelope"></i> อีเมล</h5>
            @auth
              <strong><?php echo Auth::user()->email; ?></strong>&nbsp;&nbsp;<small id="emailHelp" class="form-text d-inline text-muted">(ข้อมูลการสั่งซื้อจะถูกส่งไปยังอีเมลนี้)</small>
            @endauth
            @guest
              <input type="email" class="form-control" id="guest-email" aria-describedby="emailHelp" placeholder="กรอกอีเมล">
              <small id="emailHelp" class="form-text text-muted">หากต้องการสั่งซื้อโดยที่ไม่ได้เป็นสมาชิก กรุณากรอกอีเมลเพื่อติดตามคำสั่งซื้อ หรือหากเป็นสมาชิกอยู่แล้ว สามารถ<a href="/login">เข้าสู่ระบบ</a>ได้ที่นี่</small>
            @endguest
          </div>
          <div class="form-group pl-4 pt-2">
            <h5><i class="far fa-sticky-note"></i> ข้อความถึงผู้ขาย</h5>
            <textarea class="form-control rounded-0 col-8" id="order_note" name="order_note" rows="4"></textarea>
          </div>
      </div>
      <div class="border p-4 mt-2 bg-gray">
        <h4>ที่อยู่</h4>
        <div class="row pt-3">
          <div class="col-lg-5 mt-2">
            <h5 class="w-100"  class="d-inline"><i class="fa fa-truck"></i> ที่อยู่สำหรับรับสินค้า</h5>
            <div class="container  bg-white border mt-2">
              <div class="row p-3">
                <?php echo session('shipping_address.firstname'); ?> <?php echo session('shipping_address.lastname'); ?><br>
                <?php echo session('shipping_address.address1'); ?><br>
                <?php echo session('shipping_address.address2'); ?>
                <?php echo session('shipping_address.thai_city'); ?>
                <?php echo session('shipping_address.postal_code'); ?><br>
                <?php echo session('shipping_address.tel_number'); ?><br>
              </div>
            </div>
          </div>
          <div class="col-lg-7 mt-2">
            <h5><i class="fas fa-file-invoice"></i> ที่อยู่สำหรับออกใบเสร็จ</h5>
            <div class="p-2">
                <div class="form-check pt-1">
                  <input class="form-check-input" type="radio" name="billing-address-selection" id="billing-address-selection1" value="same" checked>
                  <label class="form-check-label" for="billing-address-selection1">
                    ออกใบเสร็จรับเงินเหมือนกับที่อยู่รับสินค้า
                  </label>
                </div>
                <div class="form-check pt-1">
                  <input class="form-check-input"  type="radio" name="billing-address-selection" id="billing-address-selection2" value="notsame">
                  <label class="form-check-label" for="billing-address-selection2">
                    กรอกที่อยู่สำหรับออกใบเสร็จรับเงิน<br>(หากแตกต่างจากที่อยู่รับสินค้า)
                  </label>
                </div>
                <div class="container  bg-white border shipping-billing-address mt-2">
                  <div class="row p-3">
                    <?php echo session('shipping_address.firstname'); ?> <?php echo session('shipping_address.lastname'); ?><br>
                    <?php echo session('shipping_address.address1'); ?><br>
                    <?php echo session('shipping_address.address2'); ?>
                    <?php echo session('shipping_address.thai_city'); ?>
                    <?php echo session('shipping_address.postal_code'); ?><br>
                    <?php echo session('shipping_address.tel_number'); ?><br>
                  </div>
                </div>
                <div class="billing-address-form p-2 border mt-3 bg-white" style="display:none;">
                  <div class="container pt-3">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="Shipping method name">ชื่อ (หรือชื่อองค์กร)</label>
                          <input type="text" class="form-control" id="BAddressFirstname" name="firstname" required>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="Shipping method name">นามสกุล</label>
                          <input type="text" class="form-control" id="BillingAddressLastname" name="lastname" required>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                       <label for="Shipping type">ที่อยู่</label>
                       <input type="text" class="form-control" id="BillingAddressAddress1" name="address1" required>
                     </div>
                     <div class="form-group">
                       <input type="text" class="form-control" id="BillingAddressAddress2" name="address2">
                     </div>

                     <div class="row">
                       <div class="col-4">
                         <div class="form-group">
                           <label for="Shipping method name">รหัสไปรษณีย์</label>
                           <input type="text" class="form-control" id="BillingAddressPostalcode" name="postal_code" pattern="\d*" maxlength="5" required>
                         </div>
                       </div>
                       <div class="col-8">
                         <div class="form-group">
                           <label for="Shipping method name">ตำบล, อำเภอ, จังหวัด</label>
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
                  </div>
                </div>
          </div>
        </div>



          </div>
      </div>

    </div>


    <div class="col-lg-4">
      <div class="border p-4 mt-2 bg-gray">
        <h4 class="w-100">รายละเอียดตะกร้าสินค้า</h4>
        <div class="table-responsive">
        <table class="table mb-0">
            <tr class="border-bottom">
              <td class="pt-2 pb-2">ยอดรวมสินค้า</td>

              <td class="pt-2 pb-2 pr-0 white-space-nowrap text-right">
                @if(Session::has('cart'))
                <?php $subtotal = CheckoutController::getCartSubTotal(Session('selected_store_id'));
                      $total = $subtotal;
                      echo $subtotal; ?> ฿
                @else
                0 ฿
                @endif
              </td>

                <table class="table mb-0" id="shippingdetailtable">
                <?php $products = array_values(Session::get('cart')->items); ?>

                 <?php if(isset($products)){ ?>
                            <?php for($i=0;$i<count($products);$i++){
                              if($products[$i]['store_id']==Session::get('selected_store_id')){
                                $product_name = CheckoutController::getProductNamebyId($products[$i]['id']);
                              ?>
                              <tr>
                                <td class="product-name pl-3 pr-9 pt-1 pb-0 text-muted">- <?php echo strlen($product_name) > 55 ? substr($product_name,0,55)."..." : $product_name; ?> x<?php echo $products[$i]['qty']; ?></td><td class="shipping-cost p-1 text-right text-muted"><?php echo $products[$i]['price']; ?> ฿</td>
                              </tr>
                           <?php } } ?>
                  </table>
                 <?php
                    }
                   ?>
            </tr>
            <tr class="pb-4 mt-5"><br>
              <td class="pb-0 font-weight-bold"><strong>ค่าจัดส่ง</strong></td>
              <table class="table mb-0" id="shippingdetailtable">
              <?php $shippings = session('cart_shipping'); ?>
              <?php if(isset($shippings)){ ?>
              <?php foreach($shippings as $shipping){ ?>
                <tr>
                  <td class="shipping-name pl-3 pr-9 pt-1 pb-0 text-muted">- <?php echo $shipping['name']; ?></td><td class="shipping-cost p-1 text-right text-muted"><?php echo $shipping['cost']; ?> ฿</td>
                </tr>
             <?php $total += $shipping['cost'];
              }
            }else{
              Redirect::to('cart');
            }?>
             </table>
            </tr>
          </table>
          <table class="table">
            <tr class="border-bottom font-weight-bold">
              <td>ยอดรวมทั้งหมด</td>
              <td class="padding-right-0 white-space-nowrap text-right">
                @if(Session::has('cart'))
                <span id="total"><?php echo $total;  ?></span> ฿
                @else
                0 ฿
                @endif
              </td>
            </tr>
          </table>
        <button type="button" name="button" class="btn btn-success btn-block" id="place-order-button"><i class="fas fa-money-check-alt"></i> ส่งคำสั่งซื้อและไปชำระเงิน</button>
      </div>
      </div>
    </div>
  </div>
</div>



<!-- End EditShipping Modal -->
@endsection
