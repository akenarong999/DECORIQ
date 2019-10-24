@extends('layouts.frontend')

@section('title')
<?php echo $page->title?> - DECORIQ
@endsection

@section('content')


<div class="container border-left border-right border-bottom p-0 pb-1 mb-4">
  <div class="container p-3" style="height:400px;background-image:url(/images/{{ $page->photo ? $page->photo->file : 'cover_photo.jpg'}}); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>

  <div class="container" >
    <div class="row">
      <div class="col-md-12 col-xs-12 pt-5  text-center">
        <h1 class="d-inline"><?php  echo $page->title; ?></h1><br>
      </div>
    </div>
  </div>

  <div class="container mt-3 mb-5">
     <div class="row">
       <div class="col-10 offset-1 content">
         <?php echo $page->content; ?>
       </div>
     </div>
  </div>

  </div>
</div>

<style>
.content img{
  max-width:100%;
  height:auto;
}

@media only screen and (max-width: 600px) {
  .content img{
    max-width:100%;
    height:auto;
  }
}
</style>

@endsection
