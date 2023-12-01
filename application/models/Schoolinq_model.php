<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schoolinq_model extends CI_Model
{
	function count_inq_by_status($school_id=0,$status=''){
		$this->db->select(' COUNT(id) AS total_count');
		$this->db->where('status',$status);
		$this->db->where('s_id',$school_id);
		$arr = $this->db->get('school_inq')->row_array();
		if(empty($arr)){
			return 0;
		}else{
			return $arr['total_count'];
		}
	}
	function count_call_by_school($school_id=0,$caller_id=0){
		$this->db->like('school_call_followup.followup_date',date('Y-m-d'));
		$this->db->where('school_inq.s_id',$school_id);
		$this->db->where('school_call_followup.followup_by',$caller_id);
		$this->db->join('school_inq','school_inq.id=school_call_followup.inquiry_id');
		$this->db->group_by('school_call_followup.inquiry_id');
		$arr = $this->db->get('school_call_followup')->num_rows();
		return $arr;
	}
}
?>