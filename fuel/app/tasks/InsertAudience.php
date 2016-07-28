<?php

namespace Fuel\Tasks;

class InsertAudience
{
	/**
	 *
	 */
	public function run()
	{
		// config/development/db.phpに追加しないとDBに接続出来ないので注意
		// 参考URL：http://qiita.com/maximum80/items/eb91248583dae795ec3d

		// CSVから読み込んだ仮の状態の観戦情報を取得
		$watch_infos = \Model_WatchingInfoProvisional::find_by(array(
			'rewriting_flg' => 0,
		), null, null, 1000);

		foreach($watch_infos as $info)
		{
			// pia_idが同じメンバーを取得する
			$member = \Model_ViewMemberDetail::find_by(array(
				"pia_id" => $info["pia_id"],
			));
			//var_dump($member[0]["id"]);

			// 観戦情報の日付とクラブidで試合情報を取得する
			$competition = \Model_Competition::find_by(array(
				"club_id_a" => $info["club_id"],
				"event_day" => $info["date"],
			));
			//var_dump($competition[0]["id"]);

			// 観戦情報テーブルにメンバー情報と試合情報を保存する
			$audience = \Model_Audience::forge()->set(array(
				"menber_id"      => $member[0]["id"],
				"competition_id" => $competition[0]["id"],
			));

			// 観戦情報を保存し、保存を行った観戦情報の仮テーブルの書き込みフラグを書き込み済みに変更する
			if($audience->save())
			{
				//echo "save成功";
				//var_dump($info);
				$info["rewriting_flg"] = 1;
				$info->save();
			}
			else echo "保存失敗";
		}
		echo "書き込み終了";
	}


	public function collect()
	{
		$end_flg = false;

		while( !$end_flg )
		{
			$index = 1;
			// CSVから読み込んだ仮の状態の観戦情報を取得
			$watch_infos = \Model_WatchingInfoProvisional::find_by(array(
				'rewriting_flg' => 0,
			), null, null, 10);

			// 仮の観戦情報の処理が全て終わっていなければ処理を行う
			if(count($watch_infos) == 0)
			{
				// 全ての処理が終わっている時
				$end_flg = true;
				echo "全件の処理が終わっているので、処理を終了します";

			}else {
				// 仮の状態から処理を行う
				$this->run();
				echo $index . "件目 処理完了\n";

				$index++;
			}
		}
	}


	public function reset()
	{
		// 観戦情報テーブルを全て削除
		$audiences = \Model_Audience::find_by();
		foreach($audiences as $audience)
		{
			$audience->delete();
		}

		// 書き込みフラグが立っている観戦情報の仮テーブルを取得
		$watch_infos = \Model_WatchingInfoProvisional::find_by(array(
			'rewriting_flg' => 1,
		));

		// 書き込みフラグの値を書き込んでいない状態に変更する
		foreach($watch_infos as $info)
		{
			$info["rewriting_flg"] = 0;
			$info->save();
		}

		echo "リセット処理終了";
	}
}