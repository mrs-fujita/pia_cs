<?php

class Controller_Analysis_User extends Controller_App
{
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
		//$data["test"] = "test";
		$this->template->title = "分析画面";
		$this->template->content = View::forge('analysis/index');

		//return Response::forge(View::forge('analysis/index',$data));
	}

	public function action_list()
	{
		$data["members"] = Model_ViewMemberDetail::find_by(array(
			"club_id" => 25, //今は決め打ち
		));

		$this->template->title = "ユーザ一覧";
		$this->template->content = View::forge('analysis/user/list', $data);
	}

	public function action_age()
	{
		$data["members_age"] = Model_ViewMemberDetail::count(
			"id",
			false,
			array(),
			"age_group"
		);
		$data["members_age"] = Format::forge($data["members_age"])->to_array();

		//$this->template = View::forge('template_test');

		//var_dump($data["members_age"]);
		$this->template->title = "観客年齢円グラフ";
		$this->template->content = View::forge('analysis/user/age', $data);
	}
}
?>