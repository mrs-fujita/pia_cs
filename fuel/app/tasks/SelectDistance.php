<?php

namespace Fuel\Tasks;

class InsertDistance
{
	/**
	 *
	 */
	public function run()
	{
		// $chk1 = \DB::query('SHOW TABLES LIKE \'distance_classes\';')->execute();
		// $chk2 = \DB::query('SHOW TABLES LIKE \'post_peoples\';')->execute();
		// if(!count($chk1) && !count($chk2))
		// {

		// 	//距離区分取得
		// 	$distanceClassesQuery = \DB::query('select id,`name` from `distance_classes`')->execute();
		// 	foreach($distanceClassesQuery as $distanceClassesRow)
		// 	{
		// 		if($distanceClassesRow["name"] != null && !empty($distanceClassesRow["name"]))
		// 		{
		// 			$distanceClassesList[] = array(
		// 				"id"=>$distanceClassesRow["id"],
		// 				"name"=>$distanceClassesRow["name"]
		// 			);
		// 		}
		// 	}

		// 	$postPeoplesQuery = \DB::query('select class_id,count(class_id) as cid from post_peoples group by class_id')->execute();

		// 	foreach($postPeoplesQuery as $postPeoplesRow)
		// 	{
		// 		foreach ($postPeoplesList as $dCKey) {
		// 			if($dCKey["id"] == $postPeoplesRow["class_id"]){
		// 				echo $dCKey["name"]." : ";
		// 				echo $postPeopleRow["cid"]."\n";
		// 				break;
		// 			}
		// 		}
		// 	}
		// }
	}


}