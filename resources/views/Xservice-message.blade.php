@extends('layouts.frontend')
@section('title')
{{$service->name}} - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\ServiceMessageController; ?>

<div class="container mt-0">
  <div class="row border-right border-left">
    <div class="col-1 p-3">
      <img class="d-inline"  style="display: block; width: 100%; height: auto; object-fit: cover;" src="/images/<?php echo $service_photos[0]->name ?>">
    </div>
    <div class="col-7 border-right p-3">
      <h3 class="mt-2 d-inline"><?php echo $service->name; ?></h3><br>
      <img class="rounded-circle d-inline"  style="width: 30px; height: 30px; border:lightgray 1px solid; object-fit: cover;" src="/images/{{$service->store->photo->file}}">
      <strong>{{$service->store->name}}</strong>
    </div>

  <div class="col-4 ">

  </div>
</div>

</div>
<div class="container d-flex flex-wrap align-content-between border p-0" style="height:68vh">
 <div class="col-10 pr-0">

 <div class="row w-100">
   <div class="border-right w-100" id="message-conversation-div"  style="overflow-y:scroll;overflow-x:hidden;height: 61vh;">
     <input type="hidden" id="conversation-id" value="<?php echo $service_conversation->id; ?>">
     <ul class="chat-section">
     <?php foreach($service_conversation->messages as $service_message){
        $isownstore = ServiceMessageController::isOwnStorebyId($service_message->service_conversation->service->store->id,$service_message->user->id);
        if($isownstore==false){ ?>
         <li class="chatmessage" data-message-id="<?php echo $service_message->id; ?>" data-user-id="<?php echo $service_message->user->id; ?>">
           <div class="w-80  p-2">
             <div class="row">
               <div class="col-1 text-right">
                 <img class="rounded-circle d-inline"  style="width: 30px; height: 30px; border:lightgray 1px solid; object-fit: cover;" src="/images/<?php echo $service_message->user->photo->file; ?>">
               </div>
               <div class="col-11 bg-gray p-3">
                 <strong><span class="d-inline"><?php if(empty($service_message->user->firstname)){ echo $service_message->user->name; }else{ echo $service_message->user->firstname.' '.$service_message->user->lastname; } ?></span> </strong> <small class="text-muted">(<?php echo $service_message->created_at->diffForHumans(); ?>)</small><br>
                 <?php echo $service_message->message; ?>
               </div>
             </div>
           </div>
         </li>

       <?php }else{ ?>
       <li class="chatmessage" data-message-id="<?php echo $service_message->id; ?>" data-store-id="<?php echo $service_message->service_conversation->service->store->id; ?>">
         <div class="w-80 p-2">
           <div class="row">
             <div class="col-1 text-right">
               <img class="rounded-circle d-inline"  style="width: 30px; height: 30px; border:lightgray 1px solid; object-fit: cover;" src="/images/<?php echo $service_message->service_conversation->service->store->photo->file; ?>">
             </div>
             <div class="col-11  bg-light p-3">
               <strong><?php echo $service_message->service_conversation->service->store->name; ?></strong> <small class="text-muted">(<?php echo $service_message->created_at->diffForHumans(); ?>)</small><br>
               <?php echo $service_message->message; ?>
             </div>
         </div>
         </div>
        </li>
       <?php } ?>
    <?php } ?>

  </ul>


   </div>
</div>
<div class="row w-100 border-right"  style="height: 6.5vh;">
      <div class="message-input  border-top" style="width:96%;">
  			<div class="wrap">
        <input type="hidden" class="service-id" value="<?php echo $service->id ?>" />
  			<input type="text" placeholder="เขียนข้อความของคุณที่นี่..." class="message-input-box" />
  			<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
  			<button class="submit message-input-submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
  			</div>
  		</div>

</div>
</div>
<div class="col-2 text-center pt-4">
  <img class="rounded-circle d-inline"  style="margin:0 auto;width: 80px; height: 80px; border:lightgray 1px solid; object-fit: cover;" src="/images/<?php echo $store->photo->file; ?>">
  <h5><?php echo $store->name; ?></h5>
  <small class="text-muted"><?php echo $store->description; ?></small>

</div>
</div>

@endsection
