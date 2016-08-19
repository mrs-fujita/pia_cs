<?php

class Controller_Analysis_distance extends Controller_App
{
	public function action_list()
	{


		//距離と男女
		$distance_gender = Model_postDistance::get_distance_gender();

		//距離と年齢
		$distance_age = Model_postDistance::get_distance_age();

		//距離シート
		$distance_seat = Model_postDistance::get_distance_seat();


		$this->template->title = "距離相関画面";
		$this->template->content = View::forge('analysis/distance/list');
		$this->template->set_global(array(
			"distance_gender" => Format::forge($distance_gender)->to_array(),
			"distance_age" => Format::forge($distance_age)->to_array(),
			"distance_seat" => Format::forge($distance_seat)->to_array(),
		));
	}
}