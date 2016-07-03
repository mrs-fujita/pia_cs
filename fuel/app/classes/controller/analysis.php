<?php

class Controller_Analysis extends Controller_App
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
}
?>