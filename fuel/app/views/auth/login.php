<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<?php echo Asset::css('bootstrap.css'); ?>

	<!-- Bootstrap core CSS -->
	<?php echo Asset::css('lib/bootstrap.min.css'); ?>
	<?php echo Asset::css('lib/bootstrap-reset.css'); ?>

	<!--Animation css-->
	<?php echo Asset::css('lib/animate.css'); ?>

	<!--Icon-fonts css-->
	<?php echo Asset::css('lib/font-awesome.css'); ?>
	<?php echo Asset::css('lib/ionicons.min.css'); ?>

	<!--Morris Chart CSS -->
	<?php echo Asset::css('lib/morris.css'); ?>

	<!-- Custom styles for this template -->
	<?php echo Asset::css('lib/style.css'); ?>
	<?php echo Asset::css('lib/helper.css'); ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<div class="wrapper-page animated fadeInDown">
	<div class="panel panel-color panel-primary">
		<div class="panel-heading">
			<h3 class="text-center m-t-10"> Sign In to <strong>PiaAnalysis</strong></h3>
		</div>

		<?php echo Form::open(array( "action" => 'user/auth', "class" => "form-horizontal m-t-40" )); ?>

		<div class="form-group ">
			<div class="col-xs-12">
				<input class="form-control" type="text" placeholder="Username" name="name">
			</div>
		</div>
		<div class="form-group ">

			<div class="col-xs-12">
				<input class="form-control" type="password" placeholder="Password" name="pass">
			</div>
		</div>

		<div class="form-group ">
			<div class="col-xs-12">
				<label class="cr-styled">
					<input type="checkbox" checked>
					<i class="fa"></i>
					Remember me
				</label>
			</div>
		</div>

		<div class="form-group text-right">
			<div class="col-xs-12">
				<button class="btn btn-purple w-md" type="submit">Log In</button>
			</div>
		</div>
		<div class="form-group m-t-30">
			<div class="col-sm-7">
				<a href="recoverpw.html"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
			</div>
			<div class="col-sm-5 text-right">
				<a href="register.html">Create an account</a>
			</div>
		</div>
		<?php echo Form::close(); ?>

	</div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<?php echo Asset::js('lib/jquery.js'); ?>
<?php echo Asset::js('lib/bootstrap.min.js'); ?>
<?php echo Asset::js('lib/pace.min.js'); ?>
<?php echo Asset::js('lib/wow.min.js'); ?>
<?php echo Asset::js('lib/jquery.nicescroll.js'); ?>


<!--common script for all pages-->
<?php echo Asset::js('lib/jquery.app.js'); ?>

</body>
</html>
