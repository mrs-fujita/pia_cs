<?php

class Controller_GetData extends Controller_Rest
{
	public function post_matchResult()
	{
		$club_id = Input::post('id');

		$competitions = Model_ViewCompetitionDetail::find_by(array(
			"club_id_a" => $club_id,
		));

		$response = array(
			'aaa' => array(
				1, 2, 3
			),
			'bbb' => array(
				"A", "B", "C", $club_id
			)
		);
		return $competitions;
	}
}
?>