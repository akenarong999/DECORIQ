<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title')
เพิ่มบทความใหม่ - DECORIQ
@endsection


@section('sidebar')
    @parent
@endsection

@section('content')
<?php use \App\Http\Controllers\StoreManager\ArticlesController; ?>
  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5">
       <h1>เพิ่มบทความใหม่</h1>
       {{Form::open(['method'=>'POST', 'action'=>array('StoreManager\ArticlesController@store',$store->username),'files'=>true,'id'=>'createarticleform'])}}
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

         <label for="article title">หัวข้อบทความ</label>
         <input type="text" name="title" class="form-control" id="article-title" value="{{ old('title') }}" required>
       </div>
       <div class="form-group mb-4 mt-4">
         <label for="product name">รูปภาพหน้าปกบทความ <span class="text-muted">(*รูปภาพแรกจะเป็นหน้าปกสินค้า)</span></label>
          <input type="file" name="articlecoverphoto" class="mb-5" required>
          {{ Form::hidden('store_id', Crypt::encrypt($store->id)) }}
        </div>

        <div class="form-group">
            <label for="content">รายละเอียดทั้งหมด</label>
            <textarea name="content" id="summernote" required>{{ old('content') }}</textarea>
        </div>

            <button type="submit" class="btn btn-primary btn-lg col-12" name="submit">เพิ่มสินค้า</button>
      </form>

     </div>



   </section>






@endsection
