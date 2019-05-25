/**
 *
 *	@author		Amit Kumar
 *	@copyright	Copyright (c) 2019
 *
 */

$(document).ready(function () {
	// delete row
	$("body").on("click", ".delete", function(e) {
		e.returnValue = false;
		var id = this.value;
		var controllerName = $("#controller_name").val();
		var tr = $(this).closest('tr');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this item!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		}, function () {
			var formData = {primary_id:id};
			$.ajax({
				type: "POST",
				data : formData,
				url: base_url + "index.php/" + controllerName + "/delete",
				success: function(response) {
					if(response == true) {
						swal("Deleted!", "Item has been deleted!", "success");
						tr.remove();
					} else {
						swal("Oops!", "Something went wrong!", "error");
					}
				},
				error: function(xhr,status,strErr) {
					alert(status);
				}
			});
		});
	});
	// deactivate
	$("body").on("click", ".status", function(e) {
		e.returnValue = false;
		var id = $(this).val();
		var status = $(this).attr("data-status");
		var controllerName = $("#controller_name").val();
		var tr = $(this).closest('tr');
		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes!",
			closeOnConfirm: false
		}, function () {
			var methodName = (status == 1) ? 'deactivate':'activate';
			var formData = {primary_id:id};
			$.ajax({
				type: "POST",
				data : formData,
				url: base_url + "index.php/" + controllerName + "/" + methodName,
				success: function(response) {
					if(response == true) {
						swal("Success!", "Updated successfully!", "success");
						tr.reload();
					} else {
						swal("Oops!", "Something went wrong!", "error");
					}
				},
				error: function(xhr,status,strErr) {
					alert(status);
				}
			});
		});
	});
	// delete gallery image
	$("body").on("click", ".galleryIMG", function(e) {
		e.returnValue = false;
		var name = this.value;
		var plant_id = $(this).attr('data-plant-id');
		var controllerName = 'plants';
		var box_id = $(this).attr('data-id');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this item!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		}, function () {
			var formData = {img_name: name, plant_id: plant_id};
			$.ajax({
				type: "POST",
				data : formData,
				url: base_url + "index.php/" + controllerName + "/delete_image",
				success: function(response) {
					if(response == true) {
						swal("Deleted!", "Item has been deleted!", "success");
						$('#' + box_id).remove();
					} else {
						swal("Oops!", "Something went wrong!", "error");
					}
				},
				error: function(xhr,status,strErr) {
					alert(status);
				}
			});
		});
	});
	// datepicker and clockpicker
	$('.input-group.date').datepicker({
		todayBtn: "linked",
		startDate: "0",
		format: "dd-mm-yyyy",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true
	});
	$('.clockpicker').clockpicker();
	
	// datatable init
	$('.dataTablesView').DataTable({
		pageLength: 25,
		responsive: true,
		aaSorting: [],
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
			{ extend: 'copy' },
			{ extend: 'csv' },
			{ extend: 'excel', title: 'erp-download' },
			{ extend: 'pdf', title: 'erp-download' },
			{ extend: 'print',
				customize: function (win)
				{
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');
					$(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
				}
			}
		]
	});

	// summernote init
	$('.summernote').summernote();

	// password strength
	var pass_options = {};
	pass_options.ui = {
		showVerdictsInsideProgressBar: true,
		viewports: {
			progress: ".pwstrength_viewport_progress"
		}
	};
	pass_options.common = {
		debug: false
	};
	$('.pass-strength').pwstrength(pass_options);

	// dropify
	$('.dropify').dropify({
		messages: {
			'default': 'Drag and drop a file here or click',
			'replace': 'Drag and drop or click to replace',
			'remove': 'Remove',
			'error': 'Ooops, something wrong appended.'
		},
		error: {
			'fileSize': 'The file size is too big (1M max).'
		}
	});

	// select2
	$(".select2_one").select2({
		placeholder: " == Please select one option == ",
		allowClear: true
	});

	// toastr
	setTimeout(function() {
		toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 5000
		};
	}, 1500);

	$('#side-menu').find('a').on('click', function(e) {
		
		// var $li = $(this).parent();
		// var $li4 = this.href;
		// alert($li4);
		// if ($li.is('.active')) {
		// 	$li.removeClass('active');
		// } else {
		// 	$li.addClass('active');
		// }
	});
});
