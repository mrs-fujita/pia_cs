<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">イベント登録</h3>
				</div>
				<div class="panel-body">
					<div class=" form">
						<form class="cmxform form-horizontal tasi-form" id="commentForm" method="post"
						      action="<?php echo Uri::base(false) ?>event/adddo" novalidate="novalidate">
							<div class="form-group ">
								<label for="cname" class="control-label col-lg-2">イベント名</label>
								<div class="col-lg-10">
									<input class="form-control" id="cname" type="text" name="name" aria-required="false">
								</div>
							</div>
							<div class="form-group ">
								<label for="ccategory" class="control-label col-lg-2">カテゴリ (必須)</label>
								<div class="col-lg-10">
									<div class="row">
										<div class="col-lg-10 col-md-10">
											<select class=" form-control" id="ccategory" name="category_id" type="text" required=""
											        aria-required="true">
												<?php
												foreach((array) $category as $cate)
												{
													echo "<option value=\"" . $cate["category_id"] . "\">" . $cate["name"] . "</option>";
												}
												?>
											</select>
										</div>
										<div class="col-lg-2 col-md-2" style="text-align: center;">
												<a href="<?php echo Uri::base(false) ?>category/index" class="btn btn-info btn-custom m-b-5">カテゴリ追加</a>
										</div>
									</div>
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
									<input class=" form-control" id="ccontent" name="content" type="text" required=""
									       aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="cdate" class="control-label col-lg-2">開催日</label>
								<div class="col-lg-10">
									<input class=" form-control" id="cdate" name="dating" type="text" value="2016-6-21" required=""
									       aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="cman_num" class="control-label col-lg-2">男性来客数</label>
								<div class="col-lg-10">
									<input class=" form-control" id="cman_num" name="man_num" type="text" value="0" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="cwoman_num" class="control-label col-lg-2">女性来客数</label>
								<div class="col-lg-10">
									<input class=" form-control" id="cwoman_num" name="woman_num" type="text" value="0" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group ">
								<label for="cvisitors_num" class="control-label col-lg-2">総来客数</label>
								<div class="col-lg-10">
									<input class=" form-control" id="cvisitors_num" name="visitors_num" type="text" value="0" required="" aria-required="true">
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
