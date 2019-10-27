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
		'enctype' => 'multipart/form-data',
		'class' => ''
	);
	echo form_open($this->misc->get_class_name() . '/add', $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Plant <small>(Basic Information)</small></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-8 b-r">
								<div class="form-group <?php if(form_error('family-name')) echo 'has-error'; ?>">
									<?php
									$dropdown = $this->mdl_family->dropdown('family_name');
									echo form_label('Family Name <small class="text-danger">*</small>','family-name');

									echo form_dropdown(array(
										'name' => 'family-name',
										'class' => 'form-control select2_one',
										'required' => 'true'
									), $dropdown);

									echo form_error('family-name'); ?>
								</div>

								<div class="form-group <?php if(form_error('plant-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Plant Name <small class="text-danger">*</small>', 'plant-name');

									echo form_input(array(
										'type' => 'text',
										'name' => 'plant-name',
										'class' => 'form-control',
										'placeholder' => 'Plant Name',
										'value' => set_value('plant-name'),
										'required' => 'true'
									));

									echo form_error('plant-name'); ?>
								</div>

								<div class="form-group <?php if(form_error('botanical-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Botanical Name <small class="text-danger">*</small>', 'botanical-name');

									echo form_input(array(
										'type' => 'text',
										'name' => 'botanical-name',
										'class' => 'form-control',
										'placeholder' => 'Botanical Name',
										'value' => set_value('botanical-name'),
										'required' => 'true'
									));

									echo form_error('botanical-name'); ?>
								</div>

								<div class="form-group <?php if(form_error('english-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('English Name <small class="text-danger">*</small>', 'english-name');

									echo form_input(array(
										'type' => 'text',
										'name' => 'english-name',
										'class' => 'form-control',
										'placeholder' => 'English Name',
										'value' => set_value('english-name'),
										'required' => 'true'
									));

									echo form_error('english-name'); ?>
								</div>

								<div class="form-group <?php if(form_error('common-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Local/Common Name', 'common-name');

									echo form_textarea(array(
										'name' => 'common-name',
										'class' => 'form-control',
										'placeholder' => 'Local/Common Name',
										'rows' => '6',
										'value' => set_value('common-name')
									));

									echo form_error('common-name'); ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group <?php if(form_error('photo')) echo 'has-error'; ?>">
									<?php
									echo form_label('Photo <small class="text-danger">*</small>', 'photo');

									echo form_input(array(
										'type' => 'file',
										'name' => 'photo',
										'class' => 'dropify',
										'required' => 'true'
									));

									echo form_error('photo'); ?>
								</div>
								<div class="form-group <?php if(form_error('qr-code')) echo 'has-error'; ?>">
									<?php
									echo form_label('QR Code <small class="text-danger">*</small>', 'qr-code');

									echo form_input(array(
										'type' => 'file',
										'name' => 'qr-code',
										'class' => 'dropify',
										'required' => 'true'
									));

									echo form_error('qr-code'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Plant Extra Information</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group <?php if(form_error('unique-features')) echo 'has-error'; ?>">
									<?php
									echo form_label('Unique Identification Feature', 'unique-features');

									echo form_textarea(array(
										'name' => 'unique-features',
										'class' => 'summernote',
										'value' => set_value('unique-features')
									));

									echo form_error('unique-features'); ?>
								</div>

								<div class="form-group <?php if(form_error('significant-features')) echo 'has-error'; ?>">
									<?php
									echo form_label('Significant Features', 'significant-features');

									echo form_textarea(array(
										'name' => 'significant-features',
										'class' => 'summernote',
										'value' => set_value('significant-features')
									));

									echo form_error('significant-features'); ?>
								</div>

								<div class="form-group <?php if(form_error('plant-care')) echo 'has-error'; ?>">
									<?php
									echo form_label('Planting and Care', 'plant-care');

									echo form_textarea(array(
										'name' => 'plant-care',
										'class' => 'summernote',
										'value' => set_value('plant-care')
									));

									echo form_error('plant-care'); ?>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="text-right">
							<button class="btn btn-primary" type="submit">Save </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
