<div class="profile-desk">
	<h1><?php echo $club["name"] ?></h1>
	<span class="designation"><?php echo $league_name ?></span>
	<p>
		<?php echo $club["detail"] ?>
	</p>

	<table class="table table-condensed">
		<thead>
		<tr>
			<th colspan="3"><h3>チーム詳細</h3></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><b>設立</b></td>
			<td>
				<?php echo $club["established_year"] ?> 年
			</td>
		</tr>
		<tr>
			<td><b>ホームタウン</b></td>
			<td>
				<?php echo $club_detail["home_town"] ?>
			</td>
		</tr>
		<tr>
			<td><b>監督</b></td>
			<td class="ng-binding"><?php echo $club_detail["director"] ?></td>
		</tr>
		<tr>
			<td><b>公式サイト</b></td>
			<td>
				<a href="<?php echo $club["url"] ?>" class="ng-binding" target="_blank">
					<?php echo $club["url"] ?>
				</a></td>
		</tr>
		<tr>
			<td style="vertical-align: middle"><b>ホームスタジアム</b></td>
			<td>
				<div class="tableStadiumInfo">
					<div class="tableStadiumInfo_details">
						<div class="tableStadiumInfo_name"><?php echo $stadium["name"] ?></div>
						<div class="tableStadiumInfo_post"><?php echo $stadium["address"] ?></div>
						<div class="tableStadiumInfo_seatSum"><?php echo $stadium["seat_sum"] ?>人</div>
					</div>
					<div class="tableStadiumInfo_visual">
						<img src="<?php echo $stadium_url ?>" alt="チームのスタジアム" class="tableStadiumInfo_img">
					</div>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
</div> <!-- end profile-desk -->