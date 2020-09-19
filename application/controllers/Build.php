<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Build extends MY_Controller {
    public $responce = array(
		"success" => true,
		"message" => ".",
		"data" => ''
    );

    private $request;

	function __construct() {
        parent::__construct();
        $this->request     = $this->getRequest();
        $this->userId      = $this->session->userdata('userData')['id'];
        $this->load->model('build_model', 'build');
    }


    /**
     * This function is used to copy folder and it's content.
     * @param  String $src Source folder path
     * @param  String $dst Destination folder path
     * @return Void
     */
    public function recurseCopy($src,$dst) { 
        $dir = opendir($src); 
        if (!file_exists($dst)) {
            mkdir($dst, 0777, true);
        }
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    $this->recurseCopy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
    }


    /**
     * This function is used to replace multiple strings in the file
     * @param  String $path    File path
     * @param  array  $strings Array of strings that we want to replace into file
     * @return VOid
     */
    public function replaceStringInFile($path, $strings = array()) {
        if(file_exists($path)) {
            $str = file_get_contents($path);
            if(!empty($strings)) {
                foreach ($strings as $strkey => $strvalue) {
                    $str = str_replace($strkey, $strvalue, $str);    
                }
                file_put_contents($path, $str);
            }
        } else {
            echo 'file not ----' . $path;
            exit;
        }
    }


    /**
     * This function is used to create modul into new project.
     * @param  Object $componentData Component detail object
     * @param  [type] $fieldData     [description]
     * @param  [type] $projectPath   [description]
     * @return [type]                [description]
     */
    public function createModule($componentData, $fieldData, $projectPath) {
        $controllerName = ucfirst(str_replace('mka_', '', $componentData->tab_name));
        $moduleSrc = CURRENT_PROJECT_DIR . 'assets/repo/base_module/';
        $moduleDst = $projectPath .'/application/modules/' . strtolower($controllerName) .'/';
        $this->recurseCopy($moduleSrc,$moduleDst);  


        rename($moduleDst . 'controllers/Mka.php', $moduleDst . 'controllers/' . $controllerName .'.php');
        $this->replaceStringInFile($moduleDst . 'controllers/' . $controllerName .'.php', array(
            "Mka" => $controllerName
        ));
        rename($moduleDst . 'models/Mka_model.php', $moduleDst . 'models/' . $controllerName .'_model.php');
        $this->replaceStringInFile($moduleDst . 'models/' . $controllerName .'_model.php', array(
            "Mka" => $controllerName
        ));
        rename($moduleDst . 'views/Mka_view.php', $moduleDst . 'views/' . $controllerName .'_view.php');
        $this->prepareViewFile($componentData, $fieldData, $projectPath); 
        $this->createTable($componentData, $fieldData);
    }

    public function prepareViewFile($componentData, $fieldData, $projectPath) {
        $controllerName = ucfirst(str_replace('mka_', '', $componentData->tab_name));
        $moduleDst = $projectPath .'/application/modules/' . strtolower($controllerName) .'/';

        $table_header = '<th>#</th>'.PHP_EOL;
        $formFieldHtml = '';
        if(is_array($fieldData) &&  !empty($fieldData)) {
            foreach ($fieldData as $field) {
                $fieldSetting = json_decode($field->configuration);
                if($fieldSetting->listview) {
                    $table_header .= '<th>'.$field->title.'</th>'.PHP_EOL; 
                }

                $formFieldHtml .= '<div class="form-group pmd-textfield pmd-textfield-floating-label">';
                if($field->type == "select") {

                } else if($field->type == "radio" || $field->type == "checkbox") {

                } else {
                    $formFieldHtml .= '<label for="'.$field->column_name.'">'.$field->title.'</label>';
                    $formFieldHtml .= '<input type="'.$field->type.'" class="mat-input form-control" name="'.$field->column_name.'" value="">';
                }

                $formFieldHtml .= '</div>';
            }
        }
        $this->replaceStringInFile($moduleDst . 'views/' . $controllerName .'_view.php', array(
            "Mka"                        => $controllerName,
            "%%MKA_COMPONENT_NAME%%"     => $componentData->title,
            "%%MKA_LIST_HEADE_TH%%"      => $table_header,
            "%%MKA_COMPONENT_NAME_ORG%%" => $componentData->tab_name,
            "%%FORM_FIELDS_HTML%%"       => $formFieldHtml
        ));
    }


    /**
     * This function is used to create table into database
     * @param  Object    $componentData  Component details object
     * @param  Object    $fieldData      Fields Object 
     * @return Void
     */
    public function createTable($componentData, $fieldData) {
        log_message('debug', "Table Creating Process Start....:" . $componentData->tab_name);
        $db = $componentData->project_id . PROJECT_DATABASE_NAME_POSTFIX;
        $fields = $fieldData;

        $qr = 'CREATE  TABLE IF NOT EXISTS `' . $db . '`.`' . $componentData->tab_name . '` (';
        $qr .= '`id` int(11) NOT NULL  AUTO_INCREMENT, ';
        if(!empty($fields)) {
            foreach ($fields as $field) {
                switch ($field->type) {
                    case 'int':
                        $qr .= '`'.$field->column_name.'` INT, ';
                        break;
                    case 'longtext':
                        $qr .= '`'.$field->column_name.'` LONGTEXT, ';
                        break;
                    default:
                        $qr .= '`'.$field->column_name.'` VARCHAR(250), ';
                        break;
                }
            }
        }
        $qr .= 'PRIMARY KEY (`id`)';
        $qr .= ') ENGINE=InnoDB DEFAULT CHARSET=latin1;';
        $this->db->query($qr);
    }

    
    /**
     * This function is responsable to create the initial database of project
     * @param  Object   $projectData    Project data object
     * @return Void
     */
    public function createInitialDB($projectData) {
        $database_name = $projectData->id . PROJECT_DATABASE_NAME_POSTFIX;
        log_message('debug', "Initial Database Creating...." . $database_name);
        $this->db->query("DROP DATABASE IF EXISTS " . $database_name);
        $this->db->query('CREATE DATABASE ' . $database_name);
        $command = "mysql -u " . DB_USER . " -p" . DB_PASS . " " . $database_name . " < " . PROJECT_SQL_FILE_PATH;
        log_message('debug', "Create database command : " . $command);
        exec($command);
        log_message('debug', "Initial Database Done");

        $destination    = CURRENT_PROJECT_DIR . 'demo/' . $projectData->id . '/' . $projectData->slug;
        $pth = $destination . '/application/config/constants.php';
        $replace = array(
            "%%DB_HOST%%" => 'localhost',
            "%%DB_NAME%%" => $database_name,
            "%%DB_USER%%" => DB_USER,
            "%%DB_PASS%%" => DB_PASS
        );
        if(is_array($projectData->components) && !empty($projectData->components)) {
            $tb_consts = '';
            foreach ($projectData->components as $comkey => $comvalue) {
                $tb_consts .= 'define(\'TAB_'.strtoupper($comvalue->tab_name).'\', \''.$comvalue->tab_name.'\');'.PHP_EOL;
            }
            $tb_consts .= '/*MKA_TABLES_CONSTANT_END*/';
            $replace['/*MKA_TABLES_CONSTANT_END*/'] = $tb_consts;
        }
        log_message('debug', "Replabe database connection details: " . json_encode($replace));
        $this->replaceStringInFile($pth, $replace);
    }  


    /**
     * This function is used to create the new project
     * @param  Integer  $projectId  Project ID
     * @return Void
     */
    public function buildproject($projectId) {
        /* Get all project details start here */
        log_message('info', 'Project Building process start....');
        $projectData = $this->globalModel->getData(TAB_PROJECTS, array('id' => $projectId), '');
        $projectData = $projectData[0];
        if(!empty($projectData)) {
            $projectData->components = $this->globalModel->getData(TAB_COMPONENT, array('project_id' => $projectId), '');
            /* Copy base-code to demo folder start here  */
            $baseSourcePath = CURRENT_PROJECT_DIR . 'assets/repo/base_code/';
            $destination    = CURRENT_PROJECT_DIR . 'demo/' . $projectId . '/' . $projectData->slug;
            log_message('debug', "Start project base code copy process....");
            log_message('debug', $baseSourcePath . " to " . $destination);
            $this->recurseCopy($baseSourcePath, $destination);
            log_message('debug', "End project base code copy process....");
            /* Copy base-code to demo folder end here  */

            /* Initial database creation start here  */
            $this->createInitialDB($projectData);

            /* Initial database creation end here  */


            $pth = $destination . '/application/views/inc/header.php';
            $replace = array(
                "%%PROJECT_TITLE%%" => $projectData->title
            );
            $this->replaceStringInFile($pth, $replace);

            $pth = $destination . '/application/modules/user/views/login.php';
            $replace = array(
                "%%MKA_VAR_PROJECT_TITLE%%" => $projectData->title
            );
            $this->replaceStringInFile($pth, $replace);
            if(is_array($projectData->components) && !empty($projectData->components)) {
                foreach ($projectData->components as $comkey => $comvalue) {
                    log_message('debug', "Creating component : " . $comvalue->title);
                    $fields = $this->globalModel->getData(TAB_FIELDS, array('component_id' => $comvalue->id), '');
                    $this->createModule($comvalue, $fields, $destination);

                    //Add Menu
                    $menutable = $projectData->id . PROJECT_DATABASE_NAME_POSTFIX. '.menu';
                    $qr = "SELECT MAX(`position`) + 1 as position FROM " . $menutable;
                    $obj = $this->globalModel->customQuery($qr);
                    $row = $obj->row();
                    $inst = array(
                        "title" => $comvalue->title,
                        "icon" => $comvalue->icon,
                        "url" => strtolower(str_replace('mka_', '', $comvalue->tab_name)),
                        "fetch_method" => strtolower(str_replace('mka_', '', $comvalue->tab_name)),
                        "position" => $row->position
                    );
                    log_message('debug', 'Menu insert data: '. print_r($inst, true));
                    $this->globalModel->insert($menutable, $inst);
                    
                }
            } else {
                log_message('debug', 'Project does not have any component : ' . $projectId);    
            }
        } else {
            log_message('debug', 'Project data not avaialable of project id : ' . $projectId);
        }
        /* Get all project details end here */
        echo true;
    }
}