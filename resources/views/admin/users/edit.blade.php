<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')

  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 mb-5 p-5">
       <div class="row">
       <div class="col-sm-3">
         <div class="custom-file-container" data-upload-id="myUniqueUploadId">
             <div  class="custom-file-container__image-preview" style="margin-bottom:20px !important;"></div>
             <label class="custom-file-container__custom-file" >
                 <input form="edituserform" type="file" class="custom-file-container__custom-file__custom-file-input" name="photo_id" accept="*">
                 <input form="edituserform" type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                 <span class="custom-file-container__custom-file__custom-file-control"></span>
             </label>
              <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">Remove preview</a></label>
         </div>
       </div>
       <div class="col-sm-9 border-bottom mb-3 pb-2">
       <h3>Edit {{$user->name}}</h3>

       @include('includes.form_error')
       {!! Form::model($user,['method'=>'PATCH', 'action'=>['Admin\AdminUsersController@update',$user->id],'files'=>true,'id'=>'edituserform']) !!}


          <div class="form-group">
            {!! Form::label('email','Email:')!!}
            {!! Form::email('email',null,['class'=>'form-control'])!!}
          </div>
          <div class="form-group">
            {!! Form::label('password','Password:')!!}
            {!! Form::password('password',['class'=>'form-control'])!!}
          </div>
          <div class="form-group">
            {!! Form::label('firstname','Firstname:')!!}
            {!! Form::text('firstname',null,['class'=>'form-control'])!!}
          </div>
          <div class="form-group">
            {!! Form::label('lastname','Lastname:')!!}
            {!! Form::text('lastname',null,['class'=>'form-control'])!!}
          </div>
          <div class="form-group">
            {!! Form::label('telnumber','Tel number:')!!}
            {!! Form::text('telnumber',null,['class'=>'form-control'])!!}
          </div>
           <div class="form-group">
            {!! Form::label('role_id','User role:')!!}
            {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
           </div>
           <div class="form-group">
            {!! Form::label('is_active','Account active')!!}
            {!! Form::select('is_active', ['0'=>'Not active','1'=>'Active'], null, ['class'=>'form-control']) !!}
           </div>

           <div class="form-group">
             {!! Form::submit('Edit user',['class'=>'btn btn-primary float-right']); !!}
           </div>
        {!! Form::close() !!}
        </div>
      </div>
     </div>
   </section>
   <script>
      var baseimg = "/images/{{$user->photo->file}}";
   </script>

@endsection
