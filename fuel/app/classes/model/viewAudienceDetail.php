<?php
class Model_ViewAudienceDetail extends \Orm\Model {

	protected static $_table_name = "view_audience_details";

	public static function get_group_age_from_comptition_ids($competition_ids)
	{
		$ret = $good_weather_member_ages = DB::select(array(DB::expr("COUNT(*)"), "cnt"),"age_group")
			->from("view_audience_details")
			->where("competition_id", "IN", $competition_ids)
			->and_where("age_group", "is not", null)
			->group_by("age_group")
			->execute();

		return $ret;
	}
}
