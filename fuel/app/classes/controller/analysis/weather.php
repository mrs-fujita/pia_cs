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

		// 悪い天気と判別している天気のみ取得
		$bad_word = "";
		foreach($bad_weathers as $key => $bad_weather)
		{
			if($key == ( count($bad_weathers) - 1 ))
				$bad_word .= $bad_weather["name"];
			else $bad_word .= $bad_weather["name"] . ", ";
		}


		// いい天気の時の試合情報を取得
		$good_competitons = Model_ViewCompetitionDetail::find(array(
			"select" => array("audience_sum", "event_day", "section", "competition_id"),
			"where" => array(
				"club_id_a" => $select_team_id,

				array( 'event_day', 'like', '%2014%' ),  //一旦2014年に決め打ち

				"weather_type" => 1,
			)
		));

		// いい天気の時の試合のidのみの配列を作成
		$good_weather_ids = array();
		foreach($good_competitons as $good_competiton)
			$good_weather_ids[] = $good_competiton["competition_id"];


		// 悪い天気の時の試合情報を取得
		$bad_competitons = Model_ViewCompetitionDetail::find(array(
			"select" => array("audience_sum", "event_day", "section", "competition_id"),
			"where" => array(
				"club_id_a" => $select_team_id,

				array( 'event_day', 'like', '%2014%' ),  //一旦2014年に決め打ち

				"weather_type" => 0,
			)
		));

		// 悪い天気の時の試合のidのみの配列を作成
		$bad_weather_ids = array();
		foreach($bad_competitons as $bad_competiton)
			$bad_weather_ids[] = $bad_competiton["competition_id"];


		// 天気がいい時のメンバーの年齢層を取得
		$good_weather_member_ages = Model_ViewAudienceDetail::get_group_age_from_comptition_ids($good_weather_ids);
		// 天気が悪い時のメンバーの年齢層を取得
		$bad_weather_member_ages = Model_ViewAudienceDetail::get_group_age_from_comptition_ids($bad_weather_ids);

		// 天気がいい時のシート別の観客数を取得
		$good_ranking_distinction_cnts = Model_ViewAudienceRankCnt::get_ranking_distinction_cnt($select_team_id, $good_weather_ids);
		// 天気が悪い時のシート別の観客数を取得
		$bad_ranking_distinction_cnts = Model_ViewAudienceRankCnt::get_ranking_distinction_cnt($select_team_id, $bad_weather_ids);


		$this->template->title = "天候結果画面";
		$this->template->content = View::forge('analysis/weather/result');
		// VIEW側でincludeを使っても大丈夫なように大域変数に値を設定
		$this->template->set_global(array(
			"good_word" => $good_word,
			"bad_word" => $bad_word,
			"good_competitons" => Format::forge($good_competitons)->to_array(),
			"bad_competitons" => Format::forge($bad_competitons)->to_array(),
			"good_weather_member_ages" => Format::forge($good_weather_member_ages)->to_array(),
			"bad_weather_member_ages" => Format::forge($bad_weather_member_ages)->to_array(),
			"good_ranking_distinction_cnts" => Format::forge($good_ranking_distinction_cnts)->to_array(),
			"bad_ranking_distinction_cnts" => Format::forge($bad_ranking_distinction_cnts)->to_array(),
		));
	}

	public function action_compare()
	{
		$this->template = View::forge('template_test');
	}
}