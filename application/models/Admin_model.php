<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model
{
	function insert_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('admin',$arr);
	}

	function view_data()
	{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$qry=$this->db->get('admin');
		return $qry->result_array();
	}

	function delete($id='')
	{
		$this->db->where('id',$id);
		$this->db->delete('admin');
		redirect('admin/view_admin');
	}

	function update($id,$arr)
	{ 
		$this->db->where('id',$id);
		$this->db->update('admin',$arr);
		//echo $this->db->last_query();die;
	}

	function get_single_record($id)
	{
	  	$this->db->where('id',$id);
		$qry=$this->db->get('admin');
		return $qry->row_array();
	}


	function get_page()
	{
		$data = $this->db->get('test')->result_array();
		return $data;
	}
	function uni_row_count($type="college_fees")
	{

		$this->db->where('fees_type',$type);
		$qry=$this->db->get('university_payment');
		$num=$qry->num_rows();
		return $num;
	}
	function get_uni_payments($type="regular",$perpage=40,$start=0,$year="",$month="")
	{
		$this->db->where('fees_type',$type);
		$this->db->limit($perpage,$start);
		$this->db->like('date',$year);
		$this->db->like('date',$month);
		$this->db->order_by('id','desc');
		$arr = $this->db->get('university_payment')->result_array();
		return $arr;
	}
	function get_total_uni_fees_by_student($reg_no=0,$type="college_fees")
	{
		$this->db->select('sum(amount) as total_amount,reg_no');
		$this->db->where('fees_type',$type);
		$this->db->where('reg_no',$reg_no);
		$this->db->group_by('reg_no');
		$arr = $this->db->get('university_payment')->row_array();
		return $arr;
	}



	function uni_row_count_student()
	{

		
		$qry=$this->db->get('college_admission');
		$num=$qry->num_rows();
		return $num;
	}
	function get_uni_student_payments($perpage=20,$start=0,$year="",$month="")
	{
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$arr = $this->db->get('college_admission')->result_array();
		return $arr;
	}
}

?>