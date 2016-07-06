<?php
class Model_Category extends Model_Crud {

  protected static $_table_name = "category_table";
  protected static $_primary_key = "category_id";

  public static function post_add($info)
    {
      // query("INSERT INTO event_table (`id`, `club_id`, `category_id`, `venue`, `post`, `dating`, `start_time`, `end_time`, `content`)
      // VALUES (".$info["id"].",".$info["club_id"].",".$info["category_id"].",".$info["venue"].",".$info["post"].",".$info["dating"].",".$info["start_time"].",".$info["end_time"].","
      // .$info["content"].")")
      $accept = DB::query("INSERT INTO category_table (`name`, `color`)
      VALUES ('".$info["name"]."','".$info["color"]."')")
      ->execute();
      return $accept;
    }
}
