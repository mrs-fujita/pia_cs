<?php

class Controller_ReadFile extends Controller_AppAdmin
{

	public function action_index()
	{
		// テンプレートを使用して管理者の一覧を表示
		$this->template->title = "ファイル読み込み";
		$this->template->content = View::forge('readFile/index');
	}

	/**
	 * csvFileのアップロードを行うアクション
	 */
	public function action_upload()
	{
		// アップロード出来るファイルの初期設定
		$config = array(
			'path'          => dirname(DOCROOT) . '/uploads/',  //ファイルの保存先
			'randomize'     => false,  // 保存する際のファイル名の変更
			'ext_whitelist' => array( 'csv' ),  // 保存するファイルの種類の変更
		);

		// アップロード基本プロセス実行
		Upload::process($config);

		// ファイルのアップロードに成功したかを検証
		if(Upload::is_valid())
		{
			// ファイルをアップロード
			Upload::save();
			// アップロードしたファイルを取得
			$file = Upload::get_files(0);

			// ファイル名
			$file_name = $file['saved_as'];
			// ファイルの保存先
			$tmp_name = $file['saved_to'] . $file['saved_as'];
			$detect_order = 'ASCII,JIS,UTF-8,CP51932,SJIS-win';
			setlocale(LC_ALL, 'ja_JP.UTF-8');

			// 文字コードを変換してファイルを置換
			$buffer = file_get_contents($tmp_name);
			if(!$encoding = mb_detect_encoding($buffer, $detect_order, true))
			{
				// 文字コードの自動判定に失敗
				unset( $buffer );
				throw new RuntimeException('Character set detection failed');
			}
			file_put_contents($tmp_name, mb_convert_encoding($buffer, 'UTF-8', $encoding));
			unset( $buffer );

			// CSVを読み込み
			$csv = new SplFileObject($tmp_name, 'r');
			$csv->setFlags(SplFileObject::READ_CSV);


			// ファイル名から年度とチーム名を取得
			$arr = explode("_", $file_name);
			$team_name = $arr[0]; //チーム名      TO, NG
			$file_year = $arr[1]; //ファイルの年度 2014, 2015
			$file_type = $arr[2]; //ファイルの区分 member, kansen


			// CLUBの情報を取得
			$club = Model_Club::find_one_by('pia_clubcode', $team_name);
			$club_id = $club["id"]; // clubのidを取得

			if($file_type == "member")
			{
				$this->saveMemberFromCsvBefore($csv, $club_id, $team_name, $file_name, $file_year);

				if($file_year == 2014)
				{

				}
				else
				{
					echo "2015年以降の処理";
				}
			}
			else
			{
				//観戦情報の処理
				$this->save_watching_info_from_csv($csv, $club_id, $file_year, $file_name);
			}
			Response::redirect("readFile/list");

		}
		else //ファイルの読み込みに失敗
		{
			Response::redirect("readFile/index");
		}
	}

	/**
	 * 読み込んだCSVの一覧を表示する
	 */
	public function action_list()
	{
		$data["csvFiles"] = Model_CsvTable::find_by();

		$this->template->title = "CSV読み込み一覧";
		$this->template->content = View::forge('readFile/list', $data);
	}

	private function saveMemberFromCsvBefore($csv, $club_id, $team_name, $file_name, $file_year)
	{
		// チームの会員グレードが指定されている列番号
		$grade_name_col_num = 13;

		// チームの会員のグレードを取得する
		$grades = Model_ClubMenberRank::get_club_rank_from_club_id((int) $club_id);
		$data["grades"] = $grades;


		$i = 0;
		foreach($csv as $key => $row)
		{
			if($key != 0)
			{
				foreach($grades as $grade)
				{
					try
					{
						//echo "row2" . $row[ $grade_name_col_num ] . "<br>";
						// csvの会員グレード名と同じグレードが見つかった場合
						if($row[ $grade_name_col_num ] == $grade["grade_name"])
						{
							// 主キーとなるidを生成 例：JU000001
							$member_id = $team_name . sprintf('%06d', $i);

							// シートのid
							$seat_id = $grade["id"];

							// 性別 男性：1、女性：0、 null：null
							$sex_num = null;
							if(!empty( $row[2] ))
								$sex_num = $row[2] == "男" ? 1 : 0;


							// 郵便番号 "-"を削除しInt型に変換
							$post_num = null;
							if(!empty( $row[4] ))
								$post_num = (int) str_replace("-", "", $row[4]);

							$age = null;
							if(!empty( $row[3] ))
								$age = 2014 - (int) ( explode("/", $row[3])[0] );

							$age_group = null;
							if($age != null)
								$age_group = $age / 10;


							if($file_year == 2014)
							{
								// 登録するメンバーを生成
								$member = Model_Member::forge()->set(array(
									'id'                => $member_id,
									'club_id'           => (int) $club_id,
									'gender'            => $sex_num,
									'birthday'          => $row[3],
									'post'              => $post_num,
									'address1'          => $row[5],
									'address2'          => $row[6],
									'address3'          => $row[7],
									'address4'          => $row[8],
									'home_tell'         => $row[9],
									'mobile_tell'       => $row[10],
									'family_name_kana'  => $row[15],
									'family_name_kanji' => $row[17],
									'first_name_kana'   => $row[16],
									'first_name_kanji'  => $row[18],
									'age'               => $age,
									'age_group'         => $age_group,
								));

								// メンバーの2014年度として保存する
								$memberRankLog = Model_MemberRankLog::forge()->set(array(
									'member_id' => $member_id,
									'rank_id'   => (int) $grade["menber_rank_id"],
									'year'      => $file_year,
									'pia_id'    => $row[1],
									'seat_id'   => $seat_id,
								));

								try
								{
									// DBに保存
									//echo "保存に成功";
									$member->save();
									$memberRankLog->save();

								} catch( Exception $e )
								{
									echo "error: " . $e->getMessage() . "<br>";
									//Response::redirect('readFile/index');
								}


							}
							else
							{
								// 登録するメンバーを生成
								$member = Model_MemberProvisinal::forge()->set(array(
									'id'                => $member_id,
									'club_id'           => (int) $club_id,
									'gender'            => $sex_num,
									'birthday'          => $row[3],
									'post'              => $post_num,
									'address1'          => $row[5],
									'address2'          => $row[6],
									'address3'          => $row[7],
									'address4'          => $row[8],
									'home_tell'         => $row[9],
									'mobile_tell'       => $row[10],
									'family_name_kana'  => $row[15],
									'family_name_kanji' => $row[17],
									'first_name_kana'   => $row[16],
									'first_name_kanji'  => $row[18],
									'age'               => $age,
									'age_group'         => $age_group,
								));

								/*
								// メンバーの2014年度として保存する
								$memberRankLog = Model_MemberRankLog::forge()->set(array(
									'member_id' => $member_id,
									'rank_id'   => (int) $grade["menber_rank_id"],
									'year'      => $file_year,
									'pia_id'    => $row[1],
								));*/


								try
								{
									// DBに保存
									//echo "保存に成功";
									$member->save();
									//$memberRankLog->save();

								} catch( Exception $e )
								{
									echo "error: " . $e->getMessage() . "<br>";
									//Response::redirect('readFile/index');
								}
							}
						}
					} catch( Exception $e )
					{
						// 何故か$row[ $grade_name_col_num ]でエラーが起きる事があるので・・
						//echo "if文でエラー";
					}
				}
				$i ++;
			}
		}

		$result = Model_CsvTable::save_csv_table_from_file_name($file_name, 1);

		if($result)
		{
			echo "csvファイルの名前保存に成功";
		}
		else
		{
			echo "csvファイルの名前保存に失敗";
		}

		Response::redirect('readFile/list');
	}

	private function save_watching_info_from_csv($csv, $club_id, $file_year, $file_name)
	{
		foreach($csv as $key => $row)
		{
			if($key != 0)
			{
				$wip = Model_WatchingInfoProvisional::forge()->set(array(
					"pia_id"  => $row[0],
					"club_id" => $club_id,
					"date"    => $row[2],
					"year"    => $file_year,
				));

				try
				{
					$wip->save();

				} catch( Exception $e )
				{
					// エラーメッセージをセット
					$msg = array( 'red', $e->getMessage() );
				}
			}
		}
		$result = Model_CsvTable::save_csv_table_from_file_name($file_name, 1);

		if($result)
		{
			echo "csvファイルの名前保存に成功";
		}
		else
		{
			echo "csvファイルの名前保存に失敗";
		}
		//return Response::forge(View::forge('readFile/list'));
		Response::redirect("readFile/list");
	}
}
