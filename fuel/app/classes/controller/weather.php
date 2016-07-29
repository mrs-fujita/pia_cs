<?php

class Controller_Weather extends Controller_App
{
	public function action_save()
	{
		$post = Input::post();
		if($post)
		{
			//$this->template = View::forge('template_test');

			$weathers = $post["weathers"];

			foreach($weathers as $weather)
			{
				// 天候の種類が"-"の場合tyepにnullを入れる
				$type_num = $weather["type"] == "-" ? null : $weather["type"];

				// 新しいweatherのモデルを作成
				$weather = Model_Weather::forge()->set(array(
					"id"   => $weather["id"],
					"type" => $type_num,
				));

				$weather->is_new(false);  //update可能にする

				if($weather->save())
				{
					//echo "保存成功" . "<br>";
				}
				else
				{
					//echo "保存失敗" . "<br>";
				}
			}

			Response::redirect('analysis/weather/result');

		}
		else
		{
			Response::redirect('analysis/weather/result');
		}

	}
}

?>