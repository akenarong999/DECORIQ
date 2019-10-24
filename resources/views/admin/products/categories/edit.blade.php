<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
แก้ไขหมวดหมู่สินค้า - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3 mt-3 pb-2 border-bottom">
             <div class="col-6">
                <h2>แก้ไขหมวดหมู่สินค้า: <?php echo $category->name; ?></h2>
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
                {!! Form::model($category,['method'=>'PATCH', 'action'=>['Admin\AdminProductsController@updateProductCategory',$category->id],'files'=>true,'id'=>'editcategoryform']) !!}
                <div class="form-group">
                  <label for="product name">ชื่อสินค้า</label>
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
                    <option value="<?php echo $all_parent_category->id; ?>" <?php if($category->category_id==$all_parent_category->id){ echo "selected";} ?>><?php echo $all_parent_category->name; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group border-bottom mb-5 pb-5">
                  <label for="product name">รูปโปรไฟล์หมวดหมู่</label>
                  <input type="file" class="form-control" name="profile_photo_id"><br>
                  <?php if($category->profile_photo_id) { ?><img src="/images/<?php echo $category->profile_photo->file; ?>" width="100"><?php }else{ ?> <img src="https://via.placeholder.com/600x90.png?text=No+image" width="600">  <?php } ?>
                </div>

                <div class="form-group border-bottom mb-5 pb-5">
                  <label for="product name">รูปหน้าปกหมวดหมู่ (1110x300px)</label>
                  <input type="file" class="form-control" name="cover_photo_id"><br>
                  <?php if($category->cover_photo_id) { ?><img src="/images/<?php echo $category->cover_photo->file; ?>" width="600"><?php }else{ ?> <img src="https://via.placeholder.com/600x90.png?text=No+image" width="600">  <?php } ?>
                </div>

                <div class="form-group border-bottom mb-5 pb-5">
                  <label for="product name">รูปไอคอนหมวดหมู่ (50x50px)</label>
                  <input type="file" class="form-control" name="icon_photo_id"><br>
                  <div class="bg-dark"><?php if($category->icon_photo_id) { ?><img src="/images/<?php echo $category->icon_photo->file; ?>" width="50"><?php }else{ ?> <img src="https://via.placeholder.com/600x90.png?text=No+image" width="600">  <?php } ?></div>
                </div>
                <button type="submit" class="btn btn-primary" name="button">Submit</button>
              </form>
              </div>
            </div>


        </div>
    </section>
@endsection
