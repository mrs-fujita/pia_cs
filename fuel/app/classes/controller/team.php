<?php

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

		return Response::forge(View::forge('Team/Detail', $data));
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


	public function action_detail()
	{
		//$this->template = View::forge('template_test');

		// 選択されているチームのid
		$select_team_id = Session::get('select_team_id');

		// チームの情報を取得
		$club = Model_Club::find_one_by("id", $select_team_id);

		// チームの最後に登録されている詳細情報を取得
		$club_details = Model_ClubDetail::find("all", array(
			"where"    => array(
				"club_id" => $select_team_id,
			),
			"order_by" => array( "year" => "desc" ),
			"limit"    => 1
		));

		// チームの詳細情報からチームのスタジアム情報・リーグ情報を取得
		$stadium = null;
		$league = null;
		$detail = null;
		foreach($club_details as $club_detail)
		{
			$detail = $club_detail;
			$stadium = $club_detail->stadium;
			$league = $club_detail->league;
		}


		$club_histories = Model_clubHistory::find("all", array(
			"where" => array("club_id" => $select_team_id),
			//"group_by" => array("year")
		));

		/*
		foreach($club_histories as $club_history)
		{
			echo $club_history["year"] . ": ";
			echo $club_history["item"];

			var_dump(next($club_histories));

			//var_dump(count($club_history));
			echo "<br><br><br>";
		}*/

		//var_dump($club_histories);

		// チームの収益情報を取得
		$profits = Model_ClubDetail::find("all", array(
			"select" => array( "year", "operating_revenue", "operating_costs", "current_net_income" ),
			"where"  => array(
				"club_id" => $select_team_id,
			)
		));
		// グラフ表示のために配列化
		$profits = Format::forge($profits)->to_array();


		// 座席情報をを取得
		$seats = Model_ClubMenberRank::find_by(array( "club_id" => $select_team_id ));

		//var_dump($seats);


		// スタジアム画像の基本となるURL
		$stadium_base_url = Model_ImgUrl::find_one_by("type", "stadium")["url"];


		$this->template->title = "チーム詳細";
		$this->template->content = View::forge('team/detail');
		$this->template->set_global(array(
			"bg_url" => Uri::base(false). $club["bg_url"],
			"stadium_url" => Uri::base(false). $stadium_base_url . $stadium["pic_file_name"],
			"emblem_url" => Uri::base(false) . "public/assets/img/club/" . $select_team_id . "/icon.png",
			"club" => $club,
			"club_detail" => $detail,
			"stadium" => $stadium,
			"profits" => $profits,
			"seats" => $seats,
			"league_name" => $league["name"],
			"club_histories" => $club_histories
		));

	}
}
