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
			<a href="<?= site_url($this->misc->get_class_name() . '/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
						<table class="table table-striped table-bordered table-hover dataTable">
							<thead>
								<tr>
									<th width="40px">S. NO.</th>
									<th>FULL NAME</th>
									<th>USERNAME/EMAIL</th>
									<th>USER ROLE</th>
									<th>LAST LOGIN</th>
									<th>STATUS</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								<input type="" id="csrf_token" value="<?= $this->security->get_csrf_hash() ?>" />
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
										<input type="hidden" id="controller_name" value="<?= $this->misc->get_class_name(); ?>" />
										<td>
											<span class="badge badge-info">&nbsp;<?= $i ?>.&nbsp;</span>
										</td>
										<td>
											<strong><?= htmlspecialchars($list->full_name,ENT_QUOTES,'UTF-8') ?></strong>
										</td>
										<td><?= htmlspecialchars($list->username,ENT_QUOTES,'UTF-8') ?></td>
										<td>
											<span class="badge badge-info"><?= htmlspecialchars($this->mdl_role->get($list->fk_role_id)->role_name,ENT_QUOTES,'UTF-8') ?></span>
										</td>
										<td>
											<span class="badge badge-info"><?= htmlspecialchars($list->last_login,ENT_QUOTES,'UTF-8') ?></span>
										</td>
										<td>
											<?php if($list->is_active == '1'): ?>
												<button class="btn btn-xs btn-warning status" value="<?= $list->user_id ?>" data-status="<?= $list->is_active ?>"> <i class="fa fa-ban"></i> Deactivate</button>
											<?php endif; ?>
											<?php if($list->is_active == '0'): ?>
												<button class="btn btn-xs btn-success status" value="<?= $list->user_id ?>" data-status="<?= $list->is_active ?>"> <i class="fa fa-check"></i> Activate</button>
											<?php endif; ?>
										</td>
										<td>
											<a href="<?= site_url($this->misc->get_class_name() . '/edit/' . $list->user_id); ?>" class="btn btn-success btn-xs">
												<i class="fa fa-pencil"></i>
											</a>
											<button class="btn btn-xs btn-danger delete" value="<?= $list->user_id ?>">
												<i class="fa fa-trash"></i>
											</button>
											<?php if($this->check->is_developer()) { ?>
												<a href="<?= site_url($this->misc->get_class_name() . '/remove/' . $list->user_id); ?>" class="btn btn-default btn-xs">DEL</a>
											<?php } ?>
										</td>
									</tr>
									<?php }
								} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>FULL NAME</th>
									<th>USERNAME/EMAIL</th>
									<th>USER ROLE</th>
									<th>LAST LOGIN</th>
									<th>STATUS</th>
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
