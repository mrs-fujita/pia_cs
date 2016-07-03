<?php

class Controller_Admin extends Controller_App
{

	public function action_index()
	{
		// 全てのユーザを取得
		$data["admins"] = Model_Admin::find_by();

		//return Response::forge(View::forge('user/index', $data));

		// テンプレートを使用して管理者の一覧を表示
		$this->template->title = "管理者一覧";
		$this->template->content = View::forge('admin/index', $data);
	}


	public function action_detail()
	{
		// postでadminのidを受け取る
		$post = Input::post();

		// postのデータがあるかの判定
		if($post)
		{
			// postの値から管理者の情報を取得
			$data["admin"] = Model_Admin::find_one_by("id", $post["id"]);

			// テンプレートを使用して管理者の詳細を表示
			$this->template->title = "管理者詳細";
			$this->template->content = View::forge('admin/detail', $data);
		}
		else
		{
			Response::redirect('admin/index');
		}
	}

	public function action_delete()
	{
		// postでadminのidを受け取る
		$post = Input::post();

		// postのデータがあるかの判定
		if($post)
		{
			// postの値から管理者の情報を取得
			$admin = Model_Admin::find_one_by("id", $post["id"]);

			if($admin->delete())
			{
				// adminの情報を削除出来た時
				/*
				Task.03

				admin/indexへリダイレクトさせる処理を書く
				このコントローラーの36行目あたり参照して（Taskの3,4,5は書くこと共通で大丈夫っす）
				*/
			}
			else
			{
				// 保存に失敗した時
				/*
				Task.04

				admin/indexへリダイレクトさせる処理を書く
				このコントローラーの36行目あたり参照して
				*/
			}
		}
		else
		{
			// 直接このURLを叩かれた時
			/*
				Task.05

				admin/indexへリダイレクトさせる処理を書く
				このコントローラーの36行目あたり参照して
				*/
		}
	}
}

?>