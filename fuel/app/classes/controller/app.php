<?php
/**
 * ユーザ認証が行われているかを確認し、
 * ユーザ認証が済んでいなかった場合はログイン画面にリダイレクトさせるコントローラー
 *
 * Class Controller_App
 */
class Controller_App extends Controller_Template {
	public function before() {
		parent::before();
		// 認証処理などの共通処理を記述
		$userid = Session::get('userid');

		if($userid == null) {
			Response::redirect('user/login');
		}
	}
}
?>