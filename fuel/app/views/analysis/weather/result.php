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
					<button class="btn btn-info btn-rounded weatherType_changeBtn" data-toggle="modal"
					        data-target="#con-close-modal">天候の種類を変更
					</button>
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

		<!-- 天候種類変更モーダル -->
		<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		     aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<form action="<?php echo Uri::base(false) ?>weather/save" accept-charset="utf-8" method="post">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">天気の種類</h4>
						</div>
						<div class="modal-body">

							<div class="weatherTypeDescription">
								<ul class="weatherTypeDescription_list">
									<li class="weatherTypeDescription_item">1・・いい天気</li>
									<li class="weatherTypeDescription_item">0・・悪い天気</li>
									<li class="weatherTypeDescription_item">-・・どちらでもない天気</li>
								</ul>
							</div>

							<table class="table">
								<thead>
								<tr>
									<th>天候名</th>
									<th>タイプ</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($weathers as $key => $weather) : ?>
									<tr>
										<input type="hidden" value="<?php echo $weather["id"] ?>" name="weathers[<?php echo $key ?>][id]">
										<td><?php echo $weather["name"] ?></td>
										<td>
											<select class="form-control" name="weathers[<?php echo $key ?>][type]">
												<?php if($weather["type"] == 0) : ?>
													<option selected>0</option>
												<?php else : ?>
													<option>0</option>
												<?php endif; ?>

												<?php if($weather["type"] == 1) : ?>
													<option selected>1</option>
												<?php else : ?>
													<option>1</option>
												<?php endif; ?>

												<?php if($weather["type"] == null) : ?>
													<option selected>-</option>
												<?php else : ?>
													<option>-</option>
												<?php endif; ?>
										</select>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-info">Save changes</button>
						</div>
					</div>
				</form>
			</div>
		</div><!-- /.modal -->
		<!-- end 天候種類変更モーダル -->

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