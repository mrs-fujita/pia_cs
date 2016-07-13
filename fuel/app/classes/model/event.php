<?php
class Model_Event extends Model_Crud {

  protected static $_table_name = "event_table";
  //protected static $_primary_key = "id";

  public static function post_add($info)
    {
      // query("INSERT INTO event_table (`id`, `club_id`, `category_id`, `venue`, `post`, `dating`, `start_time`, `end_time`, `content`)
      // VALUES (".$info["id"].",".$info["club_id"].",".$info["category_id"].",".$info["venue"].",".$info["post"].",".$info["dating"].",".$info["start_time"].",".$info["end_time"].","
      // .$info["content"].")")
      $accept = DB::query("INSERT INTO event_table (`club_id`, `category_id`, `venue`, `post`, `dating`,`content`,`name`,`man_num`,`woman_num`,`visitors_num`)
      VALUES (25,'".$info["category_id"]."','".$info["venue"]."','".$info["post"]."','".$info["dating"]."','".$info["content"]."','".$info["name"]."','".$info["man_num"]."','".$info["woman_num"]."','".$info["visitors_num"]."')")
      ->execute();
      return $accept;
    }

}
