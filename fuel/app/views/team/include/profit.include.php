<div class="row m-t-10">
	<div class="col-md-12">
		<div class="profit_graph"></div>
	</div>
</div>

<script type="text/javascript">
	var json = <?php echo json_encode($profits, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

	console.log(json);

	$(function() {

		var operatingRevenue = "収益";
		var operatingCost = "費用";
		var currentNetIncome = "損益";

		var operatingRevenues = [];
		var operatingCosts = [];
		var currentNetIncomes = [];

		operatingRevenues.push(operatingRevenue);
		operatingCosts.push(operatingCost);
		currentNetIncomes.push(currentNetIncome);

		$.each(json, function(key, value) {

			operatingRevenues.push(this.operating_revenue);
			operatingCosts.push(this.operating_costs);
			currentNetIncomes.push(this.current_net_income);
		});

		var graphVal = {
			bindto: '.profit_graph',
			padding: {
				//top: 40,
				right: 80,
				//bottom: 40,
				left: 50,
			},
			data: {
				columns: [
					operatingRevenues,
					operatingCosts,
					currentNetIncomes
				],
				types: {
					収益: 'line',
					費用: 'line',
					損益: "area-step"
					//data3: 'spline',
					//data4: 'line',
					//data5: 'bar'
				},
				colors: {
					operatingRevenues: '#ebc142',
					operatingCosts: '#03a9f4',
					//data3: '#009688',
					//data4: '#E67A77',
					//data5: '#95D7BB'
				},
				axes: {
					収益: 'y',
					費用: 'y',
					損益: 'y2'
				},
			},
			axis: {
				x: {
					type: 'categorized'
				},
				y2: {
					show: true
				}
			}
		}

		//console.log(graphVal);

		var chart = c3.generate(graphVal);


	});
</script>