<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
#fetch all records to display with filters

function GetAllRecord($table_name='',$condition=array(),$is_single=false){

	$ci = & get_instance();

	if($condition && count($condition))

		$ci->db->where($condition);

	$res = $ci->db->get($table_name);

	if($is_single)

		return $res->row_array();

	else

		return $res->result_array();

}
function get_meta_words($course='',$field=''){
	if(is_string($course)){
		$ci = & get_instance();

		$get_course = $ci->db->get_where('course',array('slug'=>$course))->row_array();

		$ci->db->select($field);
		$ci->db->where('course',$get_course['id']);
		$meta_word = $ci->db->get('keyword')->row_array();
		//echo $ci->db->last_query();die;
		return $meta_word[$field];
	}
}
function get_footer_tags(){
	$ci = & get_instance();
	$ci->load->model('admin/content_model');
	return $ci->content_model->get_footer_tags();
}

#insert update query with filter and flag

function ManageData($table_name='',$condition=array(),$udata=array(),$is_insert=false){

	$resultArr = array();

	$ci = & get_instance();

	if($condition && count($condition))

		$ci->db->where($condition);

	if($is_insert)

	{

		$ci->db->insert($table_name,$udata);

		$insertid = $ci->db->insert_id();

		return $insertid;

	}

	else

	{

		$ci->db->update($table_name,$udata);

		return 1;

	}

}

function pre($str) //Print prev screen for array

{

	echo '<pre>';

	print_r($str);

	echo '</pre>';

}

function last_query() //print last executed query

{

	$CI= & get_instance();

	pre($CI->db->last_query());

}



/*

++++++++++++++++++++++++++++++++++++++++++++++

	Mail send shortcut function.

	Pass parameters according described in functions

	parameters.

++++++++++++++++++++++++++++++++++++++++++++++

*/
function sendMail($toEmail,$subject,$mail_body,$from_email='',$from_name = '',$file_path = '')

{

	#$from_name = 'info@samworld.com';

	$C =& get_instance();

	$C->load->library('email');

	

	$config['protocol']    = 'smtp';

	$config['smtp_host']    = 'mail.cdmi.in';

	$config['smtp_port']    = '587';

	$config['smtp_timeout'] = '7';

	$config['smtp_user']    = 'info@cdmi.in';	//your email

	$config['smtp_pass']    = 'CDMI_16003';	//your password

	$config['charset']    = 'utf-8';

	$config['newline']    = "\r\n";

	$config['mailtype'] = 'html'; // or html

	$config['validation'] = TRUE; // bool whether to validate email or not      

	$config['mailtype'] = 'html';

	//$config['protocol'] = 'sendmail';

	//$config['mailpath'] = '/usr/sbin/sendmail';

	$config['charset'] = 'utf-8';

	$config['wordwrap'] = TRUE;

	

	$C->email->initialize($config);

	// if in loop need to clear it

	$C->email->clear();

	

	$C->email->from($from_email,$from_name);

	$C->email->to($toEmail);

	$C->email->subject($subject);

	$C->email->message($mail_body);

	if($file_path != ''){

		$C->email->attach($file_path);

	}

	if($C->email->send()){

		return $C->email->print_debugger();	

	}else{

		return false;

	}

#	unset($C);

}
// function sendMail($toEmail,$subject,$mail_body,$from_email='',$from_name = '',$file_path = '')

// {

// 	#$from_name = 'info@samworld.com';

// 	$C =& get_instance();

// 	$C->load->library('email');

// 	$config['mailtype'] = 'html';

// 	//$config['protocol'] = 'sendmail';

// 	//$config['mailpath'] = '/usr/sbin/sendmail';

// 	$config['charset'] = 'utf-8';

// 	$config['wordwrap'] = TRUE;

	

// 	$C->email->initialize($config);

// 	// if in loop need to clear it

// 	$C->email->clear();

	

// 	$C->email->from($from_email,$from_name);

// 	$C->email->to($toEmail);

// 	$C->email->subject($subject);

// 	$C->email->message($mail_body);

// 	if($file_path != ''){

// 		$C->email->attach($file_path);

// 	}

// 	$C->email->send();			

// 	return $C->email->print_debugger();

// #	unset($C);

// }

function sendMail2($toEmail,$subject,$mail_body,$from_email='',$from_name = '',$file_path = '')

{

	#$from_name = 'info@samworld.com';

	$C =& get_instance();

	$C->load->library('email');

	

	$config['protocol']    = 'smtp';

	$config['smtp_host']    = 'ssl://smtp.gmail.com';

	$config['smtp_port']    = '465';

	$config['smtp_timeout'] = '7';

	$config['smtp_user']    = 'paresh.pampim@gmail.com';	//your email

	$config['smtp_pass']    = 'paresh@gmail';	//your password

	$config['charset']    = 'utf-8';

	$config['newline']    = "\r\n";

	$config['mailtype'] = 'html'; // or html

	$config['validation'] = TRUE; // bool whether to validate email or not      

	$config['mailtype'] = 'html';

	//$config['protocol'] = 'sendmail';

	//$config['mailpath'] = '/usr/sbin/sendmail';

	$config['charset'] = 'utf-8';

	$config['wordwrap'] = TRUE;

	

	$C->email->initialize($config);

	// if in loop need to clear it

	$C->email->clear();

	

	$C->email->from($from_email,$from_name);

	$C->email->to($toEmail);

	$C->email->subject($subject);

	$C->email->message($mail_body);

	if($file_path != ''){

		$C->email->attach($file_path);

	}

	if($C->email->send()){

		return $C->email->print_debugger();	

	}else{

		return false;

	}

#	unset($C);

}

#joinTable

function JoinData($table_name='',$condition=array(),$condition2=array(),$join_table='',$table_id='',$join_id='',$is_single=false,$join_condition=array()){

	$ci = & get_instance();

	#$ci->db->select('first_name,last_name');

	if($condition && count($condition))

		$ci->db->where($condition);

	if($condition2 && count($condition2))

		$ci->db->or_where($condition2);

	$ci->db->from($table_name);

	if($join_table)

		$ci->db->join($join_table,"$table_name.$table_id = $join_table.$join_id");

	if($join_condition)

		$ci->db->where($join_condition);

	#$ci->db->where('facebook_newuser.subscribe',1);

	$res = $ci->db->get();

	if($is_single)

		return $res->row_array();

	else

		return $res->result_array();

}



function pagination($total_rows=0,$per_page=5,$base_url='',$uri_segment=3,$position_cls='')
{
	$ci = & get_instance();

	

	$ci->load->library('pagination');

	$config['base_url'] = $base_url;

	$config['total_rows'] = $total_rows;

	$config['per_page'] = $per_page;

	$config['uri_segment'] = $uri_segment;

	$config['first_link'] = '«';

	$config['last_link'] = '»';

	$config['next_link'] = '<i class="fa fa-angle-right "></i>';

	$config['prev_link'] = '<i class="fa fa-angle-left "></i>';

	$config['full_tag_open'] = '<ul class="pagination justify-content-center mb-5">';

	$config['full_tag_close'] = '</ul>';

	$config['num_tag_open'] = '<li class="page-item">';
	$config['num_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="page-item"><a class="page-link">';
	$config['cur_tag_close'] = '</a></li>';
	$config['next_tag_open'] = '<li class="page-item">';
	$config['next_tag_close'] = '</li>';
	$config['prev_tag_open'] = '<li class="page-item">';
	$config['prev_tag_close'] = '</li>';
	$config['first_tag_open'] = '<li class="page-item">';
	$config['first_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li class="page-item">';
	$config['last_tag_close'] = '</li>';

	
	$config['attributes'] = array('class' => 'page-link');
	$ci->pagination->initialize($config); 

	

	return $ci->pagination->create_links();

	

}

function ajax_pagination($total_rows=0,$per_page=5,$base_url='',$target='',$my_paginate='',$uri_segment=3)
{
	$ci = & get_instance();

	$ci->load->library('Ajax_pagination');
	
	$config['base_url']=$base_url;
	$config['total_rows']=$total_rows;
	$config['per_page']=$per_page;
	$config['uri_segment']=$uri_segment;
	$config['link_func'] = $my_paginate;
	$ci->ajax_pagination->initialize($config);
	return $ci->ajax_pagination->create_links();
	
}

function pagination_new($total_rows=0,$per_page=5,$base_url='',$uri_segment=3,$position_cls='')
{
	$ci = & get_instance();
	$ci->load->library('pagination');
	$config['base_url'] = $base_url;
	$config['total_rows'] = $total_rows;
	$config['per_page'] = $per_page;
	$config['uri_segment'] = $uri_segment;
	$config['next_link'] = 'Next';
	$config['prev_link'] = 'Prev';
	$config['full_tag_open']='<div class="pagination">';
	$config['full_tag_close']='</div>';
	$config['cur_tag_open']='<a class="active">';
	$config['cur_tag_close']='</a>';
	
	$ci->pagination->initialize($config); 
	return $ci->pagination->create_links();
}
function getSimpleDate($date=""){
	if($date!= "" && $date!="0000-00-00"){
		$new_date=date('d-m-Y',strtotime($date));
	}else{
		$new_date ="";
	}
	return $new_date;
}
function getDateTime($timestamp=''){
	$date = new DateTime($timestamp, new DateTimeZone('Asia/Kolkata'));
	$date->setTimezone(new DateTimeZone('Asia/Kolkata'));
	return $date->format('d-m-Y H:i:s');
}
function getImageName($img_name = ''){
	if($img_name!= ''){
		$img_parts = explode('.',$img_name);
		return str_replace("-"," ",$img_parts[0]);
	}else{
		return '';
	}
}
/**
 * multi array scan 
 * 
 * @param $array array
 * 
 * @return bool
 */
function scan_array($array = array()){
  if (empty($array)) return true;

  foreach ($array as $sarray) {
    if (empty($sarray)) return true;
  } 

  return false;
}
//get the work days of month
function findWorkDays($month,$year){
	$workdays = array();
	$type = CAL_GREGORIAN;
	$curmonth = date('n'); // Month ID, 1 through to 12.
	$curyear = date('Y'); // Year in 4 digit 2009 format.
	$day_count = cal_days_in_month($type, $month, $year); // Get the amount of days
	if($month ==$curmonth && $year == $curyear){
		$today = date('d');
		//loop through all days
		for ($i = $today; $i >= 1; $i--) {
	        $date = $year.'/'.$month.'/'.$i; //format date
	        $get_name = date('l', strtotime($date)); //get week day
	        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

	        //if not a weekend add day to array
	        if($day_name != 'Sun'){
	            $workdays[] = $i;
	        }
		}
	}else{
		//loop through all days
		for ($i = $day_count; $i >= 1; $i--) {
	        $date = $year.'/'.$month.'/'.$i; //format date
	        $get_name = date('l', strtotime($date)); //get week day
	        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

	        //if not a weekend add day to array
	        if($day_name != 'Sun'){
	            $workdays[] = $i;
	        }
		}	
	}
	
	return $workdays;
	//print_r($workdays);	
}
function getTimeDiff($time1,$time2)
{
    $datetime1 = new DateTime($time1);
	$datetime2 = new DateTime($time2);
	$interval = $datetime1->diff($datetime2);
	//return $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
	return $interval->format('%h').":".$interval->format('%i');
}
function AddWorkingHours($times) {
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    foreach ($times as $time) {
        list($hour, $minute) = explode(':', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }

    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d:%02d', $hours, $minutes);
}
function randomCode($len = 12)

{

	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

	$pass = array(); 

	

	for ($i = 0; $i <$len; $i++) {

	$n = rand(0, strlen($alphabet)-1); //use strlen instead of count

	$pass[$i] = $alphabet[$n];

}

	return implode($pass); //turn the array into a string

}

########################################################

# Functions used to send the SMS message

########################################################

function SMSSend($phone, $msg){
   // return array();
	$user = "cdmisms";
	$password = "cdmi@123";
	$senderid = "CDMINS";
	//$smsurl = "http://sms.cdmi.in/API/WebSMS/Http/v1.0a/index.php?";
	$smsurl="http://mysmsshop.in/http-api.php?";
	//$smsurl = "http://sms.bulksmsind.in/sendSMS?";
	//$smsurl = "http://text.msgkiyakya.co.in/api/sendhttp.php?";

	$url = 'username='.$user;
	$url.= '&password='.$password;
	$url.= '&senderid='.$senderid;
	$url.= '&number='.urlencode($phone);
	$url.= '&message='.urlencode($msg);
	//$url.= '&smstype=TRANS';
	$url.= '&route=3';
	//$url.= '&apikey=6c40826e-ffa2-4e82-bdc9-40953fe4e403';
	
	$urltouse =  $smsurl.$url;
    //echo $urltouse;die;
	$ch = curl_init($urltouse);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//$response = curl_exec($ch);
	if($response = curl_exec($ch) === false)
	{
		echo 'Curl error: ' . curl_error($ch);
	}
	curl_close($ch);
	
	$array = json_decode($response,true);
	return($array);
}

function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return strtoupper(($Rupees ? $Rupees . 'Rupees ' : '') . $paise);
}

########################################################
# GET data from sendsms.html
########################################################

//$phonenum = $_POST['recipient'];
//$message = $_POST['message'];

//$response = SMSSend($phonenum,$message);
//echo '<pre>';print_r($response);
function getString($n) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
function encodeString($str){
	$encoded = str_rot13($str);
	return $encoded;
}

function date_compare($element1, $element2) {
    $datetime1 = strtotime(@$element1['date']);
    $datetime2 = strtotime(@$element2['date']);
    return $datetime1 - $datetime2;
} 
?>








