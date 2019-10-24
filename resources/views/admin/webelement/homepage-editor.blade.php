<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
องค์ประกอบเว็บไซต์ - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3 mt-3 pb-2 border-bottom">
             <div class="col-6">
                <h2>แก้ไขหน้าหลัก</h2>
                <p>หน้าหลักของเว็บไซต์</p>
             </div>
           </div>

           <div class="container mt-5">
             <div class="row">
               <div class="col-12">
                 <h3>Slideshow</h3><br>
                 <div class="row border-bottom pb-5">
                   <div class="col-12">
                  {!! Form::model($slide_photos,['method'=>'PATCH', 'action'=>['Admin\AdminWebElementController@EditHomepageSlideshow'],'files'=>true,'id'=>'editproductform']) !!}
                     <?php
                      // define uploads path
                      $public_path = public_path();
                      $uploadDir = $public_path.'/images/';
                      $count_slide = 0;
                  		foreach($slide_photos as $slide_photo) {
                       $count_slide++;
            					// add file to our array
            					$preloadedFiles[] = array(
            						"name" => $slide_photo->photo_file,
            						"type" => 'image/*',
            						"size" => filesize($uploadDir . $slide_photo->photo_file),
            						"file" => url('images/') .'/'. $slide_photo->photo_file,
            						"data" => array(
            							"url" => url('images/').'/'. $slide_photo->photo_file,
                          "thumbnail" => $uploadDir. $slide_photo->photo_file ? url('images/').'/'.  $slide_photo->photo_file : null,
            						 ),);
                       ?>
                      <div class="row mt-3">
                        <input type="hidden" class="form-control" name="slide-photo-id-<?php echo $count_slide; ?>" value="<?php echo $slide_photo->id; ?>">
                         <div class="col-7">
                           <h5>รายละเอียดรูปที่ <?php echo $slide_photo->id; ?></h5>
                           <input type="text" class="form-control" name="slide-description-<?php echo $count_slide; ?>" value="<?php echo $slide_photo->description; ?>">
                         </div>
                         <div class="col-5">
                           <h5>ลิงค์ของรูปที่ <?php echo $slide_photo->id; ?></h5>
                           <input type="text" class="form-control" name="slide-link-<?php echo $count_slide; ?>" value="<?php echo $slide_photo->link; ?>">
                         </div>
                      </div>

                       <?php
                        }
                				// convert our array into json string
                        if(!empty($preloadedFiles)){
                				      $preloadedFiles = json_encode($preloadedFiles);
                        }
                        else{
                          $preloadedFiles = '';
                        }

                        ?>
                      <input type="hidden" name="count_slide" value="<?php echo $count_slide ?>">
                      <input type="file" name="homepage-slideshow" data-fileuploader-files='<?php echo $preloadedFiles;?>'>
                      <input type="submit" class="btn btn-primary align-right">
                    </form>
                    </div>

                 </div>
               </div>
             </div>
           </div>


         <div class="container mt-5">
           <div class="row">
             <div class="col-12">
               <h3>หมวดหมู่สินค้ายอดนิยม (ใส่ ID ของหมวดหมู่สินค้าแล้วคั่นด้วย , [comma])</h3><br>
           {!! Form::model($homepagefeaturedproductcategories,['method'=>'PATCH', 'action'=>['Admin\AdminWebElementController@EditHomepageFeaturedProductCategories'],'files'=>true,'id'=>'EditHomepageFeaturedProductCategoriesform']) !!}
               <div class="row">
                 <div class="col-11">
                   <input class="form-control form-inline d-inline" type="text" name="component_value" value="<?php echo $homepagefeaturedproductcategories['component_value']; ?>">
                 </div>
                 <div class="col-1">
                   <button type="submit" class="btn btn-primary d-inline" name="button">Submit</button>
                 </div>
               </form>
               </div>
             </div>
           </div>
         </div>

         <div class="container mt-5">
           <div class="row">
             <div class="col-12">
               <h3>สินค้าแนะนำ (ใส่ ID ของสินค้าแล้วคั่นด้วย , [comma])</h3><br>
           {!! Form::model($homepagefeaturedproducts,['method'=>'PATCH', 'action'=>['Admin\AdminWebElementController@EditHomepageFeaturedProducts'],'files'=>true,'id'=>'EditHomepageFeaturedProductsform']) !!}
               <div class="row">
                 <div class="col-11">
                   <input class="form-control form-inline d-inline" type="text" name="component_value" value="<?php echo $homepagefeaturedproducts['component_value']; ?>">
                 </div>
                 <div class="col-1">
                   <button type="submit" class="btn btn-primary d-inline" name="button">Submit</button>
                 </div>
               </form>
               </div>
             </div>
           </div>
         </div>

         <div class="container mt-5">
           <div class="row">
             <div class="col-12">
               <h3>บริการแนะนำ (ใส่ ID ของสินค้าแล้วคั่นด้วย , [comma])</h3><br>
           {!! Form::model($homepagefeaturedservices,['method'=>'PATCH', 'action'=>['Admin\AdminWebElementController@EditHomepageFeaturedServices'],'files'=>true,'id'=>'EditHomepageFeaturedServicesform']) !!}
               <div class="row">
                 <div class="col-11">
                   <input class="form-control form-inline d-inline" type="text" name="component_value" value="<?php echo $homepagefeaturedservices['component_value']; ?>">
                 </div>
                 <div class="col-1">
                   <button type="submit" class="btn btn-primary d-inline" name="button">Submit</button>
                 </div>
               </form>
               </div>
             </div>
           </div>
         </div>



        </div>
    </section>
@endsection
