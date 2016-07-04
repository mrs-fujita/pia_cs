<div class="wraper container-fluid">
	<div class="page-title">
		<h3 class="title">C3 Chart</h3>
	</div>


	<div class="row">

		<div class="col-lg-6">
			<div class="portlet"><!-- /primary heading -->
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">
						2014年度 観客動員数 + 勝率
					</h3>
					<div class="portlet-widgets">
						<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
						<span class="divider"></span>
						<a data-toggle="collapse" data-parent="#accordion1" href="#portlet3"><i class="ion-minus-round"></i></a>
						<span class="divider"></span>
						<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div id="portlet3" class="panel-collapse collapse in">
					<div class="portlet-body">
						<div id="combine-chart"></div>
					</div>
				</div>
			</div>
		</div>

	</div>  <!-- End row -->

	<script type="text/javascript">
		var json = <?php echo json_encode($competitions_2014, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

		console.log(json);
	</script>

</div>