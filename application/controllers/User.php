<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    
    public $user;

	function __construct() {
        parent::__construct();
    }
    
    /**
     * This method is responsible to fetch the detail of user by it's id
     * @param Integer  $id
     * @return Json
     */
    public function getUserDetail($id) {
        $where = array(
            'id' => $id
        );
        $user = $this->globalModel->getData(TAB_USERS, $where, []);
        unset($user[0]->password);
        unset($user[0]->access_token);
        $this->responce['data'] = $user;
        $this->responce['message'] = "User detail fetched successfully.";
        $this->sendResponce($this->responce);
    }

    /**
     * This method is responsible to update user's detail into databse
     * @return Json
     */
    public function updateUserDetail() {

        $request = $this->input->post();

        if(isset($request['id']) && $request['id'] > 0) {
            $where = array(
                'id' => $request['id']
            );
            $oldRow = $this->globalModel->getData(TAB_USERS, $where, []);
            $updateRow = array();
            $pass = 1;
            if(isset($request['currentpassword']) && $request['currentpassword'] != '') {
                $pass = 0;
                if (!password_verify($request['currentpassword'], $oldRow[0]->password)) {
                    $this->responce['success'] = false;       
                    $this->responce['message'] = "Wrong Current Password Entered.";
                } else {
                    if(isset($request['password']) && $request['password'] != '') {
                        $pass = 1;
                        $updateRow['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
                    } else {
                        $this->responce['success'] = false;
                        $this->responce['message'] = "Password should not blank if you entered current password.";
                    }
                }             
            }
            if($pass == 1) {
                $profile = '';
                if(isset($_FILES) && $_FILES['profile']['error'] == 0) {
                    $uploadData = array(
                        'field_name'    => 'profile',
                        'path'          => ASSETS_PATH . 'theme/img/',
                        'allowed_types' => 'jpg|jpeg|png',
                        'max_size'      => 10000,
                    );
                    $profile = $this->fileUpload($uploadData);
                    $profile = $profile['filenames'][0];
                }
                if($profile != '') {
                    $updateRow['profile_image'] = $profile;
                }
                $updateRow['name'] = $request['name'];
                $updateRow['email'] = $request['email'];
                $updateRow['phone'] = $request['phone'];
                if($this->globalModel->update(TAB_USERS, $updateRow, $where)) {
                    $this->responce['message'] = "User Profile updated successfully.";
                } else {
                    $this->responce['success'] = false;
                    $this->responce['message'] = "Change something to update.";
                }
            }
        } else {
            $this->responce['success'] = false;
            $this->responce['message'] = "User does't exists.";
        }

        $this->sendResponce($this->responce);
    }

    public function profile() {
        $this->load->view('common/header');
        $this->load->view('profile');
        $this->load->view('common/footer');
    }
}