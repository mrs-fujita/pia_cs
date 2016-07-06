<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">管理者詳細</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">


							<!-- 管理者の詳細 -->
							<p>名前</p><?php echo $admin["name"] ?><br />
							<p>利用可能開始日</p><?php echo $admin["available_startday"] ?><br />
							<p>利用可能終了日</p><?php echo $admin["available_endday"] ?><br />
							<!-- End 管理者の詳細 -->


						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- End Row -->


</div>
