<button type="button" class="navbar-toggle pull-left">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</button>

<!-- Left navbar -->
<nav class=" navbar-default" role="navigation">

	<!-- Right navbar -->
	<ul class="nav navbar-nav navbar-right top-menu top-right-menu">
		<!-- mesages
		<li class="dropdown">
			<a data-toggle="dropdown" class="dropdown-toggle" href="#">
				<i class="fa fa-envelope-o "></i>
				<span class="badge badge-sm up bg-purple count">4</span>
			</a>
			<ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5001">
				<li>
					<p>Messages</p>
				</li>
				<li>
					<a href="#">
						<span class="pull-left"><img src="img/avatar-2.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
						<span class="block"><strong>John smith</strong></span>
						<span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 seconds ago</small></span>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="pull-left"><img src="img/avatar-3.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
						<span class="block"><strong>John smith</strong></span>
						<span class="media-body block">New tasks needs to be done<br><small class="text-muted">3 minutes ago</small></span>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="pull-left"><img src="img/avatar-4.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
						<span class="block"><strong>John smith</strong></span>
						<span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 minutes ago</small></span>
					</a>
				</li>
				<li>
					<p><a href="inbox.html" class="text-right">See all Messages</a></p>
				</li>
			</ul>
		</li>
		 /messages -->
		<!-- Notification
		<li class="dropdown">
			<a data-toggle="dropdown" class="dropdown-toggle" href="#">
				<i class="fa fa-bell-o"></i>
				<span class="badge badge-sm up bg-pink count">3</span>
			</a>
			<ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
				<li class="noti-header">
					<p>Notifications</p>
				</li>
				<li>
					<a href="#">
						<span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span>
						<span>New user registered<br><small class="text-muted">5 minutes ago</small></span>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span>
						<span>Use animate.css<br><small class="text-muted">5 minutes ago</small></span>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
						<span>Send project demo files to client<br><small class="text-muted">1 hour ago</small></span>
					</a>
				</li>

				<li>
					<p><a href="#" class="text-right">See all notifications</a></p>
				</li>
			</ul>
		</li>
		 /Notification -->

		<!-- user login dropdown start-->
		<li class="dropdown text-center">
			<a data-toggle="dropdown" class="dropdown-toggle" href="#">
				<!--				<img alt="" src="img/avatar-2.jpg" class="img-circle profile-img thumb-sm">-->
				<span class="username"><?php echo Session::get("user_name") ?> </span> <span class="caret"></span>
			</a>
			<ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
				<!--<li><a href="profile.html"><i class="fa fa-briefcase"></i>Profile</a></li>-->

				<?php if(Session::get("owner_flg")) : ?>
					<li><a href="<?php echo Uri::base(false) ?>admin/index"><i class="fa fa-cog"></i>管理者画面</a></li>
				<?php endif; ?>
				<li><a href="<?php echo Uri::base(false) ?>team/select"><i class="fa fa-sign-out"></i>チーム選択画面に戻る</a></li>
				<li><a href="<?php echo Uri::base(false) ?>user/logout"><i class="fa fa-sign-out"></i>ログアウト</a></li>
			</ul>
		</li>
		<!-- user login dropdown end -->
	</ul>
	<!-- End right navbar -->
</nav>

