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

	<?php $select_team_id = Session::get('select_team_id'); ?>
	<?php if($select_team_id != null) : ?>
	<a href="<?php echo Uri::base(false) ?>team/detail">
		<div class="sideTeamInfo hidden-xs">
			<?php echo Asset::img("club/$select_team_id/icon.png", array(
				'id'    => 'logo',
				"class" => "sideTeamInfo_logo"
			)); ?>
			<div class="sideTeamInfo_name"><?php echo Session::get('select_team_name'); ?></div>
			<a href="<?php echo Uri::base(false) ?>team/detail" class="sideTeamInfo_link">詳しい情報</a>
			</a>
		</div>
	<?php endif; ?>


	<ul class="list-unstyled">
		<li>
			<a href="<?php echo Uri::base(false) ?>analysis/index">
				<i class="ion-home"></i> <span class="nav-label">Dashboard</span>
			</a>
		</li>
		<li>
			<a href="<?php echo Uri::base(false) ?>analysis/event/analyzed">
				<i class="ion-flask"></i> <span class="nav-label">イベント分析</span>
			</a>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-person"></i> <span class="nav-label">ユーザ分析</span><!--<span class="badge bg-success">New</span>-->
			</a>
			<ul class="list-unstyled">
				<!--<li><?php //echo Html::anchor('analysis/user/list', 'ユーザ一覧'); ?></li>-->
				<li><?php echo Html::anchor('analysis/user/age', 'ユーザ年齢別グラフ'); ?></li>
			</ul>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-ios7-cloud"></i> <span class="nav-label">天候分析</span>
			</a>
			<ul class="list-unstyled">
				<li><?php echo Html::anchor('analysis/weather/result', '天候別結果'); ?></li>
				<!--<li><?php // echo Html::anchor('analysis/weather/compare', '天候比較'); ?></li>-->
			</ul>
		</li>
		<li class="has-submenu">
			<a href="#">
				<i class="ion-compose"></i> <span class="nav-label">勝敗分析</span>
			</a>
			<ul class="list-unstyled">
				<li><?php echo Html::anchor('match/winPerGraph', '勝敗観客動員'); ?></li>
				<li><?php echo Html::anchor('match/list', '勝敗一覧'); ?></li>
			</ul>
		</li>
	</ul>
</nav>
