<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'เลือกร้านค้าของคุณ')

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="seller-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <h4 class="mb-4">เลือกร้านค้าของคุณ</h4>
            <div class="row is-flex">
              <div class="col-md-6  border-primary text-primary" style="border:dashed 2px;min-height:140px">
                <div class="d-flex h-100 ">
                  <div class="align-self-center text-center w-100">
                    <a href="/storemanager/create" class="text-decoration-none"><p class="text-center h5"><i class="themify ti ti-plus"></i> เพิ่มร้านค้าใหม่</p></a>
                    </div>
                </div>
              </div>
            @if($stores)
                @foreach($stores as $store)
              <div class="col-md-6  border-bottom">
                <div class="wrapper mt-3 ml-2 mr-2">
                  	<div class="icon">
                      <img class="d-inline"  style="display: block; width: 100px; height: 100px; object-fit: cover;" src="/images/{{$store->photo ? $store->photo->file : 'store_no_avatar.png'}}">
                  	</div>
                  	<div class="content">
                      	<h5 class="d-inline">{{$store->name}}</h5>
                        @if($store->is_approve==1)
                        <span class="badge badge-success">Approve</span>
                        @else
                        <span class="badge badge-secondary">Not Approve</span>
                        @endif
                        <p class="text-muted mb-1">{{$store->description}}</p>
                        <a class="btn btn-primary btn-sm" href="/storemanager/store/{{$store->username}}/dashboard" role="button">แดชบอร์ด</a>
                        <a class="btn btn-light btn-sm" href="/store/{{$store->username}}" role="button" target="_blank">ไปหน้าร้านค้า</a>
                  </div>
                  </div>
              </div>

                @endforeach
              @endif


            </div>
        </div>
    </section>





@endsection
