<?php

class Controller_Match extends Controller_App
{
	/*
	public function action_index()
	{

		// 選択されたチームを判定する処理
		$team_id = -1;

		$post = Input::post();
		if($post) {
			$team_id = $post["team_id"];
		}
		$this->template = View::forge('template');

		// 必要なデータを取得
		$data["test"] = "test";
		$this->template->title = "test";
		$this->template->content = View::forge('analysis/index', $data);

		//return Response::forge(View::forge('analysis/index',$data));
	}*/

	public function action_list()
	{
		$club_id = Input::post('id');

		$data["competitions"] = Model_ViewCompetitionDetail::find_by(array(
			"club_id_a" => 25,
		));

		$this->template->title = "勝敗一覧";
		$this->template->content = View::forge('match/list', $data);
	}

	public function action_winPerGraph()
	{
		$club_id = Input::post('id');

		$data["competitions_2014"] = Model_ViewCompetitionDetail::find(array(
			"select" => array("audience_sum", "event_day", "winning_percentage"),
			"where" => array(
				"club_id_a" => 25,
				array('event_day', 'like', '%2014%'),
			),
		));

		$data["competitions_2014"] = Format::forge($data["competitions_2014"])->to_array();

			//var_dump($data["competitions_2014"]);

		//$data["competitions_2014"] = Format::forge($data["competitions_2014"])->to_json();

		//print_r(Format::forge($data["competitions_2014"])->to_json());

		//$this->template = View::forge('template_test');

		$this->template->title = "勝率観客動員グラフ";
		$this->template->content = View::forge('match/winPerGraph', $data);
	}
}
?>