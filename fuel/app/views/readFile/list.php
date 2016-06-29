<table class="table table-striped table-bordered">
	<thead class="thead-default">
	<tr>
		<th>id</th>
		<th>管理者id</th>
		<th>ファイル名</th>
		<th>追加日</th>
	</tr>
	</thead>

	<tbody>
	<?php foreach($csvFiles as $csvFile): ?>
		<tr>
			<th scope="row"><?php echo $csvFile["id"] ?></th>
			<td><?php echo $csvFile["admin_id"] ?></td>
			<td><?php echo $csvFile["file_name"] ?></td>
			<td><?php echo $csvFile["add_time"] ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>

</table>
