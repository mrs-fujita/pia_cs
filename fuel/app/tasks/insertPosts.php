<?php

namespace Fuel\Tasks;

use Oil\Exception;

class InsertPosts
{
	/**
	 *
	 */
	public function run()
	{
		$queries = \DB::query("select distinct post from member_table;")->execute();

		foreach($queries as $query)
		{
			var_dump($query["post"]);

			if($query["post"] != null && $query["post"] != 0)
			{

				$post_table = \Model_Post::forge()->set(array(
					"post" => $query["post"],
					"flg"  => 0,
				));
				if($post_table->save()) {
					echo "保存成功";
				}else {
					echo "保存失敗";
				}
			}
		}
	}

	public function find()
	{
		// php oil r InsertPosts:find
		// で実行可能


		// 郵便番号から緯度経度を求めるためのAPIのURL
		$base_url = "http://geoapi.heartrails.com/api/json?method=searchByPostal&postal=";

		// 緯度経度を求めていない郵便番号を取得
		$postcodes = \Model_Post::find_by(array(
			'writing_flg' => 0,
		), null, null, 1000);

		foreach($postcodes as $postcode)
		{
			//var_dump($postcode["post"]);

			echo "postコード: " . $postcode["post"] . "\n";
			// 郵便番号が7桁ない場合の処理
			if(strlen($postcode["post"]) != 7) {
				echo "7桁ありません" . "\n";
				$new_post = str_pad($postcode["post"], 7, 0, STR_PAD_LEFT);
				echo "新しいpostcode:" .$new_post . "\n";
				$url = $base_url . $new_post;
			}else
			{
				// 郵便番号からAPIにアクセスURLを作成
				$url = $base_url . $postcode["post"];
			}

			// JSONを取得し処理を行うための連想配列に変換
			$json = file_get_contents($url);
			$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
			$arr = json_decode($json,true);

			
			// 緯度経度が取得できた場合のみ処理を行う
			if (array_key_exists('location', $arr["response"])) {
				$prefecture = $arr["response"]["location"][0]["prefecture"];  //都道府県
				$city = $arr["response"]["location"][0]["city"];  //都市名
				$town = $arr["response"]["location"][0]["town"];  //町名
				$latitude = $arr["response"]["location"][0]["y"];  //緯度
				$longitude = $arr["response"]["location"][0]["x"];  //経度

				echo $prefecture . ", " . $city . ", " . $latitude . ", ". $longitude. "\n";
				//echo "エラーじゃない";

				$postcode["latitude"] = $latitude;
				$postcode["longitude"] = $longitude;
				$postcode["prefecture"] = $prefecture;
				$postcode["city"] = $city;
				$postcode["town"] = $town;
				$postcode["writing_flg"] = 1;

				// 強制的に新規登録ではなくアップデートさせる
				$postcode->is_new(false);

				if($postcode->save()) echo "update成功";
				else echo "update失敗";
			}



			sleep(1);

		}
	}
}

?>