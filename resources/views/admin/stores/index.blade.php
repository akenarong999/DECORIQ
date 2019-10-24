<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
ร้านค้าทั้งหมด - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3 mt-3 pb-2 border-bottom">
             <div class="col-6">
                <h2>รายการร้านค้า</h2>
             </div>
           </div>



           <table class="table table-striped" id="table_id">
            <thead>
              <tr>
                <th>#</th>
                <th></th>
                <th>ร้าน</th>
                <th>การอนุมัติ</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($stores as $store){ ?>
                <tr>
                  <td><?php echo $store->id; ?></td>
                  <td><?php if(!$store->photo==NULL){ ?><img src="/images/<?php echo $store->photo->file; ?>" class="d-inline" style="display: block; width: 48px; height: 48px; object-fit: cover;"><?php }else{ ?><img src="/images/store_no_avatar.png"  class="d-inline" style="display: block; width: 48px; height: 48px; object-fit: cover;"><?php } ?></td>
                  <td><?php echo $store->name; ?></td>
                  <td class="pt-0">
                      <label class="onoff-switch">
                          <input type="checkbox" class="onoff-switch-input" name="onoff_switch" value="{{$store->id}}"
                          <?php
                          if($store->is_approve==1)
                          {
                            echo "checked";
                          }?>>
                          <span class="onoff-slider"></span>
                      </label>
                  </td>
                  <td><a href="/store/<?php echo $store->username ?>" target="_blank">ดูร้านค้า</a> | <a href="#">แก้ไขร้านค้า</a></td>



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
