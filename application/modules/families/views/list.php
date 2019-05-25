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
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url($this->misc->get_class_name() . "/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
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
						<table class="table table-bordered table-striped table-hover dataTablesView">
							<thead>
								<tr>
									<th>#</th>
									<th>FAMILY NAME</th>
									<th width="25%">DESCRIPTION</th>
									<th>STATUS</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(count($lists) == 0) { ?>
									<tr class="text-center text-uppercase">
										<td colspan="7"><strong>NO RECORD AVAILABLE</strong></td>
									</tr>
								<?php
								} else {
									$i = 0;
									foreach ($lists as $list) {
									$i++; ?>
									<tr>
										<input type="hidden" id="controller_name" value="<?= $this->misc->get_class_name(); ?>">
										<td>
											<span class="badge badge-info">&nbsp;<?= $i ?>.&nbsp;</span>
										</td>
										<td>
											<strong><?= htmlspecialchars($list->family_name,ENT_QUOTES,'UTF-8') ?></strong>
										</td>
										<td><?= $list->description ?></td>
										<td>
											<?php if($list->is_active == '1'): ?>
												<button class="btn btn-xs btn-warning status" value="<?= $list->family_id ?>" data-status="<?= $list->is_active ?>"> <i class="fa fa-ban"></i> Deactivate</button>
											<?php endif; ?>
											<?php if($list->is_active == '0'): ?>
												<button class="btn btn-xs btn-success status" value="<?= $list->family_id ?>" data-status="<?= $list->is_active ?>"> <i class="fa fa-check"></i> Activate</button>
											<?php endif; ?>
										</td>
										<td>
											<a href="<?= site_url($this->misc->get_class_name() . '/edit/' . $list->family_id); ?>" class="btn btn-success btn-xs">
												<i class="fa fa-pencil"></i>
											</a>
											<button class="btn btn-xs btn-danger delete" value="<?= $list->family_id ?>">
												<i class="fa fa-trash"></i>
											</button>
											<?php if($this->auth->is_developer()) { ?>
												<a href="<?= site_url($this->misc->get_class_name() . '/remove/' . $list->family_id); ?>" class="btn btn-default btn-xs">DEL</a>
											<?php } ?>
										</td>
									</tr>
									<?php }
								} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>#</th>
									<th>FAMILY NAME</th>
									<th width="25%">DESCRIPTION</th>
									<th>STATUS</th>
									<th>ACTION</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- edit modal -->
		<div class="modal fade inmodal" id="edit-data" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form method="POST" name="editItem" role="form" ng-submit="saveEdit()" ng-validate="validationOptions">
						<input ng-model="form.id" type="hidden" name="id" />
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Edit Family</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="title" class="control-label col-xs-2">Family Name</label>
								<div class="col-xs-10">
									<input type="text" name="title" class="form-control" id="title" placeholder="title" ng-model="dataForm.family_name">
									<span class="help-block text-danger"></span>
								</div>
							</div>

							<div class="form-group">
								<label for="description" class="control-label col-xs-2">Description</label>
								<div class="col-xs-10">
									<textarea name="description" class="form-control" id="description" placeholder="description" ng-model="form.description"></textarea>
									<span class="help-block text-danger"></span>
								</div>
							</div>

							<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
							<button type="submit" ng-disabled="editItem.$invalid" class="btn btn-primary create-crud">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- edit modal -->
	</div>
</div>
