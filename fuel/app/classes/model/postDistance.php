<?php
class Model_postDistance extends Model_Crud {

	protected static $_table_name = "post_distance";

	protected static $_primary_key = array('post');

	public static function get_distance_gender()
	{
	
		$ret = $memberClassQuery = \DB::query('select
			 distance_classes.max_num,
			 view_member_details.gender,
			 count(view_member_details.id) as cid
			 from view_member_details
			 left join post_distances
			 on view_member_details.post = post_distances.post
			 left join distance_classes
			 on post_distances.class_id = distance_classes.id 
             and view_member_details.club_id = 25
			 group by view_member_details.gender,distance_classes.id')
			 ->execute();

		return $ret;
	}

		public static function get_distance_age()
	{
	
		$ret = $memberClassQuery = \DB::query('select
			 distance_classes.id as class_id,
			 distance_classes.max_num,
			 view_member_details.age_group,
			 count(view_member_details.id) as cid
			 from view_member_details
			 left join post_distances
			 on view_member_details.post = post_distances.post
			 left join distance_classes
			 on post_distances.class_id = distance_classes.id 
             and view_member_details.club_id = 25
			 group by view_member_details.age_group,distance_classes.id')
			 ->execute();

		return $ret;
	}

		public static function get_distance_seat()
	{
	
		$ret = $memberClassQuery = \DB::query('select
			 distance_classes.max_num,
			 view_member_details.rank_id,
			 count(view_member_details.id) as cid
			 from view_member_details
			 left join post_distances
			 on view_member_details.post = post_distances.post
			 left join distance_classes
			 on post_distances.class_id = distance_classes.id 
             and view_member_details.club_id = 25
			 group by view_member_details.rank_id,distance_classes.id')
			 ->execute();

		return $ret;
	}



}
