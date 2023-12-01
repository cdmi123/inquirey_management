<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Today_followup extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
	}
	public function index()
	{
		$this->load->model('Inquiry_model');
		$date = date('Y-m-d'); 
		$this->db->select('inq_offline.*,admin.name as inq_by_name');
		$this->db->where('demo_date',$date);
		$this->db->join('admin','admin.id=inq_offline.inquiry_by');
		$data['arr'] = $this->db->get('inq_offline')->result_array();
		$this->load->view('today_followup',$data);
	}

	public function due_followups()
	{
		$this->load->model('Inquiry_model');
		$date = date('Y-m-d'); 
		$this->db->select('inq_offline.*,admin.name as inq_by_name');
		$this->db->where('demo_date < ',$date);
		$this->db->where('inq_offline.status',"P");
		$this->db->join('admin','admin.id=inq_offline.inquiry_by');
		$data['arr'] = $this->db->get('inq_offline')->result_array();
		$this->load->view('today_followup',$data);
	}
}
