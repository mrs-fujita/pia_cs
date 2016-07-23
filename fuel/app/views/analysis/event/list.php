<div class="wraper container-fluid">
	<div class="page-title">
		<h3 class="title">C3 Chart</h3>
	</div>


	<div class="row">

		<div class="col-lg-6">
			<div class="portlet"><!-- /primary heading -->
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">
						2014年度 イベント棒グラフ
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
	<table class="table table-striped table-bordered">
		<thead>
		<tr>
			<th>イベントid</th>
			<th>イベント名</th>
			<th>開催場所名</th>
			<th>開催日</th>
			<th>開催内容</th>
			<th>総来客数</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ((array)$events as $event): ?>
			<form name="form">
				<tr>
					<th scope="row"><?php echo $event["id"] ?></th>
					<td><?php echo $event["name"] ?></td>
					<td><?php echo $event["venue"] ?></td>
					<td><?php echo $event["dating"] ?></td>
					<td><?php echo $event["content"] ?></td>
					<td><?php echo $event["visitors_num"] ?></td>
					<input type="hidden" name="dating" value="<?php echo $event["dating"] ?>">
					<td><input type="submit" name="btn" value="表示"></td>
				</tr>
			</form>
		<?php endforeach; ?>
		</tbody>
	</table>

	<script type="text/javascript">
		var json0 = <?php echo json_encode($competitions_2014, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
		var json1 = <?php echo json_encode($events, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
		console.log(json0);
		console.log(json1);
	</script>
</div>
