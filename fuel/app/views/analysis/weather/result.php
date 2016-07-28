<div class="wraper container-fluid">
	<div class="page-title">
		<h3 class="title">天候結果</h3>
	</div>


	<div class="row">

		<div class="col-lg-12 col-md-12">
			<div class="portlet"><!-- /primary heading -->
				<div class="weatherType">
					<ul class="weatherType_list">
						<li class="weatherType_item">いい天気・・<?php echo $good_word; ?></li>
						<li class="weatherType_item">悪い天気・・<?php echo $bad_word; ?></li>
					</ul>
					<button class="btn btn-info btn-rounded weatherType_changeBtn">天候の種類を変更</button>
				</div>
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">
						天候結果別試合観戦動員数
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
						<?php echo View::forge('analysis/weather/include/weatherTypeChart.inc') ?>
					</div>
				</div>
			</div>
		</div>

	</div>  <!-- End row -->

	<div class="row">
		<div class="col-lg-6 col-md-6">
			<div class="portlet"><!-- /primary heading -->
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">天候がいい時の年齢層</h3>
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
						<?php echo View::forge('analysis/weather/include/goodAgeChart.inc') ?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6">
			<div class="portlet"><!-- /primary heading -->
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">天候が悪い時の年齢層</h3>
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
						<?php echo View::forge('analysis/weather/include/badAgeChart.inc') ?>
					</div>
				</div>
			</div>
		</div>


		<div class="col-lg-6 col-md-6">
			<div class="portlet"><!-- /primary heading -->
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">天候がいい時のシート割合</h3>
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
						<?php echo View::forge('analysis/weather/include/goodSeatChart.inc') ?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6">
			<div class="portlet"><!-- /primary heading -->
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">天候が悪い時のシート割合</h3>
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
						<?php echo View::forge('analysis/weather/include/badSeatChart.inc') ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>