<?php
class Model_Team extends Model_Crud {

  protected static $_table_name = "Club_Table";

  public static function post_team($id,$data_u)
    {
      $accept = false;
      //write update sql
      $ret = DB::query(/*sql code*/)->
                execute();

      return $accept;
    }
}
