<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{
	var $perpage=50;
	function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
	}
	function index($id=0)
	{
		$res=array();
		$res['data1']=$this->Admin_model->get_single_record($id);
		$res['branches'] = $this->db->get('branches')->result_array();

		if($this->input->post('submit'))
		{
			$name=$this->input->post('name');	
			$email=$this->input->post('email');
			$contact=$this->input->post('contact');
			$password=$this->input->post('password');
			$status=$this->input->post('status');
			$role=$this->input->post('role');
			$dept_id=$this->input->post('dept_id');
			$branch_id=$this->input->post('branch_id');
			
			$arr=array('name'=>$name,'email'=>$email,'mobile'=>$contact,'status'=>$status,'role'=>$role,'branch_id'=>$branch_id,'dept_id'=>$dept_id);
			if($password!=""){
				$arr['password']=md5($password);
			}
			$config['allowed_types'] = 'jpg|png|gif';
			$config['upload_path'] = './upload';
			$this->load->library('upload',$config);
			//echo 'test';die;
			if($id > 0 && !empty($_FILES['image']['name'])){
				if($this->upload->do_upload('image')){
					$file_data = $this->upload->data();
					$arr['image'] = $file_data['file_name'];
					$this->Admin_model->update($id,$arr);	
					redirect('admin/view_admin');
				}else{
					$res['file_error']=$this->upload->display_errors();
				}
			}else if($id ==0 && !empty($_FILES['image']['name']) ){
				if($this->upload->do_upload('image')){
					$file_data = $this->upload->data();
					$arr['image'] = $file_data['file_name'];
					$this->Admin_model->insert_data($arr);
					redirect('admin/view_admin');
				}else{
					$res['file_error']=$this->upload->display_errors();
				}
			}else{
				if($id>0)
				{
					$this->Admin_model->update($id,$arr);	
				}
				else
				{
					$arr['image'] = 'user.png';
					$this->Admin_model->insert_data($arr);
				}
				redirect('admin/view_admin');
			}
			
		}
		$this->load->view('add_admin',$res);
		
	}


	function view_admin()
	{
		
		$this->load->model('Admin_model');
		$data['arr']=$this->Admin_model->view_data();
		$this->load->view('view_admin',$data);
	}

	function delete_data($id='')
	{
		$this->load->model('Admin_model');
		$this->Admin_model->delete($id);
	}



	function demo()
	{
		$this->load->model('Admin_model');
		$data['info'] = $this->Admin_model->get_page();
		$this->load->view('demo1',$data);
	}



	function backup_db(){
		$this->load->dbutil();
		$prefs = array(     
		    'format'      => 'zip',             
		    'filename'    => 'management-'.date("Y-m-d-H-i-s").'.sql',
		    'foreign_key_checks'=>FALSE
		);
		$backup =& $this->dbutil->backup($prefs); 
		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'backup/'.$db_name;
		$this->load->helper('file');
		write_file($save, $backup); 
		$this->load->helper('download');
		force_download($db_name, $backup);
	}
	function monthly_report_course(){
		$output = [];
		for($i=date("Y");$i>=START_YEAR;$i--){
			$year = [];
			for($j=1;$j<=12;$j++){
				$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,MONTHNAME(date) as month_name FROM fees WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
				$record = $query->row_array();
				if(empty($record)){
					$record = array('total_amount'=>0,'month_name'=>date("F", strtotime($i."-".$j.'-1')),'count'=>0 );
				}
				$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,MONTHNAME(join_date) as month_name FROM admission WHERE YEAR(join_date) = '" . $i . "' and MONTH(join_date) = '" . $j . "' GROUP BY YEAR(join_date),MONTH(join_date)"); 
				$record1 = $query1->row_array();
				if(!empty($record1)){
					$record['total_admission'] = $record1['total_admission'];
				}else{
					$record['total_admission'] = 0;
				}

				$query2 =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_refund,MONTHNAME(date) as month_name FROM course_return WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
				$record2 = $query2->row_array();
				if(!empty($record2)){
					$record['total_refund'] = $record2['total_refund'];
				}else{
					$record['total_refund'] = 0;
				}

				$query3 =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_allowance,MONTHNAME(date) as month_name FROM allowance WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
				$record3 = $query3->row_array();
				if(!empty($record3)){
					$record['total_allowance'] = $record3['total_allowance'];
				}else{
					$record['total_allowance'] = 0;
				}
				
				$query4 =  $this->db->query("SELECT COUNT(id) as total_drop,MONTHNAME(join_date) as month_name FROM admission WHERE YEAR(status_date) = '" . $i . "' and MONTH(status_date) = '" . $j . "' and status='D' GROUP BY YEAR(status_date),MONTH(status_date)"); 
				$record4 = $query4->row_array();
				if(!empty($record4)){
					$record['total_drop'] = $record4['total_drop'];
				}else{
					$record['total_drop'] = 0;
				}

				$year[$j] = $record;
				
			}
			$output[$i] = $year;
			
		}
		$data['summary'] = $output;
		//pre($data);die;
		$this->load->view('view_summary_course',$data);
	}	
	function monthly_report(){
		$output = [];
		for($i=date("Y");$i>=START_YEAR;$i--){
			$year = [];
			for($j=1;$j<=12;$j++){
				//college fees
				$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,MONTHNAME(date) as month_name FROM college_fees WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
				$record = $query->row_array();
				if(empty($record)){
					$record = array('total_amount'=>0,'month_name'=>date("F", strtotime($i."-".$j.'-1')),'count'=>0 );
				}
				//college admission
				$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,MONTHNAME(join_date) as month_name FROM college_admission WHERE YEAR(join_date) = '" . $i . "' and MONTH(join_date) = '" . $j . "' GROUP BY YEAR(join_date),MONTH(join_date)"); 
				$record1 = $query1->row_array();
				if(!empty($record1)){
					$record['total_admission'] = $record1['total_admission'];
				}else{
					$record['total_admission'] = 0;
				}
				//exam fees
				$query2 =  $this->db->query("SELECT SUM(amount) as total_amount,MONTHNAME(date) as month_name FROM exam_fees WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
				$record2 = $query2->row_array();
				
				if(!empty($record2)){
					$record['exam_fees'] = $record2['total_amount'];
				}else{
					$record['exam_fees'] = 0;
				}
				//certificate fees
				$query3 =  $this->db->query("SELECT SUM(amount) as total_amount,MONTHNAME(date) as month_name FROM certificate_fees WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
				$record3 = $query3->row_array();
				
				if(!empty($record3)){
					$record['certificate_fees'] = $record3['total_amount'];
				}else{
					$record['certificate_fees'] = 0;
				}
				//refund fees
				$query4 =  $this->db->query("SELECT SUM(amount) as total_refund,MONTHNAME(date) as month_name FROM college_return WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
				$record4 = $query4->row_array();
				if(!empty($record4)){
					$record['total_refund'] = $record4['total_refund'];
				}else{
					$record['total_refund'] = 0;
				}
				//allowance fees
				$query5 =  $this->db->query("SELECT SUM(amount) as total_allowance,MONTHNAME(date) as month_name FROM college_allowance WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
				$record5 = $query5->row_array();
				if(!empty($record5)){
					$record['total_allowance'] = $record5['total_allowance'];
				}else{
					$record['total_allowance'] = 0;
				}
				$query6 =  $this->db->query("SELECT COUNT(id) as total_drop,MONTHNAME(join_date) as month_name FROM college_admission WHERE YEAR(status_date) = '" . $i . "' and MONTH(status_date) = '" . $j . "' and status='D' GROUP BY YEAR(status_date),MONTH(status_date)"); 
				$record6 = $query6->row_array();
				if(!empty($record6)){
					$record['total_drop'] = $record6['total_drop'];
				}else{
					$record['total_drop'] = 0;
				}
				$year[$j] = $record;
				
			}
			$output[$i] = $year;
			
		}
		
		#pre($output);die;
		$data['summary'] = $output;
		$this->load->view('view_summary_college',$data);
	}	
	function monthly_report_cert(){
		$output = [];
		for($i=date("Y");$i>=2022;$i--){
			$year = [];
			for($j=1;$j<=12;$j++){
				//certificate fees
				$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,MONTHNAME(created_date) as month_name FROM certificate WHERE YEAR(created_date) = '" . $i . "' and MONTH(created_date) = '" . $j . "' GROUP BY YEAR(created_date),MONTH(created_date)"); 
				$record = $query->row_array();
				if(empty($record)){
					$record = array('total_amount'=>0,'month_name'=>date("F", strtotime($i."-".$j.'-1')),'count'=>0 );
				}
				//certificate admission
				$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,MONTHNAME(created_date) as month_name FROM certificate WHERE YEAR(created_date) = '" . $i . "' and MONTH(created_date) = '" . $j . "' GROUP BY YEAR(created_date),MONTH(created_date)"); 
				$record1 = $query1->row_array();
				if(!empty($record1)){
					$record['total_admission'] = $record1['total_admission'];
				}else{
					$record['total_admission'] = 0;
				}
				$year[$j] = $record;
				
			}
			$output[$i] = $year;
			
		}
		
		#pre($output);die;
		$data['summary'] = $output;
		$this->load->view('view_summary_certificate',$data);
	}	
	function get_uni_fees_count()
	{
		$data = array();
		$regno = $this->input->post('regno');
		$fees_type = $this->input->post('fees_type');
		$this->db->where('regno',$regno);
		$data = $this->db->get('college_admission')->row_array();

		$this->db->where('reg_no',$regno);
		$this->db->where('fees_type',$fees_type);
		$cnt = $this->db->get('university_payment')->num_rows();

		$data['count'] = $cnt+1;
		echo json_encode($data);
	}
	function add_uni_fees($action="update",$id=0){
		$data=array();
		if($action == "update"){
			$this->db->where('id',$id);
			$data['up'] = $this->db->get('university_payment')->row_array();
		}else if("add"){
			$data['reg_no'] = $id;	
		}
		$data['action'] = $action;
		$data['rec_no']  = $this->db->get('university_payment')->num_rows();
		if($this->input->post()) 
		{
			$regno = $this->input->post('regno');
			$student_name = $this->input->post('student_name');
			$course = $this->input->post('course');
			$ins_no = $this->input->post('ins_no');
			$amount = $this->input->post('amount');
			$date = $this->input->post('date');
			$fees_type = $this->input->post('fees_type');
			@$extra_detail = $this->input->post('extra_detail') ? $this->input->post('extra_detail') : "";

			$arr = array('reg_no'=>$regno,'student_name'=>$student_name,'course'=>$course,'amount'=>$amount,'installment_no'=>$ins_no,'date'=>$date,'fees_type'=>$fees_type,'extra_detail'=>$extra_detail);
			
			if($id > 0 && $action =="update")
			{
				$this->db->where('id',$id);
				$this->db->update('university_payment',$arr);
			}
			else
			{
					
				$this->db->insert('university_payment',$arr);
			}
			redirect('view-uni-payment');
		}
		$this->load->view('add_uni_fees',$data);
	}
	function view_uni_payment()
	{
		$arr = array();
		$type = "regular";
		$start=0;
		$total=$this->Admin_model->uni_row_count($type); 
		$base_url=site_url('Admin/ajax_uni_payment');
		$arr['fees_data'] = $this->Admin_model->get_uni_payments($type,$this->perpage,$start);
		$arr['pagination'] =pagination_new($total,$this->perpage,$base_url,3);
		$arr['found_results'] = $total;
		$arr['fees_type'] = $type;
		$this->load->view('view_uni_payment',$arr);
	}
	function ajax_uni_payment(){
		$perpage = $this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$fees_type = $this->input->post('fees_type');
		
		$table = "university_payment";
		if($search_by=='byno' && $search_keyword != '')
		{
			$this->db->where('reg_no',$search_keyword);
		}

		if($search_by=='byname'  && $search_keyword != '')
		{
			$this->db->like('student_name',$search_keyword);
		}
		$this->db->where('fees_type',$fees_type);
		$total = $this->db->count_all_results($table, FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$data['fees_data'] = $this->db->get()->result_array();
		$base_url = site_url('Admin/ajax_uni_payment');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_uni_payment',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}
	function view_certi_payment()
	{
		$arr = array();
		$type = "certificate";
		$start=0;
		$total=$this->Admin_model->uni_row_count($type); 
		$base_url=site_url('Admin/ajax_uni_payment');
		$arr['fees_data'] = $this->Admin_model->get_uni_payments($type,$this->perpage,$start);
		$arr['pagination'] =pagination_new($total,$this->perpage,$base_url,3);
		$arr['found_results'] = $total;
		$arr['fees_type'] = $type;
		$this->load->view('view_uni_payment',$arr);
	}
	function view_exam_payment()
	{
		$arr = array();
		$type = "exam";
		$start=0;
		$total=$this->Admin_model->uni_row_count($type); 
		$base_url=site_url('Admin/ajax_uni_payment');
		$arr['fees_data'] = $this->Admin_model->get_uni_payments($type,$this->perpage,$start);
		$arr['pagination'] =pagination_new($total,$this->perpage,$base_url,3);
		$arr['found_results'] = $total;
		$arr['fees_type'] = $type;
		$this->load->view('view_uni_payment',$arr);
	}
	function uni_student_payment()
	{
		$arr = array();
		$year = "";
		$month = "";
		$type = "exam_fees";
		$start=$this->uri->segment(3);
		$total=$this->Admin_model->uni_row_count_student(); 
		$arr['adm_data'] = $this->Admin_model->get_uni_student_payments($this->perpage,$start,$year,$month);	
		
		$base_url = site_url('Admin/ajax_search_uni_payment');
		$arr['pagination'] =pagination_new($total,$this->perpage,$base_url,3);
		$arr['found_results'] = $total;

		$this->db->select('course_name');
		$arr['college_course'] = $this->db->get('college_course')->result_array();

		
		$this->db->select('code');
		$arr['college_university'] = $this->db->get('universities')->result_array();

		$this->db->distinct();
		$this->db->select('start_session');
		$this->db->where("start_session !=","");
		$this->db->order_by('start_session','asc');
		$arr['st_session'] = $this->db->get('college_admission')->result_array();

		$this->db->distinct();
		$this->db->select('end_session');
		$this->db->where("end_session !=","");
		$this->db->order_by('end_session','asc');
		$arr['en_session'] = $this->db->get('college_admission')->result_array();
		$this->load->view('uni_student_payment',$arr);
	}
	function ajax_search_uni_payment()
	{
		$perpage = $this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$course_status = $this->input->post('course_status');
		$mode = $this->input->post('mode');
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$college_course = $this->input->post('college_course');
		$university = $this->input->post('university');
		$college_year = $this->input->post('college_year');
		$start_session = $this->input->post('start_session');
		$end_session = $this->input->post('end_session');

		$table = "college_admission";
		if($college_year!="all" and $college_year!= ""){
			$cur_month = date("m");
			$cur_year = date("Y");
			if($cur_month <= 5){
				if($college_year == "first"){
					$start_sess = $cur_year-1;
				}else if($college_year == "second"){
					$start_sess = $cur_year-2;
				}else if($college_year == "third"){
					$start_sess = $cur_year-3;
				}else if($college_year == "fourth"){
					$start_sess = $cur_year-4;
				}
				
			}else{
				if($college_year == "first"){
					$start_sess = $cur_year;
				}else if($college_year == "second"){
					$start_sess = $cur_year-1;
				}else if($college_year == "third"){
					$start_sess = $cur_year-2;
				}else if($college_year == "fourth"){
					$start_sess = $cur_year-3;
				}
			}
			//echo $start_sess;die;
			if($start_sess!='')
			{
				$this->db->where('start_session',$start_sess);
			}
		}

		if($search_by=='byno' && $search_keyword != '')
		{
			$this->db->where('regno',$search_keyword);
		}

		if($search_by=='byname'  && $search_keyword != '')
		{
			$this->db->like('student_name',$search_keyword);
		}

		if($search_by=='bycontact'  && $search_keyword != '')	
		{
			$this->db->like('contact',$search_keyword);
		}
		if($mode!='')
		{
			$this->db->where('college_mode',$mode);
		}

		if($college_course!='')
		{
			$this->db->where('college_course',$college_course);
		}

		if($university!='')
		{
			$this->db->like('university',$university);
		}

		if($start_session!='')
		{
			$this->db->where('start_session',$start_session);
		}

		if($end_session!='')
		{
			$this->db->where('end_session',$end_session);
		}
		if($course_status!='')
		{
			$this->db->like('status',$course_status);
		}
		$total = $this->db->count_all_results($table, FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$data['adm_data'] = $this->db->get()->result_array();
		$base_url = site_url('Admin/ajax_search_uni_payment');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_uni_student_payment',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}
	function uni_report(){
		$this->db->select('code');
		$universities = $this->db->get('universities')->result_array();
		$output = [];
		for($i=date("Y");$i>=2018;$i--){
			$year = [];
			foreach($universities as $uni){
				$query =  $this->db->query("SELECT SUM(amount) as total_amount,university FROM university_payment join college_admission on college_admission.regno=university_payment.reg_no WHERE YEAR(date) = '" . $i . "' and college_admission.university='".$uni['code']."' and university_payment.fees_type='regular' GROUP BY YEAR(date)"); 
				$record = $query->row_array();
				if(empty($record)){
					$record = array('total_amount'=>0,'university'=>$uni['code']);
				}
				$year[]= $record;
			}
			$output[$i] = $year;
			
		}			
		//pre($output);die;
		$data['summary'] = $output;		
		$this->load->view('uni_summary',$data);		
	}
	function import_uni_fees(){
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
						// pre($row);	
						$regno = $row[0];
						$student_name = $row[1];
						$course = $row[2];
						$amount = $row[3];
						$date = date('Y-m-d',strtotime($row[4]));
						$fees_type = $row[5];
						$extra_detail = $row[6];
						$this->db->where('reg_no',$regno);
						$this->db->where('fees_type',$fees_type);
						$cnt = $this->db->get('university_payment')->num_rows();
						$ins_no = $cnt+1;	


						$arr = array('reg_no'=>$regno,'student_name'=>$student_name,'course'=>$course,'amount'=>$amount,'installment_no'=>$ins_no,'date'=>$date,'fees_type'=>$fees_type,'extra_detail'=>$extra_detail);
						$this->db->insert('university_payment',$arr);
			
					}
				}
				//echo "<pre>";
				//print_r($sheetData);
			}
		}
		$this->load->view('uni_fee_import');
	}

	
}

?>