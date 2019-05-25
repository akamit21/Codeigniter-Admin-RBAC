<!-- navbar -->
<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<!-- menu -->
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element">
					<span>
						<img alt="image" class="img-circle" src="<?php echo base_url(); ?>/assets/img/profile_small.jpg" />
					</span>
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="clear">
							<span class="block m-t-xs"> <strong class="font-bold"><?= $this->session->userdata['full_name'] ?></strong></span>
							<span class="text-muted text-xs block"><?= $this->session->userdata['username'] ?> <b class="caret"></b></span>
						</span>
					</a>
					<ul class="dropdown-menu m-t-xs">
						<li><a href="profile.html">Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?= site_url('main/logout') ?>">Logout</a></li>
					</ul>
				</div>
				<div class="logo-element"> PARK </div>
			</li>

			<!-- dashboard -->
			<li>
				<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">DASHBOARD</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="#">Dashboard v.1</a></li>
				</ul>
			</li>

			<!-- plants -->
			<?php if($this->auth->module_access($name = 'plants')[0]): ?>
			<li class="<?= in_array($this->uri->segment(1), ['plants']) ? 'active':'' ?>">
				<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">PLANTS</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="<?= site_url('plants') ?>">View List</a>
					</li>
					<li>
						<a href="<?= site_url('plants/add') ?>">Add New</a>
					</li>
				</ul>
			</li>
			<?php endif; ?>

			<!-- families -->
			<?php if($this->auth->module_access($name = 'families')[0]): ?>
			<li class="<?= in_array($this->uri->segment(1), ['families']) ? 'active':'' ?>">
				<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">FAMILIES</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="<?= site_url('families') ?>">View List</a>
					</li>
					<li>
						<a href="<?= site_url('families/add') ?>">Add New</a>
					</li>
				</ul>
			</li>
			<?php endif; ?>

			<!-- admin -->
			<li class="<?= in_array($this->uri->segment(1), ['users', 'roles', 'components', 'permissions']) ? 'active':'' ?>">
				<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">ADMIN</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<?php if($this->auth->module_access($name = 'users')[0]): ?>
					<li>
						<a href="#"> USERS <span class="fa arrow"></span></a>
						<ul class="nav nav-third-level">
							<li>
								<a href="<?= site_url('users') ?>"> View List</a>
							</li>
							<li>
								<a href="<?= site_url('users/add') ?>">Add New</a>
							</li>
						</ul>
					</li>
					<?php endif; ?>

					<?php if($this->auth->module_access($name = 'roles')[0]): ?>
					<li>
						<a href="#"> ROLES <span class="fa arrow"></span></a>
						<ul class="nav nav-third-level">
							<li>
								<a href="<?= site_url('roles') ?>"> View List</a>
							</li>
							<li>
								<a href="<?= site_url('roles/add') ?>">Add New</a>
							</li>
						</ul>
					</li>
					<?php endif; ?>

					<?php if($this->auth->module_access($name = 'components')[0]): ?>
					<li>
						<a href="#"> COMPONENTS <span class="fa arrow"></span></a>
						<ul class="nav nav-third-level">
							<li>
								<a href="<?= site_url('components') ?>"> View List</a>
							</li>
							<li>
								<a href="<?= site_url('components/add') ?>">Add New</a>
							</li>
						</ul>
					</li>
					<?php endif; ?>

					<?php if($this->auth->module_access($name = 'permissions')[0]): ?>
					<li>
						<a href="#"> PERMISSIONS <span class="fa arrow"></span></a>
						<ul class="nav nav-third-level">
							<li>
								<a href="<?= site_url('permissions') ?>"> View List</a>
							</li>
							<li>
								<a href="<?= site_url('permissions/add') ?>">Add New</a>
							</li>
						</ul>
					</li>
					<?php endif; ?>
				</ul>
			</li>
		</ul>
		<!-- /sidemenu -->
	</div>
	<!-- /.sidebar-collapse -->
</nav>
<!-- /navigation
