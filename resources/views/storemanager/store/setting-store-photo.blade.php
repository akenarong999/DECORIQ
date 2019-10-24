<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'แก้ไขรูปภาพของร้าน '.$store->name)

@section('sidebar')
    @parent
@endsection


@section('content')

<?php use \App\Http\Controllers\StoreManager\SettingsController; ?>

    <section id="seller-dashboard-shipping">
       <div class="container bg-white border mt-3 p-5 mb-3">
         <div class="row">
           <div class="col-9 mb-3 pr-4 border-right">
             <h2 class="mb-4">ตั้งค่ารูปร้าน</h2>
             <div>
               <form action="/storemanager/store/<?php echo $store->username; ?>/settings/storephoto/update" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                <input type="hidden" name="store_name" value="<?php echo $store->username; ?>">
                 <div class="row">
                   <div class="col-12">
                     <div class="form-group">
                       <label for="profile picture">รูปโปรไฟล์ร้าน :</label>
                       <?php
                        // define uploads path
                        $public_path = public_path();
                        $uploadDir = $public_path.'/images/';

                        // add file to our array
                        $preloadedFiles = array(
                          "name" => $store->photo->file,
                          "type" => 'image/*',
                          "size" => filesize($uploadDir . $store->photo->file),
                          "file" => url('images/') .'/'. $store->photo->file,
                          "data" => array(
                            "url" => url('images/').'/'. $store->photo->file,
                            "thumbnail" => $uploadDir. $store->photo->file ? url('images/').'/'.  $store->photo->file : null,
                           ),);

                          // convert our array into json string
                          if(!empty($preloadedFiles)){
                                $preloadedFiles = json_encode($preloadedFiles);
                          }
                          else{
                            $preloadedFiles = '';
                          }
                          ?>
                          <input type="file" id="profilephoto" name="profilephoto" data-fileuploader-files='<?php echo $preloadedFiles;?>'>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-12">
                     <div class="form-group">
                       <label for="cover photo">รูปหน้าปก :</label>

                          <?php
                           // define uploads path
                           $public_path = public_path();
                           $uploadDir = $public_path.'/images/';

                           if(isset($store->cover_photo->file)){
                           // add file to our array
                           $preloadedFiles1 = array(
                             "name" => $store->cover_photo->file,
                             "type" => 'image/*',
                             "size" => filesize($uploadDir . $store->cover_photo->file),
                             "file" => url('images/') .'/'. $store->cover_photo->file,
                             "data" => array(
                               "url" => url('images/').'/'. $store->cover_photo->file,
                               "thumbnail" => $uploadDir. $store->cover_photo->file ? url('images/').'/'.  $store->cover_photo->file : null,
                              ),);
                            }
                             // convert our array into json string
                             if(!empty($preloadedFiles1)){
                                   $preloadedFiles1 = json_encode($preloadedFiles1);
                             }
                             else{
                               $preloadedFiles1 = '';
                             }
                             ?>
                             <input type="file" id="coverphoto" name="coverphoto" data-fileuploader-files='<?php echo $preloadedFiles1;?>'>
                     </div>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col-12">
                     <button type="submit" class="btn btn-primary btn-lg btn-block">อัพเดท</button>
                   </div>
                 </div>

               </form>

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

                <form id="addaddressform" action="/storemanager/store/<?php echo $store->name; ?>/settings/add-store-address" method="get">
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
