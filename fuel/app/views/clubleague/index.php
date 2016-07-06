<?php
var_dump($clubleague);
 ?>
<br>
<?php
foreach ($clubleague as $val) {
  echo "ID:".$val["id"]."Club_ID:". $val["club_id"] ."league_ID:". $val["league_id"] ."Season_ID:". $val["season_id"] . "<br>";
}
?>
