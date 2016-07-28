<?php

class Controller_Admin extends Controller_AppAdmin
{

	public function action_index()
	{
		// 全てのユーザを取得
		$data["admins"] = Model_Admin::find_all();

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


	public function action_create()
	{
		// テンプレートを使用して管理者の詳細を表示
		$this->template->title = "管理者追加";
		$this->template->content = View::forge('admin/create');
	}

	public function action_save()
	{
		//$this->template = View::forge('template_test');

		$post = Input::post();

		if($post)
		{
			//パスワードの整合性を確認
			if($post["password"] == $post["password_confirm"]){
				//パスワードが一致した場合
				// 新規adminを作成
				$admin = Model_Admin::forge()->set(array(
					"authority_id" => 1,
					"name" => $post["name"],
					"password" => $post["password"],
					"regist_day" => date('Y-m-d'),
					"change_day" => date('Y-m-d'),
					"available_startday" => $post["start_time"],
					"available_endday" => $post["end_time"],
				));

				if($admin->save())
				{
					//登録できた時の処理
					Response::redirect('admin/index');
				}
				else
				{
					//登録失敗した時の処理
					Response::redirect('admin/index');
				}
			}

			else {
				//パスワードが不一致の場合
				Response::redirect('admin/create');
			}


		}
		else
		{
			// 直接URLを叩かれた時の処理
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
				Response::redirect('admin/index');
			}
			else
			{
				// 保存に失敗した時
				Response::redirect('admin/index');
			}
		}
		else
		{
			// 直接このURLを叩かれた時
				Response::redirect('admin/index');
		}
	}
}
?>
