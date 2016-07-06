<div class="wraper container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">カテゴリ登録</h3>
				</div>
				<div class="panel-body">
					<div class=" form">
						<form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="<?php echo Uri::base(false) ?>category/adddo" novalidate="novalidate">
    <?php
    foreach ((array)$details as $detail) {
      echo $detail["category_id"];
      echo $detail["name"];
      echo $detail["color"];
      echo Form::open(array('action' => 'category/update', 'method' => 'get'));
      echo Form::hidden("id",$detail["category_id"]);
      echo Form::submit("","更新");
      echo Form::close();
    }
    echo Form::open('category/index');
    echo Form::submit("","戻る");
    echo Form::close();
    ?>
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
