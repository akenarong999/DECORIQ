<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'การจัดส่งของร้าน '.$store->name)

@section('sidebar')
    @parent
@endsection


@section('content')

<?php use \App\Http\Controllers\StoreManager\SettingsController; ?>

    <section id="seller-dashboard-shipping">
       <div class="container bg-white border mt-3 p-5 mb-3">
         <div class="row">
           <div class="col-9 mb-3 pr-4 border-right">
             <h1 class="mb-4">ตั้งค่าร้านค้า</h1>
             <div class="p-5 border">

               <form id="saveaddressform" action="/storemanager/store/<?php echo $store->username; ?>/settings/save-store-address" method="get">

                 <div class="mb-3">
                      <h3 class="pb-2 mb-4 border-bottom">ตั้งค่าที่อยู่ร้าน</h3>
                      @if (Session::has('success'))
                       <div class="alert alert-success alert-block mb-4">
                       	<button type="button" class="close" data-dismiss="alert">×</button>
                               {{ Session::get('success') }}
                       </div>
                       @endif
                       <h4>ที่อยู่หลักของร้าน</h4>

                 <?php if(!empty($store_addresses)){
                        foreach ($store_addresses as $store_address): ?>

                        <div class="radio">
                          <label><input type="radio" name="main_address_id" value="<?php echo $store_address->id; ?>"  <?php echo ($store_address->id ==$store->main_address_id)? 'checked':'' ?>>&nbsp;<?php echo $store_address->address1.', '.$store_address->address2.'<br>'.$store_address->thai_city.' '.$store_address->postal_code.' , โทร '.$store_address->tel_number; ?></label>
                        </div>

                      <?php endforeach;
                      }else{ ?>
                        <span>กรุณาเพิ่มที่อยู่ของร้าน</span>
                      <?php } ?>
                  </div>

                   <div class="mb-3 mt-3">
                       <h4>ที่อยู่สำหรับคืนสินค้า</h4>
                       <?php if(!empty($store_addresses)){
                            foreach ($store_addresses as $store_address): ?>

                        <div class="radio">
                          <label><input type="radio" name="return_address_id" value="<?php echo $store_address->id; ?>" <?php echo ($store_address->id ==$store->return_address_id)? 'checked':'' ?>>&nbsp;<?php echo $store_address->address1.', '.$store_address->address2.'<br>'.$store_address->thai_city.' '.$store_address->postal_code.' , โทร '.$store_address->tel_number; ?></label>
                        </div>

                    <?php endforeach;
                    }else{ ?>
                      <span>กรุณาเพิ่มที่อยู่ของร้าน</span>
                    <?php } ?>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-success" form="saveaddressform">บันทึก</button> <button type="button" name="button" class="btn btn-default" data-toggle="modal" data-target="#AddShippingModal"><i class="fas fa-plus"></i> เพิ่มที่อยู่ใหม่</button>
                  </form>
                  </div>
            </div>
           </div>

           <div class="col-3 mb-3 pt-4">
             <div class="list-group">
                <a href="/storemanager/store/{{$store->username}}/settings" class="list-group-item list-group-item-action">ตั้งค่าโปรไฟล์ร้าน</a>
                <a href="/storemanager/store/{{$store->username}}/settings/storephoto" class="list-group-item list-group-item-action active">ตั้งค่ารูปร้าน</a>
                <a href="/storemanager/store/{{$store->username}}/settings/address" class="list-group-item list-group-item-action">ตั้งค่าที่อยู่ร้าน</a>
                <a href="/storemanager/store/{{$store->username}}/settings/role" class="list-group-item list-group-item-action">ตั้งค่าผู้ดูแลร้าน</a>
                <a href="/storemanager/store/{{$store->username}}/settings/ads" class="list-group-item list-group-item-action">ตั้งค่าการโฆษณา</a>
                <a href="/storemanager/store/{{$store->username}}/settings/display" class="list-group-item list-group-item-action disabled">ตั้งค่าการแสดงผลร้าน</a>
              </div>

           </div>

         </div>

         </div>
       </div>

    </section>


        <div class="modal fade" id="AddShippingModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มที่อยู่ใหม่</h5>
              </div>
              <div class="modal-body">

                <form id="addaddressform" action="/storemanager/store/<?php echo $store->username; ?>/settings/add-store-address" method="get">
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
                       <input type="text" class="form-control" name="tel_number" value="">
                     </div>
                   </div>
                 </div>

              </div>
              <div class="modal-footer">
                 <button type="submit" class="btn btn-primary" id="addaddressbutton" form="addaddressform">เพิ่มที่อยู่</button>
              </div>
              </form>

            </div>
          </div>
        </div>
        <script type="text/javascript">

            $('#AddShippingModal').on('shown.bs.modal', function () {
          $('#ShippingAddressFirstname').trigger('focus')
        })
        </script>


@endsection
