<?php

class Model_ClubMenberRank extends Model_Crud {

	protected static $_table_name = "ClubMenberRank_Table";

	public static function get_club_rank_from_club_id($club_id) {
				$club = Model_ClubMenberRank::find(array(
						'select' => array( 'menber_rank_id', 'grade_name' ),
						'where'  => array( 'club_id' => $club_id)
					)
				);


		return $club;
	}
}
