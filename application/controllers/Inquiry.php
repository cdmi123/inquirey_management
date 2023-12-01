<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inquiry extends CI_Controller {
	var $perpage=50;
	function __construct()
	{
		parent::__construct();	
		$this->load->model('Inquiry_model');
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}	
	}
	public function index($id=0)
	{
		$course['course_data'] = $this->db->get('inq_courses')->result_array();

		// $this->db->where_in('id',INQ_IDS);
		$this->db->where_in('status',1);

		$course['faculties'] = $this->db->get('admin')->result_array();

		$course['branches'] = $this->db->get('branches')->result_array();

		if($id>0){
			
			$this->db->where('id',$id);
			$course['update_data'] = $this->db->get('inq_offline')->row_array();
		}
		if($this->input->post())
		{
			$name = strtoupper($this->input->post('name'));
			$contact = $this->input->post('contact');
			$parent_contact = $this->input->post('parent_contact');
			$course = strtoupper($this->input->post('course'));
			if(substr($course, -2) ==", "){
				$course = substr($course, 0,strlen($course)-2);
			}
			//echo $course[-2];
			//echo $course;die;
			$course_content = strtoupper($this->input->post('course_content'));
			$reference = strtoupper($this->input->post('reference'));
			$batch_time = $this->input->post('batch_time');
			$demo_date = $this->input->post('demo_date');
			$fees = $this->input->post('fees');
			$enq_by = $this->input->post('enq_by');
			$added_by = $this->input->post('added_by');
			$status = $this->input->post('status');
			$extra_info = strtoupper($this->input->post('extra_info'));
			$inq_details = strtoupper($this->input->post('inq_details'));
			$reference_name = strtoupper($this->input->post('reference_name'));
			$branch_id = $this->input->post('branch_id');
			$arr = array('name'=>$name,'contact'=>$contact,'parent_contact'=>$parent_contact,'course'=>$course,'course_content'=>$course_content,'reference'=>$reference,'reference_name'=>$reference_name,'batch_time'=>$batch_time,'demo_date'=>$demo_date,'extra_information'=>$extra_info,'inq_details'=>$inq_details,'fees'=>$fees,'inquiry_by'=>$enq_by,'added_by'=>$added_by,'status'=>$status,'branch_id'=>$branch_id);

			if($id>0)
			{

				$up_arr = array('name'=>$name,'contact'=>$contact,'parent_contact'=>$parent_contact,'course'=>$course,'course_content'=>$course_content,'reference'=>$reference,'reference_name'=>$reference_name,'batch_time'=>$batch_time,'demo_date'=>$demo_date,'extra_information'=>$extra_info,'inq_details'=>$inq_details,'fees'=>$fees,'inquiry_by'=>$enq_by,'added_by'=>$added_by,'status'=>$status,'branch_id'=>$branch_id);
				$this->Inquiry_model->update($id,$up_arr);	
			}
			else
			{

				$this->Inquiry_model->insert_data($arr);
				$inquiry_id = $this->db->insert_id();
				$arr1 = array('inquiry_id'=>$inquiry_id,'followup_reason'=>$extra_info,'followup_by'=>$enq_by);
				$this->Inquiry_model->followup_data($arr1);
				SMSSend($contact,'Thank you for interest with Creative Multimedia.Visit Again.');
			}
			redirect('inquiry/view_inquiry');
		}
		$this->load->view('add_inquiry',$course);
	}


	function view_inquiry()
	{
		$data['branches1'] = $this->db->get('branches')->result_array();

		$start=$this->uri->segment(3);
		// $this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$total=$this->Inquiry_model->row_count();
		$base_url = site_url('inquiry/search_offline_inquiry');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$data['pagination'] =$pagination;
		$data['perpage'] = $this->perpage;
		$data['found_results'] = $total;
		//$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$data['arr']=$this->Inquiry_model->view_data($this->perpage,$start);
			// echo last_query(); die();	
		$branches = $this->db->get('branches')->result_array();
		$branch_arr = array();
		foreach($branches as $branch){
			$branch_arr[$branch['id']] = $branch['branch'];
		}
		$data['branches'] =$branch_arr; 
		$data['course_data'] = $this->db->get('inq_courses')->result_array();
		$data['type'] = "all";
		// $this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data['faculties'] = $this->db->get('admin')->result_array();



		$this->load->view('view_inquiry',$data);
	}
	function search_offline_inquiry(){
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$course_status = $this->input->post('course_status');
		$faculties = $this->input->post('faculties');
		$course = $this->input->post('course');
		$month = $this->input->post('month');
		$inq_type = $this->input->post('inq_type');
		$branch_id = $this->input->post('branch');

		// print_r($branch_id); die();

		if($search_by=='byno' && $search_keyword != '')
		{
			$this->db->where('inq_offline.id',$search_keyword);
		}
		if($search_by=='byname' && $search_keyword != '')
		{
			$this->db->like('inq_offline.name',$search_keyword);
		}
		if($search_by=='bycontact'  && $search_keyword != '')	
		{
			$this->db->like('inq_offline.contact',$search_keyword);
		}
		if($course_status!="")
		{
			$this->db->where('inq_offline.status',$course_status);
		}	

		// if($branch_id!="")
		// {
		// 	$this->db->where('inq_offline.branch_id',array($branch_id));
		// }	

		if($month != ""){

			$this->db->where("YEAR(inquiry_time) = '" . date("Y",strtotime($month)) . "' and MONTH(inquiry_time) = '" . date("m",strtotime($month)) . "'");
		}
		if($inq_type  == "today"){
			$date = date('Y-m-d'); 
			$this->db->where('demo_date ',$date);
			$this->db->where_in('inq_offline.status',array('P','D'));
		}else if($inq_type == "due"){
			$date = date('Y-m-d'); 
			$this->db->where_in('inq_offline.status',array('P','D'));
			$this->db->where('demo_date < ',$date);
		}
		if(!empty($course))
		{
			$this->db->group_start();
			foreach($course as $cour){
				$this->db->or_like('course',$cour);
			}
			$this->db->group_end();
		}
		if(!empty($faculties))
		{
			$this->db->group_start();
			foreach($faculties as $fac){
				$this->db->or_where('inquiry_by',$fac);
			}
			$this->db->group_end();
		}

		if(!empty($branch_id))
		{
			$this->db->group_start();
			foreach($branch_id as $branch){
				$this->db->or_where('inq_offline.branch_id',$branch);
			}
			$this->db->group_end();
		}

		$this->db->select('inq_offline.*,a.name as added_by_name,b.name as inq_by_name');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		// $this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$this->db->order_by('inquiry_time','desc');
		$total = $this->db->count_all_results('inq_offline', FALSE);
		$this->db->limit($perpage,$start);
		$data = $this->db->get();
		// echo $this->db->last_query();die;
		$arr['arr'] = $data->result_array();
		$branches = $this->db->get('branches')->result_array();
		$branch_arr = array();
		foreach($branches as $branch){
			$branch_arr[$branch['id']] = $branch['branch'];
		}
		$arr['branches'] =$branch_arr; 
		$base_url = site_url('inquiry/search_offline_inquiry');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_offline_inquiry',$arr,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}
	function get_ajax_course(){
		$this->db->like('course_name',$this->input->get('term'));
		$res=$this->db->get('inq_courses')->result_array();
		$rec = array();
		foreach($res as $r){
			$rec[] = $r['course_name'];
		}
		echo json_encode($rec);
	}
	
	function inquiry_update_status(){
		$inqid = $this->input->post('inqid');
		$status = $this->input->post('status');
		$note = $this->input->post('note');
		if($inqid!="" && $inqid!=0){
			$this->db->where('id',$inqid);
			$this->db->update('inq_offline',array('status'=>$status,'status_note'=>$note));	
			echo 'Successfully Changed.';
		}else{
			echo 'Reg No. Missing';
		}
	}

	
	function update_status($inq_id,$status)
	{
		$this->load->model('Inquiry_model');
		$arr = array('status'=>$status);
		$this->Inquiry_model->update($inq_id,$arr);	
		redirect('inquiry/view_inquiry');
	}

	function update_offline_decliened_status($id)
	{
		$arr = array('status'=>2);
		$this->db->where('id',$id);
		$this->db->update('inq_offline',$arr);
		
		redirect('inquiry/view_inquiry');
	}

	 public function userList()
	 {
	 	$this->load->model('Inquiry_model');
    // POST data
    	$postData = $this->input->post();


    // Get data
    		$data = $this->Inquiry_model->getUsers($postData);

    		echo json_encode($data);
  	}

  	function today_followup()
	{
		$start=$this->uri->segment(3);
		$branches = $this->db->get('branches')->result_array();
		$branch_arr = array();
		foreach($branches as $branch){
			$branch_arr[$branch['id']] = $branch['branch'];
		}
		$data['branches'] =$branch_arr; 
		$data['course_data'] = $this->db->get('inq_courses')->result_array();

		$this->load->model('Inquiry_model');
		$date = date('Y-m-d'); 
		$this->db->select('inq_offline.*,a.name as added_by_name,b.name as inq_by_name');
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));

		$total = $this->db->count_all_results('inq_offline', FALSE);
		$this->db->limit($this->perpage,0);
		$data['arr'] = $this->db->get()->result_array();

		$base_url = site_url('inquiry/search_offline_inquiry');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$data['pagination'] =$pagination;
		$data['perpage'] = $this->perpage;
		$data['found_results'] = $total;
		$data['type'] = "today";
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data['faculties'] = $this->db->get('admin')->result_array();
		$this->load->view('view_inquiry',$data);
	}
	function due_followup()
	{
		$start=$this->uri->segment(3);
		$branches = $this->db->get('branches')->result_array();
		$branch_arr = array();
		foreach($branches as $branch){
			$branch_arr[$branch['id']] = $branch['branch'];
		}
		$data['branches'] =$branch_arr; 
		$data['course_data'] = $this->db->get('inq_courses')->result_array();

		$this->load->model('Inquiry_model');
		$date = date('Y-m-d'); 
		$this->db->select('inq_offline.*,a.name as added_by_name,b.name as inq_by_name');
		$this->db->where('demo_date < ',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$total = $this->db->count_all_results('inq_offline', FALSE);
		$this->db->limit($this->perpage,0);
		$data['arr'] = $this->db->get()->result_array();

		$base_url = site_url('inquiry/search_offline_inquiry');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$data['pagination'] =$pagination;
		$data['perpage'] = $this->perpage;
		$data['found_results'] = $total;
		$data['type'] = "due";
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data['faculties'] = $this->db->get('admin')->result_array();
		$this->load->view('view_inquiry',$data);
	}

	

	function update_decliened_status($id)
	{
		$arr = array('status'=>2);
		$this->db->where('id',$id);
		$this->db->update('inq_call',$arr);
		redirect('inquiry/view_call_inquiry');
	}

	function show_pending_inquiry()
	{
				$search_by = "";
		$search_keyword = "";

		if($this->input->post('see_all'))
		{
				$this->session->unset_userdata('search_by');
			$this->session->unset_userdata('search_keyword');			
		}
		if($this->input->post('search'))
		{

			//echo '<pre>';print_r($this->input->post());die;
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
			$this->session->set_userdata('search_by',$search_by);
			$this->session->set_userdata('search_keyword',$search_keyword);
		}else if($this->session->userdata('search_keyword')){
			$search_by = $this->session->userdata('search_by');
			$search_keyword = $this->session->userdata('search_keyword');
		}

		$this->load->model('Inquiry_model');

	    $this->load->library('pagination');
		$perpage=20;
		$start=$this->uri->segment(3);

		$total=$this->Inquiry_model->offline_pending_row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/show_pending_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->Inquiry_model->offline_pending_view_data($perpage,$start,$search_by,$search_keyword);	
		$this->load->view('view_offline_pending_inquiry',$data);
	}


	function show_admission_inquiry()
	{
				$search_by = "";
		$search_keyword = "";

		if($this->input->post('see_all'))
		{
				$this->session->unset_userdata('search_by');
			$this->session->unset_userdata('search_keyword');			
		}
		if($this->input->post('search'))
		{

			//echo '<pre>';print_r($this->input->post());die;
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
			$this->session->set_userdata('search_by',$search_by);
			$this->session->set_userdata('search_keyword',$search_keyword);
		}else if($this->session->userdata('search_keyword')){
			$search_by = $this->session->userdata('search_by');
			$search_keyword = $this->session->userdata('search_keyword');
		}

		$this->load->model('Inquiry_model');

	    $this->load->library('pagination');
		$perpage=20;
		$start=$this->uri->segment(3);

		$total=$this->Inquiry_model->offline_admission_row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/show_admission_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->Inquiry_model->offline_admission_view_data($perpage,$start,$search_by,$search_keyword);	
		$this->load->view('view_offline_admission_inquiry',$data);
	}

	function show_decliened_inquiry()
	{
		$search_by = "";
		$search_keyword = "";

		if($this->input->post('see_all'))
		{
				$this->session->unset_userdata('search_by');
			$this->session->unset_userdata('search_keyword');			
		}
		if($this->input->post('search'))
		{

			//echo '<pre>';print_r($this->input->post());die;
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
			$this->session->set_userdata('search_by',$search_by);
			$this->session->set_userdata('search_keyword',$search_keyword);
		}else if($this->session->userdata('search_keyword')){
			$search_by = $this->session->userdata('search_by');
			$search_keyword = $this->session->userdata('search_keyword');
		}

		$this->load->model('Inquiry_model');

	    $this->load->library('pagination');
		$perpage=20;
		$start=$this->uri->segment(3);

		$total=$this->Inquiry_model->offline_decliened_row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/show_decliened_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->Inquiry_model->offline_decliened_view_data($perpage,$start,$search_by,$search_keyword);	
		$this->load->view('view_offline_decliened_inquiry',$data);
	}


	function view_justdial_pending_inquiry()
	{

		$search_by = "";
		$search_keyword = "";

		if($this->input->post('see_all'))
		{
				$this->session->unset_userdata('search_by');
			$this->session->unset_userdata('search_keyword');			
		}
		if($this->input->post('search'))
		{

			//echo '<pre>';print_r($this->input->post());die;
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
			$this->session->set_userdata('search_by',$search_by);
			$this->session->set_userdata('search_keyword',$search_keyword);
		}else if($this->session->userdata('search_keyword')){
			$search_by = $this->session->userdata('search_by');
			$search_keyword = $this->session->userdata('search_keyword');
		}

		$this->load->model('Inquiry_model');

	    $this->load->library('pagination');
		$perpage=4;
		$start=$this->uri->segment(3);

		$total=$this->Inquiry_model->justdial_row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/view_justdial_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->Inquiry_model->justdial_view_data($perpage,$start,$search_by,$search_keyword);	
		$this->load->view('view_justdial_inquiry',$data);
	}



	function ajax_search_inquiry()
	{
		 $this->load->model('Inquiry_model');
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		//echo '<pre>';print_r($this->input->post());die;
		// $year = $this->input->post('year');
		// $month = $this->input->post('month');
		// $course = $this->input->post('course');
		// @$course_arr = implode(',', $course);
		// $faculty = $this->input->post('faculty');
		// @$faculty_arr =  implode(',', $faculty);
		// $batch_time = $this->input->post('batch_time');
		// @$batch_time_arr =  implode(',', $batch_time);
		$course_status = $this->input->post('course_status');
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');


		if($search_by=='byno' && $search_keyword != '')
		{
			$this->db->where('id',$search_keyword);
		}
		if($search_by=='byname'  && $search_keyword != '')
		{
			$this->db->like('name',$search_keyword);
		}
		if($search_by=='bycontact'  && $search_keyword != '')	
		{
			$this->db->like('contact',$search_keyword);
		}
		
	
		
		if($course_status!='')
		{
			$this->db->where('status',$course_status);
		}
		$this->db->order_by('id','desc');
		$total = $this->db->count_all_results('inq_offline', FALSE);
		 $this->db->limit($perpage,$start);
		$data = $this->db->get();
		$inq['arr'] = $data->result_array();
		//pre($inq['arr']);die;
		$base_url = site_url('inquiry/view_inquiry');
		//echo $this->db->last_query();die;
		 $pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_search_inquiry',$inq,true);
		 echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}

	function ajax_search_online_inquiry()
	{
		 $this->load->model('Inquiry_model');
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		//echo '<pre>';print_r($this->input->post());die;
		// $year = $this->input->post('year');
		// $month = $this->input->post('month');
		// $course = $this->input->post('course');
		// @$course_arr = implode(',', $course);
		// $faculty = $this->input->post('faculty');
		// @$faculty_arr =  implode(',', $faculty);
		// $batch_time = $this->input->post('batch_time');
		// @$batch_time_arr =  implode(',', $batch_time);
		$course_status = $this->input->post('course_status');
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');


		if($search_by=='byno' && $search_keyword != '')
		{
			$this->db->where('id',$search_keyword);
		}
		if($search_by=='byname'  && $search_keyword != '')
		{
			$this->db->like('name',$search_keyword);
		}
		if($search_by=='bycontact'  && $search_keyword != '')	
		{
			$this->db->like('contact',$search_keyword);
		}
		
	
		
		if($course_status!='')
		{
			$this->db->where('status',$course_status);
		}
		$this->db->order_by('id','desc');
		$total = $this->db->count_all_results('inq_online', FALSE);
		 $this->db->limit($perpage,$start);
		$data = $this->db->get();
		$inq['arr'] = $data->result_array();
		//pre($inq['arr']);die;
		$base_url = site_url('inquiry/view_online_inquiry');
		//echo $this->db->last_query();die;
		 $pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_search_online_inquiry',$inq,true);
		 echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}

	function inq_report(){
		//$fac_arr = array(11,10,12,13,16,44,4);
		$status_arr = array("A","D","V","DC","P");
		$branch_id = $this->session->userdata('branch_id');
		$report = array();
		$start_month = 1;
		$cur_year = date('Y');
		$inq_data =array();
		for($i=$cur_year;$i>=START_YEAR;$i--){
			$temp = array();
			if($i<$cur_year){
				$last_month = 12;
			}else{
				$last_month = date('m');
			}
			for($j=$start_month;$j<=$last_month;$j++){
				$query =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(inquiry_time) as month_name,YEAR(inquiry_time) as inq_year FROM inq_offline WHERE YEAR(inquiry_time) = '" . $i . "' and MONTH(inquiry_time) = '" . $j . "' and branch_id = $branch_id GROUP BY YEAR(inquiry_time),MONTH(inquiry_time)");
				$total_record = $query->row_array();
				if(empty($total_record)){
					$total_record = array(
						'month_name' =>date('M',strtotime($i.'-'.$j.'-01')),
						'total_count'=>0,
						'inq_year'=>$i
					);
				}
				$query_done =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(inquiry_time) as month_name,YEAR(inquiry_time) as inq_year FROM inq_offline WHERE YEAR(inquiry_time) = '" . $i . "' and MONTH(inquiry_time) = '" . $j . "' and branch_id = $branch_id and status='A' GROUP BY YEAR(inquiry_time),MONTH(inquiry_time)");
				$done_record = $query_done->row_array();

				$query_declined =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(inquiry_time) as month_name,YEAR(inquiry_time) as inq_year FROM inq_offline WHERE YEAR(inquiry_time) = '" . $i . "' and MONTH(inquiry_time) = '" . $j . "' and branch_id = $branch_id and status='DC' GROUP BY YEAR(inquiry_time),MONTH(inquiry_time)");
				$declined_record = $query_declined->row_array();

				$query_pending =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(inquiry_time) as month_name,YEAR(inquiry_time) as inq_year FROM inq_offline WHERE YEAR(inquiry_time) = '" . $i . "' and MONTH(inquiry_time) = '" . $j . "' and branch_id = $branch_id and status='P' GROUP BY YEAR(inquiry_time),MONTH(inquiry_time)");
				$pending_record = $query_pending->row_array();

				$query_ddc =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(inquiry_time) as month_name,YEAR(inquiry_time) as inq_year FROM inq_offline WHERE YEAR(inquiry_time) = '" . $i . "' and MONTH(inquiry_time) = '" . $j . "' and branch_id = $branch_id and status='DDC' GROUP BY YEAR(inquiry_time),MONTH(inquiry_time)");
				$ddc_record = $query_ddc->row_array();

				$query_trf =  $this->db->query("SELECT COUNT(id) as total_count,MONTHNAME(inquiry_time) as month_name,YEAR(inquiry_time) as inq_year FROM inq_offline WHERE YEAR(inquiry_time) = '" . $i . "' and MONTH(inquiry_time) = '" . $j . "' and branch_id = $branch_id and status='T' GROUP BY YEAR(inquiry_time),MONTH(inquiry_time)");
				$trf_record = $query_trf->row_array();

				$total_record['done']=isset($done_record['total_count']) ? $done_record['total_count'] : 0;
				$total_record['declined']=isset($declined_record['total_count']) ? $declined_record['total_count'] :0;
				$total_record['pending']=isset($pending_record['total_count']) ? $pending_record['total_count']:0;
				$total_record['ddc']=isset($ddc_record['total_count']) ? $ddc_record['total_count'] :0;
				$total_record['trf']=isset($trf_record['total_count']) ? $trf_record['total_count'] :0;
			//	pre($total_record);die;
				$temp[$j] = $total_record;
			}
			$inq_data[$i] = $temp;
			 
			
		}
		$data['summary'] = $inq_data;
		$this->load->view('view_inq_summary',$data);
	}
	function export_inquiries(){
		$this->load->library('exportexcel');
		$getdata =$this->db->get('inq_offline')->result();
		$fields = $this->db->list_fields('inq_offline');
		$this->exportexcel->export_data($fields,$getdata);
	}

	public function faculty_inq_month_report($value='')
	{
		$fac_arr =RECP_IDS;
		$status_arr = array("A","D","V","DC","P","T");
		$branch_id = $this->session->userdata('branch_id');
		$report = array();
		$start_month = 1;
		$cur_year = date('Y');
		$inq_data =array();
		for($i=$cur_year;$i>=START_YEAR;$i--){
			$temp = array();
			$temp1 = array();
			$inq_month=array();
			if($i<$cur_year){
				$last_month = 12;
			}else{
				$last_month = date('m');
			}
			for($j=$last_month;$j>=$start_month;$j--){

				$arr=array();

					foreach ($fac_arr as $key => $value) {

					$qry_info = $this->getdata($value,$i,$j);
					if(!empty($qry_info)){
						$arr[$value] = $qry_info;	
					}else{
						$arr[$value] = array( 'total_count'=>0, );	
					}

					foreach ($status_arr as $key => $value1) 
					{
						$status_data = $this->getdata_status($value,$i,$j,$value1);
						if(!empty( $status_data)){
							$arr[$value][$value1] = $status_data;
						}else{
							$arr[$value][$value1]=array(
								'total_count'=>0,
							);
						}
					}
				}

				$inq_month[$j] = $arr;
			}
			$inq_data[$i] = $inq_month;

		}
		$data['summary'] = $inq_data;
		//pre($data);die();
		$this->load->view('view_fac_inq_summary',$data);
	}

	public function getdata($id=0,$i=0,$j=0)
	{	
			$query_ekta =  $this->db->query("SELECT COUNT(id) as total_count FROM inq_offline WHERE YEAR(inquiry_time) = '" . $i . "' and MONTH(inquiry_time) = '" . $j . "'  and inquiry_by='$id' GROUP BY YEAR(inquiry_time),MONTH(inquiry_time)");
			return $query_ekta->row_array();
	}

	public function getdata_status($id=0,$i=0,$j=0,$status='')
	{
			$query_ekta =  $this->db->query("SELECT COUNT(id) as total_count FROM inq_offline WHERE YEAR(inquiry_time) = '" . $i . "' and MONTH(inquiry_time) = '" . $j . "'  and inquiry_by='$id' and status='$status' GROUP BY YEAR(inquiry_time),MONTH(inquiry_time)");
			// echo last_query();die;
			return $query_ekta->row_array();

	}


	/* school report  */

	public function school_inq_year_report()
	{
		$fac_arr =RECP_IDS;
		$status_arr = array("A","P","D","V","DC","CD","IC","NV","DP");
		$branch_id = $this->session->userdata('branch_id');
		$report = array();
		//$start_month = 1;
		$cur_year = date('Y');
		//$inq_data =array();


			$school_master = $this->db->get("school_master")->result_array();


		for($i=$cur_year;$i>=$cur_year;$i--){

			$temp = array();
			$temp1 = array();

				foreach ($school_master as $key => $value) {

						$arr=array();

					$qry_info = $this->getdata_school($value['id'],$i);
					
					if(!empty($qry_info)){
						$arr[$value['id']] = $qry_info;	
					}else{
						$arr[$value['id']] = array( 'total_count'=>0, );	
					}
					
					foreach ($status_arr as $key1 => $value1) 
					{
						$status_data = $this->getdata_status_school($value['id'],$i,$value1);
						if(!empty( $status_data)){
							$arr[$value['id']][$value1] = $status_data;
						}else{
							$arr[$value['id']][$value1]=array(
								'total_count'=>0,
							);
						}
					}

					$inq_month[$key] = $arr;
				}

			$inq_data["schoolinq_repo"] = $inq_month;
		}

		// pre($inq_data);die();
		
		$this->load->view('view_schoolinq_inq_summary',$inq_data);
	}

	public function getdata_school($id=0,$i=0)
	{	
			$query_ekta =  $this->db->query("SELECT COUNT(id) as total_count FROM school_inq WHERE inq_year = '" . $i . "' and s_id='$id' GROUP BY s_id = '$id'");
			return $query_ekta->row_array();
	}

	public function getdata_status_school($id=0,$i=0,$status='')
	{
			$query_ekta =  $this->db->query("SELECT COUNT(id) as total_count FROM school_inq WHERE inq_year = '" . $i . "' and status='$status' 
				and s_id='$id' GROUP BY inq_year = '" . $i . "'");
			return $query_ekta->row_array();

	}



	/* end school report */
	function update_inquries_table(){
		$this->db->like('course','COLLEGE COURSE');
		$this->db->or_like('course_content','COLLEGE COURSE');
		$qry1 = $this->db->get('inq_offline');
		$rows = $qry1->result_array();
		pre($rows);
		foreach($rows as $row){
			$course_new = str_replace('COLLEGE COURSE','IT-TUTION-COURSE',$row['course']);
			$content_new = str_replace('COLLEGE COURSE','IT-TUTION-COURSE',$row['course_content']);
			$content_new = str_replace('BCA','BCA Internship',$content_new);
			$content_new = str_replace('B.sc.','B.Sc. Internship',$content_new);
			// echo $course_new;
			// echo '<br>';
			// echo $content_new;die;
			$this->db->where('id',$row['id']);
			$this->db->update('inq_offline',array('course'=>$course_new,'course_content'=>$content_new));
		}
	}
}
