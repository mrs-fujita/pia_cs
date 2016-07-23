<!-- サイドバーのあるテンプレート -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<!-- Bootstrap core CSS -->
	<?php echo Asset::css('lib/bootstrap.min.css'); ?>
	<?php echo Asset::css('lib/bootstrap-reset.css'); ?>

	<!--Animation css-->
	<?php echo Asset::css('lib/animate.css'); ?>

	<!--Icon-fonts css-->
	<?php echo Asset::css('lib/font-awesome.css'); ?>
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">

	<!--Morris Chart CSS -->
	<?php echo Asset::css('lib/morris.css'); ?>

	<!--C3 Chart CSS -->
	<?php echo Asset::css('lib/assets/c3-chart/c3.css'); ?>

	<!-- modal -->
	<?php echo Asset::css('lib/assets/modal-effect/component.css'); ?>


	<!-- Custom styles for this template -->
	<?php echo Asset::css('lib/style.css'); ?>
	<?php echo Asset::css('lib/helper.css'); ?>


	<!-- DataTables 並び替え可能テーブル -->
	<?php echo Asset::css('lib/assets/jquery.dataTables.min.css'); ?>


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- オリジナルCSS -->
	<?php echo Asset::css('main.css'); ?>

	<!-- jQuery -->
	<?php echo Asset::js('lib/jquery.js'); ?>
</head>

<body>

<!-- Aside Start-->
<aside class="left-panel">
	<?php echo View::forge('views/left-panel') //left-panelの読み込み ?>
</aside>
<!-- Aside Ends-->

<!--Main Content Start -->
<section class="content">
	<!-- Header -->
	<header class="top-head container-fluid">
		<?php echo View::forge('views/header') //headerの読み込み ?>
	</header>
	<!-- Header Ends -->

	<!-- Page Content Start -->
	<!-- ================== -->
	<div class="wraper container-fluid">
		<?php echo $content; //contentsの読み込み ?>
	</div>
	<!-- Page Content Ends -->
	<!-- ================== -->

	<footer class="footer">
		<?php echo View::forge('views/footer') //footerの読み込み ?>
	</footer>
</section>
<!-- Main Content Ends -->

<!-- js placed at the end of the document so the pages load faster -->
<?php //echo Asset::js('lib/jquery.js'); jQueryは文章の途中でscriptタグを使いたいのでhead内で読み込む ?>
<?php echo Asset::js('lib/bootstrap.min.js'); ?>
<?php echo Asset::js('lib/pace.min.js'); ?>
<?php echo Asset::js('lib/wow.min.js'); ?>
<?php echo Asset::js('lib/modernizr.min.js'); ?>
<?php echo Asset::js('lib/jquery.nicescroll.js'); ?>


<!--common script for all pages-->
<?php echo Asset::js('lib/jquery.app.js'); ?>


<?php echo Asset::js('main.js'); ?>
<?php echo Asset::js('analysis.js'); ?>

<!-- フォームのバリデーションを行うために使用 -->
<!--form validation-->
<?php echo Asset::js('lib/assets/jquery.validate.min.js'); ?>
<!--form validation init-->
<?php echo Asset::js('lib/assets/form-validation-init.js'); ?>


<!-- 並び替え可能テーブル -->
<?php echo Asset::js('lib/assets/jquery.dataTables.min.js'); ?>
<?php echo Asset::js('lib/assets/dataTables.bootstrap.js'); ?>
<!-- 並び替え可能テーブルを作動させるために必要 -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').dataTable();
	});
</script>

<!--C3 Chart-->
<?php echo Asset::js('lib/assets/c3-chart/d3.v3.min.js'); ?>
<?php echo Asset::js('lib/assets/c3-chart/c3.js'); ?>

<?php if(strpos(Uri::current(), 'winPerGraph') !== false): ?>
	<?php echo Asset::js('lib/assets/c3-chart/winPerGraph.js'); ?>
<?php elseif(strpos(Uri::current(), 'analyzed') !== false): ?>
	<?php echo Asset::js('lib/assets/c3-chart/eventAnalyzed.js'); ?>
<?php else: ?>
	<?php // echo Asset::js('lib/assets/c3-chart/userAge.js'); ?>
<?php endif; ?>
<?php // echo Asset::js('lib/assets/c3-chart/c3-chart.init.js'); ?>

<!-- Modal-Effect -->
<?php echo Asset::js('lib/assets/modal-effect/classie.js'); ?>
<?php echo Asset::js('lib/assets/modal-effect/modalEffects.js'); ?>


</body>
</html>
