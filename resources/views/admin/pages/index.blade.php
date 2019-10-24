<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')
<?php use \App\Http\Controllers\Admin\AdminOrdersController; ?>
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3 mt-3 pb-2 border-bottom">
             <div class="col-6">
                <h2>หน้าเนื้อหาบนเว็บ</h2>
             </div>
           </div>

           <div class="container">
             <div class="row">
               <div class="col-12">
                 @if ( Session::has('delete_success') )
                    <div class="alert alert-success">
                        <span>{{ Session::get('delete_success') }}</span>
                    </div>
                  @endif
               </div>
             </div>
           </div>


           <table class="table table-hover" id="table_id">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">หัวข้อ</th>
                <th scope="col">ผู้เขียน</th>
                <th scope="col">วันที่เขียน</th>
                <th scope="col">สถานะ</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @if($pages)
                @foreach($pages as $page)
                  <tr>
                    <td>{{$page->id}}</td>
                    <td><strong>{{$page->title}}</strong></td>
                    <td><img src="/images/{{$page->user->photo->file}}" class="rounded-circle d-inline" style="display: block; width: 18px; height: 18px; object-fit: cover;"> {{$page->user->name}}</td>
                    <td>{{$page->created_at}}</td>
                    <td>{{$page->is_publish}}</td>
                    <td>
                      <a href="/admin/pages/edit/{{$page->id}}">แก้ไข</a>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>

        </div>
    </section>
@endsection
