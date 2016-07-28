<?php
class Model_MemberRankLog extends \Orm\Model {

	protected static $_table_name = "MemberRankLog_Table";

	protected static $_has_many = array(
		'audience_details' => array(
			'key_from' => 'member_id',
			'model_to' => 'Model_ViewAudienceDetail',
			'key_to' => 'member_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
}
