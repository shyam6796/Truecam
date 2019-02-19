<?php
header('Content-Type: application/json');
//error_reporting(0);
session_start();
date_default_timezone_set('Asia/Kolkata');
include("../include/define.php");
include("../include/function.class.php");
require_once("../include/notification.class.php");
$db = new Functions();
$conn = $db->connect();
$rights=$_SESSION['rights']=array("insert_flag"=>1,"view_flag"=>1,"update_flag"=>1,"delete_flag"=>1); 
if(isset($_REQUEST[API_PARAM]) && $_REQUEST[API_PARAM]!="")
{
	$is_valid_api_key=$db->checkAPIKey($db->clean($_REQUEST[API_PARAM]));
	if(isset($_REQUEST[SERVICE_PARAM]) && $_REQUEST[SERVICE_PARAM]!="")
	{
		$is_valid_service=$db->checkAPI($db->clean($_REQUEST[SERVICE_PARAM]));
		if($is_valid_service)
		{
			$is_valid_service=true;
			$service=$_REQUEST[SERVICE_PARAM];
		}
		else
		{
			$is_valid_service=false;
			$service="";
		}
		
	}
	else
	{
		$is_valid_service=false;
		$service="";
	}	

}
else
{
	$is_valid_api_key=false;
}	

?>