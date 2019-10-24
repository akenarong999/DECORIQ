<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.backend')

@section('title', 'การจัดส่งของร้าน '.$store->name)

@section('sidebar')
    @parent
@endsection


@section('content')
    <section id="seller-dashboard-shipping">
       <div class="container bg-white border mt-3 mb-4 p-5">
         <div class="row">
           <div class="col-9 mb-3"><h1>การจัดส่ง</h1></div>
           <div class="col-3 text-right">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddShippingModal">
                <i class="themify ti ti-plus font-weight-bold"></i> เพิ่มรูปแบบการจัดส่ง</button></div>
            </div>
            <div class="row">
                <div class="col-12">
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
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
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="AddShippingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มการจัดส่งใหม่</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     {{Form::open(['method'=>'POST', 'action'=>array('StoreManager\ShippingsController@store',$store->username),'files'=>true,'id'=>'createshippingform'])}}
                      <div class="form-group">
                        <label for="Shipping method name">ชื่อการจัดส่ง</label>
                        <input type="text" class="form-control" id="ShippingMethodName" name="name">
                        {{ Form::hidden('store_id', Crypt::encrypt($store->id)) }}
                      </div>
                      <div class="form-group">
                        <label for="Shipping type">รูปแบบการจัดส่ง</label>
                        <select multiple class="form-control" id="shippingType" name="type">
                          <option value="flat">ราคาเดียว (Flat rate)</option>
                          <option value="weight">ราคาตามน้ำหนัก (Weight based)</option>
                          <option value="free">จัดส่งฟรี (Free shipping)</option>
                        </select>
                        <small id="addshippingmethodHelp" class="form-text text-muted">หมายเหตุ: คุณจะสามารถเพิ่ม/เปลี่ยนแปลงค่าบริการการจัดส่งได้ในภายหลัง</small>
                      </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" form="createshippingform">เพิ่มการจัดส่ง</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        <div class="pb-4 mb-5 border-bottom">
          <div class="row">
            @if($shippings->count() > 0)
            @foreach($shippings as $shipping)

                <div class="col-sm-6 col-md-3 mb-2">
                  <div class="card">
                    @if(is_null($shipping->file)) <img class="card-img-top" height="250" src="/images/no-shipping-image.png"> @else <img class="card-img-top" height="250" src="/images/{{$shipping->file}}"> @endif
                   <div class="card-body">
                     <h4 class="card-title mb-0">{{ $shipping->name }}</h4>
                     <span class="text-muted font-italic">(
                       <?php
                         if($shipping->type=='flat'){
                           echo "ราคาเดียว";
                         }
                         elseif($shipping->type=='weight'){
                           echo "ราคาตามน้ำหนัก";
                         }
                         else{
                           echo "จัดส่งฟรี";
                         }
                       ?>
                       )</span><br>
                     <a href="{{ url('/storemanager/store/'.$store->username.'/shippings/'.$shipping->shippingsId.'/detail') }}" title="แสดงรายละเอียดการจัดส่ง" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="watch"><i class="ti ti-eye"></i></a>
                     <a href="/storemanager/store/{{$store->username}}/shippings/{{$shipping->shippingsId}}/edit" title="แก้ไขการจัดส่ง" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="watch"><i class="ti ti-pencil"></i></a>
                     {{ Form::open(['method'=>'DELETE','action'=>['StoreManager\ShippingsController@destroy',$store->username, $shipping->shippingsId],'class'=>'d-inline']) }}
                     <button type="submit" onclick="return confirm('คุณต้องการจะลบการขนส่งนี้จริงหรือ?')" class="btn btn-sm btn-outline-secondary">
                        <i class="themify ti ti-trash"></i>
                     </button>
                     {{ Form::close() }}


                    <!-- <label class="float-right switch mt-1">
                       <input type="checkbox" checked>
                       <span class="slider round" data-toggle="tooltip" data-placement="bottom" title="active/deactive"></span>
                    </lable>-->
                   </div>
                  </div>
                </div>

            @endforeach
            @else
             ไม่มีการจัดส่ง
            @endif
          </div>
         </div>


       </div>
    </section>
@endsection
