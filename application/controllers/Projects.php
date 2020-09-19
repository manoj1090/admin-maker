<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends MY_Controller {
    public $responce = array(
        "success" => true,
        "message" => ".",
        "data"    => ''
    );

    private $request;

	function __construct() {
        parent::__construct();
        $this->request = $this->getRequest();
        $this->userId  = $this->session->userdata('userData')['id'];
    }

    /**
     * This function is used to load view of project
     * @return Void
     */
    public function index() {
        $where = array(
            "user_id" => $this->userId
        );
        $data['project'] = $this->globalModel->getData(TAB_PROJECTS, $where, array('id' => 'desc'));
        $this->load->view('common/header');
        $this->load->view('projects', $data);
        $this->load->view('common/footer');
    }

    /**
     * This function is used to create new project
     * @return Void
     */
    public function create() {
        $request = $this->input->post();
        $lFile = '';
        $fFile = '';
        if(isset($_FILES['pLogo']) && !empty($_FILES['pLogo']) && $_FILES['pLogo']['error'] == 0) {
            $logo = array(
                'field_name'    => 'pLogo',
                'path'          => ASSETS_PATH . 'images/projects/',
                'allowed_types' => 'jpg|jpeg|png',
                'max_size'      => 1000,
            );
           $logofile = $this->fileUpload($logo);
           $lFile = $logofile['filenames'][0];
        }
        if(isset($_FILES['pFavicon']) && !empty($_FILES['pFavicon']) && $_FILES['pFavicon']['error'] == 0) {
            $logo = array(
                'field_name'    => 'pFavicon',
                'path'          => ASSETS_PATH . 'images/projects/',
                'allowed_types' => 'ico',
                'max_size'      => 100,
            );
           $logofile = $this->fileUpload($logo);
           $fFile = $logofile['filenames'][0];
        }
        $data = array(
            "slug"    => $this->generateAccessToken(6) . '_' . time("now"),
            "user_id" => $this->userId,
            "title"   => $request['pTitle'],
            "logo"    => $lFile,
            "favicon" => $fFile,
            "remark"  => $request['pRemark'],
            "status"  => 'active'
        );
        $projectId = $this->globalModel->insert(TAB_PROJECTS, $data);
        if($projectId) {
            $this->responce['message'] = "Project created successfully.";
        } else {
            $this->responce['success'] = false;
            $this->responce['message'] = "Unable to create project.";
        }
        redirect(baseurl() . 'projects');
    }
    

    /**
     * This function is used to delete the project
     * @param  Integer  $id     ID of project
     * @return Boolean          TRUE if removed successfully else FALSE
     */
    public function delete($id){
        $componens = $this->globalModel->getData(TAB_COMPONENT, array('project_id' => $id), '');
        if(is_array($componens) && !empty($componens)) {
            foreach ($componens as $component) {
                $this->globalModel->delete(TAB_FIELDS, array( "component_id" =>  $component->id ));
                $this->globalModel->delete(TAB_COMPONENT, array( "id" =>  $component->id ));
            }
        }
        $this->globalModel->delete(TAB_PROJECTS, array( "id" =>  $id ));
        $this->responce['message'] = 'Project deleted successfully';
        $this->sendResponce($this->responce);
    }

    public function get($id) {
        $project = $this->globalModel->getData(TAB_PROJECTS, array('id' => $id), '');
        $this->responce['message'] = 'Project fetched successfully';
        $this->responce['data'] = $project[0];
        $this->sendResponce($this->responce);
    }
   
}