<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<p>ユーザー詳細</p>

<?php
echo $user["id"];
echo $user["name"];
echo $user["available_startday"];
echo $user["available_endday"];
echo $user["authority_id"];
?>
</body>
</html>
