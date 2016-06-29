<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>ユーザー一覧</h1>

<table>
	<thead class="thead-default">
	<tr>
		<th>ユーザid</th>
		<th>ユーザ名</th>
		<th>使用開始日</th>
		<th>使用終了日</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($users as $user): ?>
		<tr>
			<th scope="row"><?php echo $user["id"] ?></th>
			<td><?php echo $user["name"] ?></td>
			<td><?php echo $user["available_startday"] ?></td>
			<td><?php echo $user["available_endday"] ?></td>
			<td>
				<?php
				echo Form::open('user/detail');
				echo Form::hidden('id', $user["id"], array());
				echo Form::submit('submit','詳細',array('class'=>'btn','type'=>'submit'));
				echo Form::close();
				?>
			</td>
			<td>
				<?php
				echo Form::open('user/index_add');
				echo Form::submit('submit','削除',array('class'=>'btn','type'=>'submit'));
				echo Form::close();
				?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo Html::anchor('user/add', 'ユーザ追加'); ?>

</body>
</html>
