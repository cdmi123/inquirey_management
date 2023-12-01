			<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['staff-login'] = "login/index";
$route['logout'] = "login/logout";
$route['staff-dashboard'] = "Dashboard/index";
$route['admin-dashboard'] = "Dashboard/overview";
$route['inq-rpt'] = "Dashboard/inq_rpt";
$route['inquiry-details'] = "Followup/view_followup_details";
$route['school-inq-repo'] = "Inquiry/school_inq_year_report";
$route['add-admission'] = "College_admission/index";
$route['view-admission'] = "College_admission/view_college_admission";
$route['faculty-students'] = "Admission/view_faculty_students";
$route['admission-report-college'] = "Admin/monthly_report";
$route['admission-report-course'] = "Admin/monthly_report_course";
$route['certificate-report'] = "Admin/monthly_report_cert";
$route['add-uni-payment/(:any)/(:num)'] = "Admin/add_uni_fees/$1/$2";
$route['import-uni-payment'] = "Admin/import_uni_fees";
$route['university-report'] = "Admin/uni_report";
$route['view-uni-payment'] = "Admin/uni_student_payment";
$route['view-uni-fees-payment'] = "Admin/view_uni_payment";
$route['view-uni-certificate-payment'] = "Admin/view_certi_payment";
$route['view-uni-exam-payment'] = "Admin/view_exam_payment";
$route['upcoming-fees'] = "Fees/upcoming_due_list";
$route['due-fees'] = "Fees/pending_list";
$route['delete-due-fees/due/(:num)'] = "Fees/due_delete_rows/due/$1";
$route['delete-due-fees/upcoming/(:num)'] = "Fees/due_delete_rows/upcoming/$1";
$route['fees-follow-up/(:num)'] = "Fees/fees_followup/$1";
$route['download-backup'] = "Admin/backup_db";
$route['college-dashboard'] = "College_admission/college_dashboard";
$route['student-attendence/(:any)/(:any)'] = "College_attendence/index/$1/$2";
$route['Batch-attendence/(:any)'] = "Batch_attendence/index/$1";
$route['today-absent'] = "Batch_attendence/today_absent";
$route['today-collage-absent'] = "College_attendence/today_absent";
$route['old-attendence/(:any)/(:any)/(:any)'] = "College_attendence/old_attendence/$1/$2/$3";
$route['old-tele-report/(:any)'] = "Schoolinq/old_tele_report/$1";
$route['Change_Batch/(:any)'] = "Admission/Change_Batch/$1";
$route['student-Exam-Report/(:any)/(:any)'] = "College_admission/export_Exam_data/$1/$2";
$route['QR-code/(:any)'] = "QrcodeController/qrcodeGenerator/$1";
$route['day1'] = "Tempcourse/index";
$route['day2'] = "Tempcourse/index2";

/* API Routes */

$route['student-details/(:any)'] = "ApiController/student_details/$1";
$route['student-complain/(:any)'] = "ApiController/student_complain/$1";
$route['student-attendence/(:any)'] = "ApiController/student_attendence/$1";

$route['login'] = "ApiController/Login";




