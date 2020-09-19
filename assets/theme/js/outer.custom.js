$(function() {
	$('.redirect').on('click', function() {
		var obj = $(this);
		if(obj.data('href') != '') {
			window.location.href= $('body').data('base-url') + obj.data('href');
		}
	});

	

	$('#loginForm').on('submit', function(event) {
		event.preventDefault();
		var json = {
			"email": $('input[name="email"]').val(),
			"pwd" : $('input[name="pwd"]').val()
		};

		$.ajax({
			url: $('body').data('base-url') + 'auth/login',
			method: 'post',
			data: json
		}).done(function(responce) {
			responce = JSON.parse(responce);
			if(responce.success) {
				window.location.href= $('body').data('base-url') + "dashboard"
			} else {
				alert(responce.message);
			}
		});
	})


	$('#registerForm').on('submit', function(event) {
		event.preventDefault();
		var json = {
			"name": $('input[name="name"]').val(),
			"email": $('input[name="email"]').val(),
			"pwd" : $('input[name="pwd"]').val()
		};

		$.ajax({
			url: $('body').data('base-url') + 'auth/register',
			method: 'post',
			data: json
		}).done(function(responce) {
			responce = JSON.parse(responce);
			if(responce.success) {
				window.location.href= $('body').data('base-url') + "auth/login"
			} else {
				alert(responce.message);
			}
		});
	})
	
});