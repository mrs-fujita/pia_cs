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
									<th>試合日</th>
									<th>開始時間</th>
									<th>得点</th>
									<th>対戦クラブ名</th>
									<th>スタジアム</th>
									<th>試合結果</th>
									<th>順位</th>
									<th>観客数</th>
									<th>天気</th>
									<th>ホーム/アウェイ</th>
								</tr>
								</thead>


								<tbody>
								<?php foreach($competitions as $competition): ?>
									<?php
									$score = $competition["score"] . " - " . $competition["lost"];
									$defeat = "";
									if($competition["defeat"] == - 1) $defeat = "負け";
									elseif($competition["defeat"] == 0) $defeat = "引き分け";
									else $defeat = "勝ち";
									$place = $competition["home_club"] ? "ホーム" : "アウェイ";
									?>
									<tr>
										<td><?php echo $competition["event_day"] ?></td>
										<td><?php echo $competition["start_time"] ?></td>
										<td><?php echo $score ?></td>
										<td><?php echo $competition["opponent_club_name"] ?></td>
										<td><?php echo $competition["stadium_name"] ?></td>
										<td><?php echo $defeat ?></td>
										<td><?php echo $competition["my_club_name"] ?></td>
										<td><?php echo $competition["audience_sum"] ?></td>
										<td><?php echo $competition["weather"] ?></td>
										<td><?php echo $place ?></td>
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