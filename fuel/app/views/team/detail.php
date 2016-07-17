<div class="wraper container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="bg-picture" style="background-image: url('<?php echo $bg_url ?>')">
				<span class="bg-picture-overlay"></span><!-- overlay -->
				<!-- meta -->
				<div class="box-layout meta bottom">
					<div class="col-sm-6 clearfix">
						<span class="img-wrapper pull-left m-r-15"><img src="<?php echo $emblem_url ?>" alt="" style="width:64px" class="br-radius"></span>
						<div class="media-body">
							<h3 class="text-white mb-2 m-t-10 ellipsis"><?php echo $club["name"] ?></h3>
							<h5 class="text-white"> <?php echo $league_name ?></h5>
						</div>
					</div>

				</div>
				<!--/ meta -->
			</div>
		</div>
	</div>

	<div class="row m-t-30">
		<div class="col-sm-12">
			<div class="panel panel-default p-0">
				<div class="panel-body p-0">
					<ul class="nav nav-tabs profile-tabs">
						<li class="active"><a data-toggle="tab" href="#aboutme">About</a></li>
						<li class=""><a data-toggle="tab" href="#user-activities">Activities</a></li>
						<li class=""><a data-toggle="tab" href="#edit-profile">Settings</a></li>
						<li class=""><a data-toggle="tab" href="#projects">Projects</a></li>
					</ul>

					<div class="tab-content m-0">

						<div id="aboutme" class="tab-pane active">
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
												<?php echo $club_detail["home_town"]  ?>
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
						</div> <!-- about-me -->


						<!-- Activities -->
						<div id="user-activities" class="tab-pane">
							<div class="timeline-2">
								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">5 minutes ago</div>
										<p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
									</div>
								</div>

								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">30 minutes ago</div>
										<p><a href="" class="text-info">Lorem</a> commented your post.</p>
										<p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
									</div>
								</div>

								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">59 minutes ago</div>
										<p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
										<p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
									</div>
								</div>

								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">5 minutes ago</div>
										<p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>
									</div>
								</div>

								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">30 minutes ago</div>
										<p><a href="" class="text-info">Lorem</a> commented your post.</p>
										<p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
									</div>
								</div>

								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">59 minutes ago</div>
										<p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
										<p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
									</div>
								</div>
							</div>
						</div>

						<!-- 収益 -->
						<div id="edit-profile" class="tab-pane">

							<div class="profit_graph"></div>

							<script type="text/javascript">
								var json = <?php echo json_encode($profits, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

								console.log(json);

								$(function() {

									var operatingRevenue = "収益";
									var operatingCost = "費用";
									var currentNetIncome = "損益";

									var operatingRevenues = [];
									var operatingCosts = [];
									var currentNetIncomes = [];

									operatingRevenues.push(operatingRevenue);
									operatingCosts.push(operatingCost);
									currentNetIncomes.push(currentNetIncome);

									$.each(json, function(key, value) {

										operatingRevenues.push(this.operating_revenue);
										operatingCosts.push(this.operating_costs);
										currentNetIncomes.push(this.current_net_income);
									});

									var graphVal = {
										bindto: '.profit_graph',
										padding: {
											//top: 40,
											right: 80,
											//bottom: 40,
											left: 50,
										},
										data: {
											columns: [
												operatingRevenues,
												operatingCosts,
												currentNetIncomes
											],
											types: {
												収益: 'line',
												費用: 'line',
												損益: "area-step"
												//data3: 'spline',
												//data4: 'line',
												//data5: 'bar'
											},
											colors: {
												operatingRevenues: '#ebc142',
												operatingCosts: '#03a9f4',
												//data3: '#009688',
												//data4: '#E67A77',
												//data5: '#95D7BB'
											},
											axes: {
												収益: 'y',
												費用: 'y',
												損益: 'y2'
											},
										},
										axis: {
											x: {
												type: 'categorized'
											},
											y2: {
												show: true
											}
										}
									}

									//console.log(graphVal);

									var chart = c3.generate(graphVal);


								});
							</script>
						</div>
						<!-- end 収益 -->

						<!-- profile -->
						<div id="projects" class="tab-pane">
							<div class="row m-t-10">
								<div class="col-md-12">
									<div class="portlet"><!-- /primary heading -->
										<div id="portlet2" class="panel-collapse collapse in">
											<div class="portlet-body">
												<div class="table-responsive">
													<table class="table">
														<thead>
														<tr>
															<th>#</th>
															<th>Project Name</th>
															<th>Start Date</th>
															<th>Due Date</th>
															<th>Status</th>
															<th>Assign</th>
														</tr>
														</thead>
														<tbody>
														<tr>
															<td>1</td>
															<td>Velonic Admin</td>
															<td>01/01/2015</td>
															<td>07/05/2015</td>
															<td><span class="label label-info">Work in Progress</span></td>
															<td>Coderthemes</td>
														</tr>
														<tr>
															<td>2</td>
															<td>Velonic Frontend</td>
															<td>01/01/2015</td>
															<td>07/05/2015</td>
															<td><span class="label label-success">Pending</span></td>
															<td>Coderthemes</td>
														</tr>
														<tr>
															<td>3</td>
															<td>Velonic Admin</td>
															<td>01/01/2015</td>
															<td>07/05/2015</td>
															<td><span class="label label-pink">Done</span></td>
															<td>Coderthemes</td>
														</tr>
														<tr>
															<td>4</td>
															<td>Velonic Frontend</td>
															<td>01/01/2015</td>
															<td>07/05/2015</td>
															<td><span class="label label-purple">Work in Progress</span></td>
															<td>Coderthemes</td>
														</tr>
														<tr>
															<td>5</td>
															<td>Velonic Admin</td>
															<td>01/01/2015</td>
															<td>07/05/2015</td>
															<td><span class="label label-warning">Coming soon</span></td>
															<td>Coderthemes</td>
														</tr>

														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div> <!-- /Portlet -->
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>






</div>