<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Web_followup extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
	}
	function add_followup_data($id)
	{
		$this->db->where('id',$id);
		$arr['inquiry_data'] = $this->db->get('inq_web')->row_array();
		$arr['fo_id'] = $id;
		if($this->input->post())
		{
			$followup_reason = $this->input->post('followup_reason');
			$followup_by = $this->input->post('followup_by');

			$arr1 = array('inquiry_id'=>$id,'followup_reason'=>$followup_reason,'followup_by'=>$followup_by);
			$this->db->insert('web_followup',$arr1);
			redirect('web_followup/view_followup/'.$id);
		}

		$this->load->view('add_web_followup',$arr);
	}


	function view_followup($id)
	{

		$arr['fo_id'] = $id;

		$this->db->where('web_followup.inquiry_id',$id);
		$this->db->join('inq_web','inq_web.id=web_followup.inquiry_id','left');
		$arr['follow'] = $this->db->get('web_followup')->result_array();

		//echo $this->db->last_query();die;

		//echo '<pre>';print_r($arr);die;
		$this->load->view('view_web_followup',$arr);
	}

}
