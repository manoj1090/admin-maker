$(function() {
	$('.module-grid.add').on('click', function() {
		resetProjectCustomizeModel();
		$('#project-customize-modal').modal('show');
		addField();
	});


	$('#submitForm').on('click', function() {
		

		$('#componentForm').submit();
	});

	$('#add-field').on('click', function() {
		addField();
	});


	$('#fieldsHtml').on('change', '.mka-ck', function() {
		$obj = $(this);
		$obj.parent().siblings('input[type="hidden"]').val('0');
		if($obj.is(':checked')) {
			$obj.parent().siblings('input[type="hidden"]').val('1');
		}
	});

	$('#fieldsHtml').on('click', '.remove-row', function() {
		$obj = $(this);
		if($('.f-row').length > 1){
			$obj.parents('.f-row:first').fadeOut(900, function() {
        $fid = $(this).find('input[name="fieldId[]"]').val();
        if($fid != 'add') {
          $('#componentForm').append('<input type="hidden" name="delField[]" value="'+ $fid +'" />');
        }
        $(this).remove();
      });
		}
	});

  $('.edit-component').on('click', function() {
    $obj = $(this);
    $compId = $obj.parents('.module-grid:first').attr('data-id');
    var url = $('body').data('base-url') + 'customize/getComponent/' + $compId;
    ajax(url, 'get', '', function(res) {
      resetProjectCustomizeModel();
      $('#project-customize-modal').modal('show');
      $('#comName').val(res.title).after('<input type="hidden" name="component_id" value="'+res.id+'">');
      $('button[name="compIcon"]').find('input').val(res.icon).siblings('i.empty').addClass(res.icon).removeClass('empty');

      if(typeof res.fieldsData != 'undefined' && res.fieldsData.length > 0) {
        $.each(res.fieldsData, function(i, v) {
          addField(i, v);
        });
      }
    });
  });


  $('body').on('click', '.delete-component', function() {
    $obj = $(this);
    if(!$obj.hasClass('confirming')) {
      $obj.addClass('confirming');
      $('#confirmation-modal').modal('show');
    } else {
      $compId = $obj.parents('.module-grid:first').attr('data-id');
      var  url = $('body').data('base-url') + 'customize/delComponent/' + $compId;
      ajax( url, 'delete', '', function(res) {
        if(res.success) {
          //alert(res.message);  
          $obj.parents('.module-grid:first').fadeOut(900, function() {
            $(this).remove();
          })
        } else {
          alert('Unable to update');
        }
      });
    }

  });


  $('#build-preview-project').on('click', function() {
    mkaProcess(true);
    var obj = $(this);
    var project_id = obj.parent().attr('data-project-id');
    if(project_id != '') {
      var url = $('body').data('base-url') + 'build/buildproject/' + project_id;
      ajax( url, 'put', '', function(res) {
        if(res) {
          mka_alert('success', 'Build Process completed.');
        }
        mkaProcess(false);
      });      
    }
  });
});


/**
 * This function is used to set loading into button.
 * @param  Object     handler   Button object
 * @param  Boolean    action    1 for set lading and 0 for reset the button and remove loading.
 * @param  text       text      What text you want to show on button while loading.
 * @return Void
 */
var mkaProcess = function(state) {
  if( state ) {
    $('.mka-cstom-progress').show();
  } else {
    $('.mka-cstom-progress').find('.progress-bar').css('width', '100%');
    setTimeout(function() {
      $('.mka-cstom-progress').hide();
    }, 500);
  }
}


var addField = function(id, data = null) {
  //var id =  $('#fieldsHtml f-row').length;
  id = id + 1; 
	$html = '<div class="f-row" id="field-'+id+'" data-index="'+id+'">' +
            '<div class="row">' +
              '<div class="col-md-3">' +
                '<div class="form-group">' +
                  '<label for="uname">Field Name</label>' +
                  '<input type="text" class="form-control" id="" placeholder="Enter Field" name="fieldName[]" required>' +
                  '<div class="invalid-feedback">Please fill out this field.</div>' +
                '</div>' +
              '</div>' +
              '<div class="col-md-3">' +
                '<div class="form-group">' +
                  '<label for="uname">Field Type</label>' +
                  '<select name="ftype[]" class="form-control" id="">' +
                    '<option value="">---Select Field Type---</option>' +
                    '<option value="text">Text</option>' +
                    '<option value="number">Number</option>' +
                    '<option value="radio">Radio</option>' +
                    '<option value="checkbox">Checkbox</option>' +
                  '</select>' +
                  '<div class="invalid-feedback">Please fill out this field.</div>' +
                '</div>' +
              '</div>' +
              '<div class="col">' +
                '<div class="form-group">' +
                  '<label for="uname">Required</label><br>' +
                  '<input type="checkbox" class="form-control mka-ck required" checked data-toggle="toggle" data-on="<i class=\'fa fa-check\'></i>" data-off="<i class=\'fa fa-times\'></i>" data-onstyle="secondary" data-offstyle="danger">' +
                  '<input type="hidden" name="required[]" value="1">' +
                '</div>' +
              '</div>' +
              '<div class="col">' +
                '<div class="form-group">' +
                  '<label for="uname">Show in list</label><br>' +
                  '<input type="checkbox" class="form-control mka-ck listview" checked data-toggle="toggle" data-on="<i class=\'fa fa-check\'></i>" data-off="<i class=\'fa fa-times\'></i>" data-onstyle="secondary" data-offstyle="danger" >' +
                  '<input type="hidden" name="listview[]" value="1">' +
                '</div>' +
              '</div>' +
              '<div class="col-md-2 mt-4">' +
                '<div class="row">' +
                  '<div class="col">' +
                    '<div class="form-group">' +
                      '<button type="button" class="btn btn-dark pull-right remove-row"> <i class="fa fa-cog"></i> </button>' +
                    '</div>' +
                  '</div>' +
                  '<div class="col">' +
                    '<div class="form-group">' +
                      '<button type="button" class="btn btn-danger pull-right remove-row"> <i class="fa fa-times"></i> </button>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
              
            '</div>' +
            '<div clas="row f-config">' +
              '<div class="col">' +
                
              '</div>' +
            '</div>' +
            '<input type="hidden" name="fieldId[]" value="add">' +
          '</div>';

    $('#fieldsHtml').append($html);
    $('[data-toggle="toggle"]').bootstrapToggle('destroy');
    $('[data-toggle="toggle"]').bootstrapToggle();

    if(data != null) {
      var configuration = JSON.parse(data.configuration);
      $('#field-' + id).find('input[name="fieldName[]"]').val(data.title);
      $('#field-' + id).find('select[name="ftype[]"]').val(data.type);
      if(typeof configuration.required != 'undefined' && configuration.required == 1) {
        $('#field-' + id).find('.required').prop('checked', true).trigger('change');
      } else {
        $('#field-' + id).find('.required').prop('checked', false).trigger('change');
      }
      if(typeof configuration.listview != 'undefined' && configuration.listview == 1) {
        $('#field-' + id).find('.listview').prop('checked', true).trigger('change');
      } else {
        $('#field-' + id).find('.listview').prop('checked', false).trigger('change');
      }

      $('#field-' + id).find('input[name="fieldId[]"]').val(data.id);
    }
}

var resetProjectCustomizeModel = function() {
	$('#project-customize-modal').find('#fieldsHtml').html('');
  $('#project-customize-modal input[name="component_id"]').remove();
  $('#comName').val('');
  $('button[name="compIcon"] i').attr('class', 'empty').siblings('input[name="compIcon"]').val('');
  $('input[name="delField[]"]').remove();
}