<?php

/*
 * @author Ravi Patel
 */


include("connect.php");
error_reporting(0);
$relCertFileNames = array();
$merge_file = array();
$d = html_entity_decode($_REQUEST['rc']);
require('mpdf60/mpdf.php');



$mpdf = new mPDF('',    // mode - default ''

 'A4',    // format - A4, for example, default ''

 1,     // font size - default 0

 'sans-serif',    // default font family

 3,    // margin_left

 3,    // margin right

 3,     // margin top

 3,    // margin bottom

 0,     // margin header

 0,     // margin footer

 'P');  // L - landscape, P - portrait

$mpdf->WriteHTML($d);

$fileName = "api_document_".SITETITLE."_".date('Y-m-d');

if(!is_dir($fileName)){

	mkdir(API_FILES.$fileName);

}

$pdf_file_path	= API_FILES."/".$fileName.'.pdf';



if(file_exists($pdf_file_path)){

	unlink($pdf_file_path);

}

$mpdf->Output($pdf_file_path);

echo $pdf_file_path;




?>