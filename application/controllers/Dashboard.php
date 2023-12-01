<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Schoolinq_model');
		$this->load->helper(array('cookie', 'url')); 
		
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}	
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		if($this->session->userdata('user_role')==6){
			redirect('college-dashboard');	
		}
	}
	public function index()
	{

			$cur_year = date("Y");
			$cur_month = date("m");
			$cur_date = date("d");

		$date = date('Y-m-d'); 


		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',1);
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b1_cnt'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',2);
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b2_cnt'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',3);
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b3_cnt'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',4);
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b4_cnt'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',5);
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b5_cnt'] = $data->num_rows(); 
		//last_query();die;

		//$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('YEAR(followup_date)',$cur_year);
		$this->db->where('MONTH(followup_date)',$cur_month);
		$this->db->where('day(followup_date)',$cur_date);
		$data = $this->db->get('followup');
		$arr['cnt1'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',1);
		$this->db->where('demo_date <',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b1_due_inq'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',2);
		$this->db->where('demo_date <',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b2_due_inq'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',3);
		$this->db->where('demo_date <',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b3_due_inq'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',4);
		$this->db->where('demo_date <',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b4_due_inq'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',5);
		$this->db->where('demo_date <',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['b5_due_inq'] = $data->num_rows(); 


		// School inquery data  

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',1);
		$this->db->where('visit_date',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b1_scl_today'] = $data->num_rows(); 

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',2);
		$this->db->where('visit_date',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b2_scl_today'] = $data->num_rows(); 

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',3);
		$this->db->where('visit_date',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b3_scl_today'] = $data->num_rows(); 



		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',4);
		$this->db->where('visit_date',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b4_scl_today'] = $data->num_rows(); 

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',5);
		$this->db->where('visit_date',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b5_scl_today'] = $data->num_rows(); 

		// due schoole inquery

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',1);
		$this->db->where('expected_date < ',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b1_scl_due'] = $data->num_rows(); 

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',2);
		$this->db->where('expected_date < ',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b2_scl_due'] = $data->num_rows(); 

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',3);
		$this->db->where('expected_date < ',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b3_scl_due'] = $data->num_rows(); 

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',4);
		$this->db->where('expected_date < ',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b4_scl_due'] = $data->num_rows(); 

		$this->db->select('school_inq.id');
		$this->db->join('admin a','a.id=school_inq.added_by','left');
		$this->db->join('admin b','b.id=school_inq.inq_by','left');
		$this->db->where('school_inq.branch_id',5);
		$this->db->where('expected_date < ',$date);
		$this->db->where_in('school_inq.status',array("V",'D',"P","IC"));
		$data = $this->db->get('school_inq');
		$arr['b5_scl_due'] = $data->num_rows(); 

		// echo "<pre>";
		// print_r($arr); die();

		// if($this->session->userdata('user_role')==8){
		// 	$this->db->join('school_master','school_master.id=school_inq.s_id','left');
		// 	$this->db->where_in('status',array("P","IC"));
		// 	$this->db->where('school_master.caller_id',$this->session->userdata('user_login'));
		// }else{
		// 	$this->db->where_in('status',array("V",'D'));
		// 	// $this->db->where_in('school_inq.status',array("V",'D',"IC","P"));
		// }
		// $this->db->where('expected_date',$date);
		// $data = $this->db->get('school_inq');
		// $arr['scl_today'] = $data->num_rows(); 

		
		// if($this->session->userdata('user_role')==8){
		// 	$this->db->join('school_master','school_master.id=school_inq.s_id','left');
		// 	$this->db->where_in('status',array("P","IC"));
		// 	$this->db->where('school_master.caller_id',$this->session->userdata('user_login'));
		// }else{
		// 	$this->db->where_in('status',array("V",'D'));
		// 	//$this->db->where_in('school_inq.status',array("V",'D',"IC","P"));
		// }
		// $this->db->where('expected_date < ',$date);
		// //$this->db->where('expected_date >','2022-10-31');
		// //$this->db->join('admin','admin.id=school_inq.inq_by');
		// $data = $this->db->get('school_inq');
		// $arr['scl_due'] = $data->num_rows(); 

		if($this->session->userdata('user_role')==8){
			$this->db->select('school_master.*,(SELECT COUNT(id) FROM school_inq WHERE school_inq.s_id=school_master.id) AS total_count');
			$this->db->where('caller_id',$this->session->userdata('user_login'));
			$arr['school_data'] = $this->db->get('school_master')->result_array();

			$this->db->select('COUNT(id) AS total_count');
			$this->db->where('followup_by',$this->session->userdata('user_login'));
			$this->db->like('followup_date',date('Y-m-d'));
			$today_call = $this->db->get('school_call_followup')->row_array();

			$arr['today_call'] = isset($today_call['total_count']) ? $today_call['total_count'] :0;
		}
		$this->load->view('dashboard',$arr);
	}

	public function inq_rpt(){

		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM tbl_dipak WHERE payment_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['month_inq'] =  @$record['total_amount'] ? $record['total_amount'] :0;


		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['today_collection_cash'] =  @$record['total_amount'] ? $record['total_amount'] :0; 

		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode!='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['today_collection_online'] = @$record['total_amount'] ? $record['total_amount'] :0; 
		$arr['course_total'] = $arr['today_collection_online']+$arr['today_collection_cash'];
		$this->load->view('inq_temp',$arr);
	}

	public function overview()
	{

		$cur_year = date("Y");
		$cur_month = date("m");
		$cur_date = date("d");

		$date = date('Y-m-d'); 
		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['cnt'] = $data->num_rows(); 


		//$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('YEAR(followup_date)',$cur_year);
		$this->db->where('MONTH(followup_date)',$cur_month);
		$this->db->where('day(followup_date)',$cur_date);
		$data = $this->db->get('followup');
		$arr['cnt1'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('demo_date <',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['due_inq'] = $data->num_rows(); 

		$this->db->where('expected_date',$date);
		// $this->db->where('status',"V");
		$this->db->where_in('school_inq.status',array("V",'D'));
		$data = $this->db->get('school_inq');
		$arr['scl_today'] = $data->num_rows(); 

		
		$this->db->where('expected_date < ',$date);
		// $this->db->where('school_inq.status',"V");
		$this->db->where_in('school_inq.status',array("V",'D'));
		$this->db->join('admin','admin.id=school_inq.inq_by');
		$data = $this->db->get('school_inq');
		$arr['scl_due'] = $data->num_rows();

			

		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['today_collection_cash'] =  @$record['total_amount'] ? $record['total_amount'] :0; 

		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode!='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();


		$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,DATE(join_date) as today_date FROM admission WHERE DATE(`join_date`) = CURDATE() GROUP BY CURDATE()"); 
		$today_course_adm = $query1->row_array();
		$arr['today_course_adm'] = $today_course_adm;

		$this->load->view('dashboard_inner',$arr);
	}

}

?>