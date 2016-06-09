<?php
class Model_User extends Model_Crud {

  protected static $_table_name = "user";

  public static function post_adduser($info)
    {
      /*
      *$info is add data by array.
      */
      $accept = DB::query("INSERT INTO /*table name*/ (/*columns name,columns name,...*/)
      VALUES (/*add data,add data,...*/)")->
                        execute();
      return $accept
    }

}
