<?php 
include('validator.class.php');
include('input.class.php');
$validator=new Validation();
$input=new Input();
$result=$validator->createValidation("length,date","min20,dd-mm-yyyy","Enter atleast 20 Character","Enter 20 Character");
if($result['ack']==1)
{
	$validation=$result['result'];
}
else
{
	$validation="";
}
$result=$input->createInput("datepicker","name","name","","Name","Enter name",$validation);
if($result['ack']==1)
{
	echo $result['result'];
}
else
{
	echo $result['ack_msg'];
}
$result=$input->getRequireAssets("text,datepicker,timepicker,datetimepicker");
if($result['ack']==1)
{
	echo $result['result']['required_css'];
	echo $result['result']['required_js'];
	
}
else
{
	echo $result['ack_msg'];
}
?>