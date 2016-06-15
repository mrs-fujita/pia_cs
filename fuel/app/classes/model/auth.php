<?php
class Model_Auth extends Model_Crud {

  protected static $_table_name = "user";

  public static function get_auth($name,$pass)
    {
      $accept = false;
        $ret = DB::select()->
                from('Admin_Table')->
                //引数$date, $limit=5, $offset=0
                //query(ゼンブカキー)->excute();でもいけるンゴ
                // where('published', '>=', $date->format('Y-m-d H:i:s'))->
                // order_by('published', 'desc')->
                // limit($limit)->
                // offset($offset)->
                execute();

        foreach($ret as $value){
          if($value["name"] === $name){
            if($value["password"] == $pass){
              $accept = true;
            }
          }
        }
        return $accept;
    }
}
