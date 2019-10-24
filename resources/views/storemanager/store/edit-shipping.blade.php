<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title')
แก้ไขการจัดส่ง {{$shipping->name}} - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
<section id="seller-dashboard-edit-shipping-page">
  <div class="container bg-white border mt-3 mb-5 p-5">
    <div class="row">
    <div class="col-sm-3">
      <div class="custom-file-container" data-upload-id="myUniqueUploadId">
          <div  class="custom-file-container__image-preview" style="margin-bottom:20px !important;  "></div>
          <label class="custom-file-container__custom-file" >
              <input form="editshippingform" type="file" class="custom-file-container__custom-file__custom-file-input" name="photo_id" accept="*">
              <input form="editshippingform" type="hidden" name="MAX_FILE_SIZE" value="10485760" />
              <span class="custom-file-container__custom-file__custom-file-control"></span>
          </label>
           <label>อัพโหลดรูปภาพ <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">ลบรูปภาพ</a></label>
      </div>
    </div>
    <div class="col-sm-9 mb-3 border-left">
    <h3>แก้ไขการจัดส่ง {{$shipping->name}}</h3>

    @include('includes.form_error')


    {!! Form::model($shipping,['method'=>'PATCH', 'action'=>['StoreManager\ShippingsController@update',$store->username,$shipping->id],'files'=>true,'id'=>'editshippingform']) !!}
       <div class="form-group">
         {!! Form::label('name','ชื่อการจัดส่ง:')!!}
         {!! Form::text('name',null,['class'=>'form-control'])!!}
       </div>
       <div class="form-group font-weight-bold">
         {!! Form::label('type','รูปแบบการจัดส่ง:')!!}
         <?php
           if($shipping->type=='flat'){
             echo "ราคาเดียว (Flat rate)";
           }
           elseif($shipping->type=='weight'){
             echo "ราคาตามน้ำหนัก (Weight base)";
           }
           else{
             echo "จัดส่งฟรี (Free shipping)";
           }
         ?>
         <input type="hidden" name="shipping_type" value="{{$shipping->type}}">
       </div>
       <div class="form-group">
         {!! Form::label('description','รายละเอียด:')!!}
         {!! Form::text('description',null,['class'=>'form-control'])!!}
       </div>
       <div class="form-group">
         {!! Form::label('private_description','รายละเอียดส่วนตัว (ลูกค้ามองไม่เห็น):')!!}
         {!! Form::text('private_description',null,['class'=>'form-control'])!!}
       </div>


       <div class="form-group">
            {!! Form::label('allowlocations','จัดส่งเฉพาะเขต (เว้นว่างหากส่งทุกที่):')!!}
            <input type="text" class="form-control" id="inputallowlocation" name ="allowlocations" data-role="tagsinput" value="{{$shipping->allowlocations}}">
       </div>

       <div class="form-group">
            {!! Form::label('notallowlocations','ไม่จัดส่งในเขต (เว้นว่างหากไม่ต้องการเลือก):')!!}
            <input type="text" class="form-control" id="inputnotallowlocation" name ="notallowlocations" data-role="tagsinput">
       </div>

       <?php
         if($shipping->type=='flat'){  ?>
           <div class="form-group">
             {!! Form::label('shipping cost','ค่าจัดส่ง:')!!}
             {!! Form::text('cost',null,['class'=>'form-control'])!!}
           </div>

       <?php
         }
         elseif($shipping->type=='weight'){  ?>
             <div class="form-group pt-4 border-top">
               <h4>ตั้งค่าค่าจัดส่งโดยน้ำหนักพัสดุ</h4><br>
               @if(Session::has('overlap'))
                 <div class="alert alert-danger">{{ Session::get('overlap') }}</div>
               @endif

          <div class="form-group">
            <?php if(count($shipping_weightbases)==NULL){
              $shipping_weightbases_array_count = 1; ?>
              <div class="row mb-2 mt-3 pb-3 weightbase-row border-bottom">
                <div class="col-sm-4">
                    <label>น้ำหนักมากกว่าหรือเท่ากับ (>= kg)</label><input type="text" name="weightbaseminweight[]" class="form-control" placeholder="">
                </div>
                <div class="col-sm-4">
                    <label>น้ำหนักน้อยกว่า (< kg)</label><input type="text" name="weightbasemaxweight[]" class="form-control">
                </div>
                <div class="col-sm-3">
                    <label>ค่าจัดส่ง</label><input name="weightbasecost[]" type="text" class="form-control">
                </div>


                </div>
              <div id="WeightbaseBoxContainer"></div>

         <?php
           }
           else{ ?>
            <div id="WeightbaseBoxContainer">
            <?php $shipping_weightbases_array_count = count($shipping_weightbases);  ?>
            <?php $j = 1 ?>
            @foreach($shipping_weightbases as $shipping_weightbase)
              <div class="row mb-2 mt-3 pb-3 weightbase-row border-bottom">
                <input type="hidden" name="weightbaseid[]" value="<?php echo $shipping_weightbase->id ?>">

                <div class="col-sm-4">
                    <label>น้ำหนักมากกว่า (> kg)</label><input type="text" name="weightbaseminweight[]" class="form-control" placeholder="" value="{{$shipping_weightbase->minweight}}">
                </div>
                <div class="col-sm-4">
                    <label>น้ำหนักน้อยกว่าหรือเท่ากับ (<= kg)</label><input type="text" name="weightbasemaxweight[]" class="form-control" value="{{$shipping_weightbase->maxweight}}">
                </div>
                <div class="col-sm-3">
                    <label>ค่าจัดส่ง</label><input name="weightbasecost[]" type="text" class="form-control" value="{{$shipping_weightbase->cost}}">
                </div>

                @if(($j==$shipping_weightbases_array_count) && ($shipping_weightbases_array_count!=1))
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

          <button  id="btnAdd" type="button" class="btn btn-sm btn-secondary mt-2" data-toggle="tooltip"><i class="themify ti ti-plus"></i>&nbsp; เพิ่มช่วงของน้ำหนัก&nbsp;</button>
         </div>
          </div>

       <?php
         }
       ?>
       <div class="form-group mt-5">
         <button type="submit" class="btn btn-primary btn-lg col-12" name="submit">แก้ไขการจัดส่ง</button>
       </div>
       {!! Form::close() !!}

     </div>
   </div>
  </div>

 </section>
 <script>
    var baseimg = "/images/{{$shipping->photo ? $shipping->photo->file : 'no-shipping-image.png'}}";
 </script>

@endsection
