<!-- サイドバーのないテンプレート -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<?php // echo Asset::css('normalize.css'); ?>
	<?php echo Asset::css('main.css'); ?>
</head>

<body>
<header class="header">
	<?php echo View::forge('views/header') //headerの読み込み ?>
</header>

<div class="main" id="main">
	<?php echo $content; //contentsの読み込み ?>
</div>

<footer class="footer">
	<?php echo View::forge('views/footer') //footerの読み込み ?>
</footer>
</body>
</html>