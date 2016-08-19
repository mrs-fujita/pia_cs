<div id="distanceGen-type-chart"></div>
<script type="text/javascript">
	var disgenJsons = <?php echo json_encode($distance_gender, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

	$(function() {
		//性別を配列
		var male = "男性";
		var female = "女性";
		
		var disGenList = [
		"～10km",
		"～100km",
		"～200km",
		"～400km",
		"～800km"
		];
		var maleList = [];
		var femaleList = [];

		maleList.push(male);
		femaleList.push(female);

		$.each(disgenJsons, function(key, value) {
			if(this.max_num != null && this.gender != null){
				if(this.gender == 0){
					maleList.push(parseInt(this.cid));
				}
				else{
					femaleList.push(parseInt(this.cid));
				}
			}
		});

		console.log(disGenList);
		console.log(maleList);
		console.log(femaleList);

		var graphVal = {
			bindto: '#distanceGen-type-chart',
			data: {
				columns: [
					maleList,
					femaleList
				],
				types: {
					"男性" : "bar",
					"女性" : "bar"
				}
			},
			axis :{
				x: {
			    	type:'category',
		            categories: disGenList
		        }  
		    }
		}
		console.log(graphVal);
		var chart = c3.generate(graphVal);
	});
</script>