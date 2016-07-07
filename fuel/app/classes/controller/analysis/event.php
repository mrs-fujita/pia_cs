<?php

class Controller_Analysis_Event extends Controller_App
{
	// public function action_index()
	// {
	// 	// 選択されたチームを判定する処理
	// 	$team_id = -1;
	// 	$post = Input::post();
	// 	if($post) {
	// 		$team_id = $post["team_id"];
	// 	}
	// 	$this->template = View::forge('template');
	// 	// 必要なデータを取得
	// 	//$data["test"] = "test";
	// 	$this->template->title = "分析画面";
	// 	$this->template->content = View::forge('analysis/index');
	// 	//return Response::forge(View::forge('analysis/index',$data));
	// }

	// public function action_list()
	// {
	// 	$data["members"] = Model_Event::find_by(array(
	// 		"club_id" => 25, //今は決め打ち
	// 	));
  //
	// 	$this->template->title = "イベント一覧";
	// 	$this->template->content = View::forge('analysis/user/list', $data);
	// }

	public function action_analyzed()
	{
		$data["events"] = Model_Event::find_all();
		$data["events"] = Format::forge($data["events"])->to_array();

		//var_dump($data["members_age"]);
		$this->template->title = "イベント棒グラフ";
		$this->template->content = View::forge('analysis/event/list', $data);
	}
}
?>
