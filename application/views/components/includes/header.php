<!DOCTYPE html>
<html lang="en">

<head>
	<title>Material Admin - Dashboard</title>

	<!-- BEGIN META -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="your,keywords">
	<meta name="description" content="Short explanation about this website">
	<!-- END META -->

	<!-- BEGIN STYLESHEETS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css' />
	<link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/theme-default/bootstrap.css?1422792965" />
	<link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/theme-default/materialadmin.css?1425466319" />
	<link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/theme-default/font-awesome.min.css?1422529194" />
	<link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/theme-default/material-design-iconic-font.min.css?1421434286" />
	<link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
	<link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
	<link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />

	<!-- END STYLESHEETS -->

	<!-- // jquery  dapat hind na naka cdn tong mga to -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" intgrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- // sweet alert -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?= base_url() ?>assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="<?= base_url() ?>assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
</head>

<body class="menubar-hoverable header-fixed ">

	<!-- BEGIN HEADER-->
	<header id="header">
		<div class="headerbar">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="headerbar-left">
				<ul class="header-nav header-nav-options">
					<li class="header-nav-brand">
						<div class="brand-holder">
							<a href="<?= base_url() ?>">
								<span class="text-lg text-bold text-primary">POINT OF SALE</span>
							</a>
						</div>
					</li>
					<li>
						<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="headerbar-right">
				<!--end .header-nav-options -->
				<ul class="header-nav header-nav-profile">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
							<img src="<?= base_url() ?>assets/img/avatar1.jpg?1403934956" alt="" />
							<span class="profile-info">
								Admin
								<small>Administrator</small>
							</span>
						</a>
						<ul class="dropdown-menu animation-dock">
							<li><a href="<?= base_url() . "login/logout" ?>"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
							<!-- <li class="divider"></li> -->
						</ul>
						<!--end .dropdown-menu -->
					</li>
					<!--end .dropdown -->
				</ul>
				<!--end .header-nav-profile -->
			</div>
			<!--end #header-navbar-collapse -->
		</div>
	</header>
	<!-- END HEADER-->
