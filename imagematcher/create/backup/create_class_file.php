<?php 
/*
Created By Jay Acharya
*/
// New class file name
$new_class_file_name=isset($_REQUEST['new_file_name'])?$_REQUEST['new_file_name']:"";
$sample_class_file="class.sample.txt";//Enter Sample Class File Name;
$change_file_name="change.txt";
if($new_class_file_name=="")
$new_class_file_name=time()."_".$sample_class_file;	

// Get Content From Sample File
$str=file_get_contents($sample_class_file);

// Read Change From Excel

/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Asia/Kolkata');

/** PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/IOFactory.php';

$inputFileType = 'Excel5';
$inputFileName = 'changes.xls';


/**  Create a new Reader of the type defined in $inputFileType  **/ 
$objReader = PHPExcel_IOFactory::createReader($inputFileType); 
/**  Load only the rows and columns that match our filter to PHPExcel  **/ 
$objPHPExcel = $objReader->load($inputFileName); 
//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
$final_data=array();
for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
    //  Insert row data array into your database of choice here
	$rowData=$rowData[0];
	for($j=1;$j<sizeof($rowData);$j++)
	{
		$final_data[$rowData[0]][]=$rowData[$j];
	}
	
}



$error=array();

if(array_key_exists("class_name",$final_data))
{
	$str=str_replace(":class_name",$final_data['class_name'][0],$str,$count);
}
else
{
	$error[]="Class name not found!!";
}
if(array_key_exists("table",$final_data))
{
	$str=str_replace(":table",'"'.$final_data['table'][0].'"',$str,$count);
}
else
{
	$error[]="Table name not found!!";
}
if(array_key_exists("primary_column",$final_data))
{
	$str=str_replace(":primary_column",'"'.$final_data['primary_column'][0].'"',$str,$count);
}
else
{
	$error[]="Primary column name not found!!";
}
if(array_key_exists("column_name",$final_data))
{
	$column_variable_declaration="";
	$valid_keys="";
	$require_column_name="";
	foreach($final_data['column_name'] as $c)
	{
		$column_variable_declaration.="public $".$c."='';";
		$valid_keys.='"'.$c.'",';
		$require_column_name.=$c.",";
	}
	$valid_keys=trim($valid_keys,",");
	$require_column_name=trim($require_column_name,",");
	$str=str_replace(":column_variable_declaration",$column_variable_declaration,$str,$count);
	$str=str_replace(":valid_keys",$valid_keys,$str,$count);
	$str=str_replace(":require_column_name",$require_column_name,$str,$count);
}
else
{
	$error[]="column name not found!!";
}

if(array_key_exists("update_fail_message",$final_data))
{
	$str=str_replace(":update_fail_message",$final_data['update_fail_message'][0],$str,$count);
}
else
{
	$error[]="Upadate Fail Message not found!!";
}


if(array_key_exists("update_success_message",$final_data))
{
	$str=str_replace(":update_success_message",$final_data['update_success_message'][0],$str,$count);
}
else
{
	$error[]="Upadate Success Message not found!!";
}

if(array_key_exists("view_fail_message",$final_data))
{
	$str=str_replace(":view_fail_message",$final_data['view_fail_message'][0],$str,$count);
}
else
{
	$error[]="View Fail Message not found!!";
}

if(array_key_exists("view_success_message",$final_data))
{
	$str=str_replace(":view_success_message",$final_data['view_success_message'][0],$str,$count);
}
else
{
	$error[]="View Success Message not found!!";
}

if(array_key_exists("insert_fail_message",$final_data))
{
	$str=str_replace(":insert_fail_message",$final_data['insert_fail_message'][0],$str,$count);
}
else
{
	$error[]="Insert Fail Message not found!!";
}

if(array_key_exists("insert_success_message",$final_data))
{
	$str=str_replace(":insert_success_message",$final_data['insert_success_message'][0],$str,$count);
}
else
{
	$error[]="Insert Success Message not found!!";
}

if(array_key_exists("delete_fail_message",$final_data))
{
	$str=str_replace(":delete_fail_message",$final_data['delete_fail_message'][0],$str,$count);
}
else
{
	$error[]="Delete Fail Message not found!!";
}
if(array_key_exists("delete_success_message",$final_data))
{
	$str=str_replace(":delete_success_message",$final_data['delete_success_message'][0],$str,$count);
}
else
{
	$error[]="Delete Success Message not found!!";
}

if(empty($error))
{
	if(array_key_exists("file_name",$final_data))
	{
		echo $file_name="class.".$final_data['file_name'][0].".php";
	}
	else
	{
		echo $file_name="class.".$final_data['class_name'][0].".php";
	}
	file_put_contents($new_class_file_name, $str);
	rename($new_class_file_name,$file_name);	
}
else
{
	print_r($error);
}
?>