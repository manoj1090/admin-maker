<section class="p-3 p-lg-3 d-column" id="profile">
  <div class="my-auto">
    <h2 class="mb-1">profile</h2>
    <hr>
    <form name="form" method="post" id="profileForm" enctype="multipart/form-data">
        <fieldset>
          <legend>General Information</legend>
          <div class="row">
            <div class="col-md-4">
              <div class="profile-image">
                <div class="profile-overlay">
                  <button type="button" class="btn btn-small btn-mka" onclick="$('#clk-profile-input').trigger('click')"><i class="fa fa-upload"></i></button>
                </div>
                <img src="<?php echo base_url(); ?>assets/theme/img/profile.jpg" id="profile-img" alt="Profile Image" class="img-thumbnail">
                <input type="file" class="blind" onchange="readURL(event, '#profile-img')" name="profile" id="clk-profile-input">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for=""></label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" required>
              </div>
              <div class="form-group">
                <label for=""></label>
                <input type="number" class="form-control" name="phone" placeholder="Enter Phone Number" required>
              </div>
              <div class="form-group">
                <label for=""></label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email" required email>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Password</legend>
          <div class="form-group">
            <label for=""></label>
            <input type="password" class="form-control" name="currentpassword" placeholder="Enter Current Password">
          </div>
          <div class="form-group">
            <label for=""></label>
            <input type="password" class="form-control" name="password" placeholder="Enter New Password">
          </div>
        </fieldset>

        <div class="form-group form-footer">
          <button class="btn btn-dark btn-sm float-right" id="saveProfile">Save Changes</button>
        </div>
    </form>
  </div>
</section>

<script type="text/javascript">
  
  $(document).ready(function() {
    getProfile();

    if(typeof $('input#userId').length != 'undefined') {
      $('#saveProfile').before('<input type="hidden" name="id" value="'+ $('input#userId').val() +'">');      
    }


    $('#profileForm').on('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      var url = $('body').data('base-url') + 'user/updateUserDetail/';
      ajax(url, 'post', formData, function(res) {
        if(res.success) {
          mka_alert('success', res.message);
          $('.navbar-brand .img-profile').attr('src', $('#profile-img').attr('src')); 
        } else {
          mka_alert('danger', res.message);
        }
      });
    });
  });


</script>