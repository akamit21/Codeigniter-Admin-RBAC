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
		'name' => 'add-form',
		'class' => 'form-horizontal'
	);
	echo form_open($this->misc->get_class_name() . '/edit/' . $info->component_id, $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Component/Module <span class="text-success text-capitalize">[<?= $info->component_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-9 col-xs-8">
								<div class="form-group <?php if(form_error('component-name')) echo 'has-error'; ?>">
									<?php echo form_label('Component/Module Name <small class="text-danger">*</small>', 'component-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'component-name',
											'class' => 'form-control text-capitalize',
											'placeholder' => 'Component Name',
											'value' => set_value('component-name', $info->component_name),
											'required' => 'true'
										));

										echo form_error('component-name'); ?>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-3 col-xs-4">
								<?php echo form_submit('submit', 'Save', 'class="btn btn-primary full-width"'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
