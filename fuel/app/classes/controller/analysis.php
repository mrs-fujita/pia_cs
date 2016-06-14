<?php

class Controller_Analysis extends Controller_Template
{
	public function action_index()
	{
		$this->template = View::forge('template');


		// ログインをしているかなどの処理

		// 選択されたチームを判定する処理

		// 必要なデータを取得
		$data["test"] = "test";
		$this->template->title = "test";
		$this->template->content = View::forge('analysis/index', $data);

		//return Response::forge(View::forge('analysis/index',$data));
	}
}
?>