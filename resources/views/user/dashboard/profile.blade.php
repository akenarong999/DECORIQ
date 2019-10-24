@extends('layouts.user_dashboard')
@section('title')
Dashboard - DECORIQ
@endsection

@section('dashboardcontent')


        <div class="cover" style="height:235px;background: url(/images/{{ Auth::user()->cover_photo ? Auth::user()->cover_photo->file : 'cover.jpg' }}); background-repeat: no-repeat; background-size: cover;">
          <div class="row" style="padding-top:190px; text-align:center;">
            <div class="col-12">
              <img class="rounded-circle d-inline" style="border:white 3px solid;" width="96" src="/images/{{Auth::user()->photo ? Auth::user()->photo->file : 'no_avatar.png'}}">
              <div class="d-inline">
                <h3><?php if(empty(Auth::user()->firstname)){ echo Auth::user()->name; }else{ echo Auth::user()->firstname.' '.Auth::user()->lastname; } ?></h3>
                  <div id="profile-link">
                    <a href="/user/<?php echo Auth::user()->name; ?>"><i class="fas fa-external-link-alt"></i> ดูหน้าโปรไฟล์</a>
                  </div>
                  <div id="status_message"><span class="text-muted"><?php if(!empty(Auth::user()->status_message)){ echo Auth::user()->status_message; }else{ echo "เขียนข้อความที่บอกความเป็นคุณที่นี่..."; }  ?><a href="javascript:editStatusMessage()" class="ml-1"><i class="themify ti ti-pencil mt-1" ></i></a></span></div>
                  <div id="status_message_form" class="form-group row" style="display:none;">
                    <div class="col-8 offset-3">
                      <form class="form-inline" action="/dashboard/updatestatusmessage" method="get">
                        <input class="form-control form-control-sm col-7" id="status_message" name="status_message" value="<?php if(!empty(Auth::user()->status_message)){ echo Auth::user()->status_message; } ?>" placeholder="เขียนข้อความที่บอกความเป็นคุณที่นี่..." type="text"><button type="submit" class="btn-sm btn-success ml-2">อัพเดท</button><button type="button" onClick="javascript:hideEditStatusMessageForm()" class="btn-sm btn-light ml-1">X</button>
                      </form>
                    </div>
                  </div>
              </div>

            </div>

          </div>
        </div>
        <div class="row" style="margin-top:180px;">
          <div class="col-2">
          </div>
          <div class="col-2 border p-3 text-center">
              <i class="far fa-user-circle"></i><br>
              ติดตาม
              <h5>33</h5>
          </div>
          <div class="col-2 border p-3 text-center">
            <i class="fas fa-users"></i><br>
              ผู้ติดตาม
              <h5>33</h5>
          </div>
          <div class="col-2 border p-3 text-center">
            <i class="far fa-heart"></i><br>
              ที่เก็บไว้
              <h5>33</h5>
          </div>
          <div class="col-2 border p-3 text-center">
            <i class="far fa-edit"></i><br>
              ออเดอร์รีวิว<br>
              <h5>33</h5>
          </div>
          <div class="col-2">
          </div>

        </div>



@endsection
