@extends('layouts.frontend')

@section('title')
เข้าสู่ระบบ - DECORIQ
@endsection

@section('content')
<div class="container p-4">
  <div class="row">
    <div class="col-12">
      <section class="login-block">
      <div class="container">
    	<div class="row" style="display:flex;">
    		<div class="col-md-5 padding-0">
          <div class="card">
          <header class="card-header">
            <h4 class="card-title mt-2">เข้าสู่ระบบ</h4>
          </header>
          <article class="card-body">
            <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
              <div class="form-group">
                <label for="exampleInputEmail1" class="text-uppercase">อีเมล</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

              </div>
              <div class="form-group">
                <label for="exampleInputPassword1" class="text-uppercase">รหัสผ่าน</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  ลืมรหัสผ่าน
                </a>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>


                <div>

                 <a href="{{ route('register') }}" class="btn btn-light border">สมัครสมาชิก</a>

                <button type="submit" class="btn btn-primary float-right">
                  เข้าสู่ระบบ
                </button>
                <label class="form-check-label float-right mt-2 mr-2">
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> จำไว้ในระบบ
                </label>
              </div>

            </form>
            <br>

            <div class="d-flex mt-2">
                <hr class="my-auto flex-grow-1">
                <div class="px-4">หรือ</div>
                <hr class="my-auto flex-grow-1">
            </div>
            <br>
            <div>
              <center><a href="/login/facebook/"><img style="max-width:70%;" src="/images/continue_with_facebook.png"></a></center>
            </div>
            <div class="mt-2">
              <center><a href="/login/google/"><img style="max-width:70%;" src="/images/continue_with_google.png"></a></center>
            </div>
          </article>
        </div>
    		</div>

    		<div class="col-md-7 banner-sec padding-0 d-none d-sm-none d-md-block">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <div class="img-gradient">
            <img class="d-block img-fluid" src="/images/home-decor-login-slide.jpg" alt="First slide">
         </div>
          <div class="carousel-caption d-none d-md-block">
            <div class="banner-text">
                <h2>หาของแต่งบ้านที่ต้องการ</h2>
                <p>หากคุณเป็นผู้ที่รักการแต่งบ้าน ที่นี่มีสินค้าของแต่งบ้าน เฟอร์นิเจอร์ ของใช้ในบ้านที่รวบรวมเอาไว้ให้เลือกสรรมากมาย</p>
            </div>
      </div>
        </div>

        <div class="carousel-item h-100">
          <div class="img-gradient">
            <img class="d-block img-fluid" src="/images/service-login-slide.jpg" alt="First slide">
          </div>
          <div class="carousel-caption d-none d-md-block">
            <div class="banner-text">
                <h2>ขายของแต่งบ้านให้ลูกค้ามากมาย</h2>
                <p>สินค้าในร้านของคุณอาจเป็นที่หมายปองของลูกค้ามากมาย เพิ่มโอกาสในการขายเพียงนำสินค้ามาลงกับเว็บของเรา รับรองว่าต้องขายออกแน่นอน</p>
            </div>
        </div>
        </div>

        <div class="carousel-item">
          <div class="img-gradient">
            <img class="d-block img-fluid" src="/images/partner-login-slide.jpg" alt="First slide">
          </div>
          <div class="carousel-caption d-none d-md-block">
            <div class="banner-text">
                <h2>นำเสนอไอเดีย</h2>
                <p>หากท่านคือสถาปนิก นักออกแบบ ไม่ว่าจะเป็นองค์กร นักออกแบบมืออาชีพ หรือแม้แต่บุคคลทั่วไป ที่มีความสนใจในงานเกี่ยวบ้าน คุณสามารถสร้างรายได้ด้วยการนำเสนอไอเดียงานบริการลงสู่เว็บไซต์แห่งนี้เพื่อให้ลูกค้าที่สนใจได้เลือกสั่ง</p>
            </div>
        </div>
        </div>

      </div>

    		</div>
    	</div>
    </div>


    </div>
  </section>

  </div>
</div>
</div>


@endsection
