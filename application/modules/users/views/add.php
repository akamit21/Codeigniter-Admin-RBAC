<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->get_class_name(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->get_class_name()}") ?>"><span class="text-capitalize"><?= $this->misc->get_class_name(); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->get_method_name(); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">

	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'add-form',
		'class' => 'form-horizontal'
	);
	echo form_open($this->misc->get_class_name() . '/add', $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New User</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('full-name')) echo 'has-error'; ?>">
									<?php echo form_label('Full Name <small class="text-danger">*</small>', 'full-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'full-name',
											'class' => 'form-control',
											'placeholder' => 'Full Name',
											'value' => set_value('full-name'),
											'required' => 'true'
										));

										echo form_error('full-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
									<?php echo form_label('Username/Email Id <small class="text-danger">*</small>', 'email', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'email',
											'name' => 'email',
											'class' => 'form-control',
											'placeholder' => 'Email Id',
											'value' => set_value('email'),
											'required' => 'true'
										));

										echo form_error('email'); ?>
										<small class="help-block m-b-none text-danger">Email id will be used as 'Username' for dashboard login.</small>
									</div>
								</div>

								<div class="form-group <?php if(form_error('password')) echo 'has-error'; ?>">
									<?php echo form_label('Password <small class="text-danger">*</small>', 'password', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'password',
											'name' => 'password',
											'class' => 'form-control pass-strength',
											'placeholder' => 'Password',
											'value' => set_value('password'),
											'required' => 'true'
										));

										echo form_error('password'); ?>
										<div class="pwstrength_viewport_progress"></div>
										<small class="help-block m-b-none text-danger">Password length should be between 8 to 15 characters.</small>
									</div>
								</div>

								<div class="form-group <?php if(form_error('confpass')) echo 'has-error'; ?>">
									<?php echo form_label('Confirm Password <small class="text-danger">*</small>', 'confpass', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'password',
											'name' => 'confpass',
											'class' => 'form-control',
											'placeholder' => 'Confirm Password',
											'value' => set_value('confpass'),
											'required' => 'true'
										));

										echo form_error('confpass'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('role')) echo 'has-error'; ?>">
									<?php echo form_label('User Role <small class="text-danger">*</small>', 'role', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$dropdown = $this->mdl_role->dropdown('role_name');
										echo form_dropdown(array(
											'name' => 'role',
											'class' => 'form-control'
										), $dropdown);

										echo form_error('role'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="text-right">
							<button class="btn btn-primary" type="submit">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
