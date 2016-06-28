<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>readFile</title>
	<?php echo Asset::css('main.css'); ?>
</head>
<body>

<?php echo Form::open(array("name" => "upload", "action" => 'readFile/upload','enctype'=>'multipart/form-data','method'=>'post')); ?>
	<div class="readCsv">
		<p id="response" class="readCsv_response"></p>
		<div id="dropto" class="readCsv_dropFile">ファイルをここにドロップ</div>
		<div id="progress" class="readCsv_progress">
			<div id="percent" class="readCsv_percent"></div>
		</div>
		または<?php echo Form::file('upload'); ?>
		<?php echo Form::submit('submit', 'Upload', array('class' => 'btn btn-primary', "value" => "CSVを読み込む")); ?>
	</div>
<?php echo Form::close(); ?>

</body>
</html>