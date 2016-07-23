<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">イベント一覧</h3>
					<?php
			    echo Form::open('event/add');
			    echo Form::submit("","新規登録");
			    echo Form::close();
					?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
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
								<?php foreach ((array)$events as $event): ?>
									<tr>
										<th scope="row"><?php echo $event["id"] ?></th>
										<td><?php echo $event["name"] ?></td>
										<td><?php echo $event["venue"] ?></td>
										<td><?php echo $event["dating"] ?></td>
										<td><?php echo $event["content"] ?></td>
										<td><?php echo $event["visitors_num"] ?></td>
										<td>
											<?php
													echo Form::open(array('action' => 'event/detail', 'method' => 'get'));
											    echo Form::hidden("id",$event["id"]);
											    echo Form::submit("","詳細");
											    echo Form::close();
											?>
										</td>
										<td>
											<?php
													echo Form::open('event/delete');
											    echo Form::hidden("id",$event["id"]);
											    echo Form::submit("","削除");
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
		</div>

	</div>
	<!-- End Row -->


</div>
    ?>
