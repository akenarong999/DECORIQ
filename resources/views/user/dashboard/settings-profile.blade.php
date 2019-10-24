@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')
<?php use \App\Http\Controllers\User\DashboardController; ?>

<div class="row p-5">
  <div class="col-12">
    <h3><i class="fas fa-cogs"></i> แก้ไขโปรไฟล์</h3>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block mt-3">
    	<button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
    @endif
    <form action="/dashboard/settings/profile/update/" method="get">

        <div class="row mt-4 mb-4">
          <div class="col-12">
            <span for="username"><strong>ชื่อผู้ใช้:</strong> <?php echo $user->name; ?> (ไม่สามารถเปลี่ยนแปลงได้)</span>
          </div>
        </div>
        <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="firstname">ชื่อ :</label>
            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $user->firstname; ?>">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="lastname">นามสกุล :</label>
            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $user->lastname; ?>">
          </div>
        </div>
      </div>


      <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label for="lastname">เบอร์โทรศัพท์ :</label>
          <input type="text" class="form-control" name="tel_number" id="tel_number" value="<?php echo $user->tel_number; ?>">
        </div>

      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="fisrtname">อีเมล :</label>
          <div><?php echo $user->email; ?> (ไม่สามารถเปลี่ยนแปลงได้)</div>
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



@endsection
