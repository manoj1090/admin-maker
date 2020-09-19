<!--content area start-->
<div id="content" class="pmd-content inner-page">
  <!--tab start-->
  <div class="container-fluid full-width-container blank">
    <!-- Title -->
    <h1 class="section-title" id="services">
      <span>First Component</span>
    </h1><!-- End Title -->
  
    <!--breadcrum start-->
    <ol class="breadcrumb text-left">
      <li><a href="<?php echo baseurl(); ?>user/dashboard">Dashboard</a></li>
      <li class="active">First Component</li>
    </ol><!--breadcrum end-->
    
  
    <div class="page-content">
      <div class="panel panel-default">
        <div class="panel-heading">
          List
          <button class="btn btn-sm btn-primary pmd-ripple-effect pull-right" type="button" onclick="showModel('model-mka_first_component')"> <i class="fa fa-plus"></i> </button>
        </div>
        <div class="panel-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
<th>F1</th>
<th>F2</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div><!-- tab end -->
</div><!-- content area end -->

<!-- Dialog with Form Elements -->
<div tabindex="-1" class="modal fade" id="model-mka_first_component" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header pmd-modal-bordered">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
        <h2 class="pmd-card-title-text">Form Modal</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?php echo baseurl() ?>" id="form-mka_first_component">
          <div class="form-group pmd-textfield pmd-textfield-floating-label"><label for="f1">F1</label><input type="text" class="mat-input form-control" name="f1" value=""></div><div class="form-group pmd-textfield pmd-textfield-floating-label"><label for="f2">F2</label><input type="number" class="mat-input form-control" name="f2" value=""></div>
          <!-- <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="first-name">Name</label>
            <input type="text" class="mat-input form-control" id="name" value="">
            <span class="help-text">Input is required!</span> </div>
          <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="first-name">Email Address</label>
            <input type="text" class="mat-input form-control" id="email" value="">
          </div>
          <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="first-name">Mobile No.</label>
            <input type="text" class="mat-input form-control" id="mobil" value="">
          </div>
          <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label class="control-label">Message</label>
            <textarea required class="form-control"></textarea>
          </div>
          <label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
            <input type="checkbox" value="">
            <span class="pmd-checkbox"> Accept Terms and conditions</span> </label> -->
        </form>
      </div>
      <div class="pmd-modal-action">
        <button data-dismiss="modal"  class="btn pmd-ripple-effect btn-primary" onclick="saveFormData('form-mka_first_component')" type="button">Save changes</button>
        <button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Discard</button>
      </div>
    </div>
  </div>
</div>