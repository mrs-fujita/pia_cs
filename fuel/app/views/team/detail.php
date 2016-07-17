<div class="wraper container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="bg-picture" style="background-image: url('<?php echo $bg_url ?>')">
				<span class="bg-picture-overlay"></span><!-- overlay -->
				<!-- meta -->
				<div class="box-layout meta bottom">
					<div class="col-sm-6 clearfix">
						<span class="img-wrapper pull-left m-r-15"><img src="<?php echo $emblem_url ?>" alt="" style="width:64px"
						                                                class="br-radius"></span>
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
						<li class=""><a data-toggle="tab" href="#edit-profile">収益</a></li>
						<li class=""><a data-toggle="tab" href="#projects">座席情報</a></li>
					</ul>

					<div class="tab-content m-0">

						<!-- about -->
						<div id="aboutme" class="tab-pane active">
							<?php echo View::forge('team/include/about.include') ?>
						</div>
						<!-- end about -->


						<!-- Activities -->
						<div id="user-activities" class="tab-pane">
							<div class="timeline-2">
								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">5 minutes ago</div>
										<p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong>
										</p>
									</div>
								</div>

								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">30 minutes ago</div>
										<p><a href="" class="text-info">Lorem</a> commented your post.</p>
										<p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt
												euismod. "</em></p>
									</div>
								</div>

								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">59 minutes ago</div>
										<p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John
												Doe</a>.</p>
										<p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt
												euismod. "</em></p>
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
										<p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt
												euismod. "</em></p>
									</div>
								</div>

								<div class="time-item">
									<div class="item-info">
										<div class="text-muted">59 minutes ago</div>
										<p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John
												Doe</a>.</p>
										<p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt
												euismod. "</em></p>
									</div>
								</div>
							</div>
						</div>

						<!-- 収益 -->
						<div id="edit-profile" class="tab-pane">
							<?php echo View::forge('team/include/profit.include') ?>
						</div>
						<!-- end 収益 -->

						<!-- 座席情報 -->
						<div id="projects" class="tab-pane">
							<?php echo View::forge('team/include/seat.include') ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


</div>