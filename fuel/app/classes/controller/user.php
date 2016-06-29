<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Mrs_fujita
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The User Controller.
 *
 *user method
 *write on this php
 *
 * @package  app
 * @extends  Controller
 */
class Controller_User extends Controller
{
	/**
	 * The first content "Login"
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_login()
	{
		return Response::forge(View::forge('auth/login'));
	}

	/**
	 * Responce Method Login
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_auth()
	{
		$post = Input::post();
		$name = $post["name"];
		$pass = $post["pass"];

		//find_one_byはModel_Crudで使える
		//指定したテーブルからクエリでパクってくる
		//arrayだと複数パクれる
		//=>で書くんやで
		$ret = Model_Auth::get_auth($name, $pass);
		$auth = $ret["accept"];
		$data["msg"] = "ログインに失敗しました";


		if($auth)
		{
			Session::set('userid', $ret["id"]);
			Response::redirect('team/select');
		}
		// $data["id"] = $id;
		// $data["pass"] = $pass;
		// 返した配列は連想名で呼び出される
		return Response::forge(View::forge('auth/login', $data));

	}

	/**
	 * The User Regist
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_regist()
	{
		$post = Input::post();
		$name = $post["name"];
		$pass = $post["pass"];
		$auth = Model_Auth::post_regist($name, $pass);
		$data["res"] = "失敗";
		if($auth)
		{
			$data["res"] = "成功";
		}

		return Response::forge(View::forge('auth/regist', $data));
	}

	/**
	 * The All User select
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		// 全てのユーザを取得
		$data["users"] = Model_User::select_alluser();

		return Response::forge(View::forge('user/index', $data));

	}

	/**
	 * The User detail
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_detail()
	{
		$post = Input::post();
		if($post)
		{
			$data["user"] = Model_User::find_one_by("id", $post["id"]);
			return Response::forge(View::forge('user/detail', $data));
		}
		else
		{
			Response::redirect('user/index');
		}
	}

	/**
	 * ユーザ追加を行うための画面へ遷移するためのアクション
	 * @return mixed
	 */
	public function action_add()
	{
		return Response::forge(View::forge('user/add'));
	}

	/**
	 * ユーザの新規保存を行うためのアクション
	 */
	public function action_save()
	{
		$post = Input::post();

		if($post)
		{
			if($post["passwd"] == $post["rePasswd"])
			{
				// 新たなユーザを作成する
				$user = Model_User::forge()->set(array(
					"authority_id"       => 1,
					"name"               => $post["name"],
					"password"           => $post["passwd"],
					"regist_day"         => date('Y-m-d H-i-s'),
					"change_day"         => date('Y-m-d H-i-s'),
					"available_startday" => $post["start_time"],
					"available_endday"   => $post["end_time"],
				));

				if($user->save())
				{
					// ユーザの新規登録が行えた時
					Response::redirect('user/index');
				}
				else
				{
					// 保存に失敗した時
					Response::redirect('user/add');
				}

			}
			else
			{
				// パスワードと確認用のパスワードが違う時
				Response::redirect('user/add');
			}
		}
		else
		{
			// POSTのデータがない時（直接URLを叩かれた時など〉
			Response::redirect('user/add');
		}
	}

	/**
	 * The User del
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_del()
	{
		$get = Input::get();
		$id = $get["id"];
		//id検索でユーザー詳細を取得
		$data["user_ditail"] = Model_User::del_user($id);
		$data["msg"] = "登録に失敗しました。";
		if($update)
		{
			$data["msg"] = "登録に成功しました。";
		}

		return Response::forge(View::forge('auth/regist', $data));
	}

	/**
	 * The
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index_add()
	{
		return Response::forge(View::forge('user/add'));
	}


}
