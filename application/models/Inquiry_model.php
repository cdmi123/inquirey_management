<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inquiry_model extends CI_Model
{
	function insert_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('inq_offline',$arr);
	}

	function get_inquiry_demo($inq_id=0,$source=""){
		$res = array();
		$this->db->select('admin.name,demo_lectures.*');
		$this->db->join('admin','admin.id=demo_lectures.faculty_id');
		$qry = $this->db->get_where('demo_lectures',array('inq_id'=>$inq_id,'source'=>$source));
		$res = $qry->row_array();
		return $res;
	}
	function online_insert_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('inq_online',$arr);
	}

	function call_insert_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('inq_call',$arr);
	}

	function web_insert_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('inq_web',$arr);
	}

	function followup_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('followup',$arr);
	}

	function justdial_followup_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('justdial_followup',$arr);
	}

	function call_followup_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('justdial_followup',$arr);
	}

	function web_followup_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('web_followup',$arr);
	}

	function last_followup($id="")
	{
			$this->db->order_by('id','desc');
			$this->db->where('inquiry_id',$id);
			$arr = $this->db->get('followup')->row_array();
			return $arr;
	}

	function justdial_last_followup($id="")
	{
			$this->db->order_by('id','desc');
			$this->db->where('inquiry_id',$id);
			$arr = $this->db->get('justdial_followup')->row_array();

			return $arr;
	}

	function call_last_followup($id="")
	{
			$this->db->order_by('id','desc');
			$this->db->where('inquiry_id',$id);
			$arr = $this->db->get('call_followup')->row_array();

			return $arr;
	}

	function web_last_followup($id="")
	{
			$this->db->order_by('id','desc');
			$this->db->where('inquiry_id',$id);
			$arr = $this->db->get('web_followup')->row_array();

			return $arr;
	}

	function row_count($search_by="",$search_keyword="")
	{
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		
		$qry=$this->db->get('inq_offline');
		$num=$qry->num_rows();
		return $num;
	}


	function online_inquiry_row_count($search_by="",$search_keyword="")
	{
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		
		$qry=$this->db->get('inq_online');
		$num=$qry->num_rows();
		return $num;
	}

	function justdial_row_count($search_by="",$search_keyword="")
	{
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		
		$qry=$this->db->get('inq_justdial');
		$num=$qry->num_rows();
		return $num;
	}


	function call_row_count($search_by="",$search_keyword="")
	{
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		
		$qry=$this->db->get('inq_call');
		$num=$qry->num_rows();
		return $num;
	}

	function web_row_count($search_by="",$search_keyword="")
	{
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		
		$qry=$this->db->get('inq_web');
		$num=$qry->num_rows();



		return $num;
	}

	function update($id,$arr)
	{ 
		$this->db->where('id',$id);
		$this->db->update('inq_offline',$arr);
		//echo $this->db->last_query();die;
	}

	function justdial_update($id,$arr)
	{ 
		$this->db->where('id',$id);
		$this->db->update('inq_justdial',$arr);
		//echo $this->db->last_query();die;
	}

	function call_update($id,$arr)
	{ 
		$this->db->where('id',$id);
		$this->db->update('inq_call',$arr);
		//echo $this->db->last_query();die;
	}

	function web_update($id,$arr)
	{ 
		$this->db->where('id',$id);
		$this->db->update('inq_web',$arr);
		//echo $this->db->last_query();die;
	}

	function view_data($perpage=2,$start=0,$search_by="",$search_keyword="")
	{
		
		$this->db->limit($perpage,$start);
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		//$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$this->db->select('inq_offline.*,a.name as added_by_name,b.name as inq_by_name');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->order_by('inquiry_time','desc');
		$qry=$this->db->get('inq_offline');
		//echo $this->db->last_query();die;
		return $qry->result_array();
	}

	function view_online_inquiry($perpage=2,$start=0,$search_by="",$search_keyword="")
	{
		$this->db->order_by('id','desc');
		$this->db->limit($perpage,$start);
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}

		$qry=$this->db->get('inq_online');
		//echo $this->db->last_query();die;
		return $qry->result_array();
	}

	function justdial_view_data($perpage=2,$start=0,$search_by="",$search_keyword="")
	{
		$this->db->order_by('id','desc');
		//$this->db->limit($perpage,$start);
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}

		$qry=$this->db->get('inq_justdial');
		//echo $this->db->last_query();die;
		return $qry->result_array();
	}

	function call_view_data($perpage=2,$start=0,$search_by="",$search_keyword="")
	{
		$this->db->order_by('id','desc');
		//$this->db->limit($perpage,$start);
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}

		$qry=$this->db->get('inq_call');
		//echo $this->db->last_query();die;
		return $qry->result_array();
	}




	function web_view_data($perpage=2,$start=0,$search_by="",$search_keyword="")
	{
		$this->db->order_by('id','desc');
		$this->db->limit($perpage,$start);
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}

		$qry=$this->db->get('inq_web');
		//echo $this->db->last_query();die;

		//echo $this->db->last_query();die;
		return $qry->result_array();
	}




	 function getUsers($postData){

     $response = array();

     if(isset($postData['search']) ){
       // Select record
     	$search_by = $postData['search_by'];
       $this->db->select('*');
       if($search_by=='by_name')
       {
       		$this->db->where("name like '%".$postData['search']."%' ");
       }else if($search_by=='by_date')
       {
       		$this->db->where("demo_date like '%".$postData['search']."%' ");
       }
		else if($search_by=='by_contact')
       {
       		$this->db->where("contact like '%".$postData['search']."%' ");
       }else if($search_by=='by_course')
       {
       		$this->db->where("course like '%".$postData['search']."%' ");
       }else if($search_by=='by_reference')
       {
       		$this->db->where("reference like '%".$postData['search']."%' ");
       }else if($search_by=='by_status')
       {
       		$this->db->where("status like '%".$postData['search']."%' ");
       }else if($search_by=='by_faculties')
       {
       		$this->db->where("inquiry_by like '%".$postData['search']."%' ");
       }
       

       $records = $this->db->get('inq_offline')->result();

       foreach($records as $row ){
          $response[] = array("value"=>$row->id,"label"=>$row->name);
       }

     }

     return $response;
  }


	  // function course_names($course_ids = '')
	  // {
	  // 		$this->db->where_in('id',array($course_ids));
	  // 		$query = $this->db->get('course')->result_array();

	  // 		foreach ($$query as $val)
	  // 		{
	  // 			$course_data = explode(',', $query);
	  // 		}

	  // 		return $course_data;
	  // }

  	function offline_pending_row_count($search_by="",$search_keyword="")
	{
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		$this->db->where('status','0');
		$qry=$this->db->get('inq_offline');
		$num=$qry->num_rows();
		return $num;
	}

	function offline_pending_view_data($perpage=2,$start=0,$search_by="",$search_keyword="")
	{
		$this->db->order_by('id','desc');
		$this->db->limit($perpage,$start);
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}

		$this->db->where('status','0');
		$qry=$this->db->get('inq_offline');
		//echo $this->db->last_query();die;
		return $qry->result_array();
	}

	function offline_admission_row_count($search_by="",$search_keyword="")
	{
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		$this->db->where('status','3');
		$qry=$this->db->get('inq_offline');
		$num=$qry->num_rows();
		return $num;
	}

	function offline_admission_view_data($perpage=2,$start=0,$search_by="",$search_keyword="")
	{
		$this->db->order_by('id','desc');
		$this->db->limit($perpage,$start);
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}

		$this->db->where('status','3');
		$qry=$this->db->get('inq_offline');
		//echo $this->db->last_query();die;
		return $qry->result_array();
	}

	function offline_decliened_row_count($search_by="",$search_keyword="")
	{
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}
		$this->db->where('status','2');
		$qry=$this->db->get('inq_offline');
		$num=$qry->num_rows();
		return $num;
	}

	function offline_decliened_view_data($perpage=2,$start=0,$search_by="",$search_keyword="")
	{
		$this->db->order_by('id','desc');
		$this->db->limit($perpage,$start);
		if($search_by=="by_name"){
			$this->db->like('name',$search_keyword);
		}else if($search_by=="by_date"){
			$this->db->like('demo_date',$search_keyword);
		}else if($search_by=="by_contact"){
			$this->db->like('contact',$search_keyword);
		}else if($search_by=="by_course"){
			$this->db->like('course',$search_keyword);
		}else if($search_by=="by_reference"){
			$this->db->like('reference',$search_keyword);
		}else if($search_by=="by_status"){
			$this->db->like('status',$search_keyword);
		}else if($search_by=="by_faculties"){
			$this->db->like('inquiry_by',$search_keyword);
		}

		$this->db->where('status','2');
		$qry=$this->db->get('inq_offline');
		//echo $this->db->last_query();die;
		return $qry->result_array();
	}



}