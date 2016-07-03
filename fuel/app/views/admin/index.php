<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">勝敗一覧</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>ユーザid</th>
									<th>ユーザ名</th>
									<th>使用開始日</th>
									<th>使用終了日</th>
								</tr>
								</thead>

								<tbody>
								<?php foreach($admins as $admin): ?>
									<tr>
										<th scope="row"><?php echo $admin["id"] ?></th>
										<td><?php echo $admin["name"] ?></td>
										<td><?php echo $admin["available_startday"] ?></td>
										<td><?php echo $admin["available_endday"] ?></td>
										<td>
											<?php
											echo Form::open('admin/detail');
											echo Form::hidden("id",$admin["id"]);
											echo Form::submit('submit','詳細',array('class'=>'btn','type'=>'submit'));
											echo Form::close();
											?>
										</td>
										<td>
											<?php
											echo Form::open('');  //Task.01 管理者を削除するアクションにリンクさせる（"admin/delete"）
											echo Form::hidden("id",$admin["id"]);
											echo Form::submit('submit','削除',array('class'=>'btn','type'=>'submit'));
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