<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schoolinq extends CI_Controller {
	var $perpage=50;
	var $role =0;
	var $login_user =0;
	function __construct()
	{
		parent::__construct();	
		$this->role = $this->session->userdata('user_role');
		$this->login_user = $this->session->userdata('user_login');
		// $this->load->model('Inquiry_model');
		$this->load->model('Schoolinq_model');
		if(!$this->login_user){
			redirect('staff-login');
		}	
	}
	function import_school(){
		$data = array();
		if($this->input->post()){
			$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)){
				$arr_file = explode('.', $_FILES['upload_file']['name']);
				$extension = end($arr_file);
				if('csv' == $extension){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
				$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				foreach($sheetData as $key=>$row){
					if($key>0){
						//pre($row);	
						$school_name =strtoupper($row[1]);
						$arr = array('school_name'=>$school_name);
						$this->db->insert('school_master',$arr);
					}
				}
				$data['msg'] = $_FILES['upload_file']['name']." Imported Successfully.";
			}
		}
		$this->load->view('school_import',$data);
	}
	function import_school_inq(){
		$data = array();
		if($this->input->post()){
			$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)){
				$arr_file = explode('.', $_FILES['upload_file']['name']);
				$extension = end($arr_file);
				if('csv' == $extension){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
				$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
				#pre($spreadsheet);die;
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				foreach($sheetData as $key=>$row){
					if($key>1){
						//pre($row);	die;
						$student_name = strtoupper($row[1]);
						$standard = $row[2];
						$contact1 = $row[3];
						$contact2 = $row[4];
						$sid = $row[5];
						$status='P';
          				$inq_year=2023;
						if($contact1=="" && $contact2==""){
							continue;
						}
          				if($contact1=="" || $contact1=="-" ||$contact1=="*"||$contact1=="0" ){
          					$contact1 = $contact2;
          				}
						if($contact2=="" || $contact2=="-" ||$contact2=="*"||$contact2=="0" ){
							$contact2= $contact1;
						}
						$arr = array('s_name'=>$student_name,'contact1'=>$contact1,'contact2'=>$contact2,'s_id'=>$sid,'standard'=>$standard,'status'=>$status,'inq_year'=>$inq_year);
						//pre($arr);	die;
						$this->db->insert('school_inq',$arr);
					}
				}
				$data['msg'] = $_FILES['upload_file']['name']." Imported Successfully.";
				//echo "<pre>";
				//print_r($sheetData);
				//die;
			}
		}
		$this->load->view('school_inq_import',$data);
	}
	public function add_school($id=0)
	{
		$this->db->where('id',$id);
		$data['info'] = $this->db->get('school_master')->row_array();
		$this->db->where('role','8');
		$data['fac_data'] = $this->db->get('admin')->result_array();
		if($this->input->post())
		{
			$name = $this->input->post('school_name');
			$caller_id = $this->input->post('caller_id');


			$arr = array('school_name'=>$name,'caller_id'=>$caller_id);

			if($id>0)
			{
				$this->db->where('id',$id);
				$this->db->update('school_master',$arr);
			}
			else
			{
				$this->db->insert('school_master',$arr);
			}
			redirect('schoolinq/view_school');
		}
		
		
		$this->load->view('add_school',$data);
	}

	function view_school()
	{
		$start=$this->uri->segment(3);
		$qry=$this->db->get('school_master');
		$total=$qry->num_rows();
		$base_url = site_url('schoolinq/ajax_search_school');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$data['pagination'] =$pagination;
		$data['perpage'] = $this->perpage;
		$data['found_results'] = $total;
		$this->db->order_by('school_name','asc');
		$this->db->limit($this->perpage,$start);
		$this->db->select('school_master.*,(SELECT COUNT(id) FROM school_inq WHERE school_inq.s_id=school_master.id) AS total_count');
		$data['arr']=$this->db->get('school_master')->result_array();	
		//pre($data);die;
		$this->load->view('view_school',$data);
	}
	function ajax_search_school(){
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$search_keyword = $this->input->post('search_keyword');
		if($search_keyword != ''){
			$this->db->like('school_name',$search_keyword);
		}
		$this->db->select('school_master.*,(SELECT COUNT(id) FROM school_inq WHERE school_inq.s_id=school_master.id) AS total_count');
		$this->db->order_by('school_name','asc');
		$total = $this->db->count_all_results('school_master', FALSE);
		$this->db->limit($perpage,$start);
		$data = $this->db->get();
		$arr['arr'] = $data->result_array();
		$base_url = site_url('schoolinq/ajax_search_school');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_search_school',$arr,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}
	function delete_data($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('school_master');
		redirect('schoolinq/view_school');
	}

	function export_inquiries(){
		$this->load->library('exportexcel');
		$this->db->select('school_inq.*,school_master.school_name');
		$this->db->join('school_master','school_master.id=school_inq.s_id');
		$qry =$this->db->get('school_inq');
		$getdata = $qry->result();
		$fields = $qry->list_fields();
		//$fields = $this->db->list_fields('school_inq');
		$this->exportexcel->export_data($fields,$getdata);
	}

	public function add_school_inquiry($id='')
	{
		

		$data = array();
		$data['school_data'] = $this->db->get('school_master')->result_array();
		$this->db->where_in('role',array(1,3,4,7));
		$this->db->where_in('status',1);
		$data['faculties'] = $this->db->get('admin')->result_array();
		if($id>0){
			$this->db->where('id',$id);
			$data['update_data'] = $this->db->get('school_inq')->row_array();
		}

		if($this->input->post())
		{
			$name = strtoupper($this->input->post('name'));
			$contact1 = $this->input->post('contact1');
			$contact2 = $this->input->post('contact2');
			$contact3 = $this->input->post('contact3');
			$school = $this->input->post('school');
			$course = $this->input->post('course');
			$extra_info = strtoupper($this->input->post('extra_info'));
			$reference = strtoupper($this->input->post('reference'));
			$reference_name = strtoupper($this->input->post('reference_name'));
			$enq_by = $this->input->post('enq_by');
			$added_by = $this->input->post('added_by');
			$status = $this->input->post('status');
			$extra_info = strtoupper($this->input->post('extra_info'));
			$expected_join_date = $this->input->post('demo_date');
			$visit_date = $this->input->post('visit_date');
			$branch_id = $this->input->post('branch_id');

			$inq_year = date("Y");
			$arr = array('s_name'=>$name,'contact1'=>$contact1,'contact2'=>$contact2,'contact3'=>$contact3,'s_id'=>$school,'status'=>$status,'inq_by'=>$enq_by,'inq_year'=>$inq_year,'course'=>$course,'extra_info'=>$extra_info,'reference'=>$reference,'reference_name'=>$reference_name,'expected_date'=>$expected_join_date,'visit_date'=>$visit_date,'added_by'=>$added_by,'branch_id'=>$branch_id);
			if($id>0)
			{
				$up_arr = array('s_name'=>$name,'contact1'=>$contact1,'contact2'=>$contact2,'contact3'=>$contact3,'s_id'=>$school,'status'=>$status,'inq_by'=>$enq_by,'inq_year'=>$inq_year,'course'=>$course,'extra_info'=>$extra_info,'reference'=>$reference,'reference_name'=>$reference_name,'expected_date'=>$expected_join_date,'visit_date'=>$visit_date,'added_by'=>$added_by,'branch_id'=>$branch_id);
					$this->db->where('id',$id);
					$this->db->update('school_inq',$up_arr);
					redirect('schoolinq/view_school_inquiry');
			}
			else
			{

				$this->db->insert('school_inq',$arr);
				$inquiry_id = $this->db->insert_id();
				$arr1 = array('inquiry_id'=>$inquiry_id,'followup_reason'=>$extra_info,'followup_by'=>$enq_by);
				$this->db->insert('school_followup',$arr1);
				SMSSend($contact1,'Thank you for interest with Creative Multimedia.Visit Again.');
			}
		}
		$data['branches'] = $this->db->get('branches')->result_array();
		$this->load->view('add_school_inquiry',$data);	
	}

	function view_school_inquiry()
	{
		$start=$this->uri->segment(3);
		
		if($this->role==8){
			$this->db->where('school_master.caller_id',$this->login_user);
			$this->db->where_not_in('school_inq.status',array('A','V'));
			$this->db->join('school_master','school_master.id=school_inq.s_id','left');
		}
		$qry=$this->db->get('school_inq');
		$total=$qry->num_rows();

		// $total=$this->Inquiry_model->row_count();
		$base_url = site_url('schoolinq/search_school_inquiry');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$data['pagination'] =$pagination;
		$data['perpage'] = $this->perpage;
		$data['found_results'] = $total;
		if($this->role==8){
			$this->db->where_not_in('school_inq.status',array('A','V'));
			$this->db->where('school_master.caller_id',$this->login_user);
		}
		$this->db->order_by('visit_date','desc');
		$this->db->limit($this->perpage,$start);
		$this->db->select('school_inq.*,school_master.school_name,admin.name as added_by_name');
		$this->db->join('school_master','school_master.id=school_inq.s_id','left');
		$this->db->join('admin','admin.id=school_inq.added_by','left');
		$data['arr']=$this->db->get('school_inq')->result_array();	
		$data['faculties'] = $this->db->get('admin')->result_array();
		$this->db->order_by('school_name','asc');

		if($this->role==8){
			$this->db->where('school_master.caller_id',$this->login_user);
		}
		$data['school_data'] = $this->db->get('school_master')->result_array();

		$this->load->view('view_college_inquiry',$data);
	}

	function search_school_inquiry(){
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$course_status = $this->input->post('course_status');
		$faculties = $this->input->post('faculties');
		$course = $this->input->post('course');
		$month = $this->input->post('month');
		$inq_type = $this->input->post('inq_type');
		$school_name = $this->input->post('school_name');
		$date = date('Y-m-d'); 
		if($search_by=='byno' && $search_keyword != '')
		{
			$this->db->where('school_inq.id',$search_keyword);
		}
		if($search_by=='byname' && $search_keyword != '')
		{
			$this->db->like('s_name',$search_keyword);
		}
		if($search_by=='bycontact'  && $search_keyword != '')	
		{
			$this->db->group_start();
			$this->db->like('contact1',$search_keyword);
			$this->db->or_like('contact2',$search_keyword);
			$this->db->or_like('contact3',$search_keyword);
			$this->db->group_end();
		}
		if($course_status!="")
		{
			$this->db->where('school_inq.status',$course_status);
		}	
		
		if($month != ""){
			$this->db->where("YEAR(created_at) = '" . date("Y",strtotime($month)) . "' and MONTH(created_at) = '" . date("m",strtotime($month)) . "'");
		}
		
		if(!empty($faculties))
		{
			$this->db->group_start();
			foreach($faculties as $fac){
				$this->db->or_where('inq_by',$fac);
			}
			$this->db->group_end();
		}
		if($school_name != '')
		{
			$this->db->where('s_id',$school_name);
		}
		if($this->role==8){
			//$this->db->where_not_in('school_inq.status',array('A','V'));
			if($inq_type  == "today"){
				$this->db->where('expected_date ',$date);
			}else if($inq_type  == "due"){
				$this->db->where('expected_date < ',$date);
			}
			$this->db->where_in('school_inq.status',array('P','IC'));
			$this->db->where('school_master.caller_id',$this->login_user);
		}else{
			if($inq_type  == "today"){
				
				$this->db->where('expected_date ',$date);
				$this->db->where_in('school_inq.status',array('V','D'));
				//$this->db->where_in('school_inq.status',array('V','D',"IC","P"));
			}else if($inq_type == "due"){
				
				$this->db->where_in('school_inq.status',array('V','D'));
				//$this->db->where_in('school_inq.status',array('V','D',"IC","P"));
				$this->db->where('expected_date < ',$date);
			}
		}
		$this->db->select('school_inq.*,school_master.school_name,admin.name as added_by_name');
		$this->db->join('school_master','school_master.id=school_inq.s_id','left');
		$this->db->join('admin','admin.id=school_inq.added_by','left');
		$this->db->order_by('school_inq.visit_date','desc');
		$total = $this->db->count_all_results('school_inq', FALSE);
		$this->db->limit($perpage,$start);
		$data = $this->db->get();
		//echo $this->db->last_query();die;
		$arr['arr'] = $data->result_array();
		
		$base_url = site_url('schoolinq/search_school_inquiry');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_school_inquiry',$arr,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}

	function today_followup($id)
	{
		$start=$this->uri->segment(3);
		$date = date('Y-m-d'); 
		if($this->role==8){
			$this->db->where_not_in('school_inq.status',array('A','V'));
			$this->db->where('school_master.caller_id',$this->login_user);
		}else{
			$this->db->where_in('school_inq.status',array('V','D'));	
			//$this->db->where_in('school_inq.status',array('V','D',"IC","P"));
		}
		$this->db->select('school_inq.*,admin.name as added_by_name,school_master.school_name');
		$this->db->where('expected_date',$date);
		$this->db->join('admin','admin.id=school_inq.added_by','left');
		$this->db->join('school_master','school_master.id=school_inq.s_id','left');
		$this->db->order_by('school_inq.expected_date','desc');
		$total = $this->db->count_all_results('school_inq', FALSE);
		$data['arr'] = $this->db->get()->result_array();

		$base_url = site_url('schoolinq/search_school_inquiry');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$data['pagination'] =$pagination;
		$data['perpage'] = $this->perpage;
		$data['found_results'] = $total;
		$data['type'] = "today";
		$data['faculties'] = $this->db->get('admin')->result_array();
		$this->db->order_by('school_name','asc');
		if($this->role==8){
			$this->db->where('school_master.caller_id',$this->login_user);
		}
		$data['school_data'] = $this->db->get('school_master')->result_array();
		$this->load->view('view_college_inquiry',$data);
	}
	function due_followup($id)
	{
		$start=$this->uri->segment(3);
		$date = date('Y-m-d'); 
		if($this->role==8){
			$this->db->where_in('school_inq.status',array('IC','P'));
			$this->db->where('school_master.caller_id',$this->login_user);
		}else{
			$this->db->where_in('school_inq.status',array('V','D'));	
			//$this->db->where_in('school_inq.status',array('V','D',"IC","P"));
		}
		
		$this->db->select('school_inq.*,admin.name as added_by_name,school_master.school_name');
		$this->db->where('expected_date <',$date);
		//$this->db->where('expected_date >','2022-10-31');
		$this->db->order_by('school_inq.expected_date','desc');
		$this->db->join('admin','admin.id=school_inq.added_by','left');
		$this->db->join('school_master','school_master.id=school_inq.s_id','left');
		$total = $this->db->count_all_results('school_inq', FALSE);
		$start=$this->uri->segment(3);
		$this->db->limit($this->perpage,$start);
		$data['arr'] = $this->db->get()->result_array();
		// echo last_query();die;
		$base_url = site_url('schoolinq/search_school_inquiry');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$data['pagination'] =$pagination;
		$data['perpage'] = $this->perpage;
		$data['found_results'] = $total;
		$data['type'] = "due";
		$data['faculties'] = $this->db->get('admin')->result_array();
		$this->db->order_by('school_name','asc');
		if($this->role==8){
			$this->db->where('school_master.caller_id',$this->login_user);
		}
		$data['school_data'] = $this->db->get('school_master')->result_array();
		$this->load->view('view_college_inquiry',$data);
	}

	function add_followup_data($id)
	{

		$this->db->where('id',$id);
		$arr['inquiry_data'] = $this->db->get('school_inq')->row_array();
		$arr['faculties'] = $this->db->get('admin')->result_array();
		$arr['fo_id'] = $id;


		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;
			$followup_reason = $this->input->post('followup_reason');
			$followup_by = $this->input->post('followup_by');
			$next_date = $this->input->post('next_date');
			$status = $this->input->post('status');
			$arr1 = array('inquiry_id'=>$id,'followup_reason'=>$followup_reason,'followup_by'=>$followup_by);
			$this->db->insert('school_followup',$arr1);
			$this->db->where('id',$id);
			$this->db->update('school_inq',array('expected_date'=>$next_date,'status'=>$status));
			redirect('schoolinq/view_college_followup/'.$id);
		}

		$this->load->view('add_college_followup',$arr);
	}


	function add_telecaller_followup($id=0)
	{

		$this->db->where('id',$id);
		$arr['inquiry_data'] = $this->db->get('school_inq')->row_array();
		$arr['faculties'] = $this->db->get('admin')->result_array();
		$arr['fo_id'] = $id;

		$user_id =  $this->login_user;
		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;
			$followup_reason = $this->input->post('followup_reason');
			$followup_by = $this->input->post('followup_by');
			$next_date = $this->input->post('next_date');
			$status = $this->input->post('status');
			$arr1 = array('inquiry_id'=>$id,'followup_reason'=>$followup_reason,'followup_by'=>$user_id);
			$this->db->insert('school_call_followup',$arr1);
			$this->db->where('id',$id);
			$this->db->update('school_inq',array('expected_date'=>$next_date,'status'=>$status));
			redirect('schoolinq/view_call_followup/'.$id);
		}

		$this->load->view('add_telecaller_followup',$arr);
	}

	function view_call_followup($id)
	{
		$arr['fo_id'] = $id;
		$this->db->select('f.*,iof.s_name,iof.contact1,iof.course,a.name as inq_by_name');
		$this->db->where('f.inquiry_id',$id);
		$this->db->join('school_inq iof','iof.id=f.inquiry_id','left');
		$this->db->join('admin a','a.id=f.followup_by','left');
		$this->db->order_by('f.id','desc');
		$arr['follow'] = $this->db->get('school_call_followup f')->result_array();
		$this->load->view('view_telecaller_followup.php',$arr);
	}

	function view_college_followup($id)
	{
		$arr['fo_id'] = $id;
		$this->db->select('f.*,iof.s_name,iof.contact1,iof.course,a.name as inq_by_name');
		$this->db->where('f.inquiry_id',$id);
		$this->db->join('school_inq iof','iof.id=f.inquiry_id','left');
		$this->db->join('admin a','a.id=f.followup_by','left');
		$this->db->order_by('f.id','desc');
		$arr['follow_before'] = $this->db->get('school_call_followup f')->result_array();

		$this->db->select('f.*,iof.s_name,iof.contact1,iof.course,a.name as inq_by_name');
		$this->db->where('f.inquiry_id',$id);
		$this->db->join('school_inq iof','iof.id=f.inquiry_id','left');
		$this->db->join('admin a','a.id=f.followup_by','left');
		$this->db->order_by('f.id','desc');
		$arr['follow'] = $this->db->get('school_followup f')->result_array();
		$this->load->view('view_school_followup.php',$arr);
	}


	public function scholl_inq_report($value='')
	{
		$fac_arr = RECP_IDS;
		$status_arr = array("A","D","V","DC","P","T");

		/* monthwise */

		$report = array();
		$start_month = 1;
		$cur_year = date('Y');
		$inq_data =array();
		$inq_fac_data =array();
		for($i=$cur_year;$i>=2022;$i--){
			$temp = array();
			$temp1 = array();
			// $inq_data=array();
			if($i<$cur_year){
				$last_month = 12;
			}else{
				$last_month = date('m');
			}

			for($j=$last_month;$j>=$start_month;$j--){

				$query =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(visit_date) as month_name,YEAR(visit_date) as inq_year FROM school_inq WHERE YEAR(visit_date) = '" . $i . "' and MONTH(visit_date) = '" . $j . "'  GROUP BY YEAR(visit_date),MONTH(visit_date)");
				$total_record = $query->row_array();
				//echo last_query();die;
				if(empty($total_record)){
					$total_record = array(
						'month_name' =>date('M',strtotime($i.'-'.$j.'-01')),
						'total_count'=>0,
						'inq_year'=>$i
					);
				}


/* MonthWise Report */

				$query_pending =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(visit_date) as month_name,YEAR(visit_date) as inq_year FROM school_inq WHERE YEAR(visit_date) = '" . $i . "' and MONTH(visit_date) = '" . $j . "'  and status='P' GROUP BY YEAR(visit_date),MONTH(visit_date)");
				$pending_record = $query_pending->row_array();


				$query_visited =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(visit_date) as month_name,YEAR(visit_date) as inq_year FROM school_inq WHERE YEAR(visit_date) = '" . $i . "' and MONTH(visit_date) = '" . $j . "'  and status='V' GROUP BY YEAR(visit_date),MONTH(visit_date)");
				$visited_record = $query_visited->row_array();


				$query_demo =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(visit_date) as month_name,YEAR(visit_date) as inq_year FROM school_inq WHERE YEAR(visit_date) = '" . $i . "' and MONTH(visit_date) = '" . $j . "'  and status='D' GROUP BY YEAR(visit_date),MONTH(visit_date)");
				$demo_record = $query_demo->row_array();

				$query_dc =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(visit_date) as month_name,YEAR(visit_date) as inq_year FROM school_inq WHERE YEAR(visit_date) = '" . $i . "' and MONTH(visit_date) = '" . $j . "'  and status='DC' GROUP BY YEAR(visit_date),MONTH(visit_date)");
				$dc_record = $query_dc->row_array();

				$query_admission =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(visit_date) as month_name,YEAR(visit_date) as inq_year FROM school_inq WHERE YEAR(visit_date) = '" . $i . "' and MONTH(visit_date) = '" . $j . "'  and status='A' GROUP BY YEAR(visit_date),MONTH(visit_date)");
				$admission_record = $query_admission->row_array();


/* faculatywise data */

				$arr=array();
				foreach ($fac_arr as $key => $value) {

					$qry_info = $this->getdata($value,$i,$j);
					if(!empty($qry_info)){
						$arr[$value] = $qry_info;	
					}else{
						$arr[$value] = array(
							'total_count'=>0,
							'month_name'=>'Static',
							'inq_year'=>$i
						);	
					}
					
					foreach ($status_arr as $key => $value1) 
					{
						$status_data = $this->getdata_status($value,$i,$j,$value1);
						if(!empty( $status_data)){
							$arr[$value][$value1] = $status_data;
						}else{
							$arr[$value][$value1]=array(
								'total_count'=>0,
								'month_name'=>'Static',
								'inq_year'=>$i
							);
						}
						
					}
					
				}
				

				$total_record['pending']=isset($pending_record['total_count']) ? $pending_record['total_count'] : 0;
				$total_record['visited']=isset($visited_record['total_count']) ? $visited_record['total_count'] : 0;
				$total_record['declined']=isset($dc_record['total_count']) ? $dc_record['total_count'] : 0;
				$total_record['demo']=isset($demo_record['total_count']) ? $demo_record['total_count'] : 0;
				$total_record['admission']=isset($admission_record['total_count']) ? $admission_record['total_count'] : 0;

				$temp[$j] = $total_record;
				$temp1[$j] = $arr;

			}

			$inq_data[$i] = $temp;
			$inq_fac_data[$i]=$temp1;
		}
		//pre($inq_fac_data);die;
		$data['summary'] = $inq_data;

		$data['summary1'] = $inq_fac_data;

		// pre($data);die();

		
			$this->load->view('school_inquiry_report',$data);
	}

	public function getdata($id=0,$i=0,$j=0)
	{	
			$query_ekta =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(visit_date) as month_name,YEAR(visit_date) as inq_year FROM school_inq WHERE YEAR(visit_date) = '" . $i . "' and MONTH(visit_date) = '" . $j . "'  and inq_by='$id' GROUP BY YEAR(visit_date),MONTH(visit_date)");
			return $query_ekta->row_array();

	}

	public function getdata_status($id=0,$i=0,$j=0,$status='')
	{
			$query_ekta =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(visit_date) as month_name,YEAR(visit_date) as inq_year FROM school_inq WHERE YEAR(visit_date) = '" . $i . "' and MONTH(visit_date) = '" . $j . "'  and inq_by='$id' and status='$status' GROUP BY YEAR(visit_date),MONTH(visit_date)");
			// echo last_query();die;
			return $query_ekta->row_array();

	}
	function transfer_data(){
		$this->db->where('s_id >',26);
		//$this->db->where_not_in('s_id',array(91,95,96,97));
		$this->db->order_by('created_at','asc');
		$data = $this->db->get('school_inq')->result_array();
		//echo count($data);die;
		foreach($data as $row){
			$this->db->order_by('id','asc');
			$followup_info = $this->db->get_where('school_followup',array('inquiry_id'=>$row['id']))->result_array();
			//echo last_query();
			//pre($followup_info);die();
			if($row['status']=="IC" ||$row['status']=="V"){
				$status = "P";
			}else{
				$status = $row['status'];
			}
			$arr = array(
				'name'=>$row['s_name'],
				'contact'=>$row['contact1'],
				'parent_contact'=>$row['contact2'],
				'course'=>$row['course'],
				'course_content'=>$row['course'],
				'reference'=>$row['reference'],
				'reference_name'=>$row['reference_name'],
				'demo_date'=>$row['expected_date'],
				'extra_information'=>$row['extra_info'],
				'inquiry_by'=>$row['inq_by'],
				'added_by'=>$row['added_by'],
				'branch_id'=>1,
				'status'=>$status,
				'inquiry_time'=>$row['created_at']
			);
			$this->db->insert('inq_offline',$arr);
			$inq_no = $this->db->insert_id();
			if(!empty($followup_info)){
				foreach($followup_info as $follow){
					$a = array(
						'inquiry_id'=>$inq_no,
						'followup_reason'=>$follow['followup_reason'],
						'followup_by'=>$follow['followup_by'],
						'followup_date'=>$follow['followup_date']
					);
					$this->db->insert('followup',$a);
				}
			}
			
			$this->db->where('inquiry_id',$row['id']);
			$this->db->delete('school_followup');

			$this->db->where('id',$row['id']);
			$this->db->delete('school_inq');
			//die;
		}
	}


	function telecaller_report()
	{
		$cur_year = date('Y');
		$cur_month = date('m');
		$cur_date = date('d');
		$telecaller_repo = array();
		$telecaller = array();
		$maxDays=date('t');
		$currentDayOfMonth=date('j');
		

		$query_faculty = $this->db->query("SELECT admin.name,admin.id FROM admin WHERE role='8'");
		$telecall_name = $query_faculty->result_array();

		for($m=$cur_month;$m<=$cur_month;$m++)
		{
			$telecaller_date = array();

			if($m<$cur_month)
			{
				$cur_date = cal_days_in_month(CAL_GREGORIAN, $m, $cur_year);
			}
			else
			{
				$cur_date = date('d');
			}

			for ($d=$cur_date; $d>=1 ; $d--) { 

				$arr = array();
					foreach ($telecall_name as $key => $value) {

						$id = $value['id'];
						$name = $value['name'];
				
				$query_report =  $this->db->query("SELECT admin.name , COUNT(school_call_followup.followup_by) AS total_count FROM admin  JOIN school_call_followup ON admin.id=school_call_followup.followup_by and admin.role= '8' AND YEAR(school_call_followup.followup_date)='$cur_year' and MONTH(school_call_followup.followup_date) = '$m' and DAY(school_call_followup.followup_date)='$d' AND school_call_followup.followup_by = '$id' ");
				$call_repo = $query_report->result_array();

				$arr[$name] = $call_repo;

				}

				$telecaller_date[$d.'-'.$m.'-'.$cur_year] = $arr;
			}

			$telecaller_repo[$m.'_'.$cur_year] = $telecaller_date;
		}

		$telecaller['tele_repo'] = $telecaller_repo;

		$this->load->view('telecaller_report',$telecaller);
	}


	function old_tele_report($data_month="")
	{
		$exp = explode('_',$data_month);
		$m = $exp[1];
		$y = $exp[0];
		$start_d = $y.'-'.$m.'-01';
		$lastdate = date("t", strtotime($start_d ));
		$telecaller_repo = array();
		$telecaller = array();

		$query_faculty = $this->db->query("SELECT admin.name,admin.id FROM admin WHERE role='8'");
		$telecall_name = $query_faculty->result_array();

			$telecaller_date = array();

			for ($d=1; $d<=$lastdate ; $d++) { 

				$arr = array();
					foreach ($telecall_name as $key => $value) {

						$id = $value['id'];
						$name = $value['name'];
				
				$query_report =  $this->db->query("SELECT admin.name , COUNT(school_call_followup.followup_by) AS total_count FROM admin  JOIN school_call_followup ON admin.id=school_call_followup.followup_by and admin.role= '8' AND YEAR(school_call_followup.followup_date)='$y' and MONTH(school_call_followup.followup_date) = '$m' and DAY(school_call_followup.followup_date)='$d' AND school_call_followup.followup_by = '$id' ");
				$call_repo = $query_report->result_array();

				$arr[$name] = $call_repo;

				}

				$telecaller_date[$d.'-'.$m.'-'.$y] = $arr;
			}

			$telecaller_repo[$m.'_'.$y] = $telecaller_date;

		$telecaller['tele_repo'] = $telecaller_repo;

		$this->load->view('telecaller_report',$telecaller);

	}
}
?>