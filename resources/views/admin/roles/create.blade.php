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
       <h3>Create role</h3>

       @include('includes.form_error')
       {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminRolesController@store','id'=>'createroleform']) !!}

          <div class="form-group">
            {!! Form::label('name','Name:')!!}
            {!! Form::text('name',null,['class'=>'form-control'])!!}
          </div>

          <div class="form-group">
            {!! Form::label('description','Description:')!!}
            {!! Form::textarea('description',null,['class'=>'form-control'])!!}
          </div>


           <div class="form-group">
             {!! Form::submit('Create role',['class'=>'btn btn-primary float-right']); !!}
           </div>
        {!! Form::close() !!}
        </div>
        </div>
        </div>
     </div>
   </section>
   <script>
      var baseimg = "https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png";
   </script>

@endsection
