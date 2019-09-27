<div class="row">
	<?php
	if(isset($detail)){
	?>
	<div class="col-xs-12 col-md-3 col-md-offset-1 col-lg-2 col-lg-offset-2">
		<a href="<?php echo $root; ?>team/view/<?php echo $detail->id; ?>" class="btn btn-block btn-fill btn-default">กลับ</a>
	</div>
	<div class="col-xs-12 col-md-3 col-md-offset-2 col-lg-2 col-lg-offset-2">
		<a href="#" class="btn btn-block btn-fill btn-success btn-form-submit" id="form-submit-list">บันทึกข้อมูล</a>
	</div>
	<div class="col-xs-12 col-md-3 col-lg-2">
		<a href="#" class="btn btn-block btn-fill btn-success btn-form-submit" id="form-submit-edit">บันทึกข้อมูลและอยู่ต่อ</a>
	</div>
	<?php
	}else{
	?>
	<div class="col-xs-12 col-md-3 col-md-offset-1 col-lg-2 col-lg-offset-2">
		<a href="<?php echo $root; ?>team" class="btn btn-block btn-fill btn-default">กลับ</a>
	</div>
	<div class="col-xs-12 col-md-3 col-md-offset-2 col-lg-2 col-lg-offset-2">
		<a href="#" class="btn btn-block btn-fill btn-success btn-form-submit" id="form-submit-list">บันทึกข้อมูล</a>
	</div>
	<div class="col-xs-12 col-md-3 col-lg-2">
		<a href="#" class="btn btn-block btn-fill btn-success btn-form-submit" id="form-submit-create">บันทึกข้อมูลและสร้างเพิ่ม</a>
	</div>
	<?php
	}
	?>
</div>