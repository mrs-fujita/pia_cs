<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">イベント詳細</h3>
				</div>
				<div class="panel-body">
					<div class=" form">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>イベントid</th>
								<th>イベント名</th>
								<th>開催場所名</th>
								<th>開催日</th>
								<th>開催内容</th>
								<th>総来客数</th>
							</tr>
							</thead>
							<tbody>
						<?php foreach ((array)$details as $detail): ?>
							<tr>
								<th scope="row"><?php echo $detail["id"] ?></th>
								<td><?php echo $detail["name"] ?></td>
								<td><?php echo $detail["venue"] ?></td>
								<td><?php echo $detail["dating"] ?></td>
								<td><?php echo $detail["content"] ?></td>
								<td><?php echo $detail["visitors_num"] ?></td>
								<td>
									<?php
										echo Form::open(array('action' => 'event/update', 'method' => 'get'));
										echo Form::hidden("id",$detail["id"]);
										echo Form::submit("","更新");
										echo Form::close();
									?>
								</td>
								<td>
									<?php
								    echo Form::open('event/index');
								    echo Form::submit("","戻る");
								    echo Form::close();
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>

		</div>
		<!-- End Row -->

		</div>
