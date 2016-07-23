<div class="wraper container-fluid">
	<div class="page-title">
		<h3 class="title">天候結果</h3>
	</div>


	<div class="row">

		<div class="col-lg-6">
			<div class="portlet"><!-- /primary heading -->
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
						<div id="weather-type-chart"></div>
					</div>
				</div>
			</div>
		</div>

	</div>  <!-- End row -->
	<script type="text/javascript">
		var badJsons = <?php echo json_encode($bad_competitons, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
		var goodJsons = <?php echo json_encode($good_competitons, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

		$(function() {
			var good = "good";
			var bad = "bad";

			var goodDay = "goodDay";
			var badDay = "badDay";


			var goods = [];
			var bads = [];

			var goodDays = [];
			var badDays = [];

			goods.push(good);
			bads.push(bad);

			goodDays.push(goodDay);
			badDays.push(badDay);


			$.each(goodJsons, function(key, value) {goods.push(parseInt(this.audience_sum));});
			$.each(badJsons, function(key, value) {bads.push(parseInt(this.audience_sum));});

			$.each(goodJsons, function(key, value) {goodDays.push(parseInt(this.section));});
			$.each(badJsons, function(key, value) {badDays.push(parseInt(this.section));});

			console.log(goods);
			console.log(goodDays);
			console.log(bads);
			console.log(badDays);


			var graphVal = {
				bindto: '#weather-type-chart',
				data: {
					xs: {
						"good" : "goodDay",
						"bad" : "badDay",
					},
					columns: [
						goodDays,
						badDays,
						goods,
						bads
					],
					types: {
						"good" : "bar",
						"bad" : "bar"
					}
				}
			}
				/*
				data: {
					xs : {
						good : goodDay,
						bad : badDay
					},
					columns: [
						goodDays,
						badDays,
						goods,
						bads
					],
					types: {
						good: 'bar',
						bad: 'bar',
						//data3: 'spline',
						//data4: 'line',
						//data5: 'bar'
					},
					colors: {
						good: '#ebc142',
						bad: '#03a9f4',
						//data3: '#009688',
						//data4: '#E67A77',
						//data5: '#95D7BB'
					}
				},
				axis: {
					xs: {
						type : 'timeseries',
						tick: {
							fit: true,
							format: "%e %b %y"
						}
					}
				}




				data: {
					x: 'x2',
					columns: [
						['x2', '2013-10-31', '2013-12-31', '2014-01-31', '2014-02-28'],
						['sample', 30, 100, 400, 150],
					]
				},
				axis : {
					x : {
						type : 'timeseries',
						tick: {
							fit: true,
							format: "%e %b %y"
						}
					}/
				}
			}*/

			console.log(graphVal);

			var chart = c3.generate(graphVal);

		});
	</script>
</div>