<?php

class Controller_GetData extends Controller_Rest
{

	public function post_userPositionList()
	{

	}


	public function post_matchResult()
	{
		$club_id = Input::post('id');

		$competitions = Model_ViewCompetitionDetail::find_by(array(
			"club_id_a" => $club_id,
		));

		return $competitions;
	}
}
?>