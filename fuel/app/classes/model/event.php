<?php
class Model_Event extends Model_Crud {

  protected static $_table_name = "event_table";

  public static function post_add($info)
    {
      // query("INSERT INTO event_table (`id`, `club_id`, `category_id`, `venue`, `post`, `dating`, `start_time`, `end_time`, `content`)
      // VALUES (".$info["id"].",".$info["club_id"].",".$info["category_id"].",".$info["venue"].",".$info["post"].",".$info["dating"].",".$info["start_time"].",".$info["end_time"].","
      // .$info["content"].")")
      $accept = DB::query("INSERT INTO event_table (`club_id`, `category_id`, `venue`, `post`, `dating`,`content`)
      VALUES (1,1,'".$info["venue"]."','".$info["post"]."','".$info["dating"]."','".$info["content"]."')")
      ->execute();
      return $accept;
    }

  public static function post_team($id,$info)
    {
      $accept = false;
      //write update sql
      $ret = DB::query(/*sql code*/)->
                execute();
      return $accept;
    }
}
