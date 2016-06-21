<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>teamSelect</title>
	<?php echo Asset::css('normalize.css'); ?>
	<?php echo Asset::css('main.css'); ?>
</head>

<script type="text/javascript">
	var j1 = [
		{id:1, name: "ジュビロ磐田", lat: 34.744636, lng: 137.968776},
		{id:2, name: "ベガルタ仙台", lat: 38.319095, lng: 140.881138},
		{id:3, name: "FC東京", lat: 35.663401, lng: 139.525436},
		{id:4, name: "名古屋グランパス", lat: 35.084717, lng: 137.170825},
		{id:5, name: "アビスパ福岡", lat: 33.585912, lng: 130.460178}
	]
	var j2 = [
		{id:1, name: "北海道コンサドーレ札幌", lat: 43.007281, lng: 141.411319},
		{id:1, name: "横浜FC", lat: 35.470743, lng: 139.602967},
		{id:1, name: "京都サンガF.C.", lat: 34.993376, lng: 135.715673}
	]
</script>

<body class="body body-teamSelect">

<header class="header header-teamSelect js-teamSelect">
	<h2 class="header-teamSelect_title">チームを選択して下さい</h2>
	<div class="header-teamSelect_selectBoxWrap dropdown">
		<?php
		echo Form::select('league', 'none', array(
			'all' => '全リーグ',
			'j1'  => 'J1',
			'j2'  => 'J2',
			'j3'  => 'J3'
		), array( 'class' => 'header-teamSelect_selectBox dropdown-select' ));
		?>
	</div>
</header>

<div id="map" style="width: 100%; height: 500px"></div>

<!-- teamInfo -->
<?php echo View::forge('team/include/teamInfo.include') ?>
<!-- /teamInfoここまで -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<?php echo Asset::js('gmaps.min.js'); ?>
<?php echo Asset::js('main.js'); ?>
</body>
</html>