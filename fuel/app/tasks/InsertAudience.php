<?php

namespace Fuel\Tasks;

class InsertAudience
{
	public function run()
	{
		// config/development/db.phpに追加しないとDBに接続出来ないので注意
		// 参考URL：http://qiita.com/maximum80/items/eb91248583dae795ec3d


		$member = \Model_ViewMemberDetail::find_all(10, 0);

		var_dump($member);
	}
}