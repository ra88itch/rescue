     <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $root; ?>controls/<?php if($current_location != 'dashboard'){ echo  $current_location; } ?>"><?php echo $title; ?></a>
                </div>
				<div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo $root; ?>profile">
                                <p>ยินดีต้อนรับ, <?php echo $user->firstname; ?></p>
                            </a>
                        </li>
						<li>
                            <a href="<?php echo $root; ?>logout">
                                <p>ออกจากระบบ</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
				<div class="row<?php if(!isset($message) || $message == ''){ echo ' hide'; } ?>" id="messsage">
                    <div class="col-md-12">
						<div class="card <?php if(isset($message) && $message != ''){ echo $message_action; } ?>" id="message_action">
							<div id="message_txt"><?php if(isset($message) && $message != ''){ echo $message; }else{ echo 'ALERT'; } ?></div>
							<span id="message_x">X</span>
						</div>
					</div>
				</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="content">
								<div class="row">								
									<form method="POST" action="#">
										<div class="col-md-6">
											<input type="text" class="form-control" name="username" placeholder="<?php if(isset($placeholder_search)){ echo $placeholder_search; }else{ echo 'ระบุสิ่งที่ต้องการค้นหา';} ?>" value="">		
										</div>
										<div class="col-md-3">
											<button type="submit" class="btn btn-info btn-fill" name="submit" value="search">ค้นหา</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">

								<div class="row">
									<div class="col-md-2">
									ID
									</div>
									<div class="col-md-3">
									FIRSTNAME LASTNAME
									</div>
									<div class="col-md-2">
									TYPE
									</div>
									<div class="col-md-1">
									VIEWLOG
									</div>
									<div class="col-md-1">
									EXPORT SCORE
									</div>
								</div>
								
								<?php
								if(isset($lists) && $lists != false){
									foreach($lists AS $value){
								?>
								<hr>
								<div class="row">
									<div class="col-md-2">
									<?php echo $value->id; ?>
									</div>
									<div class="col-md-3">
									<?php echo $value->firstname,' ', $value->lastname; ?>
									</div>
									<div class="col-md-2">
									<?php echo $value->type_name; ?>
									</div>
									<div class="col-md-1">
										<form method="POST" action="#">
											<input type="hidden" name="id" value="<?php echo $value->id; ?>">
											<button type="submit" class="btn btn-clean" name="submit" value="viewlog">
												<i class="pe-7s-search"></i>
											</button>
										</form>
									</div>
									<div class="col-md-1">
										<form method="POST" action="<?php echo $root; ?>/pdf/score">
											<input type="hidden" name="id" value="<?php echo $value->id; ?>">
											<button type="submit" class="btn btn-clean" name="submit" value="viewlog">
												<i class="pe-7s-star"></i>
											</button>
										</form>
									</div>
								</div>
								<?php
									}
								}else{
								?>
								<div class="row">									
									<div class="col-md-12" style="text-align:center; color:gray; padding:50px 0;">
										ไม่พบข้อมูล
									</div>
								</div>
								<?php
								}
								?>
								
								<div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

				<?php if(isset($show_page_nav) && $show_page_nav == true){ ?>
				<div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="content">
								<div class="row">
									<div class="col-md-12">
									[ หน้า ]
									<?php
									if(!isset($_GET['page'])){
										$_GET['page'] = 1;
									}
									$page = ($all_lists / 20) + 1;
									for($i=1; $i <= $page; $i++){
										if($i!=$_GET['page']){											
											echo '<a href="?page=', $i ,'">', $i ,'</a>&nbsp;';
										}else{
											echo $i,'&nbsp;';
										}
									}
									?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>

            </div>
        </div>
