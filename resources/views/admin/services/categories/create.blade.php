<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
สร้างหมวดหมู่สินค้าใหม่ - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3 mt-3 pb-2 border-bottom">
             <div class="col-6">
                <h2>สร้างหมวดหมู่บริการใหม่</h2>
             </div>
           </div>

           <div class="row mb-3 mt-3 pb-2 border-bottom">
              <div class="col-12">

                @if(session()->has('success-message'))
                    <div class="alert alert-success">
                        {{ session()->get('success-message') }}
                    </div>
                @endif

                @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      คุณใส่ข้อมูลไม่ถูกต้อง ดังต่อไปนี้...
                      <ul>
                          @foreach ($errors->all() as $error)

                              <li>{{ $error }}</li>

                          @endforeach
                      </ul>
                  </div>
              @endif
              <form action="/admin/service-categories/storenewservicecategory" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="product name">ชื่อบริการ</label>
                  {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                  <label for="product name">รายละเอียด</label>
                  {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                  <label for="product name">หมวดหมู่หลัก</label>
                  <select class="form-control" name="category_id">
                    <option value="0">ไม่มีหมวดหมู่หลัก</option>
                    <?php foreach($all_parent_categories as $all_parent_category){ ?>
                    <option value="<?php echo $all_parent_category->id; ?>"><?php echo $all_parent_category->name; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group border-bottom">
                  <label for="product name">รูปโปรไฟล์หมวดหมู่</label>
                  <input type="file" class="form-control" name="profile_photo_id"><br>
                </div>

                <div class="form-group border-bottom">
                  <label for="product name">รูปหน้าปกหมวดหมู่ (1110x300px)</label>
                  <input type="file" class="form-control" name="cover_photo_id"><br>
                </div>

                <div class="form-group border-bottom">
                  <label for="product name">รูปไอคอนหมวดหมู่ (50x50px)</label>
                  <input type="file" class="form-control" name="icon_photo_id"><br>
                </div>
                <button type="submit" class="btn btn-primary" name="button">Submit</button>
              </form>
              </div>
            </div>


        </div>
    </section>
@endsection
