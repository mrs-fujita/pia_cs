<?php

namespace Fuel\Tasks;

class SelectDistance
{
	/**
	 *
	 */
	public function run()
	{
		$chk = \DB::query('SHOW TABLES LIKE \'post_distance\';')->execute();
		if(!count($chk))
		{
		    // テーブルが存在しなければ作成
			SelectDistance::createPostDistance();
		}

		$chk = null;
		echo $chk;
		$chk = \DB::query('SHOW TABLES LIKE \'distance_classes\';')->execute();
		if(!count($chk))
		{
		    // テーブルが存在しなければ作成
			SelectDistance::createDistanceClasses();
			SelectDistance::classsort();
		}


		SelectDistance::postSet();

	}

	public function postSet()
	{
		//郵便番号と緯度経度をSELECT
		$postQuery = \DB::query('select post,latitude,longitude from `posts`')->execute();

		foreach($postQuery as $postRow)
		{
			//郵便番号・緯度・経度がが無かったら排除
			if($postRow["post"] != null && !empty($postRow["post"]) && $postRow["latitude"] != null && !empty($postRow["latitude"]) && $postRow["longitude"] != null && !empty($postRow["longitude"]))
			{
				$postList[] = array(
					"post"=>$postRow["post"],
					"latitude"=>$postRow["latitude"],
					"longitude"=>$postRow["longitude"]
				);
			}
		}

		$clubId = 24;
		//スタジアムの緯度・経度SELECT
		//ジュビロ(ヤマハスタジアム)固定
		$stadiumQuery = \DB::query('select latitude,longitude from `stadium_table` where id='.$clubId)->execute();
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
		if(empty($postList))
		{
			$nullFlg = true;
			echo "postListNULL"."\n";
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
			foreach($postList as $postKey)
			{
				//距離計算
				$distance = SelectDistance::distance($stadiumLatitude,$stadiumLongitude,$postKey["latitude"],$postKey["longitude"]);
				$distance = round($distance / 1000,3);

				foreach ($distanceClassesList as $dCKey) {

					if($distance <= $dCKey["max_num"]){
						$setList[] = array(
							"post"=>$postKey["post"],
							"distance"=>$distance,
							"club_id"=>$clubId,
							"class_id"=>$dCKey["id"]
						);
						break;
					}
				}
			}

		//メンバID・緯度・経度・距離・区分インサート
   		$insert = \DB::insert(
            'post_distance'
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


	}

	/*
	*テーブル作成
	*郵便番号に対するクラブ毎の人数
	*/
	public function createPostDistance()
	{
		$insertQuery = \DB::query('
		CREATE TABLE `post_distance` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `post` int NOT NULL COMMENT \'郵便番号\',
	  `club_id` int DEFAULT NULL COMMENT \'クラブID\',
	  `class_id` int DEFAULT NULL COMMENT \'区分ID\',
	  `distance` double DEFAULT NULL COMMENT \'距離(km)\',
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
		$postQuery = \DB::query('
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
	*2点の経度・緯度から距離を求める
	*/
	public function tdistance()
	{

	$SLat = 34.410280;
	$SLong = 132.450732;
	$ELat = 34.397349;
	$ELong = 132.447650;

	$a = 6378137;
	$f = 1/298.257222101;;

	$l = $ELong - $SLong;

	if($l > 180){
		$ll = $l - 360;
	}
	else if($l < -180){
		$ll = $l + 360;
	}
	else{
		$ll = $l;
	}

	$L = abs($ll);
	$LL = 180 - $L;

	if($ll >= 0){
		$delta = $ELat - $SLat;
		$u1 = atan((1-$f)*tan($SLat));
		$u2 = atan((1-$f)*tan($ELat));
	}
	else if($ll < 0){
		$delta = $SLat - $ELat;
		$u1 = atan((1-$f)*tan($ELat));
		$u2 = atan((1-$f)*tan($SLat));
	}

	$sigma = $SLat + $ELat;
	$Sigma = $u1 + $u2;
	$Delta = $u2 - $u1;

	$zeta = cos($Sigma/2);
	$Zeta = sin($Sigma/2);

	$eta = sin($Delta/2);
	$Eta = cos($Delta/2);

	$x = sin($u1)*sin($u2);
	$y = cos($u1)*cos($u2);

	$c = $y*cos($L)+$x;
	$epsilon = ($f*(2-$f))/(1-$f)^2;




	echo $x."\n";
	echo $y."\n";
	echo $c."\n";
	echo $epsilon."\n";
	}

	/*
	*距離ごとに区分をつける
	*/
	public function classsort()
	{

		$distanceClassesList[] = array("max_num"=>1,"name"=>"1");
		$distanceClassesList[] = array("max_num"=>2,"name"=>"2");
		$distanceClassesList[] = array("max_num"=>3,"name"=>"3");
		$distanceClassesList[] = array("max_num"=>4,"name"=>"4");
		$distanceClassesList[] = array("max_num"=>5,"name"=>"5");
		$distanceClassesList[] = array("max_num"=>6,"name"=>"6");
		$distanceClassesList[] = array("max_num"=>7,"name"=>"7");
		$distanceClassesList[] = array("max_num"=>8,"name"=>"8");
		$distanceClassesList[] = array("max_num"=>9,"name"=>"9");
		$distanceClassesList[] = array("max_num"=>10,"name"=>"10");
		$distanceClassesList[] = array("max_num"=>11,"name"=>"11");
		$distanceClassesList[] = array("max_num"=>12,"name"=>"12");
		$distanceClassesList[] = array("max_num"=>13,"name"=>"13");
		$distanceClassesList[] = array("max_num"=>14,"name"=>"14");
		$distanceClassesList[] = array("max_num"=>15,"name"=>"15");
		$distanceClassesList[] = array("max_num"=>16,"name"=>"16");
		$distanceClassesList[] = array("max_num"=>17,"name"=>"17");
		$distanceClassesList[] = array("max_num"=>18,"name"=>"18");
		$distanceClassesList[] = array("max_num"=>19,"name"=>"19");
		$distanceClassesList[] = array("max_num"=>20,"name"=>"20");
		$distanceClassesList[] = array("max_num"=>21,"name"=>"21");
		$distanceClassesList[] = array("max_num"=>22,"name"=>"22");
		$distanceClassesList[] = array("max_num"=>23,"name"=>"23");
		$distanceClassesList[] = array("max_num"=>24,"name"=>"24");
		$distanceClassesList[] = array("max_num"=>25,"name"=>"25");
		$distanceClassesList[] = array("max_num"=>26,"name"=>"26");
		$distanceClassesList[] = array("max_num"=>27,"name"=>"27");
		$distanceClassesList[] = array("max_num"=>28,"name"=>"28");
		$distanceClassesList[] = array("max_num"=>29,"name"=>"29");
		$distanceClassesList[] = array("max_num"=>30,"name"=>"30");
		$distanceClassesList[] = array("max_num"=>31,"name"=>"41");
		$distanceClassesList[] = array("max_num"=>32,"name"=>"42");
		$distanceClassesList[] = array("max_num"=>33,"name"=>"43");
		$distanceClassesList[] = array("max_num"=>34,"name"=>"44");
		$distanceClassesList[] = array("max_num"=>35,"name"=>"45");
		$distanceClassesList[] = array("max_num"=>36,"name"=>"46");
		$distanceClassesList[] = array("max_num"=>37,"name"=>"47");
		$distanceClassesList[] = array("max_num"=>38,"name"=>"48");
		$distanceClassesList[] = array("max_num"=>39,"name"=>"49");
		$distanceClassesList[] = array("max_num"=>40,"name"=>"40");
		$distanceClassesList[] = array("max_num"=>51,"name"=>"51");
		$distanceClassesList[] = array("max_num"=>52,"name"=>"52");
		$distanceClassesList[] = array("max_num"=>53,"name"=>"53");
		$distanceClassesList[] = array("max_num"=>54,"name"=>"54");
		$distanceClassesList[] = array("max_num"=>55,"name"=>"55");
		$distanceClassesList[] = array("max_num"=>56,"name"=>"56");
		$distanceClassesList[] = array("max_num"=>57,"name"=>"57");
		$distanceClassesList[] = array("max_num"=>58,"name"=>"58");
		$distanceClassesList[] = array("max_num"=>59,"name"=>"59");
		$distanceClassesList[] = array("max_num"=>50,"name"=>"50");
		$distanceClassesList[] = array("max_num"=>60,"name"=>"60");
		$distanceClassesList[] = array("max_num"=>70,"name"=>"70");
		$distanceClassesList[] = array("max_num"=>80,"name"=>"80");
		$distanceClassesList[] = array("max_num"=>90,"name"=>"90");
		$distanceClassesList[] = array("max_num"=>100,"name"=>"100");
		$distanceClassesList[] = array("max_num"=>110,"name"=>"110");
		$distanceClassesList[] = array("max_num"=>120,"name"=>"120");
		$distanceClassesList[] = array("max_num"=>130,"name"=>"130");
		$distanceClassesList[] = array("max_num"=>140,"name"=>"140");
		$distanceClassesList[] = array("max_num"=>150,"name"=>"150");
		$distanceClassesList[] = array("max_num"=>160,"name"=>"160");
		$distanceClassesList[] = array("max_num"=>170,"name"=>"170");
		$distanceClassesList[] = array("max_num"=>180,"name"=>"180");
		$distanceClassesList[] = array("max_num"=>190,"name"=>"190");
		$distanceClassesList[] = array("max_num"=>200,"name"=>"200");
		$distanceClassesList[] = array("max_num"=>210,"name"=>"210");
		$distanceClassesList[] = array("max_num"=>220,"name"=>"220");
		$distanceClassesList[] = array("max_num"=>230,"name"=>"230");
		$distanceClassesList[] = array("max_num"=>240,"name"=>"240");
		$distanceClassesList[] = array("max_num"=>250,"name"=>"250");
		$distanceClassesList[] = array("max_num"=>260,"name"=>"260");
		$distanceClassesList[] = array("max_num"=>270,"name"=>"270");
		$distanceClassesList[] = array("max_num"=>280,"name"=>"280");
		$distanceClassesList[] = array("max_num"=>290,"name"=>"290");
		$distanceClassesList[] = array("max_num"=>300,"name"=>"300");
		$distanceClassesList[] = array("max_num"=>310,"name"=>"310");
		$distanceClassesList[] = array("max_num"=>320,"name"=>"320");
		$distanceClassesList[] = array("max_num"=>330,"name"=>"330");
		$distanceClassesList[] = array("max_num"=>340,"name"=>"340");
		$distanceClassesList[] = array("max_num"=>350,"name"=>"350");
		$distanceClassesList[] = array("max_num"=>360,"name"=>"360");
		$distanceClassesList[] = array("max_num"=>370,"name"=>"370");
		$distanceClassesList[] = array("max_num"=>380,"name"=>"380");
		$distanceClassesList[] = array("max_num"=>390,"name"=>"390");
		$distanceClassesList[] = array("max_num"=>400,"name"=>"400");
		$distanceClassesList[] = array("max_num"=>410,"name"=>"410");
		$distanceClassesList[] = array("max_num"=>420,"name"=>"420");
		$distanceClassesList[] = array("max_num"=>430,"name"=>"430");
		$distanceClassesList[] = array("max_num"=>440,"name"=>"440");
		$distanceClassesList[] = array("max_num"=>450,"name"=>"450");
		$distanceClassesList[] = array("max_num"=>460,"name"=>"460");
		$distanceClassesList[] = array("max_num"=>470,"name"=>"470");
		$distanceClassesList[] = array("max_num"=>480,"name"=>"480");
		$distanceClassesList[] = array("max_num"=>490,"name"=>"490");
		$distanceClassesList[] = array("max_num"=>500,"name"=>"500");
		$distanceClassesList[] = array("max_num"=>600,"name"=>"600");
		$distanceClassesList[] = array("max_num"=>700,"name"=>"700");
		$distanceClassesList[] = array("max_num"=>800,"name"=>"800");
		$distanceClassesList[] = array("max_num"=>900,"name"=>"900");
		$distanceClassesList[] = array("max_num"=>1000,"name"=>"1000");
		$distanceClassesList[] = array("max_num"=>999999,"name"=>"999999");

		$insert = \DB::insert(
	            'distance_classes'
	        )->columns(array(
	            'max_num',
	            'name',
	        ));

	        foreach ($distanceClassesList as $dCkey)
			{
	            $insert = $insert->values($dCkey);
	        }

	        $insert->execute();
	}

	public function statisticsSelect()
	{
		$memberClassQuery = \DB::query('select `distance_classes`.`max_num`,`distance_classes`.`id`,count(`member_table`.`id`) as cid from `member_table` LEFT JOIN `post_distance` ON `member_table`.`post` = `post_distance`.`post` LEFT JOIN `distance_classes` ON `post_distance`.`class_id` = `distance_classes`.`id` GROUP BY distance_classes.id')->execute();
		foreach($memberClassQuery as $memberClassRow)
		{
			$memberClassList[] = array(
				"max_num"=>$memberClassRow["max_num"],
				"cid"=>$memberClassRow["cid"],
			);
		}

		foreach ($memberClassList as $mCList) {
			echo $mCList["max_num"]." : ";
			echo $mCList["cid"]."\n";
		}

	}

	/*
	*テーブル削除
	*ユーザ毎のスタジアムまでの距離
	*/
	public function deleteTable(){		
		$delete = \DB::delete(`post_distance`)->execute();
		echo count($delete);
		$delete = \DB::query(`distance_classes`)->execute();
		echo count($delete);
	}

	public function dropTable(){		
		$drop = \DB::query('drop table post_distance')->execute();
		echo count($drop."\n");
		$drop = \DB::query('drop table distance_classes')->execute();
		echo count($drop."\n");
	}


}