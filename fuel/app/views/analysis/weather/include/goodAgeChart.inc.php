<div id="good-age-chart"></div>
<script type="text/javascript">
	//var badAgeJsons = <?php echo json_encode($bad_weather_member_ages, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	var goodAgeJsons = <?php echo json_encode($good_weather_member_ages, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

	$(function() {

		var columns = [];

		$.each(goodAgeJsons, function(key, value) {
			var arr = [];
			arr.push(value.age_group + "0代");
			arr.push(value.cnt);
			columns.push(arr);
			//console.log(value.cnt);
			//console.log(value.age_group + "0代");
			//console.log(arr);
		});

		//console.log(columns);

		//$.each(goodJsons, function(key, value) {goods.push(parseInt(this.audience_sum));});
		//$.each(badJsons, function(key, value) {bads.push(parseInt(this.audience_sum));});

		//console.log(badAgeJsons);


		var graphVal = {
			bindto: '#good-age-chart',
			data: {
				// iris data from R
				columns: columns,
				type : 'pie',
				onclick: function (d, i) { console.log("onclick", d, i); },
				//onmouseover: function (d, i) { console.log("onmouseover", d, i); },
				//onmouseout: function (d, i) { console.log("onmouseout", d, i); }
			}
		}
		//console.log(graphVal);
		var chart = c3.generate(graphVal);
	});
</script>