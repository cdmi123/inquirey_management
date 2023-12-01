<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Exportexcel {
	public function export_data($fields=array(),$data=array(),$file_name='cdmi_excel') {
		$CI =& get_instance();
		$CI->load->helper('download');

		$columnNames = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ","CA","CB","CC","CD","CE","CF","CG","CH","CI","CJ","CK","CL","CM","CN","CO","CP","CQ","CR","CS","CT","CU","CV","CW","CX","CY","CZ");

		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Set document properties
		$spreadsheet->getProperties()->setCreator('Creative Multimedia')
		->setLastModifiedBy('Creative Multimedia')
		->setTitle('Creative Multimedia Office Data');
		// ->setSubject('Generate Excel use PhpSpreadsheet in CodeIgniter')
		// ->setDescription('Export data to Excel Work for me!');
		// add style to the header
		$styleArray = array(
			'font' => array(
				'bold' => true,
			),
			'alignment' => array(
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'bottom' => array(
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
				'color' => array('rgb' => '333333'),
				),
			),
			'fill' => array(
				'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
				'startcolor' => array('rgb' => '0d0d0d'),
				'endColor'   => array('rgb' => 'f2f2f2'),
			),
		);
		$spreadsheet->getActiveSheet()->getStyle('A1:AZ1')->applyFromArray($styleArray);
		// auto fit column to content
		foreach(range('A', 'AZ') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}
		// set the names of header cells
		$i =1;
		foreach($fields as $k=>$f){
			$sheet->setCellValue($columnNames[$k].$i, $f);	
		}
		// $sheet->setCellValue('A1', 'RegNo');
		// $sheet->setCellValue('B1', 'Name');
		// $sheet->setCellValue('C1', 'Mobile');
		// $sheet->setCellValue('D1', 'Sex');
		// $sheet->setCellValue('E1', 'Course');
		// $sheet->setCellValue('F1', 'Fees');
		// $sheet->setCellValue('G1', 'Join Date');
		//$getdata =$this->db->get('college_admission')->result();
		//$getdata = $this->welcome_message->get_sample();
		// Add some data
		$i = 2;
		foreach($data as $get){
			$k=0;
			foreach($get as $row_data){
				//echo $columnNames[$k].$i;
				//pre($get);die;
				$sheet->setCellValue($columnNames[$k].$i, $row_data);	
				$k++;
			}
			$i++;
			// $sheet->setCellValue('A'.$x, $get->regno);
			// $sheet->setCellValue('B'.$x, $get->student_name);
			// $sheet->setCellValue('C'.$x, $get->personal_mobile_no);
			// $sheet->setCellValue('D'.$x, $get->gender);
			// $sheet->setCellValue('E'.$x, $get->college_course);
			// $sheet->setCellValue('F'.$x, $get->total_Fees);
			// $sheet->setCellValue('G'.$x, $get->join_date);
			
		}
		//Create file excel.xlsx
		$writer = new Xlsx($spreadsheet);
		$name = './backup/'.$file_name.'.xlsx';
		$writer->save($name);
		//End Function index
		force_download($name,NULL);
	}
}
?>