<?php
class Controller_league extends Controller
{
  public function action_index()
  {
    $data["league"] = Model_ViewClubLeagueDetalis::find_by();
    return Response::forge(View::forge('league/index',$data));
  }
}
