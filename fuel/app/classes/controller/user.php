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
		$ret = Model_Auth::get_auth($name,$pass);
		$auth = $ret["accept"];
		$data["msg"] = "ログインに失敗しました";


		if($auth){
			Session::set('userid', $ret["id"]);
			Response::redirect('team/select');
		}
		// $data["id"] = $id;
    // $data["pass"] = $pass;
		// 返した配列は連想名で呼び出される
		return Response::forge(View::forge('auth/login',$data));

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
		$auth = Model_Auth::post_regist($name,$pass);
		$data["res"] = "失敗";
		if($auth){
			$data["res"] = "成功";
		}
		return Response::forge(View::forge('auth/regist',$data));
	}

	/**
	 * The All User select
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_alluser()
	{
		// 全てのユーザを取得
		//$data[] = Model_User::find('all');
		//return Response::forge(View::forge('user/index',$data));

		return Response::forge(View::forge('user/index'));
	}

	/**
	 * The User detail
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_userdetail()
	{
    $get = Input::get();
		$id = $get["id"];
		$data[] = Model_User::find($id);
		return Response::forge(View::forge('auth/regist',$data));
	}

	/**
	 * The User add
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_useradd()
	{
    $post = Input::post();
		$info["id"] = $post["id"];
		/*
		*add more need info
		*...
		*/
		$update = Model_User::post_adduser($info);
		$data["msg"] = "失敗しました。";
		if($update){
			$data["msg"] = "成功しました。";
		}
		return Response::forge(View::forge('auth/regist',$data));
	}

}
