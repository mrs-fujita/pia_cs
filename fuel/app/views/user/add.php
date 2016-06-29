<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ユーザー追加</title>
</head>
<body>
<p>user/index</p>
<h1>ユーザー追加</h1>

<?php echo Form::open('user/save'); ?>

<?php
echo Form::label('名前：', 'name', array( 'class' => 'user_nameLabel' ));
echo Form::input("name", "", array( 'id' => 'name', 'class' => 'user_nameInput form_input' ));
?>
<br>

<?php
echo Form::label('パスワード：', 'passwd', array( 'class' => 'user_nameLabel' ));
echo Form::input("passwd", "", array( 'id' => 'passwd', 'class' => 'user_passwdInput form_input' ));
?>
<br>

<?php
echo Form::label('パスワード確認：', 'rePasswd', array( 'class' => 'user_nameLabel' ));
echo Form::input("rePasswd", "", array( 'id' => 'rePasswd', 'class' => 'user_rePasswdInput form_input' ));
?>
<br>

<?php
echo Form::label('使用開始：', 'start_time', array( 'class' => 'user_nameLabel' ));
echo Form::input("start_time", "", array( 'id' => 'start_time', 'class' => 'user_startTimeInput form_input'));
?>
<br>

<?php
echo Form::label('使用終了：', 'end_time', array( 'class' => 'user_nameLabel' ));
echo Form::input("end_time", "", array( 'id' => 'end_time', 'class' => 'user_endTimeInput form_input'));
?>
<br>

<?php echo Form::submit(); ?>
<?php echo Form::close(); ?>


</body>
</html>
