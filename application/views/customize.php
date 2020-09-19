
<section class="p-3 d-flex flex-column" id="myprojects">
  <div class="my-auto">
  	<span class="float-right mt-2">
  		<img src="<?php echo base_url() . '/assets/images/projects/' . $project->logo ?>" alt="Project Logo" id="project-logo">
  	</span>
    <h2 class="mb-1"><?php echo $project->title; ?></h2>
  	<hr>
    <div class="resume-item">
  		<h3 class="mb-0">Component</h3>
      <div class="row mt-3">
        <div class="col">
          <?php 
            if(!empty($compponents)) {
              foreach ($compponents as $key => $comp) {
          ?>
          
            <div class="module-grid" data-id="<?php echo $comp->id; ?>">
              <div class="tool-bar">
                <span class="edit-component" title="Edit Component"><i class="fa fa-edit"></i></span>
                <span class="delete-component" title="Delete Component"><i class="fa fa-times-circle"></i></span>
              </div>
              <span><i class="<?php echo $comp->icon; ?> fa-2x"></i></span>
              <div class="text-center"1>
                <b><?php echo $comp->title; ?></b>
              </div>
            </div>
          
                <?php } } ?>
          
            <div class="module-grid add">
              <span><i class="fa fa-plus fa-2x"></i></span>
              <div class="text-center">
                <b>Add Component</b>
              </div>
            </div>
          
        </div>
      </div>

      <div class="row mt-5 cutomize-btn-row">
        <div class="col" data-project-id="<?php echo $project->id; ?>">
          <div class="progress mka-cstom-progress blind">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" style="width:0%"></div>
          </div>
          <button class="btn btn-outline-dark" id="build-preview-project"><i class="fa fa-eye"></i> Preview Project</button>
          <button class="btn btn-outline-dark " id="download-project"><i class="fa fa-download"></i> Download Project</button>
        </div>
        <div class="col">
        </div>
      </div>
    </div>
  </div>
</section>



<!-- The Modal -->
<div class="modal fade" id="project-customize-modal">
  <div class="modal-dialog modal-full">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center">Create Component </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?php echo baseurl(); ?>customize/addComponent" class="needs-validation" novalidate id="componentForm" method="post">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="componentName">Component Name</label>
                <input type="text" class="form-control" id="comName" placeholder="Enter Component Name" name="componentName" required>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>    
            </div>
            <div class="col-1">
              <div class="form-group">
                <label for="icon">Icon</label>
                <button name="compIcon" class="btn btn-outline-secondary form-control" role="iconpicker"></button>
              </div>    
            </div>
          </div>
          <hr>
          <div id="fieldsHtml"></div>
          <a href="javascript:;" class="float-right text-secondary" id="add-field"><i class="fa fa-plus"></i> Add Field</a>
          <input type="hidden" name="porjectId" value="<?php echo $project->id; ?>">
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark " id="submitForm" >Save</button>
        <input type="hidden" name="fieldsCount" value="0">
      </div>
    </div>
  </div>
</div>


