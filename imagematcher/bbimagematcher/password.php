<?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Kolkata');
include("../include/define.php");
include("../include/function.class.php");

$db = new Admin();
$conn = $db->connect();

$last_login = date('Y-m-d H:i:s');
$last_ip 	= $db->rp_get_client_ip();

//$toadmin = "rjpatel2290@gmail.com";
$toadmin = $db->rp_getValue(CTABLE_ADMIN,"email","id=1");

$scheck_where = " ip='".$last_ip."' AND attempts>3 AND status='1' ";
$scheck_res = $db->rp_getData("security","*",$scheck_where);

if(mysql_num_rows($scheck_res)>0){
	//404
	$fail_data 	= mysql_fetch_array($scheck_res);
	$attempts 	= $fail_data['attempts'];
	$attempts++;
	$rows 	= array(
			"attempts"=>$attempts,
			"ltime"=>$last_login
			);

	$where3	= "ip='".$last_ip."'";
	$db->rp_update("security",$rows,$where3);
	$db->rp_location(SITEURL."404/");
}else{
	
	$where = " username='".mysql_real_escape_string($_REQUEST['username'])."' and password='".md5(mysql_real_escape_string($_REQUEST['password']))."' ";
	
	$res = $db->rp_getData(CTABLE_ADMIN,"*",$where);
	if(mysql_num_rows($res)>0){
		
		$res_d = mysql_fetch_array($res);
		
		$_SESSION[SITE_SESS.'_ADMIN_SESS_ID'] 	= $res_d['id'];
		$_SESSION['SESS_NAME'] 	= stripslashes($res_d['name']);
		
		$db->rp_update(CTABLE_ADMIN,array("last_login"=>$last_login),"id=1");
		
		$where2 = " ip='".$last_ip."'";
		$res2 = $db->rp_getData("security","*",$where2);
		if(mysql_num_rows($res2)>0){
			$data2 = mysql_fetch_array($res2);
			$attempts = $data2['attempts'];
		}else{
			$attempts = 0;
		}
		
		if($attempts<=3){
			
			$where4 = " ip='".$last_ip."'";
			$res4 = $db->rp_getData("security","*",$where4);
			if(mysql_num_rows($res4)>0){
				$where5 = " ip='".$last_ip."'";
				$db->rp_delete("security",$where5);
			}
			
			$rows 	= array("last_login"=>$last_login,"last_ip"=>$last_ip);
			$where	= "id='".$res_d['id']."'";
			$db->rp_update(CTABLE_ADMIN,$rows,$where);
			
			
			$mail_body = "Dear Admin,
			
Your system is accessed successfully. Please see the details.

IP - ".$last_ip."
Time - ".$last_login."

If it is trusted source, the system is safe. If you are unaware about the IP address, please investigate and act accordingly.

It is system generated mail. Please do not reply.
";
			$from_name = SITENAME;
			$from_mail = ADMIN_EMAIL;

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "From: $from_name <".$from_mail.">" ."\r\n";
			$headers .= "reply-to:	".$from_mail;
			
			//mail($toadmin,"User Logged in Successfully on ".SITENAME."",$mail_body,$headers);
			
			if(isset($_REQUEST['from']) && $_REQUEST['from']!=""){
				$db->rp_location($_REQUEST['from']);
			}else{
				$db->rp_location("dashboard.php");
			}
		}else{
			$db->rp_location("index.php?msg=1");
		}
	}else{
		$last_login = date('Y-m-d H:i:s');
		$last_ip 	=  $db->rp_get_client_ip();
		
		$where22 = " ip='".$last_ip."'";
		$res22 = $db->rp_getData("security","*",$where22);
		if(mysql_num_rows($res22)>0){
			//update
			$data22 = mysql_fetch_array($res22);
			$cattempts = $data22['attempts'];
			$attempts = $data22['attempts'];
			$attempts++;
			
			if($cattempts>3){
				$rows 	= array(
						"attempts"=>$attempts,
						"ltime"=>$last_login,
						"status"=>"1"
						);
			
				$where3	= "ip='".$last_ip."'";
				$db->rp_update("security",$rows,$where3);
				
				//mail
				$mail_body = "Dear Admin,
				
3 failed attempts of login have been made from unknown source. Please review the details.

IP - ".$last_ip."
Time - ".$last_login."

Your system might be at risk. The id is blocked as of now, if it a trusted source (in some instances when user forgot the password) please unblock the user from the utility function of the system. 

It is system generated mail. Please do not reply.
";
				$from_name = SITENAME;
				$from_mail = ADMIN_EMAIL;
	
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= "From: $from_name <".$from_mail.">" ."\r\n";
				$headers .= "reply-to:	".$from_mail;
				
				//mail($toadmin,"Login Attempt Failure on ".SITENAME."",$mail_body,$headers);
				$db->rp_location(ADMINSITEURL."?msg=0");
			
			}else{
				$rows 	= array("attempts"=>$attempts,"ltime"=>$last_login);
				$where3	= "ip='".$last_ip."'";
				$db->rp_update("security",$rows,$where3);
				
				$db->rp_location(ADMINSITEURL."?msg=0");
			}
			
		}else{
			//insert
			$rows 	= array("ip","ltime","attempts","status");
			$values = array($last_ip,$last_login,"1","0");
			$application_id  = $db->rp_insert("security",$values,$rows);
			
			$db->rp_location(ADMINSITEURL."?msg=0");
		}
	}
	
}
?>