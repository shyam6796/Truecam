<?php
$page_id=402;
$page_slug="login";
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
include("../include/define.php");
include("../include/function.class.php");
	
$db = new Admin();
$conn = $db->connect();

$last_login = date('Y-m-d H:i:s');
$last_ip 	= $db->rp_get_client_ip();

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
}

if((isset($_SESSION[SITE_SESS.'_ADMIN_SESS_ID']) && $_SESSION[SITE_SESS.'_ADMIN_SESS_ID']>0)){
	$db->rp_location("dashboard.php");
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
		<title>Login | <?php echo SITETITLE; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="../assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="../assets/pages/img/logo-big.png" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="password.php" method="post" onSubmit="return check_form();">
                <h3 class="form-title">Login to your account</h3>
                
				
				
				<?php
					// Login Fail Messages Start 
					if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="0"){
					?>
						<div class="alert alert-danger">
							<button class="close" data-close="alert"></button>
							<span>Incorrect Username OR Password. </span>
						</div>
					<?php
					}else if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="1"){
					?>
						<div class="alert alert-success">
							<button class="close" data-close="alert"></button>
							<span>Login detail has been sent successfully. Please check your mail box. </span>
						</div>
					<?php
					}else if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="3"){
					?>
						<div class="alert alert-success">
							<button class="close" data-close="alert"></button>
							<span>Password updated successfully. </span>
						</div>    
					<?php
					}else if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="4"){
					?>
						<div class="alert alert-success">
							<button class="close" data-close="alert"></button>
							<span>Something went wrong. Please try again. </span>
						</div>    
					<?php
					}
					
					// Login Fail Messages End
					?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username" /> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password" /> </div>
                </div>
                <div class="form-actions">                    
                    <button type="submit" class="btn green pull-right"> Login </button>
                </div>               
                <div class="forget-password">
                    <h4>Forgot your password ?</h4>
                    <p> No worries, click
                        <a href="javascript:;" id="forget-password"> here </a> to reset your password. </p>
                </div>                
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="pass-recover.php" method="post" onSubmit="return check_form2();">
                <h3>Forget Password ?</h3>
				<?php
					if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="2"){
					?>
						<div class="alert alert-danger">
							<button class="close" data-close="alert"></button>
							<span>Invalid Email-Id. </span>
						</div>    
					<?php
					}
					?>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"  name="admin_mail" id="admin_mail" /> </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn red btn-outline">Back </button>
                    <button type="submit" class="btn green pull-right"> Submit </button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->           
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"> 2016 &copy; <?php echo SITETITLE ?> by FRIENDFILL </div>
        <!-- END COPYRIGHT -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/login-4.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
		<!-- CUSTOM -->
		<script>
		<?php
		if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="2"){
		?>
			$(document).ready(function() {
				$("#forget-password").trigger("click");
			});
		<?php
		}
		?>
		</script>
		<script>
		function check_form()
		{
			if($("#username").val()=="" || $("#username").val().split(" ")==""){
				$("#username").focus();
				return false;
			}
			if($("#password").val()=="" || $("#password").val().split(" ")==""){
			
			$("#password").focus();
			return false;
			}
		}
		
		function check_form2()
		{
			if($("#admin_mail").val()=="" || $("#admin_mail").val().split(" ")==""){
				alert("Please enter email.");
				$("#admin_mail").focus();
				return false;
			}
			else
			{
				if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#admin_mail").val()))
				{  
				 
				}
				else
				{
					alert("Please enter valid email.");
					$("#admin_mail").focus();
					return false;
				}
			}
		}
		</script>
    </body>

</html>