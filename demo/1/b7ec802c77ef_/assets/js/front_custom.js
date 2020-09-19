$(function() {
	$('#login-submit').on('click', function() {
		var username = $('#username-field').val();
		var password = $('#password-field').val();
		if(username == '' || password == '') {
			$('.login-card .alert').addClass('alert-danger').removeClass('alert-success').text('All Fields are required.').show();
		} else {
			$('.login-card .alert').hide();

			$.ajax({
				url: $('body').attr('data-base_url') + 'user/authentication',
				method: 'post',
				data: {
					'email' : username,
					'password' : password
				}
			}).done(function(responce) {
				console.log(responce);
				if(responce == 'varified') {
					$('.login-card .alert').addClass('alert-success').removeClass('alert-danger').text('Welcone back, Successfully authenticated.').show();
					setTimeout(function() {
						window.location.href = $('body').attr('data-base_url') + 'user/dashboard'
					}, 1000)
				} else if( responce == 'invalid') {
					$('.login-card .alert').removeClass('alert-success').addClass('alert-danger').text('Invalid User.').show();
				} else if( responce == 'not_varified') {
					$('.login-card .alert').removeClass('alert-success').addClass('alert-danger').text('Your account is not activated, Please contact to admin.').show();
				}
			})
		}


	});



	$('#register-submit').on(function() {
		var username = $('#regUsername').val();
		var password = $('#regPassword').val();
		var email    = $('#regEmail').val();

		var validation = true;
		var msg
		if(username == '') {
			msg = 'Username is required.';
			validation = false;
		}
		if(password == '') {
			msg = 'Password is required.';
			validation = false;
		} 
		if( email == '' ) {
			msg = 'Email is required.';
			validation = false;			
		}

		if(!validation) {
			$('.login-card .alert').addClass('alert-danger').removeClass('alert-success').text(msg).show();
		} else {

			$.ajax({
				url: $('body').attr('data-base_url') + 'user/register',
				method: 'post',
				data: {
					'username' : username,
					'email' : email,
					'password' : password
				}
			}).done(function(responce) {
				console.log(responce);
				if(responce == 'done') {
					$('.login-card .alert').addClass('alert-success').removeClass('alert-danger').text('Your account has been created successfully. ').show();
					//show login page
					setTimeout(function() {
						$('.register-login').trigger('click');
					}, 500);
				} else if( responce == 'email_exist') {
					$('.login-card .alert').removeClass('alert-success').addClass('alert-danger').text('This email is not available.').show();
				}
			});
		}
	});
});