<?php
/*
Created By Jay Acharya
*/
include('../include/define.php');
include('../include/function.class.php');
include('validator.class.php');
include('input.class.php');
include('view.class.php');

$db=new Admin();
$validator=new Validation();
$input=new Input();
$view=new View();

// New class file name
$new_class_file_name=isset($_REQUEST['new_file_name'])?$_REQUEST['new_file_name']:"";
$sample_class_file="class.sample.txt";//Enter Sample Class File Name;
$sample_form_file="form.txt";//Enter Sample form File Name;
$sample_manage_table_js_file="table-datatables-ajax-sample.txt";//Enter Sample Manage Datatable File Name;
$sample_ajax_file="sample_ajax_function.txt";//Enter Sample AJAX Function File Name;
$sample_view_file="view.txt";//Enter Sample view File Name;
$change_file_name="change.txt";
if($new_class_file_name=="")
$new_class_file_name=time()."_".$sample_class_file;

// Get Content From Sample File For Class
$str=file_get_contents($sample_class_file);

// Get Content From Sample File For Form
$str_form=file_get_contents($sample_form_file);

// Get Content From Sample File For JS Of Datatable
$str_datatable_js=file_get_contents($sample_manage_table_js_file);

// Get Content From Sample File For AJAX
$str_ajax=file_get_contents($sample_ajax_file);

// Get Content From Sample File For View
$str_view=file_get_contents($sample_view_file);

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
 	//generate Unique Page ID
    $page_slug="page_".strtolower(trim($final_data['class_name'][0]));
    $page_title=$final_data['class_name'][0]." Pages";
    $page_data= $db->rp_getData("page_table","id","page_slug='".$page_slug."'");
    $page_count=0;
    $page_urls=array();
    if($page_data)
    {
        $page_data=mysql_fetch_assoc($page_data);
        $page_id=$page_data['id'];
        $db->rp_update("page_table",array("page_title"=>$page_title,"page_slug"=>$page_slug),"id='".$page_id."'");
        echo "Page Already Found will be replaced <br>";
    }
    else
    {
        $page_id=$db->rp_insert("page_table",array($page_slug,$page_title),array("page_slug","page_title"),0);
        echo "New page created!!<br>";
    }

    echo "Page Id ".$page_id."</br>";


$error=array();
// Starting Step 1;

echo "STEP -1 Create Class File \n<br/>";

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
if(array_key_exists("unique_column",$final_data))
{
	$str=str_replace(":unique_column",'"'.$final_data['unique_column'][0].'"',$str,$count);
}
else
{
	$error[]="Unique column name not found!!";
}
if(array_key_exists("column_name",$final_data))
{
	$column_variable_declaration="";
	$valid_keys="";
	$require_column_name="";
	foreach($final_data['column_name'] as $c)
	{
		$c=trim($c);
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
if(array_key_exists("duplicate_record_message",$final_data))
{
	$str=str_replace(":duplicate_record_message",$final_data['duplicate_record_message'][0],$str,$count);
}
else
{
	$error[]="Record Duplicate Message not found!!";
}

if(empty($error))
{
	$folder=$final_data['class_name'][0]."/";
	$include="include/";
	$files="bbfalando/";
	$js=$files."js/";
	if(!file_exists($folder.$include))
	{
		mkdir($folder.$include);
	}
	if(!file_exists($folder.$files))
	{
		mkdir($folder.$files);
	}
	if(!file_exists($folder.$js))
	{
		mkdir($folder.$js);
	}
	
	if(array_key_exists("file_name",$final_data))
	{
		$file_name="class.".$final_data['file_name'][0].".php";
	}
	else
	{
		$file_name="class.".$final_data['class_name'][0].".php";
	}
	
	file_put_contents($new_class_file_name, $str);
	rename($new_class_file_name,$folder.$include.$file_name);

	echo "Class File Creation Completed ---> Class File Name -->".$file_name."<br/>";
	
	// Start Step 2
	
	echo "Step -2 Create Form File\n<br/>";
	
	//Later it will generated from database
	// Replace page_id
	$str_form=str_replace("[[:PAGE_ID:]]",$page_id,$str_form,$count);
	
	if(array_key_exists("parent_page",$final_data))
	{
		$main_page=$final_data['parent_page'][0];
	}
	else
	{
		$main_page="dashboard";
	}
	// Replace mainpage
	$str_form=str_replace("[[:MAIN_PAGE:]]",$main_page,$str_form,$count);
	
	
	$page_slug="".strtolower(trim($final_data['class_name'][0]));
	$page_title="Add/Edit ".$final_data['class_name'][0];
	$page_description="Add/Edit ".$final_data['class_name'][0];
	$page_hierarchy="";

	// Replace page_slug
	$str_form=str_replace("[[:PAGE_SLUG:]]",$page_slug,$str_form,$count);
	// Replace page_title
	$str_form=str_replace("[[:PAGE_TITLE:]]",$page_title,$str_form,$count);
	// Replace page_description
	$str_form=str_replace("[[:PAGE_DESCRIPTION:]]",$page_description,$str_form,$count);
		
	if(array_key_exists("insert_page_hierarchy",$final_data))
	{
		
		foreach($final_data['insert_page_hierarchy'] as $c)
		{
			$c=explode("|",$c);
			if(sizeof($c)==2)
			$page_hierarchy[]='array("link"=>"'.$c[1].'","title"=>"'.$c[0].'")';			
		}
		$page_hierarchy="array(".implode(",",$page_hierarchy).")";
	}
	// Replace page_hierarchy
	$str_form=str_replace("[[:PAGE_HIERARCHY:]]",$page_hierarchy,$str_form,$count);
	
	//PAGE_CLASS
	$page_class="include('../include/".$file_name."');".PHP_EOL;
	$page_class.="$".$page_slug."_obj=new ".$final_data['class_name'][0]."();";
	
	// Replace PAGE_CLASS
	$str_form=str_replace("[[:PAGE_CLASS:]]",$page_class,$str_form,$count);
	
	
	// PAGE_VARIABLE_DEFINATION AND PAGE_VARIABLE_DECLARATION
	$column_variable_defination="";
	$column_variable_declaration="\$params=array();";
	$require_column_name="";
	$form_content="";
	$view_columns=array();
	$datatable_columns=array();
	$ajax_function_view_columns=array();
	$search_within=array();
	if((sizeof($final_data['column_name'])==sizeof($final_data['validation'])) && (sizeof($final_data['column_name'])==sizeof($final_data['add_form_component'])))
	{
			$total_input=array();
			for($i=0;$i<sizeof($final_data['column_name']);$i++)
			{
				$c=trim($final_data['column_name'][$i]);
				$validation=$final_data['validation'][$i];
				$validation_value=$final_data['validation_value'][$i];
				$validation_error_message=$final_data['validation_error_message'][$i];
				$validation_help_text=$final_data['validation_help_text'][$i];
				$form_component=$final_data['add_form_component'][$i];
				$label=$final_data['label'][$i];
				$column_variable_defination.="$".$c."='';";
				$column_variable_declaration.="\$params['".$c."']=trim(\$db->clean(\$_REQUEST['".$c."']));".PHP_EOL;
				$require_column_name.=$c.",";

				// SHOW ON VIEW ENTRY
				if(array_key_exists($i,$final_data['show_on_view']))
				{
						if($final_data['show_on_view'][$i]=='TRUE')
						{
							$view_columns[]=array("slug"=>$c,"label"=>$label);
							$datatable_columns[]='{"data":"'.$c.'"}';
							$ajax_function_view_columns[]=$c;
						}

						if($final_data['search_within'][$i]=='TRUE')
						{
							$search_within[]=$c;

						}


				}

				if($validation!="NONE")
				{
					$result=$validator->createValidation($validation,$validation_value,$validation_error_message,$validation_help_text);
					if($result['ack']==1)
					{
						$validation=$result['result'];

					}
					else
					{
						$validation="";
					}
				}
				if($form_component!="NONE")
				{
					$total_input[]=$form_component;
					$result=$input->createInput($form_component,$c,$c,"",$label,"<?php echo \$".$c."; ?>",$validation_help_text,$validation);
					if($result['ack']==1)
					{
						$form_content.=$result['result'];
					}
					else
					{
						echo $result['ack_msg'];
						exit();
					}
				}
			}
			$total_input=implode(",",array_unique($total_input));
			$required_assets=$input->getRequiredAssets($total_input);
			if($required_assets['ack']==1)
			{

				$require_js=$required_assets['result']['required_js'];
				$require_css=$required_assets['result']['required_css'];
			}
			else
			{
				$require_js="";
				$require_css="";
			}
		$require_column_name=trim($require_column_name,",");
		// Replace PAGE_VARIABLE_DEFINATION AND PAGE_VARIABLE_DECLARATION
		$str_form=str_replace("[[:PAGE_VARIABLE_DEFINATION:]]",$column_variable_defination,$str_form,$count);
		$str_form=str_replace("[[:PAGE_VARIABLE_DECLARATION:]]",$column_variable_declaration,$str_form,$count);

		
		
		// PAGE_ADD
		$page_add_logic='
		$reply=$'.$page_slug.'_obj->insert($params,array("key"=>"'.$final_data['unique_column'][0].'","value"=>$params[\''.$final_data['unique_column'][0].'\']));
		if($reply[\'ack\']==1)
		{
			$success_msg[]=$reply[\'ack_msg\'];
		}
		else
		{
			$error_msg[]=$reply[\'ack_msg\'];
		}';
		// Replace PAGE_ADD
		$str_form=str_replace("[[:PAGE_ADD:]]",$page_add_logic,$str_form,$count);
		
		
		// PAGE_EDIT
		$page_edit_logic='
		$reply=$'.$page_slug.'_obj->update($params,$params[\''.$final_data['unique_column'][0].'\'],$params[\''.$final_data['primary_column'][0].'\']);
		if($reply[\'ack\']==1)
		{
			$success_msg[]=$reply[\'ack_msg\'];
		}
		else
		{
			$error_msg[]=$reply[\'ack_msg\'];
		}';
		// Replace PAGE_EDIT
		$str_form=str_replace("[[:PAGE_EDIT:]]",$page_edit_logic,$str_form,$count);
		
		// PAGE_VARIABLE_FETCHING_LOGIC
		$page_view_logic='
		$'.$final_data['primary_column'][0].'=trim($db->clean($_REQUEST[\''.$final_data['primary_column'][0].'\']));'. PHP_EOL .'
		$reply=$'.$page_slug.'_obj->view("'.$final_data['primary_column'][0].'=\'".$'.$final_data['primary_column'][0].'."\'");
		if($reply[\'ack\']==1)
		{
			extract($reply[\'result\'][0]);
		}
		else
		{
			$error_msg[]=$reply[\'ack_msg\'];
		}';
		// Replace PAGE_VARIABLE_FETCHING_LOGIC
		$str_form=str_replace("[[:PAGE_VARIABLE_FETCHING_LOGIC:]]",$page_view_logic,$str_form,$count);
		
		// PAGE_DELETE_LOGIC
		$page_delete_logic='
		$reply=$'.$page_slug.'_obj->delete(array("key"=>"'.$final_data['primary_column'][0].'","value"=>$params[\''.$final_data['primary_column'][0].'\']));
		if($reply[\'ack\']==1)
		{
			extract($reply[\'result\']);
		}
		else
		{
			$error_msg[]=$reply[\'ack_msg\'];
		}';
		// Replace PAGE_DELETE
		$str_form=str_replace("[[:PAGE_DELETE:]]",$page_delete_logic,$str_form,$count);
		
		
		
		// FORM PART
		//FORM_ID
		$form_name=$form_id="form_".$page_slug;
		$str_form=str_replace("[[:FORM_ID:]]",$form_id,$str_form,$count);
		$str_form=str_replace("[[:FORM_NAME:]]",$form_name,$str_form,$count);
		$str_form=str_replace("[[:FORM_TITLE:]]",$page_title,$str_form,$count);
		$str_form=str_replace("[[:FORM_ACTION:]]","",$str_form,$count);//echo htmlspecialchars(\$_SERVER['PHP_SELF']);
		
		//FORM_CONTENT
		$str_form=str_replace("[[:FORM_CONTENT:]]",$form_content,$str_form,$count);
		$str_form=str_replace("[[:REQUIRED_CSS:]]",$require_css,$str_form,$count);
		$str_form=str_replace("[[:REQUIRED_JS:]]",$require_js,$str_form,$count);
		
		
		
		$new_form_file_name=time()."_".$sample_form_file;
		file_put_contents($new_form_file_name, $str_form);
		if(array_key_exists("form_file_name",$final_data))
		{
			$form_file_name=$final_data['form_file_name'][0].".php";
		}
		else
		{
			$form_file_name=$page_slug."_crud.php";
		}
		rename($new_form_file_name,$folder.$files.$form_file_name);

        $page_count++;
        $page_urls[]=$form_file_name;

		echo "Form File Creation Completed ---> Form File Name -->".$form_file_name."<br/>";
		
		echo "Step -3 Create JSON RETURN AJAX Function File\n<br/>";
		//Later it will generated from database
		// Replace page_id
		$str_ajax=str_replace("[[:PAGE_ID:]]",$page_id,$str_ajax,$count);
		
		
		//PAGE_CLASS
		$page_class="include('../include/".$file_name."');".PHP_EOL;
		$page_class.="$".$page_slug."_obj=new ".$final_data['class_name'][0]."();".PHP_EOL;
		
		// Replace PAGE_CLASS
		$str_ajax=str_replace("[[:PAGE_CLASS:]]",$page_class,$str_ajax,$count);
		
		
		// CREATE AJAX FUNCTION FOR VIEW WITH DATATABLE
		
		$service_slug=$page_slug."_"."view_datatable_function";
		$service_id=rand();

       //generate Unique Page ID
        $service_title=$page_slug." View Datatable Functions";
        $service_data= $db->rp_getData("api_table","id","api_slug='".$service_slug."'");
        if($service_data)
        {
            $service_data=mysql_fetch_assoc($service_data);
            $service_id=$service_data['id'];
            $db->rp_update("api_table",array("api_title"=>$service_title,"api_slug"=>$service_slug),"id='".$service_id."'");
            echo "API Already Found will be replaced <br>";
        }
        else
        {
            $service_id=$db->rp_insert("api_table",array($service_slug,$service_title),array("api_slug","api_title"),0);
            echo "New API created!!<br>";
        }

		$string_view_columns="";
		$string_search_within_columns=array();
		foreach($ajax_function_view_columns as $key=>$value)
		{
			$string_view_columns.=$key."=>\"".$value."\",";
		}
		foreach($search_within as $a)
		{
			$string_search_within_columns[]=''.$a." LIKE %\".\$requestData['search']['value'].\"% ".'';
		}
		$ajax_for_view='
			if($service=="'.$service_slug.'" || $service=='.$service_id.')
			{
				// storing  request (ie, get/post) global array to a variable
				$requestData= $_REQUEST;
				$totalData = $'.$page_slug.'_obj->count'.$final_data['class_name'][0].'("1","1");
				$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

				// Response Column Name Specify
				$columns = array(
				// datatable column index  => database column name
					'.$string_view_columns.'
				);
				// getting total number records without any search
				if( !empty($requestData[\'search\'][\'value\']) ) {
					"'.implode(" OR ",$string_search_within_columns).'";
				}
				$totalFiltered = $'.$page_slug.'_obj->count'.$final_data['class_name'][0].'("isDelete","0");
				// when there is a search parameter then we have to modify total number filtered rows as per search result.


				$order_by=$columns[$requestData[\'order\'][0][\'column\']]."   ".$requestData[\'order\'][0][\'dir\'];
				$limit=$requestData[\'start\']." ,".$requestData[\'length\']."   ";
				/* $requestData[\'order\'][0][\'column\'] contains colmun index, $requestData[\'order\'][0][\'dir\'] contains order such as asc/desc  */
				$projection=$columns;
				$data_row=$'.$page_slug.'_obj->view($condition,$projection,$order_by,$limit);
				$json_data = array(
							"draw"            => intval( $requestData[\'draw\'] ),
							// for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
							"recordsTotal"    => intval( $totalData ),  // total number of records
							"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
							"data"            => $data_row[\'result\']   // total data array
							);

				echo json_encode($json_data);
			}
			
		';
		
		// Replace PAGE_EDIT
		$str_ajax=str_replace("[[:AJAX_SERVICES:]]",$ajax_for_view,$str_ajax,$count);
		
		$new_ajax_file_name=time()."_".$sample_ajax_file;
		file_put_contents($new_ajax_file_name, $str_ajax);
		if(array_key_exists("form_ajax_name",$final_data))
		{
			$ajax_file_name=$final_data['form_ajax_name'][0].".php";
		}
		else
		{
			$ajax_file_name=$page_slug."_ajax_function.php";
		}
		rename($new_ajax_file_name,$folder.$files.$ajax_file_name);
		$page_count++;
        $page_urls[]=$ajax_file_name;

		
		echo "AJAX Function File Creation Completed ---> Function File Name -->".$ajax_file_name."<br/>";

		
		
		echo "Step -4 Create View File\n<br/>";
	
		//Later it will generated from database
		// Replace page_id
		$str_view=str_replace("[[:PAGE_ID:]]",$page_id,$str_view,$count);
		
		if(array_key_exists("parent_page",$final_data))
		{
			$main_page=$final_data['parent_page'][0];
		}
		else
		{
			$main_page="dashboard";
		}
		// Replace mainpage
		$str_view=str_replace("[[:MAIN_PAGE:]]",$main_page,$str_view,$count);
		
		
		$page_slug="".strtolower(trim($final_data['class_name'][0]));
		$page_title="Manage ".$final_data['class_name'][0];
		$page_description="Manage ".$final_data['class_name'][0];
		$page_hierarchy="";
		
		// Replace page_slug
		$str_view=str_replace("[[:PAGE_SLUG:]]",$page_slug,$str_view,$count);
		// Replace page_title
		$str_view=str_replace("[[:PAGE_TITLE:]]",$page_title,$str_view,$count);
		// Replace page_description
		$str_view=str_replace("[[:PAGE_DESCRIPTION:]]",$page_description,$str_view,$count);
			
		if(array_key_exists("view_page_hierarchy",$final_data))
		{
			
			foreach($final_data['view_page_hierarchy'] as $c)
			{
				$c=explode("|",$c);
				if(sizeof($c)==2)
				$page_hierarchy[]='array("link"=>"'.$c[1].'","title"=>"'.$c[0].'")';
			}
			$page_hierarchy="array(".implode(",",$page_hierarchy).")";
		}
		else
		{
			$page_hierarchy="array()";
		}
		// Replace page_hierarchy
		$str_view=str_replace("[[:PAGE_HIERARCHY:]]",$page_hierarchy,$str_view,$count);
		
		//PAGE_CLASS
		$page_class="include('../include/".$file_name."');".PHP_EOL;
		$page_class.="$".$page_slug."_obj=new ".$final_data['class_name'][0]."();".PHP_EOL;
		$page_class.="\$result=$".$page_slug."_obj->view();".PHP_EOL;
		
		// Replace PAGE_CLASS
		$str_view=str_replace("[[:PAGE_CLASS:]]",$page_class,$str_view,$count);
		
		
		// Creating JS For Datatable
		$str_datatable_js=str_replace("[[:TABLE_NAME:]]","#".$page_slug."_table_id",$str_datatable_js,$count);
		$str_datatable_js=str_replace("[[:COLUMNS:]]",implode(",",$datatable_columns),$str_datatable_js,$count);
		$str_datatable_js=str_replace("[[:SERVICE_URL:]]",'"'.$ajax_file_name.'"',$str_datatable_js,$count);
		$str_datatable_js=str_replace("[[:SERVICE_DATA:]]",'data:{s:"'.$service_slug.'",key:1226}',$str_datatable_js,$count);
		$new_datatable_js_file_name=time()."_".$sample_form_file;
		file_put_contents($new_datatable_js_file_name, $str_datatable_js);

		if(array_key_exists("datatable_js_file_name",$final_data))
		{
			$datatable_js_file_name=$final_data['datatable_js_file_name'][0].".php";
		}
		else
		{
			$datatable_js_file_name=$page_slug."_datatable.js";
		}
		rename($new_datatable_js_file_name,$folder.$js.$datatable_js_file_name);
		$require_css=' <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
       ';
        $require_js='<script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        ';
		$include_js_file_for_datatable=$require_js.PHP_EOL.'<script src="js/'.$datatable_js_file_name.'" type="text/javascript"></script>';
		// PUT VIEW Content
		$view_page=$view->createView($view_columns,$page_slug."_table_id",$page_slug."_table_class");
		$str_view=str_replace("[[:PAGE_CONTENT:]]",$view_page['result']['content'],$str_view,$count);
		$str_view=str_replace("[[:REQUIRED_CSS:]]",$require_css,$str_view,$count);
		$str_view=str_replace("[[:REQUIRED_JS:]]",PHP_EOL.$include_js_file_for_datatable,$str_view,$count);
		$new_view_file_name=time()."_".$sample_form_file;
		file_put_contents($new_view_file_name, $str_view);
		
		if(array_key_exists("view_file_name",$final_data))
		{
			$view_file_name=$final_data['view_file_name'][0].".php";
		}
		else
		{
			$view_file_name=$page_slug."_manage.php";
		}
		rename($new_view_file_name,$folder.$files.$view_file_name);
        $page_count++;
        $page_urls[]=$view_file_name;

		echo "View File Creation Completed ---> View File Name -->".$view_file_name."<br/>";



        //Update Page Table Entry with actual page count and Page URLS
        $isPageEntryUpdated=$db->rp_update("page_table",array("page_count"=>$page_count,"page_urls"=>implode(",",$page_urls),"adate"=>date("Y-m-d H:i:s")),"id='".$page_id."'");
        if($isPageEntryUpdated)
        {
            echo "Page Table Entry Updated!! You are done here move all files to desitination that's it!!";
        }
        else
        {
            echo "Sorry we can't reach to page table please enter page count and page urls manually!!";
        }
    }

	else
	{
		echo "Form Component and validation data not matched!!<br/>";
		exit();
	}

}
else
{
	echo "Class File Creation Failed \n Process Terminated!!";
	print_r($error);
}
?>