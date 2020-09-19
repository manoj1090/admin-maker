<?php 

function baseurl() {
	return base_url() . 'index.php/';
}

function checkLogin() {
	$CI = get_instance();
    $exclude = array(
        "login",
        "register"
    );
    
    if(in_array($CI->router->method, $exclude)) {
	    if($CI->session->userdata('userData')) {
	        redirect(baseurl() . 'dashboard');
	    }
    } else {
    	if(!$CI->session->userdata('userData')) {
	        redirect(baseurl() . 'auth/login');
	    }
    }

}