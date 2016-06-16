<div class="teamInfo">
	<div class="teamInfo_header">

		<img src="http://localhost/pia_cs/public/assets/img/club/1/emblem.png" alt="" class="teamInfo_icon js-teamIcon">
		<div class="teamInfo_teamName js-teamName"></div>
	</div>

	<div class="teamInfo_mainImgWrap">
		<img src="http://localhost/pia_cs/public/assets/img/club/1/1-1.png" alt="" class="teamInfo_mainImg">
	</div>

	<div class="teamInfo_form">
		<?php echo Form::open('analysis'); ?>

		<a href='#' class='teamInfo_button teamInfo_cancelButton fancyButton pop-onhover bg-gradient3'>
			<span>キャンセル</span>
		</a>

		<?php echo Form::button('name', '<span>決定</span>', array( 'class' => 'teamInfo_button teamInfo_submitButton fancyButton pop-onhover bg-gradient1' )); ?>

		<input type="hidden" name="team_id" value="" class="js-teamInfoId">
		<?php echo Form::close(); ?>

	</div>
</div>