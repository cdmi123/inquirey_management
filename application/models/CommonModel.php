<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CommonModel extends CI_Model
{
	function get_course_names($ids = ""){
		$course_names = "";
		if(!empty($ids)){
			$ids_arr = explode(",", $ids);
			$this->db->where_in("id",$ids_arr);
			$qry=$this->db->get('course');
			$res = $qry->result_array();
			//echo $this->db->last_query();
			//print_r($res);die;
			$names = array();
			foreach($res as $row){
				$names[] =$row['course_name'];
			}
			$course_names = implode(",", $names);
		}
		return $course_names;
	}
	function get_staff_info($staff_id=0){
		$this->db->where_in("id",$staff_id);
		$qry=$this->db->get('admin');
		$res = $qry->row_array();
		return $res;
	}
}