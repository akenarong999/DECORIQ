@extends('layouts.frontend')

@section('title')
สมัครสมาชิก - DECORIQ
@endsection

@section('content')
<div class="container p-4">
  <div class="row justify-content-center">
<div class="col-md-6 padding-0">
<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">สมัครสมาชิก</h4>
</header>
<article class="card-body">
  <form method="POST" action="{{ route('register') }}">
     @csrf
	<div class="form-row">
		<div class="col form-group">
			<label>ชื่อผู้ใช้ <small>(ภาษาอังกฤษ ไม่เว้นวรรค)</small></label>
      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

      @if ($errors->has('name'))
          <span class="invalid-feedback">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
      @endif
		</div> <!-- form-group end.// -->

	</div> <!-- form-row end.// -->
	<div class="form-group">
		<label>อีเมล</label>
    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

    @if ($errors->has('email'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
	</div> <!-- form-group end.// -->

	<div class="form-group">
		<label>รหัสผ่าน</label>
    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

    @if ($errors->has('password'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
	</div> <!-- form-group end.// -->

  <div class="form-group">
		<label>รหัสผ่าน (กรอกเหมือนข้างบน)</label>
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
	</div> <!-- form-group end.// -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">ลงทะเบียน</button>
    </div> <!-- form-group// -->
</form>
</article> <!-- card-body end .// -->
<div class="border-top card-body text-center">มีบัญชีผู้ใช้อยู่แล้ว? <a href="{{ route('login') }}">เข้าสู่ระบบ</a></div>
</div> <!-- card.// -->
</div> <!-- col.//-->

<div class="col-md-6 banner-sec p-0 d-none d-sm-none d-md-block">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <div class="img-gradient">
                <img class="d-block img-fluid" src="/images/home-decor-register-page.jpg" alt="First slide">
             </div>
              <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <h2>ข้อดีของการเป็นสมาชิก</h2>
                    <ul>
                      <li>ทราบส่วนลดสิทธิประโยชน์ก่อนใคร</li>
                      <li>สั่งซื้อได้ง่ายรวดเร็ว</li>
                      <li>ติดตามหรือจัดการการสั่งซื้อได้โดยง่ายผ่านระบบ</li>
                      <li>ได้รับการแนะนำสินค้าและแจ้งที่จัดเตรียมมาเพื่อคุณโดยเฉพาะ</li>
                      <li>เก็บสินค้าที่คุณชื่นชอบ รีวิวสินค้า หรือใช้งานคอมมูนิตี้ของเรา</li>
                    </ul>
                </div>
            </div>
            </div>
          </div>

      </div>
</div>

</div> <!-- row.//-->

</div>
@endsection
