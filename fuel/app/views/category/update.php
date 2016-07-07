<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">カテゴリ更新</h3>
				</div>
				<div class="panel-body">
					<div class=" form">
  					<?php foreach((array)$category as $data): ?>
						<form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="<?php echo Uri::base(false) ?>category/updatedo" novalidate="novalidate">
					    <input type="hidden" name="id" value="<?= $data["category_id"]?>">
							<div class="form-group ">
								<label for="cname" class="control-label col-lg-2">カテゴリ名</label>
								<div class="col-lg-10">
									<input class="form-control" id="cname" type="text" name="name" value="<?= $data["name"];?>" aria-required="false">
								</div>
							</div>
							<div class="form-group ">
								<label for="ccolor" class="control-label col-lg-2">カテゴリ色 (必須)</label>
								<div class="col-lg-10">
									<input class=" form-control" id="ccolor" name="color" type="text" value="<?= $data["color"];?>" required="" aria-required="true">
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button class="btn btn-success" type="submit">Save</button>
									<button class="btn btn-default" type="button">Cancel</button>
								</div>
							</div>
						</form>
						<?php endforeach; ?>
				</div>
			</div>
		</div>

	</div>
	<!-- End Row -->

</div>
