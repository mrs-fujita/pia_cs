<div id="distanceAge-type-chart"></div>
<script type="text/javascript">
	var disageJsons = <?php echo json_encode($distance_age, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

	$(function() {
		//年齢を配列
	
		var age1 = "10代";
		var age2 = "20代";
		var age3 = "30代";
		var age4 = "40代";
		var age5 = "50代";
		var age6 = "60代";
		var age7 = "70代";
		var age8 = "80代";

		for(var i = 1;i <= 8 ;i++){
			eval("var age"+i+"List=[];");
			eval("age"+i+"List.push(age"+i+");");
			for(var l = 0; l < 5;l++){
				eval("age"+i+"List.push(0);");
			}
		}

		var disGenList = [
		"～10km",
		"～100km",
		"～200km",
		"～400km",
		"～800km"
		];

		$.each(disageJsons, function(key, value) {
			if(this.max_num != null && this.age_group != null){
				for(i=1;i <= 8;i++){
					if(i == this.age_group){ 
						eval("age"+this.age_group+"List["+this.class_id+"] = "+this.cid+";")
					}
				}
			}
		});

		 console.log(age1List);
		 console.log(age2List);
		 console.log(age3List);
		 console.log(age4List);
		 console.log(age5List);
		 console.log(age6List);
		 console.log(age7List);
		 console.log(age8List);
		 console.log(disGenList);

		var graphVal = {
			bindto: '#distanceAge-type-chart',
			data: {
				columns: [
					age1List,
					age2List,
					age3List,
					age4List,
					age5List,
					age6List,
					age7List,
					age8List
				],
				types: {
					"10代" : "bar",
					"20代" : "bar",
					"30代" : "bar",
					"40代" : "bar",
					"50代" : "bar",
					"60代" : "bar",
					"70代" : "bar",
					"80代" : "bar"
				},
		        groups: [
		            [
		            age1,
		            age2,
		            age3,
		            age4,
		            age5,
		            age6,
		            age7,
		            age8
		            ]
		        ],
		        order: 'null'
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