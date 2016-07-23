<?php

class Controller_Analysis_Weather extends Controller_App
{

	/**
	 *
	 * いずれは年間・月間・試合毎で選択出来ると良い
	 *
	 * それらを選択後、更に細かく選択出来るようにする（2014年・2014/1・1節..など）
	 *
	 */

	public function action_result()
	{

		//$this->template = View::forge('template_test');

		// 選択されているチーム
		$select_team_id = Session::get('select_team_id');

		// いい天気のみ取得
		$good_weathers = Model_Weather::find_by(array( "type" => 1 ));
		// 悪い転移のみ取得
		$bad_weathers = Model_Weather::find_by(array( "type" => 0 ));

		// 良い天気と判別している天気のみ取得
		$good_word = "";
		foreach($good_weathers as $key => $good_weather)
		{
			if($key == ( count($good_weathers) - 1 ))
				$good_word .= $good_weather["name"];
			else $good_word .= $good_weather["name"] . ", ";
		}
		$data["good_word"] = $good_word;

		// 悪い天気と判別している天気のみ取得
		$bad_word = "";
		foreach($bad_weathers as $key => $bad_weather)
		{
			if($key == ( count($bad_weathers) - 1 ))
				$bad_word .= $bad_weather["name"];
			else $bad_word .= $bad_weather["name"] . ", ";
		}
		$data["bad_word"] = $bad_word;

		//echo $good . "<br>";
		//echo $bad . "<br><br>";


		$good_competitons = Model_ViewCompetitionDetail::find(array(
			"select" => array("audience_sum", "event_day", "section"),
			"where" => array(
				"club_id_a" => $select_team_id,

				array( 'event_day', 'like', '%2014%' ),  //一旦2014年に決め打ち

				"weather_type" => 1,
			)
		));
		$data["good_competitons"] = Format::forge($good_competitons)->to_array();
		$bad_competitons = Model_ViewCompetitionDetail::find(array(
			"select" => array("audience_sum", "event_day", "section"),
			"where" => array(
				"club_id_a" => $select_team_id,

				array( 'event_day', 'like', '%2014%' ),  //一旦2014年に決め打ち

				"weather_type" => 0,
			)
		));
		$data["bad_competitons"] = Format::forge($bad_competitons)->to_array();

		//var_dump($good_competitons);

		//var_dump($good_weathers);

		$this->template->title = "天候結果画面";
		$this->template->content = View::forge('analysis/weather/result', $data);
		$this->template->set_global(array(
			"good_word" => $good_word,
			"bad_word" => $bad_word,
			"good_competitons" => $good_competitons,
			"bad_competitons" => $bad_competitons,
		));

	}

	public function action_compare()
	{
		$this->template = View::forge('template_test');
	}
}