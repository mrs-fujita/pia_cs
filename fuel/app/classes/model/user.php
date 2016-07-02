<?php
class Model_User extends Model_Crud {

  protected static $_table_name = "admin_table";

  public static function select_alluser()
    {
      $accept = DB::query("select * from admin_table")->
                        execute();
      return $accept;
    }


  public static function find_user($id)
    {
      $accept = DB::query("select * from admin_table where id =".$id)->
                        execute();
      return $accept;
    }

  public static function del_user($id)
    {
      $accept = DB::query("delete from admin_table where id =".$id)->
                        execute();
      return $accept;
    }


  public static function post_adduser($info)
    {
      /*
      *$info is add data by array.
      */
      $accept = DB::query("INSERT INTO admin_table (authoriry_id, name, password, available_startday,available_endday)
      VALUES (".$info["authority"].",".
      $info["name"].",".
      $info["passwd"].",".
      $info["start_time"].",".
      $info["end_time"].",")->
                        execute();
      return $accept;
    }

    public static function post_adduser($info)
      {
        /*
        *$info is add data by array.
        */
        $accept = DB::query("INSERT INTO admin_table (authoriry_id, name, password, available_startday,available_endday)
        VALUES (".$info["authority"].",".
        $info["name"].",".
        $info["passwd"].",".
        $info["start_time"].",".
        $info["end_time"].",")->
                          execute();
        return $accept;
      }

}

?>
