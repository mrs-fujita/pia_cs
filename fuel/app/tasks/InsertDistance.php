<?php

namespace Fuel\Tasks;

class InsertDistance
{
	/**
	 *
	 */
	public function run()
	{
		$chk = \DB::query('SHOW TABLES LIKE \'post_distances\';')->execute();
		if(!count($chk))
		{
		    // テーブルが存在しなければ作成
			InsertDistance::createPostDistance();
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

		$stadiumId = 24;
		//スタジアムの緯度・経度SELECT
		//ジュビロ(ヤマハスタジアム)固定
		$stadiumQuery = \DB::query('select latitude,longitude from `stadium_table` where id='.$stadiumId)->execute();
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
				$distance = InsertDistance::distance($stadiumLatitude,$stadiumLongitude,$postKey["latitude"],$postKey["longitude"]);
				$distance = round($distance / 1000,3);

				foreach ($distanceClassesList as $dCKey) {

					if($distance <= $dCKey["max_num"]){
						$setList[] = array(
							"post"=>$postKey["post"],
							"distance"=>$distance,
							"stadium_id"=>$stadiumId,
							"class_id"=>$dCKey["id"]
						);
						break;
					}
				}
			}

		//メンバID・緯度・経度・距離・区分インサート
   		$insert = \DB::insert(
            'post_distances'
        )->columns(array(
            'post',
            'distance',
            'stadium_id',
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
		CREATE TABLE `post_distances` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `post` int NOT NULL COMMENT \'郵便番号\',
	  `stadium_id` int DEFAULT NULL COMMENT \'スタジアムID\',
	  `class_id` int DEFAULT NULL COMMENT \'区分ID\',
	  `distance` double DEFAULT NULL COMMENT \'距離(km)\',
	  PRIMARY KEY (`id`),
	  FOREIGN KEY(`post`) REFERENCES posts(`post`),
	  FOREIGN KEY(`stadium_id`) REFERENCES stadium_table(`id`)
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
	  `class` varchar(255) NOT NULL COMMENT \'区分 遠距離は中遠より遠い場合\',
	  `max_num` int NOT NULL COMMENT \'区分最大値\',
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;')->execute();
	}

	/*
	*2点の経度・緯度から距離を求める
	*/
	public function distance($SLat,$SLong,$ELat,$ELong)
	{
	// $SLat = 36.10377477777778;
	// $SLong = 140.08785502777778;
	// $ELat = 35.65502847222223;
	// $ELong = 139.74475044444443;

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
	*2点の経度・緯度から距離を求める（高精度版）
	*まだ不完全
	*/
	public function tdistance()
	{

	$SLat = 36.10377477777778;
	$SLong = 140.08785502777778;
	$ELat = 35.65502847222223;
	$ELong = 139.74475044444443;

	$a = 6378137;
	$f = 1/298.257222101;

	$l = $ELong - $SLong;

	if($l > 180){
		$l_d = $l - 360;
	}
	else if($l < -180){
		$l_d = $l + 360;
	}
	else{
		$l_d = $l;
	}

	$L = abs($l_d);
	$L_d = 180 - $L;

	if($l_d >= 0){
		$Delta = $ELat - $SLat;
		$u1 = atan((1-$f)*tan($SLat));
		$u2 = atan((1-$f)*tan($ELat));
	}
	else if($l_d < 0){
		$Delta = $SLat - $ELat;
		$u1 = atan((1-$f)*tan($ELat));
		$u2 = atan((1-$f)*tan($SLat));
	}

	$Sigma = $SLat + $ELat;
	$Sigma_d = $u1 + $u2;
	$Delta_d = $u2 - $u1;

	$xi = cos($Sigma_d/2);
	$xi_d = sin($Sigma_d/2);

	$eta = sin($Delta_d/2);
	$eta_d = cos($Delta_d/2);

	$x = sin($u1)*sin($u2);
	$y = cos($u1)*cos($u2);

	$c = $y*cos($L)+$x;
	$epsilon = ($f*(2-$f))/pow((1-$f),2);

	//ゾーンの判断
	if($c >= 0){
		$theta_0 = $L*(1+$f*$y);
		$zoneFlg = false;
	}
	else if (0 > $c && $c >= cos(-0.9899924966 * $u1)) {
		$theta_0 = $L_d;
		$zoneFlg = true;
	}
	else{
		$theta_0 = InsertDistance::zone_3();
		$zoneFlg = true;
	}

	$F = 0;
	$theta = $theta_0;
	$Gamma = 0;
	$J = 0;
	$K = 0;
	$zeta = 0;
	$sigma = 0;

	while(abs($F)<1*pow(10,-15)){
		if(!$zoneFlg){
			$g = sqrt(pow($eta,2)*(1+cos(2*($theta/2))/2) + pow($xi,2)*(1-sin(2*$theta)/2));
			$h = sqrt(pow($eta_d,2)*(1+cos(2*$theta)/2) + pow($xi_d,2)*(1-sin(2*$theta)/2));
		}
		else{
			$g = sqrt(pow($eta,2)*(1-sin(2*$theta)/2) + pow($xi,2)*(1+cos(2*$theta)/2));
			$h = sqrt(pow($eta_d,2)*(1-sin(2*$theta)/2) + pow($xi_d,2)*(1+cos(2*$theta)/2));
		}

		$sigma = 2*atan($g/$h);
		$J = 2*$g*$h;
		$K = pow($h,2)-pow($g,2);
		$gamma = $y*sin($theta)/$J;

		$Gamma = 1-pow($gamma,2);
		$zeta = $Gamma*$K-2*$x;
		$zeta_d = $zeta + $x;

		$D = 1/4*($f*1+$f*$f)-3/16*pow($f,2)*$Gamma;
		$E = (1-$D*$Gamma)*$f*$gamma*($sigma+$D*$K*(2*pow($zeta,2)-pow($Gamma,2)));
		if(!$zoneFlg){
			$F = $theta-$L-$E;
		}
		else{
			$F = $theta-$L_d+$E;
		}
		$G = $f*pow($gamma,2)*(1-2*$D*$Gamma)+$f*$zeta_d*($sigma/$J)+(1-$D*$Gamma+1/2*$f*pow($gamma,2))+1/4*pow($f,2)*$zeta*$zeta_d;

		$theta = $theta-$F/(1-$G);

		echo $theta."\n";
	}


	//方位角の計算
	if(!$zoneFlg){
		$a = atan(($xi*tan($theta/2))/$eta);
		$Delta_2 = atan(($xi_d*tan($theta/2))/$eta_d);
	}
	else {
		$a = atan(($eta_d*tan($theta/2))/$xi_d);
		$Delta_2 = atan(($eta*tan($theta/2))/$xi);
	}

	if($a >= 0 && $L >= 0 || $a < 0 && $L == 0){
		$a_d = $a;
	}
	else if($a < 0 && $L > 0){
		$a_d = $a + 180;
	}

	if($a == 0 && $L == 0 && $Delta > 0 || $a == 0 && $L = 180 && $sigma > 0){
		$a_d = 0;
	}
	else if($a == 0 && $L == 0 && $Delta < 0 || $a == 0 && $L = 180 && $sigma < 0){
		$a_d = 180;
	}

	$a_d_1 = $a_d - $Delta_2;

	if(!$zoneFlg){
		$a_2 = $a_d + $Delta_2;
	}
	else{
		$a_2 = 180 - $a_d - $Delta_2;
	}

	$a_d_21 = 180 + $a_2;

	if($l_d >= 0){
		$a_1 = $a_d_1;
		$a_21 = $a_d_21;
	}
	else if($l_d < 0){
		$a_1 = $a_d_21;
		$a_21 = $a_d_1;
	}

	//0-360の範囲外なら360の整数倍で足し引きする
	while ($a_1 > 360) {
		$a_1 -= 360;
	}
	while ($a_1 < 0) {
		$a_1 += 360;
	}
	while ($a_21 > 360) {
		$a_1 -= 360;
	}
	while ($a_21 < 0) {
		$a_1 += 360;
	}

	//測地線長の計算
	$n_0 = $epsilon * $Gamma / pow(sqrt(1+$epsilon*$Gamma)+1, 2);
	$A = (1+$n_0)*(1+5/4*pow($n_0,2));
	$B = $epsilon*(1-3/8*pow($n_0, 2))/pow((sqrt(1+$epsilon*$Gamma)+1),2);

	$distance = (1-$f)*$a*$A*($sigma-$B*$J*($zeta-1/4*$B*($K*(pow($Gamma, 2)-2*pow($zeta, 2))-1/6*$B*$zeta*(1-4*pow($K, 2)*(3*pow($Gamma, 2)-4*pow($zeta, 2))))));
	
	echo $distance;

	}


	public function zone_3(){
		$R = pi($f)*(1+cos(2*($u1*(1-1/4*$f*(1+$f)*(1-sin(2*$u1)+3/16*pow($f, 2)*(1-sin(4*$u1)/4)))))/2);
	}

	/*
	*距離ごとに区分をつける
	*/
	public function classsort()
	{

		$distanceClassesList[] = array("class"=>"近","max_num"=>10);
		$distanceClassesList[] = array("class"=>"近中","max_num"=>100);
		$distanceClassesList[] = array("class"=>"中","max_num"=>200);
		$distanceClassesList[] = array("class"=>"中遠","max_num"=>400);
		$distanceClassesList[] = array("class"=>"遠","max_num"=>800);

		$insert = \DB::insert(
	            'distance_classes'
	        )->columns(array(
	            'class',
	            'max_num',
	        ));

	        foreach ($distanceClassesList as $dCkey)
			{
	            $insert = $insert->values($dCkey);
	        }

	        $insert->execute();
	}

	public function statisticsSelect()
	{

		$aaa = 0;

		$memberClassQuery = \DB::query('select
			 view_member_details.gender,
			 distance_classes.max_num,
			 count(view_member_details.id) as cid
			 from view_member_details
			 left join post_distances
			 on view_member_details.post = post_distances.post
			 left join distance_classes
			 on post_distances.class_id = distance_classes.id 
             and view_member_details.club_id = 25
			 group by view_member_details.gender,distance_classes.id')
			 ->execute();

		foreach($memberClassQuery as $memberClassRow)
		{
			$memberClassList1[] = array(
				"max_num"=>$memberClassRow["max_num"],
				"gender"=>$memberClassRow["gender"],
				"cid"=>$memberClassRow["cid"],
			);
		}


		foreach ($memberClassList1 as $mCList) {
			echo $mCList["max_num"]." : ";
			echo $mCList["gender"]." : ";
			echo $mCList["cid"]."\n";
			$aaa += $mCList["cid"];
		}

		echo $aaa."\n\n";
		$aaa = 0;

		$memberClassQuery = \DB::query('select
			 distance_classes.max_num,
			 view_member_details.age_group,
			 count(view_member_details.id) as cid
			 from view_member_details
			 left join post_distances
			 on view_member_details.post = post_distances.post
			 left join distance_classes
			 on post_distances.class_id = distance_classes.id 
             and view_member_details.club_id = 25
			 group by distance_classes.id,view_member_details.age_group')
			 ->execute();

		

		foreach($memberClassQuery as $memberClassRow)
		{
			$memberClassList2[] = array(
				"max_num"=>$memberClassRow["max_num"],
				"age_group"=>$memberClassRow["age_group"],
				"cid"=>$memberClassRow["cid"],
				);
		}

		foreach ($memberClassList2 as $mCList) {
			echo $mCList["max_num"]." : ";
			echo $mCList["age_group"]." : ";
			echo $mCList["cid"]."\n";
			$aaa += $mCList["cid"];
		}

		echo $aaa."\n\n";
		$aaa = 0;

		$memberClassQuery = \DB::query('select
			 view_member_details.rank_id,
			 distance_classes.max_num,
			 count(view_member_details.id) as cid
			 from view_member_details
			 left join post_distances
			 on view_member_details.post = post_distances.post
			 left join distance_classes
			 on post_distances.class_id = distance_classes.id 
             and view_member_details.club_id = 25
			 group by view_member_details.rank_id,distance_classes.id')
			 ->execute();

		foreach($memberClassQuery as $memberClassRow)
		{
			$memberClassList3[] = array(
				"max_num"=>$memberClassRow["max_num"],
				"rankid"=>$memberClassRow["rank_id"],
				"cid"=>$memberClassRow["cid"],
			);
		}

		foreach ($memberClassList3 as $mCList) {
			echo $mCList["max_num"]." : ";
			echo $mCList["rankid"]." : ";
			echo $mCList["cid"]."\n";
			$aaa += $mCList["cid"];
		}

		echo $aaa."\n";

	}

	/*
	*テーブル削除
	*ユーザ毎のスタジアムまでの距離
	*/
	public function deleteTable(){		
		$delete = \DB::delete(`post_distances`)->execute();
		echo count($delete);
		$delete = \DB::query(`distance_classes`)->execute();
		echo count($delete);
	}

	public function dropTable(){		
		$drop = \DB::query('drop table post_distances')->execute();
		echo count($drop."\n");
		$drop = \DB::query('drop table distance_classes')->execute();
		echo count($drop."\n");
	}

}