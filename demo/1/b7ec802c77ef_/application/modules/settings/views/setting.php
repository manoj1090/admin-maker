<!--content area start-->
<div id="content" class="pmd-content inner-page">
  <!--tab start-->
  <div class="container-fluid full-width-container blank">
    <!-- Title -->
    <h1 class="section-title" id="services">
      <span>Settings</span>
    </h1><!-- End Title -->
  
    <!--breadcrum start-->
    <ol class="breadcrumb text-left">
      <li><a href="<?php echo baseurl().'user/dashboard'; ?>">Dashboard</a></li>
      <li class="active">settings</li>
    </ol><!--breadcrum end-->
    <div class="page-content app-settings">
      <div class="pmd-card pmd-z-depth">
        <div class="pmd-tabs">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">General</a></li>
            <li><a data-toggle="tab" href="#email">Email</a></li>
          </ul>
        </div>
        <div class="pmd-card-body">
          <div class="tab-content">
            <div id="general" class="tab-pane fade in active">
              <form action="<?php echo baseurl().'settings/updateSettings' ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <label for="test" class="control-label col-md-4">Project Title :</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="project_title" value="<?php echo $settings['project_title']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="test" class="control-label col-md-4">Language :</label>
                  <div class="col-md-8">
                    <select name="language" class="form-control" id="">
                      <option value="">Select Language</option>
                      <option value="en" <?= $settings['language'] == 'en'?'selected': ''; ?>>English</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="test" class="control-label col-md-4">Project Logo :</label>
                  <div class="col-md-8">
                    <div class="custom-file blind">
                      <input type="file" name="logo">
                    </div>
                    <button type="button" class="btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-info btn-sm upload-logo-fav"><i class="fa fa-upload"></i></button>
                    <div class="logo-preview">
                      <img src="" alt="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="test" class="control-label col-md-4">Project Favicon :</label>
                  <div class="col-md-8">
                    <div class="custom-file blind">
                      <input type="file" name="favicon">
                    </div>
                    <button type="button" class="btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-info btn-sm upload-logo-fav"><i class="fa fa-upload"></i></button>
                    <div class="favicon-preview">
                      <img src="" alt="">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <div class="col-md-4"></div>
                  <div class="col-md-8">
                    <button class="btn btn-primary pmd-ripple-effect">Update</button>
                  </div>
                </div>
              </form>
            </div>
          
            <div id="email" class="tab-pane fade">
              <p class="text-center">Need to develop yet..</p>
            </div>          
          </div>
        </div>
      </div>
    </div>
  </div><!-- tab end -->
  
</div><!-- content area end -->