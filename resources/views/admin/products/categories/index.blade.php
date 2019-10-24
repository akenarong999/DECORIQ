<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
รายการหมวดหมู่สินค้าทั้งหมด - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3 mt-3 pb-2 border-bottom">
             <div class="col-6">
                <h2>รายการสินค้า</h2>
             </div>
             <div class="col-3 offset-3 text-right">
                <a href="/admin/product-categories/create" class="btn btn-primary">+ เพิ่มหมวดหมู่สินค้าใหม่</a>
             </div>
           </div><br>

           @if(session()->has('success-message'))
               <div class="alert alert-success">
                   {{ session()->get('success-message') }}
               </div>
           @endif

           <table class="table table-striped" id="table_id">
            <thead>
              <tr>
                <th>#</th>
                <th>ชื่อหมวดหมู่</th>
                <th>หมวดหมู่หลัก</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($categories as $category){ ?>
             <tr>
               <td><?php echo $category->id; ?></td>
               <td><?php echo $category->name; ?></td>
               <td><?php if($category->Category){echo $category->Category->name;}else{echo "-";} ?></td>
               <td><a href="/category/product/<?php echo $category->slug; ?>/" class="btn btn-sm btn-primary border" target="_blank">ดูหมวดหมู่</a>  <a href="/admin/product-categories/<?php echo $category->id; ?>/edit" class="btn btn-sm btn-light border">แก้ไข</a></td>
             </tr>
            <?php } ?>
            </tbody>
          </table>

          <div class="row">
            <div class="col-sm-4 offset-sm-5">
            </div>
          </div>
        </div>
    </section>
@endsection
