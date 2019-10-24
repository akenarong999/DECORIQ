<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title')
บทความของร้าน {{$store->name}} - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection
<?php use \App\Http\Controllers\StoreManager\ProductsController; ?>

@section('content')

  <section id="seller-dashboard-product-main">
    <div class="container bg-white border mt-3 mb-3 pl-3 pr-3 pb-3 pt-5">
      <div class="row mb-4 pl-4 pr-4">
       <div class="col-10">
          <h3><i class="themify ti ti-write"></i> บทความของร้าน {{$store->name}}</h3>
       </div>
       @if(session()->has('success'))
            <div class="alert alert-success m-3">
                {{ session()->get('success') }}
            </div>
        @endif
       <div class="col-2 text-right">
          <a class="btn btn-primary" href="/storemanager/store/{{$store->username}}/articles/create">
            <i class="themify ti ti-plus font-weight-bold"></i> เพิ่มบทความใหม่
          </a>
       </div>
       </div>

      <div class="row">
         <?php foreach($articles as $article){ ?>
           <div class="col-6">
             <div class="row mb-4 pl-4 pr-4">
              <div class="col-4">
                <img src="/images/<?php echo $article->photo->file; ?>" class="d-inline w-100" style="display: block;  object-fit: cover;">
              </div>
              <div class="col-8">
                <h5><a href="/store/<?php echo $store->username; ?>/articles/<?php echo $article->id ?>/" class="text-black"><?php echo $article->title; ?></a></h5>
                <span>
              <?php if (strlen($article->content) > 100)
                    {
                    $maxLength = 99;
                    $content = substr($article->content, 0, $maxLength);
                    echo $content.'...';
                  } ?><a href="/store/<?php echo $store->username; ?>/articles/<?php echo $article->id ?>/">(อ่านทั้งหมด)</a>
                </span>
              </div>
              </div>
           </div>
           <?php }  ?>
         </div>

    </div>
   </section>

@endsection
