<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is the core class of the project. which have all the common core functions
 * That my be use at any controller
 * 
 * @author Manoj Kumar Ahirwar
 * @license 
 */
class MY_Controller extends CI_Controller {

    public $responce = array(
		"success" => true,
		"message" => ".",
		"data" => ''
    );

    public $userId = '';

    function __construct() {
        parent::__construct();
        $this->load->model('my_model', 'globalModel');
        checkLogin();
    }

    

    /**
     * This method is used to get the request from the fron end
     */
    public function getRequest() {
        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * This function is used to send back the processed output to the client
     */
    public function sendResponce($dataArray) {
        $out = $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($dataArray));
        echo $out->final_output; exit;
    }

    /**
     * This method is used to authenticate the token. 
     */
    public function authenticateToken() {
        $headers = getallheaders();

        $exclude = array(
            "login",
            "register"
        );

        if(in_array($this->router->method, $exclude)) {
            return true;
        }
        if(isset($headers['Authorization']) && $headers['Authorization'] != '') {
            $where = array(
                'access_token' => $headers['Authorization']
            );
            $res = $this->globalModel->getData(TAB_USERS, $where, []);
            if(!empty($res)) {
                $this->userId = $res[0]->id;
                $this->session->set_userdata('userData', $res);
                return true;
            } else {
                $this->responce['success'] = False;
                $this->responce['message'] = "Authentication token error";
            }
        } else {
            $this->responce['success'] = False;
            $this->responce['message'] = "Authentication token error";
        }
        $this->sendResponce($this->responce);
    }


    /**
     * This is a global functio to upload file
     * @param  FILE     $req    FILE Object
     * @return [type]      [description]
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

    /**
     * This function is used to get token string.
     * @param  Integer  $range 
     * @return String   
     */
    public function generateAccessToken($range) {
        return bin2hex(openssl_random_pseudo_bytes($range));
    }
}