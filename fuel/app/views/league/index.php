<?php
  var_dump($league);
 ?>

<br>
<br>

<?php

header("Content-Type: text/html; charset=UTF-8");

foreach ($league as $val) {
  echo $val["クラブID"].",". $val["クラブ名"].",".$val["ぴあクラブコード"].",".$val["シーズン開始日"].",".$val["シーズン終了日"].",".$val["シーズン名"].",".$val["リーグ名"]. "<br>";
}
 ?>
