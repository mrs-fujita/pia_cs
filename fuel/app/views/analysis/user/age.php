<div class="wraper container-fluid">
	<div class="page-title">
		<h3 class="title">ユーザ年齢別グラフ</h3>
	</div>


	<div class="row">

		<div class="col-lg-12 col-md-12">
			<div class="portlet"><!-- /primary heading -->
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark">
						2014年度 ユーザ年齢別円グラフ
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
						<div id="age-chart"></div>
					</div>
				</div>
			</div>
		</div>

	</div>  <!-- End row -->
	<script type="text/javascript">
		var ageJsons = <?php echo json_encode($members_age, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

		//console.log(ageJsons);

		$(function() {

			var columns = [];

			$.each(ageJsons, function(key, value) {
				// 年齢が未入力ではない人以外のデータをグラフに表示出来るようにする
				if(key != "") {
					columns.push([((key * 10) + "代"), parseInt(value)]);
				}
			});


			var chart = c3.generate({
				bindto: '#age-chart',
				data: {
					columns: columns,
					type : 'pie',
					onclick: function (d, i) { console.log("onclick", d, i); },
					onmouseover: function (d, i) { console.log("onmouseover", d, i); },
					onmouseout: function (d, i) { console.log("onmouseout", d, i); }
				}
			});

		});



	</script>
</div>