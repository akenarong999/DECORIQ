<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="store-dashboard-main">
      <div class="container bg-white border mt-3 mb-5 p-5">
        <div class="row">
        <div class="col-sm-3">
          <div class="custom-file-container" data-upload-id="myUniqueUploadId">
              <div  class="custom-file-container__image-preview" style="margin-bottom:20px !important;  "></div>
              <label class="custom-file-container__custom-file" >
                  <input form="createuserform" type="file" class="custom-file-container__custom-file__custom-file-input" name="photo_id" accept="*">
                  <input form="createuserform" type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                  <span class="custom-file-container__custom-file__custom-file-control"></span>
              </label>
               <label><a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">Remove preview</a></label>
          </div>
        </div>
        <div class="col-9 mb-3 pb-2">
        <h3>สร้างร้านค้า</h3>

        @include('includes.form_error')
        {!! Form::open(['method'=>'POST', 'action'=>'StoreManager\StoresListController@store','files'=>true,'id'=>'createuserform']) !!}

           <div class="form-group">
             {!! Form::label('name','ชื่อร้านค้า:')!!}
             {!! Form::text('name',null,['class'=>'form-control'])!!}
           </div>

           <div class="form-group">
             {!! Form::label('username','ชื่อผู้ใช้ร้านค้า:')!!}
             {!! Form::text('username',null,['class'=>'form-control'])!!}
             <small>(https://www.decoriq.com/store/XXXXX)</small>
           </div>

           <div class="form-group">
             {!! Form::label('description','รายละเอียด:') !!}
             {!! Form::textarea('description',null,['class'=>'form-control'])!!}
           </div>


            <div class="form-group">
              {!! Form::submit('Create store',['class'=>'btn btn-primary float-right']); !!}
            </div>
         {!! Form::close() !!}
         </div>
         </div>
         </div>
    </section>

    <script>
       var baseimg = "https://www.picz.in.th/images/2018/06/28/4MZ5fR.png";
    </script>



@endsection
