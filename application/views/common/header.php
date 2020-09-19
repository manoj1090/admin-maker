<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Builder - Online Admin Panel Builder</title>

    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/theme/css/resume.min.css'); ?>">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-iconpicker-1.10.0/dist/css/bootstrap-iconpicker.css"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-iconpicker-1.10.0/icon-fonts/elusive-icons-2.0.0/css/elusive-icons.min.css"/>
    <!--  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/theme/css/style.css'); ?>">

    <script src="<?php echo base_url('assets/theme/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.js'); ?>"></script>

</head>
<body data-base-url="<?php echo baseurl(); ?>">
	<nav class="navbar navbar-dark bg-dark">
		<span class="navbar-text">
			<!-- Navbar text with an inline element -->
			<img class="mka-cstom-progress" src="<?php echo base_url(); ?>assets/images/loading.gif" alt="">
		</span>
		<div class="my-2 my-lg-0">
			<a href="<?php echo baseurl() .'auth/logout'; ?>" class="btn btn-outline-light my-2 my-sm-0" id="logout">Logout <i class="fa fa-sign-out-alt"></i></a>
		</div>
	</nav>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
		<a class="navbar-brand js-scroll-trigger" href="#page-top">
			<span class="d-block d-lg-none">Start Bootstrap</span>
			<span class="d-none d-lg-block">
	  			<img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="<?php echo base_url(); ?>assets/theme/img/profile.jpg" alt="">
			</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav">
	  			<li class="nav-item">
	    			<a class="nav-link js-scroll-trigger" href="<?php echo baseurl() . 'profile'; ?>" id="menu-user">Profile</a>
	  			</li>
	  			<li class="nav-item">
	    			<a class="nav-link js-scroll-trigger" href="<?php echo baseurl() . 'dashboard'; ?>" id="menu-dashboard">Dashboard</a>
	  			</li>
	  			<li class="nav-item">
	    			<a class="nav-link js-scroll-trigger" href="<?php echo baseurl() . 'projects'; ?>" id="menu-projects">My Projects</a>
	  			</li>
	  			<li class="nav-item">
	    			<a class="nav-link js-scroll-trigger" href="<?php echo baseurl() . 'examples'; ?>" id="menu-examples">Examples</a>
	  			</li>
	  			<li class="nav-item">
	    			<a class="nav-link js-scroll-trigger" href="<?php echo baseurl() . 'knowledge-base'; ?>" id="menu-KnowledgeBase">Documentation</a>
	  			</li>
	  			<li class="nav-item">
	    			<a class="nav-link js-scroll-trigger" href="<?php echo baseurl() . 'contact-us'; ?>" id="menu-ContactUs">Contact Us</a>
	  			</li>
			</ul>
		</div>
	</nav>

	
	
