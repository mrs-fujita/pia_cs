<!DOCTYPE html>
<html>
<head>
	<?php echo Asset::css('normalize.css'); ?>
	<?php echo Asset::css('main.css'); ?>
</head>
<body>
<header class="header">
	<?php echo View::forge('views/header') //headerの読み込み ?>
</header>

<div id="content">
	<?php echo $content; //contentsの読み込み ?>
</div>

<footer class="footer">
	<?php echo View::forge('views/footer') //footerの読み込み ?>
</footer>
</body>
</html>