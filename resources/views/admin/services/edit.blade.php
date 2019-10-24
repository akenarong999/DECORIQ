<!-- Stored in resources/views/child.blade.php -->
<?php include_once(app_path().'/includes/class.fileuploader.php'); ?>
@extends('layouts.admin')

@section('title')
แก้ไข {{$service->name}} - DECORIQ
@endsection

@section('sidebar')
    @parent

@endsection

@section('content')

<?php use \App\Http\Controllers\StoreManager\ServicesController; ?>

@section('content')
  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5 mb-3">
       <h1>แก้ไข {{$service->name}}</h1><br>

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

       {!! Form::model($service,['method'=>'PATCH',  'action'=>array('Admin\AdminServicesController@update',$service->id),'files'=>true,'id'=>'edit-service-form']) !!}
       <div class="form-group">
         <div class="row">
           <div class="col-md-8 col-sm-12 mt-2">
             <h5 for="service name">ชื่อบริการ</h5>
             {!! Form::text('name',null,['class'=>'form-control form-control-lg','id'=>'service-title','placeholder'=>'รับทำ...','required' => 'required']) !!}
          </div>
          <div class="col-md-4  col-sm-12 mt-2">
            <h5 for="service name">ราคาเริ่มต้น</h5>
            <div class="form-inline">
              {!! Form::text('start_price',null,['class'=>'form-control form-control-lg mr-2','id'=>'start_price','placeholder'=>'ระบุราคาเริ่มต้นเป็นตัวเลข','required' => 'required']) !!}<h3> ฿</h3>
            </div>
            <small id="start-price-help" class="form-text text-muted">ระบุราคาเริ่มต้นสำหรับแสดงในหน้ารายละเอียดบริการ คุณสามารถเสนอราคาภายหลังได้ เมื่อทราบรายละเอียดที่มากขึ้น</small>
          </div>
         </div>
       </div>

       <div class="form-group mb-4 mt-4">
         <label for="product name">รูปภาพสินค้า <span class="text-muted">(*รูปภาพแรกจะเป็นหน้าปกบริการ)</span></label><br>
         <?php
          // define uploads path
          $public_path = public_path();
          $uploadDir = $public_path.'/images/';
				  // create an empty array
          // we will add to this array the files from directory below
          // here you can also add files from MySQL database
   				// add files to our array with
	  			// made to use the correct structure of a file

      		foreach($service_photos as $service_photo) {
					// add file to our array
					$preloadedFiles[] = array(
						"name" => $service_photo->name,
						"type" => 'image/*',
						"size" => filesize($uploadDir . $service_photo->name),
						"file" => url('images/') .'/'. $service_photo->name,
						"data" => array(
							"url" => url('images/').'/'. $service_photo->name,
              "thumbnail" => $uploadDir. $service_photo->name ? url('images/').'/'.  $service_photo->name : null,
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
          <input type="hidden" name="service_id" value="{{$service->id}}" id="service_id">
          <input type="hidden" name="store_id" value="{{$store->id}}">
        </div>

        <div class="form-group mb-5">
            <div class="row">
              <div class="col-sm-6">
                {!! Form::label('category_id','หมวดหมู่:')!!}
                {!! Form::select('parent_category_id', $parent_categories, null, ['class'=>'form-control','id'=>'parentcategories']) !!}

              </div>
              <div class="col-sm-6">
                {!! Form::label('subcategory_id','หมวดหมู่ย่อย:')!!}
                <select class="form-control" id="subcategories" name="service_category_id">
                </select>

                </form>
              </div>

            </div>
          </div>


        <div class="form-group mb-4 mt-4">
            <label for="service-description">รายละเอียดบริการ</label>
            {!! Form::textarea('description',null,['class'=>'form-control','id'=>'summernote']) !!}
        </div>

        <div class="form-group mb-4 mt-4">
          <label for="requirement">ข้อมูลที่ต้องการจากลูกค้า (Requirement)</label>
          {!! Form::textarea('requirement',null,['class'=>'form-control','rows'=>'2','placeholder'=>'ระบุข้อมูลที่คุณต้องการสำหรับการเริ่มงาน โดยอาจเขียนเป็นข้อๆ เมื่อลูกค้าทำการสั่งซื้อบริการนี้แล้ว เราจะแจ้งลูกค้าให้กรอกข้อมูลเพิ่มเติมที่คุณต้องการนี้','required' => 'required']) !!}
        </div>



          <hr>

          <div class="form-group mb-4 mt-4">
              <div class="row">
                <div class="col-sm-6">
                  <i class="fa fa-clock-o" aria-hidden="true"></i>  <label for="work_duration_day">ระยะเวลาในการทำงาน: </label>
                  <select class="form-control" name="work_duration" required>
                    <option value="">เลือกระยะเวลาในการทำงานของบริการนี้</option>
                    <?php  for($i=1;$i<=31;$i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($service->work_duration==$i){ echo "selected"; } ?>><?php echo $i; ?> วัน</option>
                  <?php } ?>
                  </select>
                </div>
                <div class="col-sm-6">
                  <i class="fa fa-refresh" aria-hidden="true"></i> <label for="revision">จำนวนครั้งที่อนุญาตให้ลูกค้าขอแก้ไขงาน: </label>
                  <select class="form-control" name="revision_time" required>
                    <option value="">เลือกจำนวนครั้งที่อนุญาตให้ลูกค้าแก้ไขงาน</option>
                    <?php  for($i=1;$i<=10;$i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($service->revision_time==$i){ echo "selected"; } ?> ><?php echo $i; ?> ครั้ง</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group mb-4 mt-4">
                <div class="row">
                  <div class="col-sm-12">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>  <label for="AfterServiceDuration">ระยะเวลาในการดูแลหลังใช้บริการ (ถ้ามี): </label>
                    <select class="form-control" id="afterservicecareduration" name="after_service_support_duration" required>
                      <option value="">เลือกระยะเวลาในการดูแลหลังจากการใช้บริการ</option>
                      <option value="-" <?php if($service->after_service_support_duration=="-"){ echo "selected"; } ?>>ไม่มีดูแลหลังการขาย</option>
                      <option value="30" <?php if($service->after_service_support_duration=="30"){ echo "selected"; } ?>>1 เดือน</option>
                      <option value="60" <?php if($service->after_service_support_duration=="60"){ echo "selected"; } ?>>2 เดือน</option>
                      <option value="90" <?php if($service->after_service_support_duration=="90"){ echo "selected"; } ?>>3 เดือน</option>
                      <?php  for($i=1;$i<=29;$i++){ ?>
                      <option value="<?php echo $i; ?>" <?php if($service->after_service_support_duration==$i){ echo "selected"; } ?> ><?php echo $i; ?> วัน</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group mb-4 mt-4" id="after-service-support-description-form"  <?php if($service->after_service_support_duration=="-"){ ?> style="display:none;"<?php } ?>>
                  <label for="AfterServiceSupportDescriptionInput">ระบุรายละเอียดในการดูแลหลังการขาย:</label>
                  <textarea class="form-control" id="after-service-support-description-input" name="after_service_support_description" placeholder="ระบุเกี่ยวกับข้อมูลการดูแลที่คุณมีให้ลูกค้า หลังจากที่การบริการนี้เสร็จสิ้นลง"><?php echo $service->after_service_support_description; ?></textarea>
              </div>


            <div class="form-group mb-4 mt-4">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                         {!! Form::label('allowlocations','บริการเฉพาะเขต (เว้นว่างหากให้บริการทุกที่):')!!}
                         <input type="text" class="form-control" id="inputallowlocation" name ="allowlocations" data-role="tagsinput" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                         {!! Form::label('notallowlocations','ไม่บริการในเขต (เว้นว่างหากไม่ต้องการเลือก):')!!}
                         <input type="text" class="form-control" id="inputnotallowlocation" name ="notallowlocations" data-role="tagsinput">
                    </div>
                  </div>
                </div>
              </div>


          <button type="submit" class="btn btn-primary btn-lg col-12" name="submit">แก้ไขข้อมูลสินค้า</button>
      </form>

 </div>
   </section>



@endsection
