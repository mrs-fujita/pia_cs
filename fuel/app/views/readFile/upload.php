<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>readFile</title>
	<?php echo Asset::css('main.css'); ?>
</head>
<body>

<p>upload</p>

<?php //echo $file_name; ?>

<?php //echo $team_name; ?>

<?php //var_dump($club); ?>
<br>
<br>

<?php

foreach($grades as $grade) {
	var_dump($grade["grade_name"]);
	echo "<br><br>";
}
?>
<br>
<br>


<?php
foreach($csv as $key => $row) {
	if($key != 0) {
		echo $key;
		echo "<br>";
		var_dump($row);
		echo "<br><br>";
	}

}
?>

</body>
</html>