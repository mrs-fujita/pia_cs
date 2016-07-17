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

<!-- 座席情報変更モーダル -->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<form action="<?php echo Uri::base(false) ?>seat/save" accept-charset="utf-8" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">チーム座席情報</h4>
				</div>
				<div class="modal-body">

					<table class="table">
						<thead>
						<tr>
							<th>座席名</th>
							<th>金額</th>
							<th>グレード</th>
						</tr>
						</thead>
						<tbody>
						<tbody>
						<?php foreach($seats as $key => $seat) : ?>
							<input type="hidden" value="<?php echo $seat["id"] ?>" name="seats[<?php echo $key ?>][id]">
							<tr>
								<td style="vertical-align: middle"><?php echo $seat["grade_name"] ?></td>
								<td>
									<input type="text" class="form-control" id="field-2" value="<?php echo $seat["price"] ?>"
									       style="width: 80%; display: inline-block" name="seats[<?php echo $key ?>][price]"> 円
								</td>
								<td>
									<select class="form-control" name="seats[<?php echo $key ?>][rank]">
										<?php if($seat["menber_rank_id"] == 1) : ?>
											<option selected>SS</option>
										<?php else : ?>
											<option>SS</option>
										<?php endif; ?>

										<?php if($seat["menber_rank_id"] == 2) : ?>
											<option selected>FC</option>
										<?php else : ?>
											<option>FC</option>
										<?php endif; ?>

										<?php if($seat["menber_rank_id"] == 3) : ?>
											<option selected>無料</option>
										<?php else : ?>
											<option>無料</option>
										<?php endif; ?>
									</select>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-info">Save changes</button>
				</div>
			</div>
		</form>
	</div>
</div><!-- /.modal -->
<!-- end 座席情報変更モーダル -->

<button class="btn btn-primary" data-toggle="modal" data-target="#con-close-modal">座席情報編集</button>