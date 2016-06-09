<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>readFile</title>
	<?php echo Asset::css('main.css'); ?>
</head>
<body>

<form method="post" action="readFile/upload" enctype="multipart/form-data">
	<div class="readCsv">
		<p id="response" class="readCsv_response"></p>
		<div id="dropto" class="readCsv_dropFile">ファイルをここにドロップ</div>
		<div id="progress" class="readCsv_progress">
			<div id="percent" class="readCsv_percent"></div>
		</div>
		または<input name="up_file" type="file" id="input-file">
		<input type="submit" value="csvファイルを読み込む" class="readCsv_submit">
	</div>
</form>

</body>
</html>