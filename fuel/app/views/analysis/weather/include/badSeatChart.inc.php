<div id="bad-seat-chart"></div>
<script type="text/javascript">
	var badSeatJsons = <?php echo json_encode($bad_ranking_distinction_cnts, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

	$(function() {

		var columns = [];

		$.each(badSeatJsons, function(key, value) {

			//console.log(key + ": " + value);

			var arr = [];
			if(key == 0) {
				arr.push("シーズンシート");
			}else if(key == 1) {
				arr.push("FC");
			}else {
				arr.push("無料");
			}

			arr.push(value);
			columns.push(arr);
		});

		//console.log(columns);


		var graphVal = {
			bindto: '#bad-seat-chart',
			data: {
				// iris data from R
				columns: columns,
				type : 'pie',
				onclick: function (d, i) { console.log("onclick", d, i); },
			}
		}
		var chart = c3.generate(graphVal);
	});
</script>