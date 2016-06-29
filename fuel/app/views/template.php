<!-- サイドバーのあるテンプレート -->
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

	<div class="sidebar">
		<?php echo View::forge('views/sidebar') //sidebarの読み込み ?>
	</div>

	<div class="content content-sidebarOn">
		<?php echo $content; //contentsの読み込み ?>
	</div>
</div>

<footer class="footer">
	<?php echo View::forge('views/footer') //footerの読み込み ?>
</footer>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<?php echo Asset::js('main.js'); ?>
</body>
</html>