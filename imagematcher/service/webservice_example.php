<?php 
// Which service requested is given in params named "service"
// Response Structure given below.
/* $ack=array(
			"ack"=>1/0,(1= success,0=failure)
			"ack_msg"=>"Message will printed on View",("This message will be shown to user so make it user readable not for developers")
			"developer_msg"=>"Message for debugging",("This message will be shown to developer on debug mode")
			"extra"=>array("requested_params"=>$_REQUEST,"other"=>array()),"Extra field contains requested params array which returns all the requested params and other array will contains extra params which you want to show on debug mode"
		)
	echo json_encode($ack);
	
*/
$service=$_REQUEST['s'];// give every service to one unique number or slug to identify which service is for which task
if($service=='get_task' || $service==1)
{
	
	$tasks=//code goes here ---> get task from database in array 
	$ack=array( "ack"=>1,
		"ack_msg"=>"Successfully loaded from server!!",
		"developer_msg"=>"You got it!!",
		"result"=>$tasks,
		"extra"=>array("requested_params"=>$_REQUEST,
						"other"=>array())
	);
	echo json_encode($ack);
	
}
else if($service=='other_service'|| $service==2)
{
	// Code for another service..
}
else if($service=='one_more_service'|| $service==3)
{
	// Code for another one service..
}
else
{
	$ack=array( "ack"=>0,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"Check your Service Key or contact Service Handler ",
				"extra"=>array("requested_params"=>$_REQUEST,
								"other"=>array())
			);
	$db->printJSON($ack);
}
			
	
?>