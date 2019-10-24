@extends('layouts.frontend')

@section('title')
พูดคุย - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\MessengerController; ?>

<div class="messenger-container">
<div id="frame" class="border">
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
				<img id="profile-img" class="rounded-circle online" style="display: block; width: 56px; height: 56px; object-fit: cover;" src="/images/{{Auth::user()->photo ? Auth::user()->photo->file : 'no_avatar.png'}}">
				<p><strong>{{ Auth::user()->name }}</strong></p>
				<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
				<div id="status-options">
					<ul>
						<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
						<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
						<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
						<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
					</ul>
				</div>
				<div id="expanded">
					<label for="twitter"><i class="fa fa-facebook" aria-hidden="true"></i></label>
					<label for="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></label>
					<label for="twitter"><i class="fa fa-instagram" aria-hidden="true"></i></label>
				</div>
			</div>
		</div>

		<div id="contacts" class="border-top">
			<ul>

				<?php foreach($conversations as $conversation){  ?>

					<?php $store_id = MessengerController::checkConversationStoreid($conversation->thread->conversation_id); ?>
					<?php if($store_id==0){ ?>
					<li class="contact" data-receiver-id="<?php echo $conversation->withUser->id; ?>" data-store-id="0">
						<div class="wrap">
							<span class="contact-status online"></span>
							<?php if(!is_null($conversation->withUser->photo['file'])){ ?>
								<img src="images/<?php echo $conversation->withUser->photo['file']; ?>" alt="" />
							<?php }else{ ?>
								<img src="images/no_avatar.png" alt="" />
							<?php } ?>
							<div class`="meta">
								<p class="name"><strong><?php if($conversation->withUser->firstname==NULL){echo $conversation->withUser->name;}else{echo $conversation->withUser->firstname.' '.$conversation->withUser->lastname;} ?></strong></p>
								<p class="preview"><?php echo MessengerController::getConversationlatestmessage($conversation->thread->conversation_id)->message; ?></p>
							</div>
						</div>
					</li>
				<?php }else{ ?>
					<?php $store = MessengerController::getStoredetail($store_id);  ?>
					<li class="contact" data-receiver-id="0"  data-store-id="<?php echo $store_id ?>">
						<div class="wrap">
							<!--<span class="contact-status online"></span>-->
							<img class="rounded-circle" style="display: block; width: 36px; height: 36px; object-fit: cover;" src="images/<?php echo $store->photo->file; ?>" alt="" />
							<div class`="meta">
								<p class="name"><strong><?php echo $store->name; ?></strong> [ร้านค้า]</p>
								<p class="preview"><?php echo MessengerController::getConversationlatestmessage($conversation->thread->conversation_id)->message; ?></p>

							</div>
						</div>
					</li>
						<?php } ?>
				<?php } ?>

			</ul>
		</div>
		<div id="bottom-bar" class="border-top">
			<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
			<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>ตั้งค่า</span></button>
		</div>
	</div>

	<div class="content border-left">
		<div class="contact-profile border-bottom">
			<img class="rounded-circle" style="display: block; width: 42px; height: 42px; object-fit: cover;" src="/images/blank.jpg" id="active-receiver-avatar" alt="" />
			<p id="active-receiver-name"  class="font-weight-bold"><span style="background-color: #dddddd">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;<span style="background-color: #dddddd">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
			<p id="active-receiver-id" class="d-none"></p>
			<p id="active-store-id" class="d-none"></p>
			<div class="social-media" id="chat-icon">
				<span style="background-color: #dddddd" class="mr-4">&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</div>
		</div>
		<div class="messages">
			<ul class="chat-section">
			</ul>
		</div>
		<div class="message-input border">
			<form id="message-form" action="javascript:void(0);" method="post" enctype="multipart/form-data">
				<input type='hidden' name='_method' value='POST'>
				 {{ csrf_field() }}
				<div id="message-upload-photo-input" style="display:none">
					 <input type="file" id="message-photos" name="message_photos">
				</div>
				<style>.fileuploader{margin:0 !important;}</style>
				<div class="wrap">
				<input type="text" placeholder="เขียนข้อความที่นี่..." id="message-input" name="message" class="message-input-box" />
				<i onclick="showMessageUploadPhotoInput()" class="fa fa-paperclip attachment" aria-hidden="true"></i>
				<button class="submit message-input-submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
				</div>
			</form>

		</div>
	</div>

	</div>
</div>
		</div>




<!-- End EditShipping Modal -->
@endsection
