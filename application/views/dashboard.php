<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('_header.php');
?>
    <!-- Begin page content -->
    <main role="main" class="container">
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
		  <h1 class="display-4"><?php echo $this->lang->line('dashboard'); ?></h1>
		  <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
		</div>
    </main>

	<div class="container">
		<div class="card-deck mb-3 text-center">

			<div class="card mb-4 box-shadow">
				<div class="card-header">
					<h4 class="my-0 font-weight-normal"><?php echo $this->lang->line('notify_4_14'); ?></h4>
				</div>
				<div class="card-body">
					<ul class="list-unstyled mt-3 mb-4">
					<?php 
					$summary_day = 99;
					if(isset($summary_day)){ 
						/*
						<h1 class="card-title pricing-card-title">
						<?php echo $summary_day; ?> <small class="text-muted"><?php echo $this->lang->line('Hours'); ?></small>								
						</h1>
						*/
					?>
						<li><?php echo $this->lang->line('you_notify_4'); ?> <?php echo $summary_day; ?> <?php echo $this->lang->line('hours'); ?></li>
						<li><?php echo $this->lang->line('dashboard_notify_14_text'); ?></li>
					<?php
					}else{
					?>
						<li><?php echo $this->lang->line('you_not_notify_4'); ?></li>
						<li><?php echo $this->lang->line('dashboard_notify_4_text'); ?></li>
					<?php
					} 
					?> 
					</ul>	
					<?php 
					$btn_text = $this->lang->line('notify_4');
					$btn_class = ' btn-primary';
					if(isset($have_notify_4)){ 
						$btn_text = $this->lang->line('notify_14');
						$btn_class = ' btn-outline-primary';
					}
					?> 
					<button type="button" class="btn btn-lg btn-block<?php echo $btn_class; ?>">	
						<?php echo $btn_text; ?>
					</button>
				</div>
			</div>

			<div class="card mb-4 box-shadow">
				<div class="card-header">
					<h4 class="my-0 font-weight-normal"><?php echo $this->lang->line('nav_notify'); ?></h4>
				</div>
				<div class="card-body">
					<ul class="list-unstyled mt-3 mb-4">
						<li>30 users included</li>
						<li>15 GB of storage</li>
					</ul>
					<button type="button" class="btn btn-lg btn-block btn-primary">
						<?php echo $this->lang->line('notify_8'); ?>
					</button>
				</div>
			</div>

			<div class="card mb-4 box-shadow">
				<div class="card-header">
					<h4 class="my-0 font-weight-normal"><?php echo $this->lang->line('nav_report'); ?></h4>
				</div>
				<div class="card-body">
					<ul class="list-unstyled mt-3 mb-4">
						<li>30 users included</li>
						<li>15 GB of storage</li>
					</ul>
					<button type="button" class="btn btn-lg btn-block btn-primary">
						<?php echo $this->lang->line('view'); ?>
					</button>
				</div>
			</div>

		</div>
	</div>

<?php
require('_footer.php');
?>