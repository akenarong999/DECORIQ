@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')
<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-cogs"></i> แก้ไขรูปโปรไฟล์และหน้าปก</h3>

    <form action="/dashboard/settings/profilephoto/update" method="POST" enctype="multipart/form-data">

     {{ csrf_field() }}

      <div class="row mt-4">
        <div class="col-12">
          <div class="form-group">
            <label for="profile picture">รูปโปรไฟล์ :</label>
            <?php
             // define uploads path
             $public_path = public_path();
             $uploadDir = $public_path.'/images/';

             if(isset($user->photo->file)){
               // add file to our array
               $preloadedFiles = array(
                 "name" => $user->photo->file,
                 "type" => 'image/*',
                 "size" => filesize($uploadDir . $user->photo->file),
                 "file" => url('images/') .'/'. $user->photo->file,
                 "data" => array(
                   "url" => url('images/').'/'. $user->photo->file,
                   "thumbnail" => $uploadDir. $user->photo->file ? url('images/').'/'.  $user->photo->file : null,
                  ),);
               }
               // convert our array into json string
               if(!empty($preloadedFiles)){
                     $preloadedFiles = json_encode($preloadedFiles);
               }
               else{
                 $preloadedFiles = '';
               }
               ?>
               <input type="file" id="profilephoto" name="profilephoto" data-fileuploader-files='<?php echo $preloadedFiles;?>'>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="cover photo">รูปหน้าปก :</label>

               <?php
                // define uploads path
                $public_path = public_path();
                $uploadDir = $public_path.'/images/';

                if(isset($user->cover_photo->file)){
                // add file to our array
                $preloadedFiles1 = array(
                  "name" => $user->cover_photo->file,
                  "type" => 'image/*',
                  "size" => filesize($uploadDir . $user->cover_photo->file),
                  "file" => url('images/') .'/'. $user->cover_photo->file,
                  "data" => array(
                    "url" => url('images/').'/'. $user->cover_photo->file,
                    "thumbnail" => $uploadDir. $user->cover_photo->file ? url('images/').'/'.  $user->cover_photo->file : null,
                   ),);
                 }
                  // convert our array into json string
                  if(!empty($preloadedFiles1)){
                        $preloadedFiles1 = json_encode($preloadedFiles1);
                  }
                  else{
                    $preloadedFiles1 = '';
                  }
                  ?>
                  <input type="file" id="coverphoto" name="coverphoto" data-fileuploader-files='<?php echo $preloadedFiles1;?>'>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-lg btn-block">อัพเดท</button>
        </div>
      </div>

    </form>

</div>



@endsection
