<div class="wraper container-fluid">
	<!--<div class="page-title">
		<h3 class="title">Datatable</h3>
	</div>-->

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
									<th>性別</th>
									<th>会員ランク</th>
									<th>クラブ会員</th>
									<th>誕生日</th>
									<th>郵便番号</th>
								</tr>
								</thead>


								<tbody>
								<?php foreach($members as $member): ?>

									<tr>
										<td><?php echo $member["gender"] ?></td>
										<td><?php echo $member["rank_id"] ?></td>
										<td><?php echo $member["member_rank_name"] ?></td>
										<td><?php echo $member["birthday"] ?></td>
										<td><?php echo $member["post"] ?></td>
									</tr>


								<?php endforeach;?>

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