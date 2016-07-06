<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">イベント登録</h3>
					<?php
					echo Form::open('category/index');
					echo Form::submit("","カテゴリ登録");
					echo Form::close();
					?>
				</div>
				<div class="panel-body">
					<div class=" form">
						<form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="<?php echo Uri::base(false) ?>event/adddo" novalidate="novalidate">
							<div class="form-group ">
								<label for="cname" class="control-label col-lg-2">イベント名</label>
								<div class="col-lg-10">
									<input class="form-control" id="cname" type="text" name="イベント名?" aria-required="false">
								</div>
							</div>
							<div class="form-group ">
								<label for="ccategory" class="control-label col-lg-2">カテゴリ (必須)</label>
								<div class="col-lg-10">
									<select class=" form-control" id="ccategory" name="category_id" type="text" required="" aria-required="true">
									<?php
									foreach ((array)$category as $cate) {
										echo "<option value=\"".$cate["category_id"]."\">".$cate["name"]."</option>";
									}
									?>
									</select>
								</div>
							</div>
							<div class="form-group ">
								<label for="cvenue" class="control-label col-lg-2">開催場所 (必須)</label>
								<div class="col-lg-10">
									<input class=" form-control" id="cvenue" name="venue" type="text" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="cpost" class="control-label col-lg-2">郵便番号 (必須)</label>
								<div class="col-lg-10">
									<input class=" form-control" id="cpost" name="post" type="text" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="ccontent" class="control-label col-lg-2">開催内容 (必須)</label>
								<div class="col-lg-10">
									<input class=" form-control" id="ccontent" name="content" type="text" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="cdate" class="control-label col-lg-2">開催日</label>
								<div class="col-lg-10">
									<input class=" form-control" id="cdate" name="dating" type="text" value="2016-6-21" required="" aria-required="true">
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
