<div id="distanceSeat-type-chart"></div>
<script type="text/javascript">
	var disseatJsons = <?php echo json_encode($distance_seat, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

	$(function() {

		//シートを配列

		var season = "シーズンシート";
		var ticket = "チケット会員";
		var free = "無料会員";

		var disGenList = [
		"～10km",
		"～100km",
		"～200km",
		"～400km",
		"～800km"
		];
		var seasonList = [];
		var ticketList = [];
		var freeList = [];

		seasonList.push(season);
		ticketList.push(ticket);
		freeList.push(free);


		$.each(disseatJsons, function(key, value) {
			if(this.max_num != null && this.rank_id != null){
				if(this.rank_id == 1){
					seasonList.push(parseInt(this.cid));
				}
				else if(this.rank_id == 2){
					ticketList.push(parseInt(this.cid));
				}
				else if(this.rank_id == 3){
					freeList.push(parseInt(this.cid));
				}
			}
		});

		console.log(seasonList);
		console.log(ticketList);
		console.log(freeList);

		var graphVal = {
			bindto: '#distanceSeat-type-chart',
			data: {
				columns: [
					seasonList,
					ticketList,
					freeList
				],
				types: {
					"シーズンシート" : "bar",
					"チケット会員" : "bar",
					"無料会員" : "bar"
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