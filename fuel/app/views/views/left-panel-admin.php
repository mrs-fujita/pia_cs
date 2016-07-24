<!-- brand -->
<div class="logo">
	<a href="<?php echo Uri::base(false) ?>analysis" class="logo-expanded">
		<!--		<i class="ion-social-buffer"></i>-->
		<?php echo Asset::img('logo.png'); ?>
		<span class="nav-label">Pia Analytics</span>
	</a>
</div>
<!-- / brand -->

<!-- Navbar Start -->
<nav class="navigation">
	<ul class="list-unstyled">
		<li class="has-submenu">
			<a href="#">
				<i class="ion-settings"></i> <span class="nav-label">管理者</span>
			</a>
			<ul class="list-unstyled">
				<li><?php echo Html::anchor('admin/index', '管理者一覧'); ?></li>
				<li><?php echo Html::anchor('admin/create', '管理者追加'); ?></li>
			</ul>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-settings"></i> <span class="nav-label">CSV</span>
			</a>
			<ul class="list-unstyled">
				<li><?php echo Html::anchor('readFile/index', 'CSV読み込み'); ?></li>
				<li><?php echo Html::anchor('readFile/list', 'CSV一覧'); ?></li>
			</ul>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-flask"></i> <span class="nav-label">イベント</span>
			</a>
			<ul class="list-unstyled">
				<li><?php echo Html::anchor('event/index', 'イベント一覧'); ?></li>
				<li><?php echo Html::anchor('event/add', 'イベント追加'); ?></li>
			</ul>
		</li>
	</ul>
</nav>
