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
class Controller_Event extends Controller_App
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
		//return Response::forge(View::forge('event/index',$data));
		$this->template->title = "イベント一覧";
		$this->template->content = View::forge('event/index', $data);
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
		//return Response::forge(View::forge('event/detail',$data));
		$this->template->title = "イベント詳細";
		$this->template->content = View::forge('event/detail', $data);
	}

	/**
	 * The event add page controller
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_add()
	{
		//return Response::forge(View::forge('event/add'));
		$data["category"] = Model_Category::find_all();
		$this->template->title = "イベント追加";
		$this->template->content = View::forge('event/add',$data);
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
		if(!$update){
				$data["msg"] = "失敗しました。";
				$data["events"] = Model_Event::find_all();
				$this->template->title = "イベント一覧";
				$this->template->content = View::forge('event/index', $data);
		}
		$data["events"] = Model_Event::find_all();
		//return Response::forge(View::forge('event/index',$data));
		$this->template->title = "イベント一覧";
		$this->template->content = View::forge('event/index', $data);
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
		$data["update"] = Model_Event::find_by('id',$id);
		$data["category"] = Model_Category::find_all();
		$this->template->title = "イベント更新";
		$this->template->content = View::forge('event/update', $data);
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
    $entry = Model_Event::find_by_pk($post["id"]);
    if($entry){
			$entry["venue"] = $post["venue"];
			$entry["post"] = $post["post"];
			$entry["dating"] = $post["dating"];
			$entry["content"] = $post["content"];
			$entry["name"] = $post["name"];
			$entry["man_num"] = $post["man_num"];
			$entry["woman_num"] = $post["woman_num"];
			$entry["visitors_num"] = $post["visitors_num"];
			if(!$entry->save()){
				$data["msg"] = "更新に失敗しました。";
				$data["details"] = Model_Event::find_by('id',$id);
				$this->template->title = "イベント一覧";
				$this->template->content = View::forge('event/index', $data);
			}
    }
		//var_dump($entry);
		$data["details"] = Model_Event::find_by('id',$id);
    //return Response::forge(View::forge('event/detail',$data));
		$this->template->title = "イベント一覧";
		$this->template->content = View::forge('event/index', $data);
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
			if(!$entry->delete()){
				$data["events"] = Model_Event::find_all();
				$this->template->title = "イベント一覧";
				$this->template->content = View::forge('event/index', $data);
			}
		}
		$data["events"] = Model_Event::find_all();
		//return Response::forge(View::forge('event/index',$data));
		$this->template->title = "イベント一覧";
		$this->template->content = View::forge('event/index', $data);
  }

}
