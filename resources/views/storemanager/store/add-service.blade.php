<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title')
เพิ่มบริการใหม่ - DECORIQ
@endsection


@section('sidebar')
    @parent
@endsection

@section('content')
  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 mb-3 p-5">
       <h1><i class="themify ti ti-ruler-pencil" ></i> เพิ่มบริการใหม่</h1><br>
       {{Form::open(['method'=>'POST', 'action'=>array('StoreManager\ServicesController@store',$store->username),'files'=>true,'id'=>'create-service-form'])}}
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
       </div>

       <div class="form-group">
         <div class="row">
           <div class="col-8">
             <h5 for="service name">ชื่อบริการ</h5>
             <input type="text" name="name" class="form-control form-control-lg" id="service-title" value="{{ old('name') }}" placeholder="รับทำ..." required>
          </div>
          <div class="col-4">
            <h5 for="service name">ราคาเริ่มต้น</h5>
            <div class="form-inline">
              <input type="text" name="start_price" class="form-control form-control-lg mr-2" id="start_price" value="{{ old('name') }}" placeholder="ระบุราคาเริ่มต้นเป็นตัวเลข" required><h3> ฿</h3>
            </div>
            <small id="start-price-help" class="form-text text-muted">ระบุราคาเริ่มต้นสำหรับแสดงในหน้ารายละเอียดบริการ คุณสามารถเสนอราคาภายหลังได้ เมื่อทราบรายละเอียดที่มากขึ้น</small>
          </div>
         </div>
       </div>



       <div class="form-group mb-4 mt-4">
         <label for="product name">รูปภาพบริการ <span class="text-muted">(*รูปภาพแรกจะเป็นหน้าปกบริการ)</span></label>
          <input type="file" name="productfile" class="mb-5"  required>
          {{ Form::hidden('store_id', Crypt::encrypt($store->id)) }}
        </div>

        <div class="form-group mb-4 mt-4">
            <div class="row">
              <div class="col-sm-6">
                {!! Form::label('category_id','หมวดหมู่:')!!}
                {!! Form::select('parent_category_id', [''=>'เลือกหมวดหมู่']+$parent_categories, null, ['class'=>'form-control','id'=>'parentcategories']) !!}
              </div>
              <div class="col-sm-6">
                {!! Form::label('subcategory_id','หมวดหมู่ย่อย:')!!}
                {!! Form::select('category_id', [''=>'เลือกหมวดหมู่ย่อย'], null, ['class'=>'form-control']) !!}
              </div>
            </div>
          </div>

        <div class="form-group mb-4 mt-4">
            <label for="exampleFormControlTextarea1">รายละเอียดบริการ</label>
            <textarea name="description" id="summernote" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group mb-4 mt-4">
            <label for="exampleFormControlTextarea1">ข้อมูลที่ต้องการจากลูกค้า (Requirement)</label>
            <textarea name="requirement" class="form-control" placeholder="ระบุข้อมูลที่คุณต้องการสำหรับการเริ่มงาน โดยอาจเขียนเป็นข้อๆ เมื่อลูกค้าทำการสั่งซื้อบริการนี้แล้ว เราจะแจ้งลูกค้าให้กรอกข้อมูลเพิ่มเติมที่คุณต้องการนี้" required>{{ old('requirement') }}</textarea>
        </div>

        <div class="form-group mb-4 mt-4">
            <div class="row">
              <div class="col-sm-6">
                <i class="fa fa-clock-o" aria-hidden="true"></i>  <label for="work_duration_day">ระยะเวลาในการทำงาน: </label>
                <select class="form-control" name="work_duration" required>
                  <option value="">เลือกระยะเวลาในการทำงานของบริการนี้</option>
                  <?php  for($i=1;$i<=31;$i++){ ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?> วัน</option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-sm-6">
                <i class="fa fa-refresh" aria-hidden="true"></i> <label for="revision">จำนวนครั้งที่อนุญาตให้ลูกค้าขอแก้ไขงาน: </label>
                <select class="form-control" name="revision_time" required>
                  <option value="">เลือกจำนวนครั้งที่อนุญาตให้ลูกค้าแก้ไขงาน</option>
                  <?php  for($i=1;$i<=10;$i++){ ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?> ครั้ง</option>
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
                    <option value="-">ไม่มีดูแลหลังการขาย</option>
                    <option value="30">1 เดือน</option>
                    <option value="60">2 เดือน</option>
                    <option value="90">3 เดือน</option>
                    <?php  for($i=1;$i<=31;$i++){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?> วัน</option>
                    <?php } ?>
                  </select>
                </div>

              </div>
            </div>

            <div class="form-group mb-4 mt-4" id="after-service-support-description-form" style="display:none;">
                <label for="AfterServiceSupportDescriptionInput">ระบุรายละเอียดในการดูแลหลังการขาย:</label>
                <textarea class="form-control" id="after-service-support-description-input" name="after_service_support_description" placeholder="ระบุเกี่ยวกับข้อมูลการดูแลที่คุณมีให้ลูกค้า หลังจากที่การบริการนี้เสร็จสิ้นลง"></textarea>
            </div>

          <div class="form-group mb-4 mt-4">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                       {!! Form::label('allowlocations','บริการเฉพาะเขต (เว้นว่างหากส่งทุกที่):')!!}
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


            <button type="submit" class="btn btn-primary btn-lg col-12" name="submit">เพิ่มบริการ</button>
      </form>

     </div>



   </section>






@endsection
