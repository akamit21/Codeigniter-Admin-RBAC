<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Forbidden Access</title>

		<!-- bootstrap -->
		<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<!-- font-awesome -->
		<link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- mainly css -->
		<link href="<?= base_url(); ?>assets/css/animate.css" rel="stylesheet">
		<link href="<?= base_url(); ?>assets/css/admin.css" rel="stylesheet">
	</head>

	<body class="gray-bg">
		<div class="middle-box text-center animated fadeInDown">
			<h1>403</h1>
			<h3 class="font-bold">Read Access Forbidden</h3>

			<div class="error-desc">
				The server encountered something unexpected that didn't allow it to complete the request. We apologize.<br/>
				You can go back to main page: <br/><a href="<?= site_url('users'); ?>" class="btn btn-primary m-t">Dashboard</a>
			</div>
		</div>
	</body>
</html>