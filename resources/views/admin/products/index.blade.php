<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
รายการสินค้าทั้งหมด - DECORIQ
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
                <h5><a href="/admin/product-categories">จัดการหมวดหมู่สินค้า</a></h5>
             </div>
           </div>

           <table class="table table-striped" id="table_id">
            <thead>
              <tr>
                <th>#</th>
                <th>ชื่อสินค้า</th>
                <th>ร้าน</th>
                <th>การอนุมัติ</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($products as $product){ ?>
                <tr>
                  <td><?php echo $product->id; ?></td>
                  <td><img src="/images/<?php echo $product->product_photos[0]->name; ?>" class="d-inline" style="display: block; width: 40px; height: 40px; object-fit: cover;"> <?php echo $product->name; ?></td>
                  <td><img src="/images/<?php echo $product->store->photo->file; ?>" class="d-inline" style="display: block; width: 24px; height: 24px; object-fit: cover;"> <?php echo $product->store->name; ?></td>
                  <td class="pt-0">
                      <label class="onoff-switch">
                          <input type="checkbox" class="onoff-switch-input" name="onoff_switch" value="{{$product->id}}"
                          <?php
                          if($product->product_status_id==2)
                          {
                            echo "checked";
                          }?>>
                          <span class="onoff-slider"></span>
                      </label>
                  </td>
                  <td><a href="/product/<?php echo $product->slug; ?>" target="_blank">ดูสินค้า</a> | <a href="/admin/product/edit/<?php echo $product->id; ?>">แก้ไขสินค้า</a></td>



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
