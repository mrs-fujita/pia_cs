<?php

namespace Fuel\Tasks;

class InsertDistance
{
	/**
	 *
	 */
	public function run()
	{
		$chk = \DB::query('SHOW TABLES LIKE \'post_peoples\';')->execute();
		if(!count($chk))
		{
		    // テーブルが存在しなければ作成
			InsertDistance::createPostPeoples();
		}

		$chk = null;
		echo $chk;
		$chk = \DB::query('SHOW TABLES LIKE \'distance_classes\';')->execute();
		if(!count($chk))
		{
		    // テーブルが存在しなければ作成
			InsertDistance::createDistanceClasses();
			InsertDistance::classsort();
		}


		InsertDistance::postSet();

	}

	public function postSet()
	{
		//メンバの郵便番号をSELECT
		$memberQuery = \DB::query('select member_table.id,member_table.club_id,member_table.post,posts.latitude,posts.longitude from `member_table` LEFT JOIN `posts` ON `member_table`.`post` = `posts`.`post`')->execute();

		foreach($memberQuery as $memberRow)
		{
			//郵便番号・緯度・経度がが無かったら排除
			if($memberRow["post"] != null && !empty($memberRow["post"]) && $memberRow["latitude"] != null && !empty($memberRow["latitude"]) && $memberRow["longitude"] != null && !empty($memberRow["longitude"]))
			{
				$memberList[] = array(
					"id"=>$memberRow["id"],
					"club_id"=>$memberRow["club_id"],
					"post"=>$memberRow["post"],
					"latitude"=>$memberRow["latitude"],
					"longitude"=>$memberRow["longitude"]
				);
			}
		}

		//スタジアムの緯度・経度SELECT
		//ジュビロ(ヤマハスタジアム)固定
		$stadiumQuery = \DB::query('select latitude,longitude from `stadium_table` where id=24')->execute();
		foreach($stadiumQuery as $stadiumRow)
		{
			$stadiumLatitude = $stadiumRow["latitude"];
			$stadiumLongitude = $stadiumRow["longitude"];
		}

		//距離区分取得
		$distanceClassesQuery = \DB::query('select id,max_num from `distance_classes` ORDER BY max_num ASC')->execute();
		foreach($distanceClassesQuery as $distanceClassesRow)
		{
			if($distanceClassesRow["max_num"] != null && !empty($distanceClassesRow["max_num"]))
			{
				$distanceClassesList[] = array(
					"id"=>$distanceClassesRow["id"],
					"max_num"=>$distanceClassesRow["max_num"],
				);
			}
		}

		$nullFlg = false;
		//null,空欄チェック
		if(empty($memberList))
		{
			$nullFlg = true;
			echo "memberListNULL"."\n";
		}
		if(empty($distanceClassesList))
		{
			$nullFlg = true;
			echo "distanceClassesListNULL"."\n";
		}
		if(empty($stadiumLatitude) || empty($stadiumLongitude))
		{
			$nullFlg = true;
			echo "stadiumLatLongNULL"."\n";
		}

		if($nullFlg == false)
		{
			//メンバの郵便番号から緯度・経度の対応
			foreach($memberList as $memberKey)
			{
				//距離計算
				$distance = InsertDistance::distance($stadiumLatitude,$stadiumLongitude,$memberKey["latitude"],$memberKey["longitude"]);
				$distance = round($distance / 1000,3);

				foreach ($distanceClassesList as $dCKey) {

					if($distance <= $dCKey["max_num"]){
						$setList[] = array(
							"post"=>$memberKey["post"],
							"distance"=>$distance,
							"club_id"=>$memberKey["club_id"],
							"class_id"=>$dCKey["id"]
						);
						break;
					}
				}
			}

		//メンバID・緯度・経度・距離・区分インサート
   		$insert = \DB::insert(
            'post_peoples'
        )->columns(array(
            'post',
            'distance',
            'club_id',
            'class_id'
        ));

        foreach ($setList as $setKey)
		{
            $insert = $insert->values($setKey);
        }

        $insert->execute();

		}


		// //登録した距離をSELECT
		// $distanceQuery = \DB::query('select id,post from `member_distance_table`')->execute();
		// foreach($distanceQuery as $distanceRow)
		// {
		// 	$distanceList[] = array(
		// 		"id"=>$distanceRow["id"],
		// 		"post"=>$distanceRow["post"]
		// 	);	
		// }

		// foreach ($memberList as $memberRow) {
		// 	$i=0
		// 	foreach ($distanceList as $distanceRow) {
		// 		if($memberRow["id"] == $distanceRow["id"])
		// 		{
		// 			//IDが同じ、距離が一緒：追加しない
		// 			if($memberRow["post"] != $distanceRow["post"])
		// 			{
		// 				//IDが同じ、距離が違う：更新
		// 				$updateList[] = array(
		// 					"id"=>$memberRow["id"],
		// 					"post"=>$memberRow["post"]
		// 				);
		// 			}
		// 		}
		// 		if($i == count($distanceRow))
		// 		{
		// 			//IDがない：追加
		// 			$insertList[] = array(
		// 				"id"=>$memberRow["id"],
		// 				"post"=>$memberRow["post"]
		// 			);
		// 		}	
		// 	}
		// }

	}

	/*
	*テーブル作成
	*郵便番号に対するクラブ毎の人数
	*/
	public function createPostPeoples()
	{
		$insertQuery = \DB::query('
		CREATE TABLE `post_peoples` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `post` int NOT NULL COMMENT \'郵便番号\',
	  `distance` double DEFAULT NULL COMMENT \'距離(km)\',
	  `club_id` int DEFAULT NULL COMMENT \'クラブID\',
	  `class_id` int DEFAULT NULL COMMENT \'区分ID\',
	  PRIMARY KEY (`id`),
	  FOREIGN KEY(`post`) REFERENCES posts(`post`),
	  FOREIGN KEY(`club_id`) REFERENCES club_table(`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;')->execute();
	}

	/*
	*テーブル作成
	*距離ごとの区分
	*/
	public function createDistanceClasses()
	{
		$memberQuery = \DB::query('
		CREATE TABLE `distance_classes` (
	  `id` int NOT NULL AUTO_INCREMENT COMMENT \'区分ID\',
	  `max_num` int NOT NULL COMMENT \'区分最大値\',
	  `name` varchar(255) NOT NULL COMMENT \'区分\',
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;')->execute();
	}

	/*
	*2点の経度・緯度から距離を求める
	*/
	public function distance($SLat,$SLong,$ELat,$ELong)
	{

	$subLat = ($ELat - $SLat) * (3.141592 / 180);
	if($subLat < 0)
	{
		$subLat = $subLat * -1;
	}
	$subLong = ($ELong - $SLong) * (3.141592 / 180); 
	if($subLong < 0)
	{
		$subLong = $subLong * -1;
	}

	$subEW = 6378137 * $subLat * cos($SLat * (3.141592 / 180));

	$subNS = 6378137 * $subLong;

	$arg = $subEW * $subEW + $subNS * $subNS;
	$distance = sqrt($arg);

	return $distance;

	}

	/*
	*距離ごとに区分をつける
	*/
	public function classsort()
	{

		$distanceClassesList[] = array("max_num"=>0,"name"=>"ERR");
		$distanceClassesList[] = array("max_num"=>10,"name"=>"～10");
		$distanceClassesList[] = array("max_num"=>50,"name"=>"～50");
		$distanceClassesList[] = array("max_num"=>100,"name"=>"～100");
		$distanceClassesList[] = array("max_num"=>200,"name"=>"～200");
		$distanceClassesList[] = array("max_num"=>400,"name"=>"～400");

		$insert = \DB::insert(
	            'distance_classes'
	        )->columns(array(
	            'max_num',
	            'name',
	        ));

	        foreach ($distanceClassesList as $dCkey)
			{
	            $insert = $insert->values($dCkey);
				echo $insert."\n";
	        }

	        $insert->execute();
	}

	/*
	*テーブル削除
	*ユーザ毎のスタジアムまでの距離
	*/
	public function deleteTable(){		
		$deleteDistance = \DB::delete('delete from member_distance_table')->execute();
	}

}