@extends('layouts.frontend')
<meta property="og:image" content="/images/<?php echo $article->photo->file; ?>" />
@section('title')
บทความ <?php  echo $article->title; ?> - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\Store\StorePageController; ?>
<?php use \App\Http\Controllers\ProductFrontendController; ?>

<div class="container border p-0 pb-1 mt-4 mb-5">
  <div class="container p-3" style="height:400px;background-image:url(/images/{{ $article->photo ? $article->photo->file : 'cover_photo.jpg'}}); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>

  <div class="container" >
    <div class="row">
      <div class="col-2"  style="margin-top:-100px;">
        <a href="/store/<?php echo $store->username; ?>"><img class="d-inline border"  style="display: block; width: 160px; height: 160px; object-fit: cover;" src="/images/{{$store->photo ? $store->photo->file : 'store_no_avatar.png'}}"></a>
      </div>
      <div class="col-md-10 col-xs-12 pl-4 pt-3">
        <h4 class="d-inline"><?php  echo $article->title; ?></h4><br>
        <span>โดยร้าน <a href="/store/<?php echo $store->username; ?>"><?php  echo $store->name ; ?></a></span> | <span>เขียนเมื่อ <?php echo $article->created_at->diffForHumans(); ?></span><br>
      </div>
    </div>
  </div>

  <div class="container mt-5 mb-5">
     <div class="row">
       <div class="col-10 offset-1 content">
         <?php echo $article->content; ?>
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
