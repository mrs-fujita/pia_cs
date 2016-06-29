<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ユーザー追加</title>
</head>
<body>
<p>user/index</p>
<h1>ユーザー追加</h1>

<?php
	echo Form::open('user/add');
	echo "名前";
	echo Form::input("name");
	echo "<br>パスワード";
	echo Form::input("passwd");
	echo "<br>パスワード確認";
	echo Form::input("again_passwd");
	echo "<br>使用開始";
	echo Form::input("start_time");
	echo "<br>使用終了";
	echo Form::input("end_time");
	echo "<br>権限";
	echo Form::input("authority");

	echo Form::submit();
	echo Form::close();

?>




</body>
</html>
