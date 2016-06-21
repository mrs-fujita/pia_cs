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
 * The Teams Controller.
 *
 *The team methods
 *prease write on this php
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Team extends Controller_App
{



	/**
	 * Serect content "Teams"
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_TeamSerect()
	{
		$post = Input::post();
		$data[] = Model_Team::find($post["id"]);
		return Response::forge(View::forge('Team/Detail',$data));
	}

	/**
	 * Update content "Team"
	 *
	 * @access  public
	 * @return  Response $data
	 */
	public function action_Teamupdate()
	{
		$post = Input::post();
		//Please add to need Infomation
		//--$"columnsname" = $post["columnsname"];
		//and into $data_u[];
		//$data_u = "data"
		/*
		$update = Model_Team::post_team($post["id"],$data_u);
		$data["msg"] = "更新に失敗しました。";
		if($update){
			$data["msg"] = "更新に成功しました。";
		}
		return Response::forge(View::forge('auth/regist',$data));
		*/
	}

	public function action_select()
	{
		return Response::forge(View::forge('team/select'));
	}
}
