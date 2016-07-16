<?php
class Model_ClubDetail extends \Orm\Model {

	protected static $_table_name = "club_details";

	protected static $_primary_key = array('id');

	//フィールド名
	protected static $_properties = array(
		'id',
		'club_id',
		'year',
		'home_town',
		'home_stadium_id',
		'director',
		'operating_revenue',
		'advertising_revenue',
		'admission_fee_revenue',
		'operating_costs',
		'personnel_expenses',
		'sga',
		'operating_loss',
		'net_loss',
		'current_net_income',
		"league_id"
	);

	protected static $_belongs_to = array(
		'stadium' => array(
			'key_from' => 'home_stadium_id',
			'model_to' => 'Model_Stadium',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		),

		'league' => array(
			'key_from' => 'league_id',
			'model_to' => 'Model_league',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
}
