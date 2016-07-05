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
 * The category Controller.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Category extends Controller
{
	/**
	 * The index page controller
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		$data["category"] = Model_Category::find_all();
		return Response::forge(View::forge('category/index',$data));
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
		$data["details"] = Model_Category::find_by('id',$id);
		return Response::forge(View::forge('category/detail',$data));
	}

	/**
	 * The category add page controller
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_add()
	{
		return Response::forge(View::forge('category/add'));
	}

	/**
	 * The category add page controller
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_adddo()
	{
    $post = Input::post();
		$add = Model_Category::post_add($post);
		$data["msg"] = "失敗しました。";
		if($update){
			$data["msg"] = "成功しました。";
		}
		$data["category"] = Model_Event::find_all();
		return Response::forge(View::forge('category/index',$data));
	}

  /**
   * The update page controller
   *
   * @access  public
   * @return  Response $data
   */
  public function action_update()
  {
		$get = Input::get();
		$id = $get["id"];
		$data["category"] = Model_Category::find_by('id',$id);
    return Response::forge(View::forge('category/update',$data));
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
    $entry = Model_Category::find_by_pk($post["id"]);
    $data["msg"] = "更新に失敗しました。";
    if($entry){
			$entry["name"] = $post["name"];
			$entry["color"] = $post["color"];
			$entry->save();
    }
		//var_dump($entry);
		$data["category"] = Model_Category::find_by('id',$id);
    return Response::forge(View::forge('category/index',$data));
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
    $entry = Model_Category::find_by_pk($post["id"]);
		if ($entry){
		    $entry->delete();
		}
		$data["category"] = Model_Category::find_all();
		return Response::forge(View::forge('category/index',$data));
  }

}
