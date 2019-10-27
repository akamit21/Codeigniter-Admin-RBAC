<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->get_class_name(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->get_class_name()) ?>"><span class="text-capitalize"><?= $this->misc->get_class_name(); ?></span></a>
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
		'name' => 'edit-form',
		'class' => 'form-horizontal'
	);
	echo form_open($this->misc->get_class_name() . "/edit/" . $info->permission_id, $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Permission <span class="text-success">[<?= $info->display_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('module-name')) echo 'has-error'; ?>">
									<?php echo form_label('Module Name <small class="text-danger">*</small>', 'module-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$dropdown = $this->component_model->dropdown('component_name');
										echo form_dropdown(array(
											'name' => 'module-name',
											'class' => 'form-control text-capitalize',
											'required' => 'true'
										), $dropdown, $info->fk_component_id);

										echo form_error('module-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('permission-name')) echo 'has-error'; ?>">
									<?php echo form_label('Permission Name <small class="text-danger">*</small><br/><small class="text-navy">[module name-method name]</small>', 'permission-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'permission-name',
											'class' => 'form-control',
											'placeholder' => 'Permission Name',
											'value' => set_value('permission-name', $info->permission_name),
											'required' => 'true'
										));

										echo form_error('permission-name'); ?>
										<small class="help-block m-b-none text-danger">Permission name should be in lower case only.</small>
									</div>
								</div>

								<div class="form-group <?php if(form_error('display-name')) echo 'has-error'; ?>">
									<?php echo form_label('Display Name <small class="text-danger">*</small>', 'display-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'display-name',
											'class' => 'form-control',
											'placeholder' => 'Display Name',
											'value' => set_value('display-name', $info->display_name),
											'required' => 'true'
										));

										echo form_error('display-name'); ?>
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
