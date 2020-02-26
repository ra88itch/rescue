		<footer class="footer">
			<div class="container-fluid">
				<p class="copyright pull-right">
					&copy; <script>document.write(new Date().getFullYear())</script> <a href="<?php echo $root; ?>">TH-RESCUE.COM</a>, Manage your rescue team
				</p>
			</div>
		</footer>

	</div>
</div>

<!--   Core JS Files   -->	
<?php
$html_js_var = '<script>';	
$html_js_var .= 'var root = "'.$root.'";';
if(isset($js_var)){
	foreach($js_var AS $key=>$value){
		$html_js_var .= 'var '.$key.' = '.$value.';';
	}
}
if(isset($referrer)){
	$html_js_var .= 'var referrer = "'.$referrer.'";';
}
$html_js_var .= 'var current_location = "'.$current_location.'";';
$html_js_var .= '</script>';
echo $html_js_var;
?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<?php
foreach($js AS $jsrow){
	echo '<script type="text/javascript" src="'.base_url('assets/js/'.$jsrow).'"></script>';
	// echo '<script src="'.$root.'assets/js/'.$jsrow.'"></script>';
}
?>
</body>
</html>