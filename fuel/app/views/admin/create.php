<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">管理者追加</h3>
				</div>
				<div class="panel-body">
					<div class=" form">
						<form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="<?php echo Uri::base(false) ?>admin/save" novalidate="novalidate">
							<div class="form-group ">
								<label for="cname" class="control-label col-lg-2">名前 (必須)</label>
								<div class="col-lg-10">
									<input class=" form-control" id="cname" name="name" type="text" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="cpassword" class="control-label col-lg-2">パスワード (必須)</label>
								<div class="col-lg-10">
									<input class="form-control " id="cpassword" type="password" name="password" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="cpassword_confirm" class="control-label col-lg-2">パスワード確認 (必須)</label>
								<div class="col-lg-10">
									<input class="form-control" id="cpassword_confirm" type="password" name="password_confirm" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="start_time" class="control-label col-lg-2">使用開始日</label>
								<div class="col-lg-10">
									<input class="form-control" id="start_time" type="text" name="start_time" aria-required="false">
								</div>
							</div>
							<div class="form-group ">
								<label for="end_time" class="control-label col-lg-2">使用終了日</label>
								<div class="col-lg-10">
									<input class="form-control" id="end_time" type="text" name="end_time" aria-required="false">
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button class="btn btn-success" type="submit">Save</button>
									<button class="btn btn-default" type="button">Cancel</button>
								</div>
							</div>
						</form>
				</div>
			</div>
		</div>

	</div>
	<!-- End Row -->


</div>