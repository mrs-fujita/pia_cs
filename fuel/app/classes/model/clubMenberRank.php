<?php

class Model_ClubMenberRank extends Model_Crud {

	protected static $_table_name = "ClubMenberRank_Table";

	public static function get_club_rank_from_club_id($club_id) {
		/*
		$club = DB::select('menber_rank_id', 'grade_name')
			->from('ClubMenberRank_Table')
			->where('club_id', $club_id)
			->execute()->as_array();
		*/

		$club = Model_ClubMenberRank::find(array(
				'select' => array( 'menber_rank_id', 'grade_name' ),
				'where'  => array( 'club_id' => $club_id)
			)
		);

		return $club;
	}
}
