<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class MY_Controller extends CI_Controller {

	public $base_url;

	function __construct() {
		parent::__construct();
		$this->load->model('my_model', 'model');
		$this->base_url = baseurl();
		$this->is_loggedin();

		//Load language
		$this->lang->load('messages',setting('language'));
	}

	/**
	 * This method is used to check if user logged in into the system
	 * and exclue the public methods that are defined in $exclude array 
	 */
	public function is_loggedin(){

		$exclude = array(
			"login",
			"register",
			"authentication",
			"forgotpassword",
			"varifyuser"
		);
		if(in_array($this->router->fetch_method(), $exclude) !== FALSE) {
			return true;
		}

		if(isset($_SESSION['user_details'])){
			return true;
		}else{
		  redirect( baseurl().'user/login', 'refresh');
		}
	}


	    /**
     * This is a global functio to upload file
     * @param  FILE     $req    FILE Object
     * @return String      			Uploaded file name
     */
    public function fileUpload($req) {
        log_message('info', 'File upload process start.' . json_encode($req));
        $responce   = array();
        $countfiles = 1;
        if(is_array($_FILES[$req['field_name']]['name']) && !empty($_FILES[$req['field_name']]['name'])) {
            $countfiles = count($_FILES[$req['field_name']]['name']);
        } else {
            $_FILES[$req['field_name']]['name'] = array($_FILES[$req['field_name']]['name']);
            $_FILES[$req['field_name']]['type'] = array($_FILES[$req['field_name']]['type']);
            $_FILES[$req['field_name']]['tmp_name'] = array($_FILES[$req['field_name']]['tmp_name']);
            $_FILES[$req['field_name']]['error'] = array($_FILES[$req['field_name']]['error']);
            $_FILES[$req['field_name']]['size'] = array($_FILES[$req['field_name']]['size']);
        }

        
        for($i=0;$i<$countfiles;$i++){
            // Define new $_FILES array - $_FILES['file']
            $_FILES['file']['name']         = $_FILES[$req['field_name']]['name'][$i];
            $_FILES['file']['type']         = $_FILES[$req['field_name']]['type'][$i];
            $_FILES['file']['tmp_name']     = $_FILES[$req['field_name']]['tmp_name'][$i];
            $_FILES['file']['error']        = $_FILES[$req['field_name']]['error'][$i];
            $_FILES['file']['size']         = $_FILES[$req['field_name']]['size'][$i];

            $config['upload_path']          = $req['path'];
            $config['allowed_types']        = $req['allowed_types'];
            $config['max_size']             = $req['max_size'];
            if(isset($req['max_width']) && $req['max_width'] > 0) 
                $config['max_width']        = $req['max_width'];
            if(isset($req['max_height']) && $req['max_height'] > 0) 
                $config['max_height']       = $req['max_height'];

            //Load upload library
            $this->load->library('upload',$config);

            if($this->upload->do_upload('file')){
                // Get data about the file
                $uploadData = $this->upload->data();
                $filename   = $uploadData['file_name'];
    
                // Initialize array
                $responce['filenames'][] = $filename;
            } else {
                $error = array('error' => $this->upload->display_errors());
                log_message('error', 'Error Occured while file uploading.' . json_encode($error));
            }
        }
        return $responce;
    }
}