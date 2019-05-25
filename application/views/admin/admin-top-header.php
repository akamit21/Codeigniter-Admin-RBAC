<!-- top-header -->
<div id="page-wrapper" class="gray-bg">
	<div class="row border-bottom">
		<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
			</div>
			<ul class="nav navbar-top-links navbar-right">
				<li>
					<span class="m-r-sm text-muted welcome-message">Welcome to Rajdhanni Vatika. <strong class="text-success"><?= $this->auth->is_developer() ? '[DEVELOPER MODE]' : '' ?></strong></span>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>index.php/admin/logout">
						<i class="fa fa-sign-out"></i> Log out
					</a>
				</li>
			</ul>
		</nav>
	</div>
