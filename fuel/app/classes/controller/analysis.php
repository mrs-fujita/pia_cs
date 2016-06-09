<?php

class Controller_Analysis extends Controller
{
	public function action_index()
	{
		// ログインをしているかなどの処理

		// 選択されたチームを判定する処理

		// 必要なデータを取得
		$data["test"] = "test";
		return Response::forge(View::forge('analysis/index',$data));
	}
}
?>