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
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th width="40px">S. NO.</th>
									<th>MODULE NAME</th>
									<th>PERMISSION NAME</th>
									<th>PERMISSION VALUE</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="5"><strong>NO RECORD AVAILABLE</strong></td>
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
										<strong class="badge badge-danger"><?= htmlspecialchars($this->mdl_component->get($list->fk_component_id)->component_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td>
										<strong class="badge badge-info"><?= htmlspecialchars($list->display_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td>
										<strong><?= htmlspecialchars($list->permission_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td>
										<a href="<?= site_url($this->misc->get_class_name() . "/edit/" . $list->permission_id); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<button class="btn btn-xs btn-danger delete" value="<?= $list->permission_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										<?php if($this->auth->is_developer()) { ?>
											<a href="<?= site_url($this->misc->get_class_name() . "/remove/" . $list->permission_id); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>MODULE NAME</th>
									<th>PERMISSION NAME</th>
									<th>PERMISSION VALUE</th>
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
