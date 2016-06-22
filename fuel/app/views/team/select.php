<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>teamSelect</title>
	<?php echo Asset::css('main.css'); ?>
</head>

<script type="text/javascript">
	var j1 = [
		{id: 2, name: "ベガルタ仙台", lat: 38.3191012, lng: 140.8811164},
		{id: 4, name: "鹿島アントラーズ", lat: 35.9921584, lng: 140.6404917},
		{id: 8, name: "浦和レッズ", lat: 35.9031344, lng: 139.7175971},
		{id: 9, name: "大宮アルディージャ", lat: 35.916158, lng: 139.6333813},
		{id: 11, name: "柏レイソル", lat: 35.8484877, lng: 139.9751674},
		{id: 12, name: "FC東京", lat: 35.6642695, lng: 139.5271508},
		{id: 15, name: "川崎フロンターレ", lat: 35.5858076, lng: 139.6527219},
		{id: 16, name: "横浜F・マリノス", lat: 35.5099461, lng: 139.6063937},
		{id: 19, name: "ヴァンホーレ甲府", lat: 35.6223833, lng: 138.5896804},
		{id: 21, name: "アルビレックス新潟", lat: 37.8826418, lng: 139.0588275},
		{id: 25, name: "ジュビロ磐田", lat: 34.725217, lng: 137.875005},
		{id: 26, name: "名古屋グランパス", lat: 35.084717, lng: 137.170825},
		{id: 29, name: "ガンバ大阪", lat: 34.8027129, lng: 135.5381068},
		{id: 30, name: "セレッソ大阪", lat: 34.613917, lng: 135.5186208},
		{id: 31, name: "ヴィッセル神戸", lat: 34.682349, lng: 135.0805277},
		{id: 34, name: "サンフレッチェ広島", lat: 34.4407422, lng: 132.3943667},
		{id: 39, name: "アビスパ福岡", lat: 33.585912, lng: 130.460178},
		{id: 41, name: "サガン鳥栖", lat: 33.3716907, lng: 130.5202175}
	]
	var j2 = [
		{id: 1, name: "北海道コンサドーレ札幌", lat: 43.007281, lng: 141.411319},
		{id: 3, name: "モンテディオ山形", lat: 38.3354862, lng: 140.3784196},
		{id: 5, name: "水戸ホーリーホック", lat: 36.3457262, lng: 140.4119216},
		{id: 7, name: "ザスパクサツ群馬", lat: 36.4115409, lng: 139.0532631},
		{id: 10, name: "ジェフユナイテッド千葉", lat: 35.5774816, lng: 140.1228732},
		{id: 13, name: "東京ヴェルディ", lat: 35.6642695, lng: 139.5271508},
		{id: 14, name: "FC町田ゼルビア", lat: 35.6642695, lng: 139.5271508},
		{id: 17, name: "横浜FC", lat: 35.470743, lng: 139.602967},
		{id: 18, name: "湘南ベルマーレ", lat: 35.3435324, lng: 139.3412218},
		{id: 20, name: "松本山雅ＦＣ", lat: 36.1797911, lng: 137.9165098},
		{id: 23, name: "ツエーゲン金沢", lat: 36.5758309, lng: 136.6053628},
		{id: 24, name: "清水エスパルス", lat: 34.9846587, lng: 138.4812474},
		{id: 27, name: "ＦＣ岐阜", lat: 35.4413183, lng: 136.7660782},
		{id: 28, name: "京都サンガF.C.", lat: 34.993376, lng: 135.715673},
		{id: 33, name: "ファジアーノ岡山", lat: 34.680656, lng: 133.919634},
		{id: 35, name: "レノファ山口FC", lat: 34.1544878, lng: 131.4352374},
		{id: 36, name: "カマタマーレ讃岐", lat: 34.2617588, lng: 133.7861374},
		{id: 37, name: "徳島ヴォルティス", lat: 34.1688622, lng: 134.6146738},
		{id: 38, name: "愛媛ＦＣ", lat: 33.7681779, lng: 132.7975803},
		{id: 40, name: "ギラヴァンツ北九州", lat: 33.8904145, lng: 130.7318547},
		{id: 42, name: "Ｖ・ファーレン長崎", lat: 32.8387102, lng: 130.039475},
		{id: 43, name: "ロアッソ熊本", lat: 32.8368953, lng: 130.8001426}
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