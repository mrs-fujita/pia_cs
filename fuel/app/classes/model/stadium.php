<?php
class Model_Stadium extends \Orm\Model {

	protected static $_table_name = "Stadium_Table";

	protected static $_primary_key = array('id');

	//フィールド名
	protected static $_properties = array(
		'id',
		'name',
		'another_name',
		'address',
		'prefectures',
		'post',
		'seat_sum',
		'longitude',
		'latitude',
		'pic_url',
		'pic_file_name',
	);

	protected static $_has_many = array(
		'club_details' => array(
			'key_from' => 'id',
			'model_to' => 'Model_ClubDetail',
			'key_to' => 'home_stadium_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
}
