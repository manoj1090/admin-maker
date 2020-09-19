<!--content area start-->
<div id="content" class="pmd-content inner-page">

	<!--tab start-->
	<div class="container-fluid full-width-container about">
		<!-- Title -->
		<h1 class="section-title" id="services">
			<span>Profile</span>
		</h1><!-- End Title -->
	
		<!--breadcrum start-->
		<ol class="breadcrumb text-left">
		  <li><a href="<?php echo baseurl() . 'user/dashboard' ?>">Dashboard</a></li>
		  <li class="active">Profile</li>
		</ol><!--breadcrum end-->
	
		<div class="page-content profile-edit">
			<div class="pmd-card pmd-z-depth">
				<div class="pmd-card-body">
					<div class="row">

						<div data-provides="fileinput" class="fileinput fileinput-new col-lg-3">
							<div data-trigger="fileinput" class="fileinput-preview thumbnail img-circle img-responsive">
								<img src="<?php echo base_url() . 'assets/images/' . $userData->profile_pic; ?>">
							</div>
							<div class="action-button"> 
								<span class="btn btn-default btn-raised btn-file ripple-effect">
									<span class="fileinput-new"><i class="material-icons md-light pmd-xs">add</i></span>
									<span class="fileinput-exists"><i class="material-icons md-light pmd-xs">mode_edit</i></span>
									<input type="file" name="profilePic" id="fileUpload" accept="image/x-png,image/jpeg"> 
								</span> 
								<a data-dismiss="fileinput" class="btn btn-default btn-raised btn-file ripple-effect fileinput-exists" href="javascript:void(0);"><i class="material-icons md-light pmd-xs">close</i></a>
							</div>
						</div>
						
						<div class="col-lg-9 custom-col-9">
							<h3 class="heading">Personal Information</h3>
							<div class="row">
								<form class="form-horizontal" method="post" action="<?php echo baseurl() . 'user/updateProfile' ?>">
								  <fieldset>
										<div class="form-group prousername pmd-textfield">
										  <label class="control-label col-sm-3">Username</label>
										  <div class="col-sm-9">
											<p class="form-control-static"><strong><?php echo $userData->username; ?></strong></p>
										  </div>
										</div>
										<div class="form-group pmd-textfield">
										  <label class="col-sm-3 control-label" for="u_fname">First Name</label>
										  <div class="col-sm-9">
											  <input type="text" class="form-control empty" value="<?php echo $userData->fname; ?>"  name="fname">
										  </div>
										</div>
										<div class="form-group pmd-textfield">
										  <label class="col-sm-3 control-label" for="u_fname">Last Name</label>
										  <div class="col-sm-9">
											  <input type="text" class="form-control empty"  name="lname" value="<?php echo $userData->lname; ?>">
										  </div>
										</div>
										<div class="form-group pmd-textfield">
										  <label class="col-sm-3 control-label" for="u_fname">Email</label>
										  <div class="col-sm-9">
											  <input type="email" class="form-control empty" name="email" value="<?php echo $userData->email; ?>">
										  </div>
										</div>
										<div class="form-group btns margin-bot-30">
										  <div class="col-sm-9 col-sm-offset-3">
										  <input type="hidden" name="type" value="general">
										  <input type="hidden" name="userId" value="<?php echo $userData->id; ?>">
											<button type="submit" class="btn btn-primary pmd-ripple-effect">Update</button>
											<button class="btn btn-default btn-link pmd-ripple-effect">Cancel</button>
										  </div>
										</div>
								  </fieldset>
								</form>
							</div>
							<h3 class="heading">Change Password</h3>
							<div class="row">	
								<form class="form-horizontal" method="post" action="<?php echo baseurl() . 'user/updateProfile' ?>">
								  <fieldset>
									<div class="form-group pmd-textfield">
										<label class="control-label col-sm-3" for="u_password">Current Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control empty"  value="" name="current_password">
										</div>
									</div>
									<div class="form-group pmd-textfield">
										<label class="control-label col-sm-3" for="u_password">New Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control empty" value="" name="new_password">
										</div>
									</div>
									<div class="form-group btns">
									  <div class="col-sm-9 col-sm-offset-3">
									  	<input type="hidden" name="type" value="password">
										  <input type="hidden" name="userId" value="<?php echo $userData->id; ?>">
											<button type="submit" class="btn btn-primary pmd-ripple-effect">Update</button>
											<button class="btn btn-default btn-link pmd-ripple-effect">Cancel</button>
									  </div>
									</div>
								  </fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- tab end -->
</div><!-- content area end -->