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
				<strong class="text-capitalize"><?= $this->misc->get_class_name(); ?></strong>
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
	echo form_open($this->misc->get_class_name() . '/edit/' . $info->role_id, $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Role <span class="text-success">[<?= $info->role_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group <?php if(form_error('role-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Role Name <small class="text-danger">*</small>', 'role-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'role-name',
											'class' => 'form-control',
											'placeholder' => 'Role Name',
											'value' => set_value('role-name', $info->role_name),
											'required' => 'true'
										));

										echo form_error('role-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php
									echo form_label('Description', 'description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_textarea(array(
											'rows' => '2',
											'name' => 'description',
											'class' => 'form-control',
											'placeholder' => 'Name',
											'value' => set_value('description', $info->description)
										));

										echo form_error('description'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Assign Permissions <small></small></h5>
					</div>
					<?php
					$component_ids = $permission_ids = array();
					$component_ids = explode(',', $role_components->component_ids);
					$permission_ids = explode(',', $role_permissions->permission_ids);
					?>
					<div class="ibox-content">
						<ul class="modules todo-list small-list">
							<?php foreach ($components as $component): ?>
							<li class="lead text-uppercase"><input type="checkbox" name="component[]" value="<?= $component->component_id ?>" <?= in_array($component->component_id, $component_ids) ? 'checked' : '' ?> />&nbsp;<?= $component->component_name ?>
								<ul class="list-inline">
									<?php foreach ($permissions as $permission):
										if($permission->fk_component_id == $component->component_id): ?>
										<li class="h5 font-bold">
											<input type="checkbox" name="permission[]" value="<?= $permission->permission_id ?>" <?= in_array($permission->permission_id, $permission_ids) ? 'checked' : '' ?> />&nbsp;<?= $permission->display_name ?>&nbsp;
											
										</li>
										<?php
										endif;
									endforeach; ?>
								</ul>
							</li>
							<?php endforeach; ?>
						</ul>

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

<script type="text/javascript">
$(document).ready(function () {
	$('.modules input[type=checkbox]').click(function () {
		$(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
		var sib = false;
		$(this).closest('ul').children('li').each(function () {
			if($('input[type=checkbox]', this).is(':checked')) sib = true;
		})
		$(this).parents('ul').prev().prop('checked', sib);
	});
});
</script>