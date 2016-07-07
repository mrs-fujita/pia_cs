<?php

class Controller_Analysis extends Controller_App
{
	public function action_index()
	{
		// 選択されたチームを判定する処理
		//$team_id = -1;

		$post = Input::post();
		if($post) {
			Session::set('select_team_id', $post["team_id"]);
			$team = Model_Team::find_one_by("id", $post["team_id"]);
			Session::set('select_team_name', $team["name"]);
		}
		$this->template = View::forge('template');

		// 必要なデータを取得
		$this->template->title = "分析画面";
		$this->template->content = View::forge('analysis/index');

		//return Response::forge(View::forge('analysis/index',$data));
	}
}
?>