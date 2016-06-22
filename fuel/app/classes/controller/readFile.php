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
	public function action_index() {
		return Response::forge(View::forge('readFile/index'));
	}

	public function action_upload() {

		//参考URL：http://qiita.com/mpyw/items/caa2568284b69d270f8b

		//$data["row"] = [];
		//$data["fp"] = [];
		$data["csv"] = [];
		$data["team_name"] = [];
		$data["year"] = [];
		$data["grade"] = [];
		//$data["file_name"] = [];

		// パラメータを正しい構造で受け取った時のみ実行
		if (isset($_FILES['up_file']['error']) && is_int($_FILES['up_file']['error'])) {

			try {
				// ファイルアップロードエラーチェック
				switch ($_FILES['up_file']['error']) {
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
				if (!$encoding = mb_detect_encoding($buffer, $detect_order, true)) {
					// 文字コードの自動判定に失敗
					unset($buffer);
					throw new RuntimeException('Character set detection failed');
				}
				file_put_contents($tmp_name, mb_convert_encoding($buffer, 'UTF-8', $encoding));
				unset($buffer);


				$csv = new SplFileObject($tmp_name, 'r');
				$csv->setFlags(SplFileObject::READ_CSV);

				$data["csv"] = $csv;



				$arr = explode("_", $file_name);

				$team_name = $arr[0]; //TO, NGなどのチーム名を取得
				$data["team_name"] = $team_name;
				$data["year"] = $arr[1]; // 年度を取得

				// CLUBの情報を取得
				$club = Model_Club::find_one_by('pia_clubcode', $team_name);
				$club_id = $club["id"]; // clubのidを取得
				$data["club_id"] = $club_id;

				$data["club"] = $club;


				$grade = Model_ClubMenberRank::get_club_rank_from_club_id((int)$club_id);
				$data["grade"] = $grade;



			}catch (Exception $e) {
				// エラーメッセージをセット
				$msg = array('red', $e->getMessage());
			}


		}else {
			// ファイルがなかった場合
		}

		return Response::forge(View::forge('readFile/upload', $data));
	}
}
