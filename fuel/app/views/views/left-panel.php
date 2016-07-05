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
		<li>
			<a href="index.html">
				<i class="ion-home"></i> <span class="nav-label">Dashboard</span>
			</a>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-flask"></i> <span class="nav-label">イベント</span>
			</a>
			<ul class="list-unstyled">
				<li><a href="typography.html">イベント一覧</a></li>
				<li><a href="buttons.html">イベント観客相関</a></li>
			</ul>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-settings"></i> <span class="nav-label">ユーザ</span><span class="badge bg-success">New</span>
			</a>
			<ul class="list-unstyled">
				<li><?php echo Html::anchor('analysis/user/list', 'ユーザ一覧'); ?></li>
				<li><a href="portlets.html">ユーザ位置相関</a></li>
			</ul>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-compose"></i> <span class="nav-label">勝敗</span>
			</a>
			<ul class="list-unstyled">
				<li><?php echo Html::anchor('match/winPerGraph', '勝敗観客動員'); ?></li>
				<li><?php echo Html::anchor('match/list', '勝敗一覧'); ?></li>
				<li><a href="form-validation.html">勝敗詳細</a></li>
			</ul>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-compose"></i> <span class="nav-label">来場回数</span>
			</a>
			<ul class="list-unstyled">
				<li><a href="form-elements.html">来場回数一覧</a></li>
				<li><a href="form-validation.html">どうしよう・・</a></li>
			</ul>
		</li>
	</ul>
</nav>

