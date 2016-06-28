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
 * The event Controller.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Event extends Controller
{
	/**
	 * The index page controller
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		$data["events"] = Model_Event::find_all();
		return Response::forge(View::forge('event/index',$data));
	}
	/**
   *
   *The detail page controller
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_detail()
	{
    $get = Input::get();
		$id = $get["id"];
		$data["details"] = Model_Event::find_by('id',$id);
		return Response::forge(View::forge('event/detail',$data));
	}

	/**
	 * The event add page controller
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_add()
	{
		return Response::forge(View::forge('event/add'));
	}

	/**
	 * The event add page controller
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_adddo()
	{
    $post = Input::post();
		$update = Model_Event::post_add($post);
		$data["msg"] = "失敗しました。";
		if($update){
			$data["msg"] = "成功しました。";
		}
		$data["events"] = Model_Event::find_all();
		return Response::forge(View::forge('event/index',$data));
	}

  /**
   * The update page controller
   *
   * @access  public
   * @return  Response $data
   */
  public function action_update()
  {
    return Response::forge(View::forge('event/update'));
  }

	/**
   * The update page controller
   *
   * @access  public
   * @return  Response $data
   */
  public function action_updatedo()
  {
    $post = Input::post();
		$id = $post["id"];
    $entry = Model_Event::find_by('id',$id);
    $data["msg"] = "更新に失敗しました。";
    if($entry->set($post)){
      $data["msg"] = "更新に成功しました。";
    }
    $entry->save();
    return Response::forge(View::forge('event/update',$data));
	}

  /**
   * The delete method controller
   *
   * @access  public
   * @return  Response $data
   */
  public function action_delete()
  {
    $post = Input::post();
    $entry = Model_Event::find_by_pk($post["id"]);
		if ($entry){
		    $entry->delete();
		}
		$data["events"] = Model_Event::find_all();
		return Response::forge(View::forge('event/index',$data));
  }

}
