<section class="p-3 d-flex flex-column" id="myprojects">
  <div class="my-auto">
    <button class="btn btn-outline-dark btn-small float-right mt-2" id="addProject" data-toggle="tooltip" title="Create Project"> <i class="fa fa-plus"></i> </button>
    <h2 class="mb-1">My Projects</h2>
    <div class="resume-item d-flex flex-column flex-md-row">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>Remark</th>
            <th>Create Date</th>
            <th>Update Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($project)) { foreach ($project as $proValue) { ?>
          <tr id="<?php echo $proValue->id; ?>">
            <td><?php echo $proValue->title; ?></td>
            <td><?php echo $proValue->remark; ?></td>
            <td><?php echo $proValue->create_date; ?></td>
            <td><?php echo $proValue->update_date; ?></td>
            <td><a href="<?php echo baseurl() . 'customize?p=' .$proValue->slug; ?>" class="btn btn-sm btn-outline-dark  mr-1" data-toggle="tooltip" title="Customize Project"><i class="fa fa-cog"></i></a><button class="btn btn-sm btn-outline-dark mr-1 project-edit" data-toggle="tooltip" title="Edit Project"><i class="fa fa-edit"></i></button><button class="btn btn-sm btn-outline-dark project-delete" data-toggle="tooltip" title="Delete Project"><i class="fa fa-trash"></i></button></td>
          </tr>
          <?php } } else { ?>
            <tr>
              <td colspan="5" class="text-center">Nothing to show</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- The Modal -->
<div class="modal fade" id="projectModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Project</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="form" method="post" id="projectForm" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Project Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pTitle" placeholder="Enter Title of project" required>
          </div>
          <div class="form-group clearfix">
            <label for="file"></label>
            <div class="row">
              <div class="col">
                <input type="file" onchange="readURL(event, '#logo-img')" name="pLogo" accept="image/gif, image/jpeg, image/png" style="display: none;">
                <a href="javascript:;" class="btn btn-dark btn-outline upload-btn"> <i class="fa fa-upload"></i> Upload Project Logo</a>
                <div class="logo-preview pro-previw blind">
                  <img src="#" alt="logo-preview" id="logo-img" height="120">
                </div>
              </div>
              <div class="col">
                <input type="file" onchange="readURL(event, '#favicon-img')" name="pFavicon" accept="image/gif, image/jpeg, image/png" style="display: none;">
                <a href="javascript:;" class="btn btn-dark btn-outline upload-btn"> <i class="fa fa-upload"></i> Upload Project Favicon</a>
                <div class="fav-preview pro-previw blind" >
                  <img src="#" alt="favicon-preview" id="favicon-img" height="120">
                </div>
              </div>
            </div>
              
          </div>
          <div class="form-group ">
            <label for="">Remark</label>
            <textarea class="form-control" name="pRemark" placeholder="Enter Remark of project" required> </textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-action="add" class="btn btn-outline-dark" id="submit-project">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

