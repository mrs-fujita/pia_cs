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
 * The Graph Controller.
 *
 *The graph methods
 *prease write on this php
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Graph extends Controller
{
	/**
	 * Serect graph type
	 *default "0"
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_TypeSerect()
	{
		$post = Input::post();
		$data["type"] = $post["type"];
		return Response::forge(View::forge('Graph/0',$data));
	}

	/**
	 * Add content "Team"
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_TeamAdd()
	{
		$post = Input::post();
		//Please write to need Infomation
		//$"columnsname" = $post["columnsname"];
		return Response::forge(View::forge('auth/regist'));

	}
}
