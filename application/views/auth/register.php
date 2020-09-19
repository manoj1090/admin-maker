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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/theme/css/resume.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/theme/css/outer.style.css'); ?>">


</head>
<body data-base-url="<?php echo baseurl(); ?>">
	<div class="loginPage">
	<div class="col-md-4 offset-4">
		<div class="card p-5 bg-secondary">
			<form id="registerForm" method="post">
                <div class="form-group">
			        <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
			    </div>
			    <div class="form-group">
			        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
			    </div>
			    <div class="form-group">
			        <input type="password" class="form-control" name="pwd" placeholder="Enter Password" required>
			    </div>
			    <div class="row">
			  	    <div class="col">
			  		    <button type="submit" class="btn btn-dark btn-block" id="registerbtn">REGISTER</button>
			  	    </div>
			  	    <div class="col">
			  		    <a href="javascript:;" data-href="auth/login" class="text-white redirect">Already have account?</a>
			  	    </div>
			  </div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo base_url('assets/theme/js/jquery-3.3.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/theme/js/outer.custom.js'); ?>"></script>
</body>
</html>