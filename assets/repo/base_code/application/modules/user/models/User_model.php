<?php
class User_model extends CI_Model {       
	function __construct(){            
	  	parent::__construct();
		$this->user_id =isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->id:'1';
	}

	/**
      * This function is used authenticate user at login
      */
  	function auth_user() {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
	    	$this->db->where("(username='$email' OR email='$email')");
			$result = $this->db->get('users')->result();
			if(!empty($result)){       
				if (password_verify($password, $result[0]->password)) {       
					if($result[0]->status != 'active') {
						return 'not_varified';
					}
					return $result;                    
				}
				else {             
					return false;
				}
			} else {
				return false;
			}
  	}

	/**
      * This function is used to load view of reset password and varify user too 
      */
	function mail_varify() {    
		$ucode = $this->input->get('code');     
		$this->db->select('email as e_mail');        
		$this->db->from('users');
		$this->db->where('var_key',$ucode);
		$query = $this->db->get();     
		$result = $query->row();   
		if(!empty($result->e_mail)){      
			return $result->e_mail;         
		}else{     
			return false;
		}
	}


	/**
      * This function is used Reset password  
      */
	function ResetPpassword(){
		$email = $this->input->post('email');
		if($this->input->post('password_confirmation') == $this->input->post('password')){
			$npass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$data['password'] = $npass;
			$data['var_key'] = '';
			return $this->db->update('users',$data, "email = '$email'");
		}
	}
 
  	/**
      * This function is used to select data form table  
      */
	function get_data_by($tableName='', $value='', $colum='',$condition='') {	
		if((!empty($value)) && (!empty($colum))) { 
			$this->db->where($colum, $value);
		}
		$this->db->select('*');
		$this->db->from($tableName);
		$query = $this->db->get();
		return $query->result();
  	}

  	/**
      * This function is used to check user is alredy exist or not  
      */
	function check_exists($table='', $colom='',$colomValue='', $id='', $id_CheckCol=''){
		$this->db->where($colom, $colomValue);
                if(!empty($id) && !empty($id_CheckCol)){
                    $this->db->where($id_CheckCol.' !=' , $id);
                }
		$res = $this->db->get($table)->row();
		if(!empty($res)){ return false; } else{ return true; }
 	}

 	/**
      * This function is used to get users detail  
      */
	function get_users($userID = '') {
		$this->db->where('status', 'active');                  
		if(isset($userID) && $userID !='') {
			$this->db->where('id', $userID); 
		} else if($this->session->userdata('user_details')[0]->role == '1') {
			$this->db->where('role', '1'); 
		} else {
			$this->db->where('users.id !=', '1'); 
		}
		$result = $this->db->get('users')->result();
		return $result;
  	}

  	/**
      * This function is used to get email template  
      */
  	function get_template($code){
	  	$this->db->where('code', $code);
	  	return $this->db->get('templates')->row();
	}


/*  	public function get_list_box_data($qr) {
  		$exe = $this->db->query($qr);
  		return $exe->result();
  	}
*/
  	public function getQrResult($qr) {
  		$exe = $this->db->query($qr);
  		return $exe->result();
  	}


    public function get_bar_chart_data($qr) {
      $exe = $this->db->query($qr);
      $res = $exe->result();
      $result = [];
      $i = 1;
      while ($i <= 12) {
        $result[$i] = 0;
        foreach ($res as $key => $value) {
          if($value->months == $i) {
            //$result[$i] += $value->mka_sum; 
            $result[$i] += ( int ) str_replace(',', '', $value->mka_sum);
          }
        } 
        $i++;
      }
      return implode(',', $result);
    }


   	public function registration_mail_varify() {    
		$ucode = $this->input->get('code');     
		if($ucode == '') {
			return false;
		}
		$this->db->select('email as e_mail');        
		$this->db->from('users');
		$this->db->where('var_key',$ucode);
		$query = $this->db->get();     
		$result = $query->row();   
		if(!empty($result->e_mail)){  
			$data['var_key'] = '';
			$data['status'] = 'active';
			if(setting_all('admin_approval') == 1) {
				$data['status'] = 'varified';
			}
			$this->db->update('users',$data, "email = '$result->e_mail'");  
			return $result->e_mail;         
		}else{     
			return false;
		}
	}
}