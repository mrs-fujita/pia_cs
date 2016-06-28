<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_ReadFile extends Controller_App
{
	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		return Response::forge(View::forge('readFile/index'));
	}

	public function action_upload()
	{

		// 初期設定
		$config = array(
			'path'          => dirname(DOCROOT) . '/uploads/',
			'randomize'     => false,
			'ext_whitelist' => array( 'csv' ),
		);

		// アップロード基本プロセス実行
		Upload::process($config);

		// 検証
		if(Upload::is_valid())
		{

			// ファイルをアップロード
			Upload::save();
			// アップロードしたファイルを取得
			$file = Upload::get_files(0);

			var_dump($file);

			echo "<br><br>";

			// ファイルの保存先
			$file_name = $file['saved_as'];
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

			foreach($csv as $key => $row)
			{
				var_dump($row);
				echo "<br>";
			}

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
				if($file_year == 2014)
				{
					$this->saveMemberFromCsvBefore2014($csv, $club_id, $team_name);
				}
				else
				{
					echo "2015年以降の処理";
				}
			}
			else
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
			}


			$result = Model_CsvTable::save_csv_table_from_file_name($file_name, 1);

			var_dump($result);

			if($result) {
				echo "csvファイルの名前保存に成功";
			}else {
				echo "csvファイルの名前保存に失敗";
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
		//$allCsvFile = Model_CsvTable::find_by();

		$this->template = View::forge('template2');
		$this->template->title = "CSV読み込み完了";
		$this->template->content = View::forge('readFile/list', $data);
	}

	private function saveMemberFromCsvBefore2014($csv, $club_id, $team_name)
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
					// csvの会員グレード名と同じグレードが見つかった場合
					if($row[ $grade_name_col_num ] == $grade["grade_name"])
					{
						// 主キーとなるidを生成 例：JU000001
						$member_id = $team_name . sprintf('%06d', $i);

						// 性別 男性：1、女性：0、 null：null
						$sex_num = null;
						if(!empty( $row[2] ))
							$sex_num = $row[2] == "男" ? 1 : 0;


						// 郵便番号 "-"を削除しInt型に変換
						$post_num = null;
						if(!empty( $row[4] ))
							$post_num = (int) str_replace("-", "", $row[4]);


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
						));

						// メンバーの2014年度として保存する
						$memberRankLog = Model_MemberRankLog::forge()->set(array(
							'member_id' => $member_id,
							'rank_id'   => (int) $grade["menber_rank_id"],
							'year'      => 2014,
							'pia_id'    => $row[1],
						));

						// var_dump($member);

						try
						{
							// DBに保存
							//echo "保存に成功";
							$member->save();
							$memberRankLog->save();

						} catch( Exception $e )
						{
							echo "error: " . $e->getMessage() . "<br>";
							Response::redirect('readFile/upload');
						}

					}
				}
				$i ++;
			}
		}

		Response::redirect('readFile/list');
	}
}
