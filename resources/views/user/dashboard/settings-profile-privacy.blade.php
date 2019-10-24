@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')
<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-cogs"></i> แก้ไขข้อมูลส่วนตัว</h3>

    <div class="mt-4 p-4 border">

        <h4>- แก้ไขรหัสผ่าน</h4>
            @if ($message = Session::get('password-change-success'))
            <div class="alert alert-success alert-block mt-3">
             <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $message }}
            </div>
            @endif
            @if ($errormessage = Session::get('error'))
            <div class="alert alert-danger alert-block mt-3">
             <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $errormessage }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-block p-1">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li style="list-style:none;">{{ $error }}</li>
                    @endforeach
                          </ul>
                      </div>
               @endif
            <form action="/dashboard/settings/privacy/changepassword" method="post">
              {{ csrf_field() }}
              <div class="row border-bottom">
              <div class="col-12">
                <div class="form-group">
                  <label for="currentpassword">รหัสผ่านปัจจุบัน :</label>
                  <input type="password" class="form-control" name="current-password" id="currentpassword">
                </div>
              </div>
            </div>
            <div class="row mt-3">
            <div class="col-12">
              <div class="form-group">
                <label for="newpassword">รหัสผ่านใหม่ :</label>
                <input type="password" class="form-control" name="new-password" id="newpassword">
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="newpasswordconfirm">รหัสผ่านใหม่(กรอกเหมือนด้านบน) :</label>
              <input type="password" class="form-control" name="new-password_confirmation" id="newpasswordconfirm">
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

</div>



@endsection
