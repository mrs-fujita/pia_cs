<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<p>user/index</p>
<h1>ユーザー一覧</h1>

<!--	リストテーブル	-->
<?php
	foreach ($user_all as $all) {
  echo $all["id"];
	echo $all["name"];
	echo $all["available_startday"];
	echo $all["available_endday"];
	echo Form::open('user/detail');
	echo Form::submit();
	echo Form::close();
	}

  echo Form::open('user/index_add');
	echo Form::submit();
	echo Form::close();

 ?>
</table>

</body>
</html>
