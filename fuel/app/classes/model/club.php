<?php
class Model_Club extends Model_Crud {

	protected static $_table_name = "Club_Table";

	public static function get_club_from_team_name($team_name)
	{
		$club = Model_Club::find_one_by('name', $team_name);

		//return $accept;
	}
}
