<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<p>結果</p>
<?php
  $post = Input::post();
  $msg = $post["msg"];
  echo $msg;
?>
</body>
</html>
