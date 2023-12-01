<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');	
		ob_start();
	}
	function index()
	{
		if($this->session->userdata('user_login')!='')
		{
			if($this->session->userdata('user_role') ==2){
				redirect('faculty-students');
			}else{
				redirect('staff-dashboard');	
			}
		}
		$data=array();
		
		if($this->input->post())
		{
			
			$qry=$this->Login_model->check_user(); 
			$res=$qry->row_array();	
			$num=$qry->num_rows();
			
			if($num==1)
			{
				$arr=$qry->row_array();
				if($arr['status'] == 1){
					$admin_id=$arr['id'];
					$this->session->set_userdata('user_login',$admin_id);
					$this->session->set_userdata('user_role',$arr['role']);
					$this->session->set_userdata('branch_id',$arr['branch_id']);
					$this->session->set_userdata('dept_id',$arr['dept_id']);
					if($arr['role'] ==2){
						redirect('faculty-students');
					}else{
						redirect('staff-dashboard');	
					}
					
				}else if($arr['status'] == 0){
					$data['msg']="Your user is not activated.please contact to administrator.";
				}else if($arr['status'] == 2){
					$data['msg']="Your user is blocked.please contact to administrator.";
				}
				

			}else
			{
				$data['msg']="invalid username and password";
			}
		}

		$this->load->view('login',$data);
	}

	function logout()
	{
		//echo $this->session->userdata('user_login');die;
		$this->load->driver('cache');
	    $this->session->sess_destroy();
	    $this->cache->clean();
	    ob_clean();
		//$this->session->unset_userdata('user_login');
		redirect('staff-login');
	}
}

?>