<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?= $title ?></title>
		<meta name="description" content="">
		<!-- tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<!-- jQuery -->
		<script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
		<!-- bootstrap -->
		<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
		<!-- style css -->
		<link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
		<link href="<?= base_url() ?>assets/css/admin.css" rel="stylesheet">
	</head>

	<body class="gray-bg">

		<div class="middle-box text-center loginscreen animated fadeInDown">
			<div>
				<div>
					<h1 class="logo-name">PARK</h1>
				</div>
				<h3>Rajdhani Vatika Admin Panel</h3>
				<p>Login in. To see it in action.</p>
				<?= isset($failed) && !empty($failed) ? "<div class='alert alert-danger'>{$failed}</div>" : ""; ?>
				<form class="m-t" role="form" action="<?= site_url('admin') ?>" method="POST">
					<div class="form-group">
						<input type="email" name="username" class="form-control" placeholder="Username/Email Id" required="true">
						<?= form_error('username') ?>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required="true">
						<?= form_error('password') ?>
					</div>
					<button type="submit" class="btn btn-primary block full-width m-b">Login</button>

					<a href="#"><small>Forgot password?</small></a>
				</form>
				<p class="m-t"> <small>Maintained by Fillip Technologies &copy; 2018</small> </p>
			</div>
		</div>
	</body>
</html>
