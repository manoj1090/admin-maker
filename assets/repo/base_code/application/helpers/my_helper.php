<?php
/**
 * This is system helper has all helper functions
 */

/**
 * This function is used to get the base URL with index file.
 * @return String    Base URL
 */
function baseurl() {
	return base_url() . 'index.php/';
}

/**
 * This function is used to get the setting by key
 * @param  String $key   Key of setting
 * @return Setting       Setting value
 */
function setting($key) {
    $CI = get_instance();
    $resp = '';
    $res = $CI->db->select('value')->from(TAB_SETTINGS)->where('key', $key)->get()->row();
    if(isset($res->value)) {
        $resp = $res->value;
    }
    return $resp;
}


/**
 * This function is used to redirect the user as is logged in or not
 * @return Void
 */
function checkLogin() {
	$CI = get_instance();
    $exclude = array(
        "login",
        "register"
    );
    
    if(in_array($CI->router->method, $exclude)) {
	    if($CI->session->userdata('user_details')) {
	        redirect(baseurl() . 'dashboard');
	    }
    } else {
    	if(!$CI->session->userdata('user_details')) {
	        redirect(baseurl() . 'auth/login');
	    }
    }

}



function getMenus() {
    $CI = get_instance();
    return $CI->db->order_by('position', 'asc')->get(TAB_MENU)->result();
}