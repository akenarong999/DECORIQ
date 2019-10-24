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
       <div class="col-12 mb-3 pb-2">
       <h3>Edit role</h3>

       @include('includes.form_error')
       {!! Form::model($role,['method'=>'PATCH', 'action'=>['AdminRolesController@update',$role->id],'id'=>'editroleform']) !!}

       <div class="form-group">
         {!! Form::label('name','Name:')!!}
         {!! Form::text('name',null,['class'=>'form-control'])!!}
       </div>

       <div class="form-group">
         {!! Form::label('description','Description:')!!}
         {!! Form::textarea('description',null,['class'=>'form-control'])!!}
       </div>


        <div class="form-group">
          {!! Form::submit('Edit role',['class'=>'btn btn-primary float-right']); !!}
        </div>
        {!! Form::close() !!}
        </div>
      </div>
     </div>
   </section>

@endsection
