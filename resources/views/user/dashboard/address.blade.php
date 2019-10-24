@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')
<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-home"></i> ที่อยู่ในการรับสินค้า</h3>

    <ul class="list-group list-group-flush mt-3">
      <?php
      $i = 1;
      foreach($shipping_addresses as $shipping_address){
         ?>
        <li class="list-group-item pt-4 pb-4">
          <h5 class="d-inline">- ที่อยู่ <?php echo $i ?></h5>&nbsp;&nbsp;<a data-toggle="modal" data-address-id="<?php echo Crypt::encrypt($shipping_address->id); ?>" data-firstname="<?php echo $shipping_address->firstname; ?>" data-lastname="<?php echo $shipping_address->lastname; ?>" data-address1="<?php echo $shipping_address->address1; ?>" data-address2="<?php echo $shipping_address->address2; ?>" data-postal_code="<?php echo $shipping_address->postal_code; ?>" data-thai_city_id="<?php echo $shipping_address->thai_city_id; ?>" data-tel_number="<?php echo $shipping_address->tel_number; ?>" class="openeditshippingmodal" href="#EditShippingModal">[แก้ไข]</a>&nbsp;&nbsp;<a class="text-red" href="javascript:deleteAddress(<?php echo $i; ?>,<?php echo $shipping_address->id; ?>);">[ลบ]</a>
          <br><strong>ชื่อ-นามสกุล:</strong> <span class="text-muted"><?php echo $shipping_address->firstname.' '.$shipping_address->lastname; ?></span> <strong>ที่อยู่:</strong> <span class="text-muted"><?php echo $shipping_address->address1.', '. $shipping_address->address2.' '. $shipping_address->thai_city.' '. $shipping_address->postal_code ?></span> <strong>โทร:</strong> <span class="text-muted"><?php echo $shipping_address->tel_number; ?></span>
        </li>

       <?php $i++; } ?>
    </ul>
    <div class="mt-4 ml-4">
    <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#AddShippingModal"><i class="fas fa-plus"></i> เพิ่มที่อยู่ในการรับสินค้า</button>

    </div>


  </div>
</div>


<!-- AddShipping Modal -->
<div class="modal fade" id="AddShippingModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มการจัดส่งใหม่</h5>&nbsp;@guest<p class="text-muted">(จัดการที่อยู่ โดยการ<a href="/login">เข้าสู่ระบบ</a>ที่นี่)</p>@endguest
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     </div>
<div class="modal-body">

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
   <button type="submit" class="btn btn-primary" id="addaddressbutton" form="addaddressform">เพิ่มที่อยู่</button>
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

        {{ Form::open(['method'=>'GET','id'=>'editaddressform','action'=>'CartController@editcustomeraddresses']) }}
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
         <button type="submit" class="btn btn-primary" id="editaddressbutton" form="editaddressform">แก้ไขที่อยู่</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End EditShipping Modal -->

@endsection
