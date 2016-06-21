<?php
class Model_Auth extends Model_Crud {

  protected static $_table_name = "user";

  public static function get_auth($name,$pass)
    {
      $ret["accept"] = false;
      $ret["id"] = null;
      //$accept = false;
      //$id = null;
        $rows = DB::select()->
                from('Admin_Table')->
                //引数$date, $limit=5, $offset=0
                //query(ゼンブカキー)->excute();でもいけるンゴ
                // where('published', '>=', $date->format('Y-m-d H:i:s'))->
                // order_by('published', 'desc')->
                // limit($limit)->
                // offset($offset)->
                execute();

        foreach($rows as $row){
          if($row["name"] === $name){
            if($row["password"] == $pass){
              $ret["accept"] = true;
              $ret["id"] = $row["id"];
              //$accept = true;
              break;
            }
          }
        }
        return $ret;
    }
}
