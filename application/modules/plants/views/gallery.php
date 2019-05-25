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
	echo form_open($this->misc->get_class_name() . '/gallery/' . $id, $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add Plant Gallery <small>(Basic Information)</small></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="row jumbotron" id="file_div">
										<div class="col-md-11 col-sm-10">
											<input type="file" name="file[]" id="file" class="form-control" required="" />
										</div>
									</div>
									<input type="button" id="add_more" class="btn btn-success btn-xs upload" value="Add More Files"/>
								</div>

								<div class="hr-line-dashed"></div>

								<div class="text-right">
									<?php echo form_submit('save', 'Save', 'class="btn btn-primary"'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>

	<div class="row lightBoxGallery">
		<?php foreach ($images as $image): ?>
		<div class="col-md-3 col-sm-4 col-xs-6" id="<?= $image->id ?>">
			<div class="contact-box">
				<a href="<?= base_url() ?>assets/img/plants/<?= $image->fk_plant_id . '/gallery/' . $image->img_name ?>" data-gallery=""><img alt="image" class="img-responsive" src="<?= base_url() ?>assets/img/plants/<?= $id . '/gallery/' . $image->img_name ?>" style="margin: 0px;"></a>

				<div class="contact-box-footer">
					<div class="m-t-xs btn-group">
						<a href="<?= base_url() ?>assets/img/plants/<?= $image->fk_plant_id . '/gallery/' . $image->img_name ?>" class="btn btn-xs btn-white" data-gallery=""><i class="fa fa-eye"></i> View</a>
						<button class="btn btn-xs btn-white galleryIMG" value="<?= $image->img_name ?>" data-id="<?= $image->id ?>" data-plant-id="<?= $image->fk_plant_id ?>" title="Delete!">
							<i class="fa fa-trash"></i> Delete
						</button>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
		<div id="blueimp-gallery" class="blueimp-gallery">
			<div class="slides"></div>
			<h3 class="title"></h3>
			<a class="prev">‹</a>
			<a class="next">›</a>
			<a class="close">×</a>
			<a class="play-pause"></a>
			<ol class="indicator"></ol>
		</div>
	</div>
</div>

<script type="text/javascript">
var file = 0; // Declaring and defining global increment variable.
$(document).ready(function() {
	// To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
	$('#add_more').click(function() {
		
		
		addFileInput();
	});
	// Following function will executes on change event of file input to select different file.
	$('body').on('change', '#file', function() {
		
		if (this.files && this.files[0]) {
			file += 1; // Incrementing global variable by 1.
			var z = file - 1;
			var x = $(this).parent().find('#previewimg' + z).remove();
			$(this).parent().after("<div id='file" + file + "' class='col-md-1 col-sm-2 thumb'><img src='' class='img-thumbnail' id='preview_img" + file + "' style='vertical-align: middle;'/></div>");
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			//$(this).hide();
			$("#file" + file).append($("<img/>", {
				id: 'delete_ico',
				src: base_url + 'assets/img/delete-icon.png',
				alt: 'delete'
			}).click(function() {
				$(this).parent().parent().remove();
			}));
		}
	});
	// To Preview Image
	function imageIsLoaded(e) {
		$('#preview_img' + file).attr('src', e.target.result);
	};
	function addFileInput(){
		var html = '';
		html += '<div class="alert alert-grey">';
		
		html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>';
		html += '<input type="file" name="file[]" id="file" class="form-control" />';
		html += '</div>';
		$("#file_div").append(html);
	}	

});
</script>
