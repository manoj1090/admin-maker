$(function() {
    $("#fileUpload").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $(".fileinput-preview");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                  "src": e.target.result,
                  "class": "thumb-image setpropileam"
                }).appendTo(image_holder);

                var user = $('input[name="userId"]').val();
                $.post( $('body').attr('data-base-url') + 'user/uploadProfile', { img : e.target.result, user: user }, function(res) {
                    console.log(res);
                })
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });


    $('.upload-logo-fav').on('click', function() {
        $(this).siblings('.custom-file').find('input[type="file"]').trigger('click');
    });

    $('input[type="file"][name="logo"], input[type="file"][name="favicon"]').on('change', function() {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("."+ $(this).attr('name') +"-preview");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                  "src": e.target.result,
                  "class": "thumb-image setpropileam"
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });
});



var showModel = function(id) {
    $('#' + id).modal('show');
}

var showNotification = function(text, type) {
    if (type === null || type === '') { type = 'success'; }
    if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
    var allowDismiss = true;

    $.notify(text, {
        // whether to hide the notification on click
        clickToHide: true,
        // whether to auto-hide the notification
        autoHide: true,
        // if autoHide, hide after milliseconds
        autoHideDelay: 5000,
        // show the arrow pointing at the element
        arrowShow: false,
        // arrow size in pixels
        arrowSize: 5,
        // position defines the notification position though uses the defaults below
        position: 'top right',
        // default positions
        //elementPosition: 'bottom right',
        //globalPosition: 'top right',
        // default style
        //style: 'bootstrap',
        // default class (string or [string])
        className: type,
        // show animation
        //showAnimation: 'slideDown',
        // show animation duration
        //showDuration: 400,
        // hide animation
        //hideAnimation: 'slideUp',
        // hide animation duration
        hideDuration: 200,
        // padding between element and notification
        gap: 4
    });
}

var saveFormData = function(formId) {

}