<div id="weather-type-chart"></div>
<script type="text/javascript">
	var badJsons = <?php echo json_encode($bad_competitons, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	var goodJsons = <?php echo json_encode($good_competitons, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

	$(function() {
		// 天候がいい日・悪い日の観客数をグラフ表示するための配列にする
		var good = "good";
		var bad = "bad";

		var goods = [];
		var bads = [];

		goods.push(good);
		bads.push(bad);

		$.each(goodJsons, function(key, value) {goods.push(parseInt(this.audience_sum));});
		$.each(badJsons, function(key, value) {bads.push(parseInt(this.audience_sum));});


		//天候がいい・悪い日の試合の節数をグラフ表示するための配列にする
		var goodDay = "goodDay";
		var badDay = "badDay";

		var goodDays = [];
		var badDays = [];

		goodDays.push(goodDay);
		badDays.push(badDay);

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
		//console.log(graphVal);
		var chart = c3.generate(graphVal);
	});
</script>