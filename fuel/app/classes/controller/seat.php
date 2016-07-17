<?php

class Controller_Seat extends Controller_App
{
	public function action_save()
	{
		//$this->template = View::forge('template_test');

		$post = Input::post();

		if($post)
		{
			$seats = $post["seats"];

			$err_flg = false;

			foreach($seats as $seat)
			{
				//var_dump($seat);

				// シートのランクからシートのidを求める
				$rank_id = 0;
				if($seat["rank"] == "SS")
					$rank_id = 1;
				elseif($seat["rank"] == "FC")
					$rank_id = 2;
				else $rank_id = 3;

				// 保存するためのモデルを用意
				$seatModel = Model_ClubMenberRank::forge()->set(array(
					"id"             => $seat["id"],
					"menber_rank_id" => $rank_id,
					"price"          => $seat["price"],
				));
				$seatModel->is_new(false);  //update可能にする

				if($seatModel->save())
				{
					//echo "保存成功" . "<br>";
				}
				else
				{
					$err_flg = true;
					//echo "保存失敗";
				}
			}

			if($err_flg) {
				Response::redirect('team/detail');  //保存に成功
			}else {
				Response::redirect('team/detail');  //保存に失敗
			}

		}
		else
		{
			Response::redirect('analysis');
		}
	}
}

?>