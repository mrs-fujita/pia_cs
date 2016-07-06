<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">カテゴリ一覧</h3>
					<?php
			    echo Form::open('category/add');
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
									<th>カテゴリid</th>
									<th>カテゴリ名</th>
									<th>イメージカラー</th>
									<th>さんぽー</th>
								</tr>
								</thead>

								<tbody>
								<?php foreach((array)$category as $cate): ?>
									<tr>
										<th scope="row"><?php echo $cate["category_id"] ?></th>
										<td><?php echo $cate["name"] ?></td>
										<td><?php echo $cate["color"] ?></td>
										<td>さんぽー</td>
										<td>
											<?php
											echo Form::open(array('action' => 'category/detail', 'method' => 'get'));
									    echo Form::hidden("id",$cate["category_id"]);
									    echo Form::submit("","詳細");
									    echo Form::close();
											?>
										</td>
										<td>
											<?php
													echo Form::open('category/delete');
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
