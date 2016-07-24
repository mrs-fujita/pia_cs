<?php

class Controller_Admin extends Controller_App
{

	public function action_index()
	{
		$this->template = View::forge('template-admin');

		// 全てのユーザを取得
		$data["admins"] = Model_Admin::find_all();

		//return Response::forge(View::forge('user/index', $data));

		// テンプレートを使用して管理者の一覧を表示
		$this->template->title = "管理者一覧";
		$this->template->content = View::forge('admin/index', $data);
	}


	public function action_detail()
	{
		$this->template = View::forge('template-admin');

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
		$this->template = View::forge('template-admin');

		// テンプレートを使用して管理者の詳細を表示
		$this->template->title = "管理者追加";
		$this->template->content = View::forge('admin/create');
	}

	public function action_save()
	{
		// このテンプレートは保存出来るか検証するために使うテンプレートなので、
		//saveを使ってちゃんと保存出来るようになったらこの1行を削除し、ちゃんとしたテンプレートを使って遷移出来るようにする
		//$this->template = View::forge('template_test');

		$post = Input::post();

		if($post)
		{
			// postで値を受け取った時の処理

			// パスワードが確認用で入力されたパスワードと等しいか検証
			/*
			Task.07

			受け取ったパスワードが確認用と等しいか検証
			パスワードの値に整合性が取れれば
			新規でadminを保存・adminの保存に失敗した時にはadmin/indexにリダイレクト

			adminを新規で作成する文は書いたので、後はそれを保存するようにして

			その辺はこのコントローラーの他のアクションや、その他のコントローラー参照でやって
			*/
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
			/*
				Task.06

				admin/indexへリダイレクトさせる処理を書く
				このコントローラーの36行目あたり参照して
				*/
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
				このコントローラーの36行目あたり参照して（Taskの3,4,5,6は書くこと共通で大丈夫っす）
				*/
				Response::redirect('admin/index');
			}
			else
			{
				// 保存に失敗した時
				/*
				Task.04
				admin/indexへリダイレクトさせる処理を書く
				このコントローラーの36行目あたり参照して
				*/
				Response::redirect('admin/index');
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
				Response::redirect('admin/index');

		}
	}
}

?>
