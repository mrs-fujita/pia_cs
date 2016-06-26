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
class Controller_ReadFile extends Controller
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

		// パラメータを正しい構造で受け取った時のみ実行
		if(isset( $_FILES['up_file']['error'] ) && is_int($_FILES['up_file']['error']))
		{

			try
			{
				// ファイルアップロードエラーチェック
				switch( $_FILES['up_file']['error'] )
				{
					case UPLOAD_ERR_OK:
						// エラー無し
						break;
					case UPLOAD_ERR_NO_FILE:
						// ファイル未選択
						throw new RuntimeException('File is not selected');
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						// 許可サイズを超過
						throw new RuntimeException('File is too large');
					default:
						throw new RuntimeException('Unknown error');
				}

				$file_name = $_FILES['up_file']['name'];
				$tmp_name = $_FILES['up_file']['tmp_name'];
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


				$csv = new SplFileObject($tmp_name, 'r');
				$csv->setFlags(SplFileObject::READ_CSV);

				$data["csv"] = $csv;


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


			} catch( Exception $e )
			{
				// エラーメッセージをセット
				$msg = array( 'red', $e->getMessage() );
			}


		}
		else
		{
			// ファイルがなかった場合
		}

		//return Response::forge(View::forge('readFile/upload', $data));
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
						}

					}
				}
				//echo "<br><br>";
				$i ++;
			}
		}
	}


}
