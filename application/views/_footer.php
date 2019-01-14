<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><footer class="footer" style="display:none;">
		<div class="container">
			<div class="row">
				<div class="col-4 col-sm-2 footer-btn-cancel do-go-back">
				CANCEL
				</div>
				<div class="col-8 col-sm-4 col-sm-offset-6 footer-btn-save form-btn-save do-submit">
				SAVE
				</div>
			</div>
		</div>
	</footer>
</div>
</body>
	<!--   Core JS Files   -->
	<script type="text/javascript">
	var root = "<?php if(isset($root)){ echo $root; }else{ echo ''; } ?>";
	</script>
    <script type="text/javascript" src="<?php echo $root; ?>assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $root; ?>assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo $root; ?>assets/js/jquery.easy-autocomplete.min.js"></script>
	<script type="text/javascript" src="<?php echo $root; ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $root; ?>assets/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="<?php echo $root; ?>assets/js/moment.js"></script>
	<script type="text/javascript" src="<?php echo $root; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo $root; ?>assets/js/zeroupload.js"></script>
	<script type="text/javascript" src="<?php echo $root; ?>assets/js/script.js"></script>
	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
</html>