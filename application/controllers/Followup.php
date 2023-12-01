<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Followup extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}	
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	function add_followup_data($id)
	{

		$this->db->where('id',$id);
		$arr['inquiry_data'] = $this->db->get('inq_offline')->row_array();
		$arr['faculties'] = $this->db->get('admin')->result_array();
		$arr['fo_id'] = $id;


		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;
			$followup_reason = $this->input->post('followup_reason');
			$followup_by = $this->input->post('followup_by');
			$next_date = $this->input->post('next_date');

			$arr1 = array('inquiry_id'=>$id,'followup_reason'=>$followup_reason,'followup_by'=>$followup_by);
			$this->db->insert('followup',$arr1);

			$this->db->where('id',$id);
			$this->db->update('inq_offline',array('demo_date'=>$next_date));
			redirect('followup/view_followup/'.$id);
		}

		$this->load->view('add_followup',$arr);
	}


	function view_followup($id)
	{
		$arr['fo_id'] = $id;
		$this->db->select('f.*,iof.name,iof.contact,iof.course,iof.fees,a.name as inq_by_name');
		$this->db->where('f.inquiry_id',$id);
		$this->db->join('inq_offline iof','iof.id=f.inquiry_id','left');
		$this->db->join('admin a','a.id=f.followup_by','left');
		$this->db->order_by('f.id','desc');
		$arr['follow'] = $this->db->get('followup f')->result_array();
		$this->load->view('view_followup',$arr);
	}

	function view_followup_details()
	{
		
			$cur_year = date("Y");
			$cur_month = date("m");
			$cur_date = date("d");
			$inq_ids = array();
		$date = date('Y-m-d'); 
		$this->db->select('id');
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('demo_date <=',$date);
		$this->db->where_in('status',array("P","D"));
		$data = $this->db->get('inq_offline');
		foreach($data->result_array() as $row){
			$inq_ids[] = $row['id'];
		}
		$inquery['cnt'] = $data->num_rows(); 

		$this->db->select('f.id');
		$this->db->from('followup f');
		$this->db->where_in('inquiry_id',$inq_ids);
		$this->db->group_by('inquiry_id');
		// $this->db->where('YEAR(followup_date)',$cur_year);
		// $this->db->where('MONTH(followup_date)',$cur_month);
		// $this->db->where('DAY(followup_date)',$cur_date);
		// $this->db->join('inq_offline io','io.id = f.inquiry_id');
		// $this->db->where('io.status',"P");
		// $this->db->not_like('io.inquiry_time',$date);
		// $this->db->like('f.followup_date',$date);
		// $this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data = $this->db->get();
		//echo last_query();die();
		$inquery['cnt1'] = $data->num_rows(); 

		$fac_arr = array(11,10,4,13,16,44,15,9,12);

					foreach ($fac_arr as $key => $value) {

						$qry_info = $this->getdata($value);
						
							if(!empty($qry_info)){
									$arr[$value] = $qry_info;
							}else{
									$arr[$value] = array( 'total_count'=>0);	
							}
					}
					$inquery["inquery_data"] = $arr;
					
		$this->load->view('view_follow_up_details',$inquery);
	}


	function getdata($f_id=0)
	{	

		$cur_year = date("Y");
		$cur_month = date("m");
		$cur_date = date("d");

			// $data =  $this->db->query("SELECT COUNT(id) as total_count FROM followup WHERE YEAR(followup_date) = '" . $cur_year . "' and MONTH(followup_date) = '" . $cur_month . "'  and  DAY(followup_date) = '". $cur_date ."' and followup_by='$f_id' GROUP BY YEAR(followup_date),MONTH(followup_date),DAY(followup_date)");

			$data = $this->db->query("SELECT COUNT(followup.id) as total_count FROM `followup` INNER JOIN inq_offline WHERE inq_offline.inquiry_time != followup.followup_date and DAY(followup.followup_date) = '$cur_date' and YEAR(followup.followup_date) = '$cur_year' and MONTH(followup.followup_date) = '$cur_date' and followup.followup_by = '$f_id'");
			return $data->row_array();
	}

}
