<?php
error_reporting(0);
include("../include/define.php");
include("../include/function.class.php");

$db = new Functions();
$conn = $db->connect();

$where		= " email='".$db->clean($_REQUEST['admin_mail'])."' ";
$ctable_r 	= $db->rp_getData(CTABLE_ADMIN,"*",$where);
if(mysql_num_rows($ctable_r)>0){
	$ctable_d 	= mysql_fetch_array($ctable_r);
	$username 	= $ctable_d['username'];
	
	$random1 	= substr(md5(rand()), 0, rand(1,6));
	$random2 	= substr(md5(rand()), 0, rand(1,7));
	$random3 	= substr(md5(rand()), 0, rand(1,6));
	$random4 	= substr(md5(rand()), 0, rand(1,8));
	$fps		= rand(0,2).$random1.rand(0,3).$random2.rand(0,1).$random3.rand(0,3).$random4;
	$rows 		= array("forgot_pass_string"=>$fps);
	
	$where		= "id=1";
	$db->rp_update(CTABLE_ADMIN,$rows,$where);
	
	$toPrimary	= $ctable_d['email'];
	//$to 		= "rjpatel2290@gmail.com";
	$subject	= ADMINTITLE." Password Recovery";
	$body		= "Hello $username,<br>
	
	Please click on the link for password recovery.<br>
	<a href='".ADMINSITEURL."/forgot-password.php?f=".$fps."' >Click Here
</a>
	<br>
	Thank You
	";
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".SITENAME." <".ADMIN_EMAIL.">" ."\r\n";
	
	mail($toPrimary,$subject,$body,$headers);
	$db->rp_location("index.php?msg=1");
}else{
	$db->rp_location("index.php?msg=2");
}
?>