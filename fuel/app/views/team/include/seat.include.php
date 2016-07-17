<div class="row m-t-10">
	<!-- 座席テーブル -->
	<div class="col-md-8">
		<div class="portlet"><!-- /primary heading -->
			<div id="portlet2" class="panel-collapse collapse in">
				<div class="portlet-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
							<tr>
								<th>座席名</th>
								<th>金額</th>
								<th>グレード</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach($seats as $seat) : ?>
								<tr>
									<td><?php echo $seat["grade_name"] ?></td>
									<td><?php echo $seat["price"] ?>円</td>
									<td>
										<?php if($seat["menber_rank_id"] == 1) : ?>
											<span class="badge bg-info">SS</span>
										<?php elseif($seat["menber_rank_id"] == 2) : ?>
											<span class="badge bg-warning">FC</span>
										<?php elseif($seat["menber_rank_id"] == 3) : ?>
											<span class="badge bg-pink">無料</span>
										<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div> <!-- /Portlet -->
	</div>
	<!-- end 座席テーブル -->

	<!-- 座席種類説明 -->
	<div class="col-md-4">
		<div class="portlet">
			<div class="seatInfo">
				<ul class="seatInfo_list">
					<li class="seatInfo_item">
						<div class="seatInfo_abbreviation"><span class="badge bg-info">SS</span></div>
						<div class="seatInfo_description">・・シーズンシート</div>
					</li>
					<li class="seatInfo_item">
						<div class="seatInfo_abbreviation"><span class="badge bg-warning">FC</span></div>
						<div class="seatInfo_description">・・ファン会員</div>
					</li>
					<li class="seatInfo_item">
						<div class="seatInfo_abbreviation"><span class="badge bg-pink">無料</span></div>
						<div class="seatInfo_description">・・無料会員</div>
					</li>
				</ul>

			</div>
		</div>
	</div>
	<!-- end 座席種類説明 -->

</div>