<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customize extends MY_Controller {
    public $responce = array(
		"success" => true,
		"message" => ".",
		"data" => ''
    );

    private $request;
    private $projectSlug;

	function __construct() {
        parent::__construct();
        $this->request = $this->getRequest();
        $this->userId = $this->session->userdata('userData')['id'];
        $this->projectSlug = $this->input->get('p');
    }

    /**
     * This function is used to load the view of customization with data
     * @return Void
     */
    public function index() {
        $project = $this->globalModel->getData(TAB_PROJECTS, array( "slug" => $this->projectSlug ), '');
        $components = $this->globalModel->getData(TAB_COMPONENT, array('project_id' => $project[0]->id), '');
        $data['project'] = $project[0];
        $data['compponents'] = $components;
        $this->load->view('common/header');
        $this->load->view('customize', $data);
        $this->load->view('common/footer');
    }

    /**
     * This function is used to generate the name of table by component name 
     * @param  String   $text  Component string
     * @return String
     */
    public function generateTableName($text) {
        $text = strtolower(trim($text));
        $text = str_replace(' ', '_', $text);
        $text = preg_replace('/[^a-z0-9\_]/', '', $text);
        return 'mka_'.$text;
    }

    /**
     * This function is used to generate the name of column by field name 
     * @param  String   $text  Field string
     * @return String
     */
    public function generateColumnName($text) {
        $text = strtolower(trim($text));
        $text = str_replace(' ', '_', $text);
        $text = preg_replace('/[^a-z0-9\_]/', '', $text);
        return $text;
    }

    /**
     * This method is used to add the componen into database
     */
    public function addComponent() {
        $project = $this->globalModel->getData(TAB_PROJECTS, array( "id" => $this->input->post('porjectId') ), '');
        $component = array(
            "project_id"    => $this->input->post('porjectId'),
            "title"         => $this->input->post('componentName'),
            "tab_name"      => $this->generateTableName($this->input->post('componentName')),
            "icon"          => $this->input->post('compIcon') != 'empty' ? $this->input->post('compIcon') : ''
        );
        if($this->input->post('component_id') > 0) {
            $comId = $this->input->post('component_id');
            $this->globalModel->update(TAB_COMPONENT, $component, array('id'=> $comId));
        }else {
            $comId = $this->globalModel->insert(TAB_COMPONENT, $component);
        }
        if(!empty($this->input->post('fieldName'))) {
            foreach ($this->input->post('fieldName') as $fieldKey => $fieldValue) {
                $configuration = array(
                    "required"  => $this->input->post('required')[$fieldKey],
                    "listview"  => $this->input->post('listview')[$fieldKey]
                );
                $field = array(
                    "component_id"  => $comId,
                    "title"         => $fieldValue,
                    "column_name"   => $this->generateColumnName($fieldValue),
                    "type"          => $this->input->post('ftype')[$fieldKey],
                    "configuration" => json_encode($configuration)
                );
                if(isset($this->input->post('fieldId')[$fieldKey]) && is_numeric($this->input->post('fieldId')[$fieldKey])) {
                    $fId = $this->input->post('fieldId')[$fieldKey];
                    $this->globalModel->update(TAB_FIELDS, $field, array('id' => $fId));
                } else {
                    $this->globalModel->insert(TAB_FIELDS, $field);
                }
            }
        }
        redirect(baseurl() . 'customize?p=' . $project[0]->slug,'refresh');
    }

    /**
     * This function is used to get the component details with fields detail.
     * @param  Integer  $compId     Component id of whitch you want detail
     * @return Json
     */
    public function getComponent($compId) {
        $compData = $this->globalModel->getData(TAB_COMPONENT, array('id' => $compId), '');
        $compData = $compData[0];
        if(!empty($compData)) {
            $fields = $this->globalModel->getData(TAB_FIELDS, array('component_id' => $compId), '');
            $compData->fieldsData = $fields;
        }

        $this->sendResponce($compData);
    }


    /**
     * This function is used to remove the component from database.
     * @param  Integer $compId  Component id
     * @return Json
     */
    public function delComponent($compId) {
        $this->globalModel->delete(TAB_FIELDS, array( "component_id" => $compId));
        $this->globalModel->delete(TAB_COMPONENT, array( "id" => $compId));
        $this->responce['message'] = 'Component deleted successfully';
        $this->sendResponce($this->responce);
    }
}