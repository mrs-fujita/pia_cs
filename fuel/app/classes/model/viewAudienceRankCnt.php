<?php

class Model_ViewAudienceRankCnt extends \Orm\Model
{

	protected static $_table_name = "view_audience_rank_cnts";

	protected static $_primary_key = array();

	protected static $_properties = array(
		"cnt",
		"club_id",
		"seat_id",
		"rank_id",
		"competition_id",
		"year"
	);

	/**
	 *
	 * 指定のクラブの指定の試合のシート別の観客数を配列で返す
	 *
	 * @param $club_id
	 * @param $competition_ids
	 *
	 * @return array
	 */
	public static function get_ranking_distinction_cnt($club_id, $competition_ids)
	{

		// 指定のクラブの指定の試合のデータを取得
		$rets = DB::select()
			->from("view_audience_rank_cnts")
			->where("club_id", $club_id)
			->and_where("competition_id", "in", $competition_ids)
			->execute();

		$rank_cnts = array(0, 0, 0);

		// シート毎の観客数の合計を取得
		foreach($rets as $ret)
		{
			if($ret["rank_id"] == 1) $rank_cnts[0] = ( $rank_cnts[0] + (int)($ret["cnt"]) );
			else if($ret["rank_id"] == 2) $rank_cnts[1] = ( $rank_cnts[1] + (int)($ret["cnt"]) );
			else if($ret["rank_id"] == 3) $rank_cnts[2] = ( $rank_cnts[2] + (int)($ret["cnt"]) );
		}

		//var_dump($rank_cnts);

		return $rank_cnts;
	}
}

?>