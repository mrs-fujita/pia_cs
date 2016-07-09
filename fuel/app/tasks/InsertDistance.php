<?php

namespace Fuel\Tasks;

class InsertDistance
{
	/**
	 *
	 */
	public function run()
	{
		$chk = \DB::query('SHOW TABLES LIKE \'member_distance_table\';')->execute();
		echo count($chk)."\n";
		if(!count($chk))
		{
		    // テーブルが存在しなければ作成
			InsertDistance::createTable();
		}

		InsertDistance::postSet();

	}

	public function postSet()
	{
		//メンバの郵便番号をSELECT
		$memberQuery = \DB::query('select id,post from `member_table`')->execute();
		foreach($memberQuery as $memberRow)
		{
			if($memberRow["post"] != null && !empty($memberRow["post"]))
			{
				$memberList[] = array(
					"id"=>$memberRow["id"],
					"post"=>$memberRow["post"]
				);
			}
		}

		//郵便番号の緯度・経度をSELECT
		$postQuery = \DB::query('select post,latitude,longitude from `posts`')->execute();
		foreach($postQuery as $postRow)
		{
			$postList[] = array(
				"post"=>$postRow["post"],
				"latitude"=>$postRow["latitude"],
				"longitude"=>$postRow["longitude"]
			);
		}

		//スタジアムの緯度・経度SELECT
		//ジュビロ固定
		$stadiumQuery = \DB::query('select latitude,longitude from `stadium_table` where id=24')->execute();
		foreach($stadiumQuery as $stadiumRow)
		{
			$stadiumLatitude = $stadiumRow["latitude"];
			$stadiumLongitude = $stadiumRow["longitude"];
		}

		$nullFlg = false;
		//null,空欄チェック
		if(empty($memberList))
		{
			$nullFlg = true;
			echo "memberListNULL"."\n";
		}
		if(empty($postList))
		{
			$nullFlg = true;
			echo "postListNULL"."\n";
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
				foreach ($postList as $postKey)
				{
					if($memberKey["post"] == $postKey["post"])
					{
						if($memberRow["latitude"] != null || !empty($memberRow["latitude"]) || $memberRow["longitude"] != null || !empty($memberRow["longitude"]))
						{
							//距離・区分、計算・判定
							$distance = InsertDistance::distance($stadiumLatitude,$stadiumLongitude,$postKey["latitude"],$postKey["longitude"]);
							$distance = round($distance / 1000,3);
							$classCode = InsertDistance::classcode($distance);
						}
						else
						{
							$distance = 0;
							$classcode = null;
						}
						$setList[] = array(
							"member_id"=>$memberKey["id"],
							"latitude"=>$postKey["latitude"],
							"longitude"=>$postKey["longitude"],
							"distance"=>$distance,
							"classCode"=>$classCode
						);
					}
				}
			}

			//メンバID・緯度・経度・距離・区分インサート
	   		$insert = \DB::insert(
	            'member_distance_table'
	        )->columns(array(
	            'member_id',
	            'latitude',
	            'longitude',
	            'distance',
	            'class_code',
	        ));

	        foreach ($setList as $setKey)
			{
	            $insert = $insert->values($setKey);
	        }

	        $insert->execute();
	  	}

	}

	public function createTable()
	{
		$memberQuery = \DB::query('
		CREATE TABLE `member_distance_table` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `member_id` varchar(255) NOT NULL,
	  `latitude` double DEFAULT NULL COMMENT \'緯度\',
	  `longitude` double DEFAULT NULL COMMENT \'経度\',
	  `distance` double DEFAULT NULL COMMENT \'距離(km)\',
	  `class_code` varchar(50) DEFAULT NULL COMMENT \'区分\',
	  PRIMARY KEY (`id`),FOREIGN KEY(member_id) REFERENCES member_table(id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;')->execute();

	}

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

	public function classcode($distance)
	{
		if($distance <= 1)
		{
			$resdis = "~1";
		}
		else if ($distance <= 5) {
			$resdis = "1~5";
		}
		else if ($distance <= 10) {
			$resdis = "5~10";
		}
		else if ($distance <= 50) {
			$resdis = "10~50";
		}
		else if ($distance <= 100) {
			$resdis = "50~100";
		}
		else if ($distance <= 200) {
			$resdis = "100~200";
		}
		else if ($distance <= 300) {
			$resdis = "200~300";
		}
		else if ($distance <= 400) {
			$resdis = "300~400";
		}
		else if ($distance <= 500) {
			$resdis = "400~500";
		}
		else if ($distance <= 1000) {
			$resdis = "500~1000";
		}
		else if ($distance >= 1000) {
			$resdis = "1000~";
		}

		return $resdis;
	}


}