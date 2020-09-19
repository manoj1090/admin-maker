$(function() {
	$('[data-toggle="tooltip"]').tooltip(); 

	$('[data-toggle="toggle"]').bootstrapToggle()

	$('.redirect').on('click', function() {
		var obj = $(this);
		if(obj.data('href') != '') {
			window.location.href= $('body').data('base-url') + obj.data('href');
		}
	});

	$('#addProject').on('click', function() {
		$('#projectModal').modal('show');
	});

	$('.project-edit').on('click', function() {
		$obj = $(this);
		resetProjectModal();
		$projectId = $obj.parents('tr:first').attr('id');
		var url = $('body').data('base-url') + 'projects/get/' + $projectId;
	    ajax(url, 'delete', '', function(res) {
	      	if(res.success) {
	      		$('#projectModal input[name="pTitle"]').val(res.data.title);
	      		$('#projectModal textarea[name="pRemark"]').val(res.data.remark);
	   			$('#projectModal').modal('show');

	      	} else {
	      		mka_alert('info', 'Unable to delete project');
	      	}
	    });
	})

	$('.upload-btn').on('click', function() {
		$(this).siblings('input[type="file"]').trigger('click');
	});

	$('#submit-project').on('click', function() {
		$obj = $(this);
		if($obj.data('action') == 'add') {
			$obj.parents('form#projectForm').attr('action', $('body').data('base-url') + 'projects/create');
		}

		$obj.parents('form#projectForm').submit();
	});


	$('#confirm button').on('click', function() {
		var __o = $(this);	
		$('#confirmation-modal').modal('hide');
		if(__o.hasClass('yes')) {
			$('.confirming').trigger('click');
		}
		setTimeout(function() {
			$('.confirming').removeClass('confirming');
		}, 1)
	});


	$('.project-delete').on('click', function() {
		$obj = $(this);
		if(!$obj.hasClass('confirming')) {
      	$obj.addClass('confirming');
      	$('#confirmation-modal').modal('show');
    } else {
		$projectId = $obj.parents('tr:first').attr('id');
		var url = $('body').data('base-url') + 'projects/delete/' + $projectId;
	    ajax(url, 'delete', '', function(res) {
	      if(res.success) {
	        $obj.parents('tr:first').fadeOut(900, function() {
	          $(this).remove();
	        })
	      } else {
	      	mka_alert('info', 'Unable to delete project');
	      }
	    });
    }

	});


	if($('.navbar-brand img.img-profile').is(':visible')) {
		var url = $('body').data('base-url') + 'user/getUserDetail/' + $('#userId').val();
	  ajax(url, 'get', '', function(res) {
	    if(res.success) {
	    	$('.navbar-brand img.img-profile').attr('src', '../assets/theme/img/' + res.data[0].profile_image);
	    }
	  });
	}
});


var resetProjectModal = function() {

}



var mka_alert = function(type, message ) {
	$.notify({
		message: message
	},{
		type: type
	});
}



var readURL = function(input, preview) {
	  var reader = new FileReader();

    reader.onload = function(e) {
    	$(preview).parents('.pro-previw:first').show();
    	$(preview).attr('src', reader.result);
    }

    reader.readAsDataURL(input.target.files[0]);
}


/*
|---------------------------------------------------------------------
| This function is used to call ajax request for all.
|---------------------------------------------------------------------
*/
var ajax = function(url, method, data, cb) {
	$.ajax({
		url		:url,
		method	:method,
		data	: data,
		cache: false,
    contentType: false,
    processData: false   
	}).done(function(responce) {
		cb(JSON.parse(responce));
	});
}


/*
|---------------------------------------------------------------------
| This function is used to get the user profile details.
|---------------------------------------------------------------------
*/
var getProfile = function() {
	var url = $('body').data('base-url') + 'user/getUserDetail/' + $('#userId').val();
  ajax(url, 'get', '', function(res) {
    if(res.success) {
      $('input[name="name"]').val(res.data[0].name);
      $('input[name="phone"]').val(res.data[0].phone);
      $('input[name="email"]').val(res.data[0].email);
    	$('#profile-img').attr('src', '../assets/theme/img/' + res.data[0].profile_image);
    }
  });
}

