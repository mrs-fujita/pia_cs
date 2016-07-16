<?php

class Model_league extends \Orm\Model
{

	protected static $_table_name = "League_Table";

	protected static $_has_many = array(
		'club_details' => array(
			'key_from' => 'id',
			'model_to' => 'Model_ClubDetail',
			'key_to' => 'league_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
}
