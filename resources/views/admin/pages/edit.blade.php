<!-- Stored in resources/views/child.blade.php -->
<?php include_once(app_path().'/includes/class.fileuploader.php'); ?>
@extends('layouts.admin')

@section('title')
แก้ไข {{$page->title}} - DECORIQ
@endsection

@section('sidebar')
    @parent

@endsection

@section('content')

  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5 mb-3">
       <h1>แก้ไข {{$page->title}}</h1><br>

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

       {!! Form::model($page,['method'=>'PATCH', 'action'=>['Admin\AdminPagesController@update',$page->id],'files'=>true,'id'=>'editpageform']) !!}
       <div class="form-group">
         <label for="product name">หัวข้อหน้า</label>
         {!! Form::text('title',null,['class'=>'form-control']) !!}
       </div>
       <div class="form-group mb-4 mt-4">
         <label for="product name">รูปภาพของหน้า <span class="text-muted">(*รูปภาพแรกจะเป็นหน้าปกของหน้า)</span></label><br>
         <?php
          // define uploads path
          $public_path = public_path();
          $uploadDir = $public_path.'/images/';

					// add file to our array
					$preloadedFiles[] = array(
						"name" => $page_cover_photo->file,
						"type" => 'image/*',
						"size" => filesize($uploadDir . $page_cover_photo->file),
						"file" => url('images/') .'/'. $page_cover_photo->file,
						"data" => array(
							"url" => url('images/').'/'. $page_cover_photo->file,
              "thumbnail" => $uploadDir. $page_cover_photo->file ? url('images/').'/'.  $page_cover_photo->file : null,
						 ),);

    				// convert our array into json string
            if(!empty($preloadedFiles)){
    				      $preloadedFiles = json_encode($preloadedFiles);
            }
            else{
              $preloadedFiles = '';
            }

            ?>
          <input type="file" name="pagefile" data-fileuploader-files='<?php echo $preloadedFiles;?>'>

        </div>

        <div class="form-group">
            <label for="product-long-description">เนื้อหา</label>
            {!! Form::textarea('content',null,['class'=>'form-control','id'=>'summernote']) !!}
        </div>

          <hr>

        <button type="submit" class="btn btn-primary btn-lg col-12" name="submit">แก้ไขข้อมูลหน้านี้</button>
      </form>

 </div>
   </section>





@endsection
