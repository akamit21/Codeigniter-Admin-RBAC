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
	echo form_open($this->misc->get_class_name(), $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Component/Module</h5>
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
											'value' => set_value('component-name'),
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

	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= $this->misc->get_class_name(); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>S/N</th>
									<th>COMPONENT/MODULE NAME</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="3"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i = 0;
								foreach ($lists as $list) {
								$i++; ?>
								<tr>
									<input type="hidden" id="cntroller_name" value="<?= $this->misc->get_class_name(); ?>">
									<td><span class="badge badge-primary">&nbsp;<?= $i ?>.&nbsp;</span></td>
									<td>
										<strong class="badge badge-info text-uppercase"><?= htmlspecialchars($list->component_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td>
										<a href="<?= site_url($this->misc->get_class_name() . "/edit/" . $list->component_id); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<?php if($this->check->is_developer()) { ?>
											<a href="<?= site_url($this->misc->get_class_name() . '/remove/' . $list->component_id); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>S/N</th>
									<th>COMPONENT/MODULE NAME</th>
									<th>ACTION</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
