@extends('layouts.frontend')

@section('title')
โปรไฟล์ <?php if(!$user->firstname){echo $user->name;}else{ echo $user->firstname.' '.$user->lastname; } ?> - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\User\UserPageController; ?>

<div class="container border p-0 pb-1 mt-4">
  <div class="container p-3" style="height:300px;background-image:url(/images/{{ $user->cover_photo ? $user->cover_photo->file : 'cover_photo.jpg'}}); background-size: cover; background-repeat: no-repeat; background-position: center center;">

  </div>

  <div class="container" >
    <div class="row" >
      <div class="col-md-2 col-xs-12"  style="margin-top:-100px;">
        <img class="d-inline border"  style="display: block; width: 160px; height: 160px; object-fit: cover;" src="/images/{{$user->photo ? $user->photo->file : 'no_avatar.png'}}">
      </div>
      <div class="col-md-10 col-xs-12 pt-3">
        <?php if(empty($user->firstname)){ echo '<h4>'.$user->name.'</h4>'; }else{ echo '<h4 class="d-inline">'.$user->firstname.' '.$user->lastname.'</h4> <span class="text-muted">(@'.$user->name.')</span>'; } ?><br>
      </div>
    </div>
  </div>

  <div class="container mb-4">
    <div class="row">
      <div class="col-10 offset-2">
       <?php if(Auth::check()){ ?>
        <?php if($user->id!=Auth::user()->id){ ?>
        <a href="/user/<?php echo $user->name; ?>/sendmessage" class="btn btn-light"><i class="far fa-comments" aria-hidden='true'></i> ส่งข้อความ</a>
          <?php if(UserPageController::checkIfFollowThisUser($user->id)){ ?>
            <a href="/user/<?php echo $user->name; ?>/dounfollow" class="follow btn btn-success" onmouseover="change_follow_btn();" onmouseout="normal_follow_btn();"><i class='fa fa-check' aria-hidden='true'></i> ติดตามแล้ว</a>
          <?php }else{ ?>
            <a href="/user/<?php echo $user->name; ?>/dofollow" class="btn btn-primary"><i class='fa fa-user-plus' aria-hidden='true'></i> ติดตาม</a>
       <?php
           }
        }
      }
         ?>
        <span class="d-inline  ml-2 pl-2 border-left"><i class="fas fa-user-friends"></i> ติดตาม <?php echo UserPageController::countFollowing($user->id); ?> / ผู้ติดตาม <?php echo UserPageController::countFollower($user->id); ?> </span>
      </div>

    </div>
 </div>

</div>

  <div class="container mt-5 mb-3">
    <div class="row">
      <div class="col-3 p-3">
        <h5 class="border-bottom pb-2">เกี่ยวกับฉัน</h5>
        <?php if(!empty($user->status_message)){ echo '<span class="text-muted">'.$user->status_message.'</span>'; } ?>
        <h5 class="border-bottom pb-2 mt-4">รูปภาพ</h5>
          <?php
          $i=0;
          foreach($timeline_posts as $timeline_post){ ?>
            <?php
              $count_all_photos = UserPageController::countAllTimelinePhotos($user->id);
              foreach($timeline_post->photos as $photo){
                if($i<8){ ?>
                  <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="gallery-<?php echo $user->id; ?>-gallery">
                    <img class="d-inline mt-1" style="display: block; width: 65px; height: 65px; object-fit: cover;" src="/images/{{ $photo->file }}"></a>
                  </a>
              <?php $i++;
            }elseif($i==8){?>
              <div class="image d-inline" style="position: relative; width: 100%;">
                <a href="#">
                  <img class="d-inline mt-1" style="display: block; width: 65px; height: 65px; object-fit: cover; background-color: black; opacity: 0.5; filter: alpha(opacity=50);" src="/images/{{ $photo->file }}">
                  <h4 style="position: absolute; top: 0; left: 0; padding-left: 25px;width: 100%; color:black; font-weight:bolder">+<?php $count_all_photos-=9;echo $count_all_photos; ?></h4>
                </a>
              </div>
              <?php $i++;
            }
                } ?>
          <?php } ?>

        <h5 class="border-bottom pb-2 mt-4">ติดตาม</h5>
           <?php $user_followings = UserPageController::getFollowing($user->id);
           foreach($user_followings as $user_following){ ?>
             <a href="/user/<?php echo $user_following->following->name; ?>" title="<?php echo $user_following->following->name; ?>"><img class="d-inline"  style="display: block; width: 55px; height: 55px; object-fit: cover; margin-top:6px;" src="/images/{{$user_following->following->photo ? $user_following->following->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"></a>
           <?php  }  ?>
        <h5 class="border-bottom pb-2 mt-4">ผู้ติดตาม</h5>
            <?php $user_followers = UserPageController::getFollower($user->id);
            foreach($user_followers as $user_follower){ ?>
              <a href="/user/<?php echo $user_follower->follower->name; ?>" title="<?php echo $user_follower->follower->name; ?>"><img class="d-inline"  style="display: block; width: 55px; height: 55px; object-fit: cover;  margin-top:6px;" src="/images/{{$user_follower->follower->photo ? $user_follower->follower->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"></a>
            <?php   }  ?>
      </div>
      <div class="col-9">
        <div class="row mb-5">
          <div class="col-12 pl-0 pr-0">
            <div id="product-tab" class="container">
              <ul class="nav nav-pills">
                <li class="active p-2 pr-4 pl-4"><a data-toggle="tab" href="#timeline"><h5>ไทม์ไลน์</h5></a></li>
                <li class="p-2 pr-4 pl-4"><a data-toggle="tab" href="#about"><h5>เกี่ยวกับ</h5></a></li>
              </ul>




              <div class="tab-content border-top p-3 pt-2">
                <div id="timeline" class="tab-pane active">

                  <?php if(Auth::user()){ ?>
                    <div class="container">
                      <div class="row">
                          <div class="col-12 p-0">
                            <div class="panel panel-default">

                             <form action="/user/<?php echo $user->name ?>/addnewpost" method="post"  enctype="multipart/form-data">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <div class="panel-body p-2">
                                   <input type="text" name="message" class="form-control" placeholder="เขียนข้อความได้ที่นี่...">
                                 </div>
                                 <div class="panel-footer p-2">
                                   <div class="btn-group">
                                   <!--  <button type="button" class="btn btn-link btn-icon"><i class="fa fa-users"></i></button> -->
                                     <button type="button" onclick="showPostUploadPhotoInput()" class="btn btn-link btn-icon"><i class="fa fa-camera"></i></button>

                                   </div>
                                   <div class="float-right">
                                     <button type="submit" class="btn btn-primary">โพสต์</button>
                                   </div>
                                   <div id="post-upload-photo-input" style="display:none">
                                      <input type="file" name="post_photos">
                                   </div>
                                 </div>
                              </form>

                         </div>
                       </div>
                      </div>
                    </div>
                    <?php } ?>

                  <?php foreach($timeline_posts as $timeline_post){ ?>
                    <div class="row mt-2">
                      <div class="col-12  p-3 border">
                        <div class="row">
                          <div class="col-1">
                            <a href="/user/<?php echo $timeline_post->poster->name; ?>" title="<?php echo $timeline_post->poster->name; ?>"><img class="d-inline"  style="display: block; width: 50px; height: 50px; object-fit: cover;" src="/images/{{ $timeline_post->poster->photo ? $timeline_post->poster->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"></a>
                          </div>
                          <div class="col-11">
                            <h6><a href="/user/<?php echo $timeline_post->poster->name; ?>"><?php if(!$timeline_post->poster->firstname){echo $timeline_post->poster->name;}else{ echo $timeline_post->poster->firstname.' '.$timeline_post->poster->lastname; } ?></a></strong><br>
                            <small class="text-muted"><?php echo $timeline_post->created_at->diffForHumans(); ?></small></h6>
                            <?php echo $timeline_post->message; ?><br>
                            <?php foreach($timeline_post->photos as $photo){ ?>
                              <a href="/images/<?php echo $photo->file; ?>" data-toggle="lightbox" data-gallery="timeline-post-<?php echo $timeline_post->id; ?>-gallery">
                                <img class="d-inline p-1" style="display: block; width: 150px; height: 150px; object-fit: cover;" src="/images/<?php echo $photo->file; ?>"></a>
                              </a>
                            <?php } ?>


                            <?php if(Auth::check()){ ?>

                            <div class="mt-2 p-2"><a class="text-primary  border pl-1 pr-1" style="cursor: pointer;" onclick="showCommentform(<?php echo $timeline_post->id; ?>)"><small><i class="themify ti ti-comment"></i> ตอบกลับ</small></a></span>

                            <?php $comments = UserPageController::getPostComments($timeline_post->id);  ?>

                            <?php  foreach($comments as $comment){ ?>
                                <div class="row mt-2 pt-2 border-top">
                                  <div class="col-1">
                                    <a href="/user/<?php echo $comment->commentator->name; ?>" title="<?php echo $comment->commentator->name; ?>"><img class="d-inline"  style="display: block; width: 50px; height: 50px; object-fit: cover;" src="/images/{{  $comment->commentator->photo ? $comment->commentator->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"></a>
                                  </div>
                                  <div class="col-11 pt-1">
                                    <h6 class="mb-0"><a href="/user/<?php echo $comment->commentator->name; ?>"><?php if(!$comment->commentator->firstname){echo $comment->commentator->name;}else{ echo $comment->commentator->firstname.' '.$comment->commentator->lastname; } ?></a></strong><br>
                                    <small class="text-muted"><?php echo $comment->created_at->diffForHumans(); ?></small></h6>
                                    <span><?php echo $comment->message; ?></span>
                                  </div>
                                </div>
                             <?php } ?>
                            <div id="post-<?php echo $timeline_post->id; ?>" style="display:none;">
                              <form action="/user/<?php echo $user->name ?>/addnewpostcomment" method="get">
                              <div class="row mt-2">
                                <div class="col-1">
                                  <img class="d-inline"  style="display: block; width: 40px; height: 40px; object-fit: cover;" src="/images/{{ Auth::user()->photo ? Auth::user()->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}">
                                </div>
                                  <div class="col-9">
                                    {{ Form::hidden('post_id', Crypt::encrypt($timeline_post->id)) }}
                                    <input class="form-control" type="text" name="message" value="">
                                  </div>
                                  <div class="col-1">
                                    <button type="submit" class="btn btn-primary">ตอบ</button>
                                  </div>

                              </div><!-- row -->
                            </form>
                            </div>
                          </div>
                          <?php } ?>

                        </div>
                      </div>
                    </div>

                  </div>
                  <?php } ?>
              </div>

                <div id="about" class="tab-pane">
                  Y
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
