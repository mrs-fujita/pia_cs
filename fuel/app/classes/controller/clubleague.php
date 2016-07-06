<?php
class Controller_clubleague extends Controller
{
  public function action_index()
  {
    $data['clubleague'] = Model_clubleague::find_by();
    return Response::forge(View::forge('clubleague/index',$data));
  }
}
