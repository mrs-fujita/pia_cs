<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<p>ユーザー詳細</p>

<?php
		foreach($user_ditail as $user){
		echo $user["id"];
		echo $user["name"];
		echo $user["regist_day"];
		echo $user["change_day"];
		echo $user["available_startday"];
		echo $user["available_endday"];
	}
	?>

</body>
</html>
