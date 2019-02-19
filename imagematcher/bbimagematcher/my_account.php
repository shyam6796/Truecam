<?php
$page_id=401;
include("connect.php");
$main_page 	= "my_account";
$page 		= "my_account";
$page_title	= "My Account";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"Home"),array("link"=>"my_account.php","title"=>"Profile"));
$success_msg=array();
$error_msg=array();
// For Submit
$name		= "";
$username		= "";
$email			= "";
$mobile_no			= "";
$interest			= "";
$occupation			= "";
$about			= "";
$website			= "";
$twitter			= "";
$facebook			= "";
if(isset($_REQUEST['submit'])){

	echo $detail['name']		= addslashes(trim($_REQUEST['name']));
	
	$detail['username']	= addslashes(trim($_REQUEST['username']));
	$detail['email']		= trim($_REQUEST['email']);
	$detail['mobile_no']		= trim($_REQUEST['mobile_no']);
	$detail['interest']		= trim($_REQUEST['interest']);
	$detail['occupation']		= trim($_REQUEST['occupation']);
	$detail['about']		= 	trim($_REQUEST['about']);
	$detail['website']		= trim($_REQUEST['website']);
	$detail['twitter']		= trim($_REQUEST['twitter']);
	$detail['facebook']		= trim($_REQUEST['facebook']);
	
	$reply=$db->update($detail,$_SESSION[SITE_SESS.'_ADMIN_SESS_ID']);
	if($reply['ack']==1)
	{
		$_SESSION['SESS_NAME'] = $name;
		echo $success_msg[]=$reply['ack_msg'];
		//$db->rp_location("my_account.php?msg=1");
	}
	else
	{
		$error_msg[]=$reply['ack_msg'];
		$db->rp_location("my_account.php?msg=0");	
	}
}

if(isset($_REQUEST['profile_picture_submit']))
{
	if(isset($_SESSION[SITE_SESS.'_ADMIN_SESS_ID']) && $_SESSION[SITE_SESS.'_ADMIN_SESS_ID']!="")
	{
		$id=$_SESSION[SITE_SESS.'_ADMIN_SESS_ID'];
		require_once("../include/class.media.php");
		$media=new Media();
		$detail=array('url'=>$_FILES['file']['name'],'title'=>"",'media_type'=>"0",'reference_type'=>"user_profile_picture",'reference_id'=>$id);
		
		$reply=$media->addMedia($detail,$_FILES);
		if($reply['ack']==1)
		{
			
			// Update Reference Id in Admin Table
			 $media_reference_id=$reply['media_id'];
			 $update=$db->update($detail=array("image_path"=>$media_reference_id),$id);
			 if($update['ack']==1)
			 {
				 $success_msg[]="Avatar Changed Successfully";
			 }
			 else
			 {
				$error_msg= array_merge($error_msg,$update['error']);
			 }
			
		}
		else
		{
			 array_merge($error_msg,$reply['error']);	
		}
		
	}
	else
	{
		$error_msg[]="Sorry!! Something went wrong !!";
	}
}
if(isset($_REQUEST['submit1'])){

	$where = " id='".$_SESSION[SITE_SESS.'_ADMIN_SESS_ID']."'";
	$admin_r = $db->rp_getData(CTABLE_ADMIN,"*",$where);
	$admin_d = mysql_fetch_array($admin_r);
		
	$old_password		= $admin_d['password'];
	
	$opassword		= md5(trim($_REQUEST['opassword']));
	$password		= md5(trim($_REQUEST['password']));
	
	if($old_password!=$opassword){
		$error_msg[]="Password not matched!!";
		$db->rp_location("my_account.php?msg=2");
	}else{
		$rows 	= array("password"=>$password);
		
		$where	= "id='".$_SESSION[SITE_SESS.'_ADMIN_SESS_ID'] ."'";
		$db->rp_update(CTABLE_ADMIN,$rows,$where);
		$success_msg[]="Password successfully changed!!";
		$db->rp_location("my_account.php?msg=1");
	}
		
}

$where = " id='".$_SESSION[SITE_SESS.'_ADMIN_SESS_ID'] ."'";
$admin_r = $db->rp_getData(CTABLE_ADMIN,"*",$where);
$admin_d = mysql_fetch_array($admin_r);

$id				= $admin_d['id'];
$name			= $admin_d['name'];
$username		= $admin_d['username'];
$email 			= $admin_d['email'];
$interest 		= $admin_d['interest'];
$occupation 	= $admin_d['occupation'];
$mobile_no 		= $admin_d['mobile_no'];
$about 			= $admin_d['about'];
$website 			= $admin_d['website'];
$twitter			= $admin_d['twitter'];
$facebook			= $admin_d['facebook'];

?>
<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo SITETITLE; ?> | User Profile | Account</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php include("include_css.php");?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="../assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white page-md">
        <div class="page-wrapper">
			<?php include("top.php");?>
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
			   <?php include('sidebar.php'); ?>	
			   <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->                        
                        <?php $system->changeThemeMenu();?>
                        <?php $system->pageBar($page_hierarchy);?> 
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Profile | Account
                            <small>user account page</small>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
							<div class="col-md-12">
								<?php 
								if(!empty($success_msg)){
									?>			
									<div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i>
										<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
										<?php 
										foreach($success_msg as $s)
										{
										?>
										<b>Success! </b><?php echo $s; ?>
										<?php }?>
									</div>
									<?php
								    }
									if(!empty($error_msg)){
									?>
									<div class="alert alert-danger alert-dismissable"> <i class="fa fa-ban"></i>
										<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
										<?php 
										foreach($error_msg as $e)
										{
										?>
										<b>Error! </b><?php echo $e; ?>
										<?php 
										}
										?>
									</div>
									<?php
									}
									?>
							</div>
                            <div class="col-md-12">
                                <!-- BEGIN PROFILE SIDEBAR -->
                                <div class="profile-sidebar">
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light profile-sidebar-portlet ">
                                        <!-- SIDEBAR USERPIC -->
                                        <div class="profile-userpic">
                                            <img src="<?php echo $loggedInUser['image_path']?>" class="img-responsive" alt=""> </div>
                                        <!-- END SIDEBAR USERPIC -->
                                        <!-- SIDEBAR USER TITLE -->
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> <?php echo $loggedInUser['name']?> </div>
                                            <div class="profile-usertitle-job"> <?php echo ($loggedInUser['occupation']!="")?$loggedInUser['occupation']:"-"?> </div>
											<br/>
                                        </div>
                                        <!-- END SIDEBAR USER TITLE -->                                                                               
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light ">
                                        <!-- STAT -->
                                        <div class="row list-separated profile-stat">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="uppercase profile-stat-title"> <?php echo $loggedInUser['countFollower']; ?></div>
                                                <div class="uppercase profile-stat-text"> Followers </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="uppercase profile-stat-title"> <?php echo $loggedInUser['countFollowing']; ?> </div>
                                                <div class="uppercase profile-stat-text"> Followings </div>
                                            </div>                                            
                                        </div>
                                        <!-- END STAT -->
                                        <div>
											
                                            <h4 class="profile-desc-title">About <?php echo $loggedInUser['name']; ?></h4>
                                            <span class="profile-desc-text"><?php echo ($loggedInUser['about']!="")?$loggedInUser['about']:"-"?></span>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-globe"></i>
                                                <a href="<?php echo ($loggedInUser['website']!="")?$loggedInUser['website']:"#"?>"><?php echo ($loggedInUser['website']!="")?$loggedInUser['website']:"-"?></a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-twitter"></i>
                                                <a href="<?php echo ($loggedInUser['twitter']!="")?"http://www.twitter.com/".$loggedInUser['twitter']:"#"?>"><?php echo ($loggedInUser['twitter']!="")?"@".$loggedInUser['twitter']:"-"?></a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-facebook"></i>
                                                <a href="<?php echo ($loggedInUser['twitter']!="")?"http://www.facebook.com/".$loggedInUser['facebook']:"#"?>"><?php echo ($loggedInUser['facebook']!="")?"@".$loggedInUser['facebook']:"-"?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                </div>
                                <!-- END BEGIN PROFILE SIDEBAR -->
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                        </li>                                                       
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                           <form role="form" action="" onSubmit="return check_form();" method="post">
                                                                <div class="form-group">
                                                                    <label class="control-label">Name</label>
                                                                    <input name="name" id="name" type="text" placeholder="Your Name" value="<?php echo $loggedInUser['name']; ?>" class="form-control" /> 
																	<p class="help-block"></p>
																	</div>
																	
																<div class="form-group">
                                                                    <label class="control-label">User Name</label>
                                                                    <input name="username" id="username" type="text" placeholder="Your User Name" value="<?php echo $loggedInUser['username']; ?>" class="form-control" /> 
																	<p class="help-block"></p>
																	</div>

																<div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input name="email" id="email" type="text" placeholder="Your Name" value="<?php echo $loggedInUser['email']; ?>" class="form-control" /> 
																	<p class="help-block"></p>
																	</div>		
                                                              
                                                                <div class="form-group">
                                                                    <label class="control-label">Mobile Number</label>
                                                                    <input name="mobile_no" id="mobile_no" type="text" placeholder="Mobile Number" value="<?php echo $loggedInUser['mobile_no']; ?>" class="form-control" />
																<p class="help-block"></p>
																	</div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Interests</label>
                                                                    <input name="interest" id="interest" type="text" value="<?php echo $loggedInUser['interest']; ?>" placeholder="Design, Web etc." class="form-control" /> 
																	<p class="help-block"></p>
																	</div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Occupation</label>
                                                                    <input name="occupation" id="occupation" type="text" placeholder="E.g. Web Developer" value="<?php echo $loggedInUser['occupation']; ?>" class="form-control" />
																	<p class="help-block"></p>
																	</div>
                                                                <div class="form-group">
                                                                    <label class="control-label">About</label>
                                                                    <textarea name="about" value="about" class="form-control" rows="3" placeholder="Two Words Please!!"><?php echo $loggedInUser['about']; ?></textarea>
																	<p class="help-block"></p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Website Url</label>
                                                                    <input name="website" id="website"  type="text" placeholder="http://www.mywebsite.com" value="<?php echo $loggedInUser['website']; ?>" class="form-control" /> 
																	<p class="help-block"></p>
																	</div>
																<div class="form-group">
                                                                    <label class="control-label">Twitter Id</label>
                                                                    <div class="input-group input-group-sm">
																	<span id="sizing-addon1" class="input-group-addon">http://www.twitter.com/</span>
																	<input type="text" name="twitter" id="twitter" placeholder="Twitter id" value="<?php echo $loggedInUser['twitter']; ?>" class="form-control" /><p class="help-block"></p></div></div>
																	<div class="form-group">
                                                                    <label class="control-label">Facebook ID</label>
                                                                    <div class="input-group input-group-sm">
																	<span id="sizing-addon1" class="input-group-addon">http://www.facebook.com/</span>
																	<input type="text" name="facebook" id="facebook" placeholder="Facebook id" value="<?php echo $loggedInUser['facebook']; ?>" class="form-control" /><p class="help-block"></p> </div>
																	</div>
                                                                <div class="margiv-top-10">
                                                                    <button type="submit" name="submit" class="btn green"> Save Changes </button>&nbsp;
                                                                    <a class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                        <!-- CHANGE AVATAR TAB -->
                                                        <div class="tab-pane" id="tab_1_2">
                                                            <p> Change your avatar.</p>
                                                            <form action="" enctype="multipart/form-data" method="post" role="form" onSubmit="return check_profile_picture()">
                                                                <div class="form-group">
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Select image </span>
                                                                                <span class="fileinput-exists"> Change </span>
                                                                                <input type="file" name="file"> </span>
                                                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix margin-top-20">
                                                                        <span class="label label-danger">NOTE! </span><br/><br/>
                                                                        <span class="margin-top-20">Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                                    </div>
                                                                </div>
                                                                <div class="margin-top-10">
                                                                    <button type="submit" name="profile_picture_submit" class="btn green"> Submit </button>&nbsp;
                                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE AVATAR TAB -->
                                                        <!-- CHANGE PASSWORD TAB -->
                                                        <div class="tab-pane" id="tab_1_3">
                                                            <form role="form" action="" onSubmit="return check_form2();" method="post">
                                                                <div class="form-group">
                                                                    <label class="control-label">Current Password</label>
                                                                    <input name="opassword" id="opassword" type="password" class="form-control" /><p class="help-block"></p></div>
                                                                <div class="form-group">
                                                                    <label class="control-label">New Password</label>
                                                                    <input type="password" name="password" id="password" class="form-control" /> <p class="help-block"></p></div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Re-type New Password</label>
                                                                    <input type="password" class="form-control"  name="cpassword" id="cpassword" /> 
																	<p class="help-block"></p>
																	</div>
																	
                                                                <div class="margin-top-10">
                                                                     <button name="submit2" type="submit" class="btn green"> Change Password </button>&nbsp;
                                                                    <a class="btn default"> Cancel </a>
																	
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE PASSWORD TAB -->                                                              
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
             <?php include('footer.php'); ?>
        </div>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
		 <?php include('include_js.php');?>
      <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
         <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/profile.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
		function check_profile_picture()
		{
			var isValid=true;
			$(".form-body").children().removeClass("has-error");
			if($("input[name=profile_picture]").val()=="" || $("input[name=profile_picture]").val().split(" ").join("")==""){
				toastr.error('Please select profile picture!!','Error!!');
				isValid=false;
			}
			
			if(isValid)
			{
				return true;
			}			
			else
			{
				return false;
			}
		}
		function check_form()
		{			
			var isValid=true;
			$(".form-body").children().removeClass("has-error");
			if($("#name").val()=="" || $("#name").val().split(" ").join("")==""){
				aj.error('name','Please enter full name!!','add_error');
				isValid=false;
			}
			if($("#email").val()=="" || $("#email").val().split(" ").join("")==""){
				aj.error('email','Please enter email!!','add_error');
				isValid=false;
			}
			else{
					if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())){    
					}else{
						aj.error('email','Please enter valid email!!','add_error');						
						isValid=false;
					}
				}			
			
			if(isValid)
			{
				return true;
			}			
			else
			{
				return false;
			}
		}
		function check_form2(){
			if($("#opassword").val()=="" || $("#opassword").val().split(" ").join("")==""){
				aj.error("opassword","Please enter current password.","add_error");
				isValid=false;
			}
			if($("#password").val()=="" || $("#password").val().split(" ").join("")==""){
				aj.erro("password","Please enter new password.","add_error");
				isValid=false;
			}
			if($("#cpassword").val()=="" || $("#cpassword").val().split(" ").join("")==""){
				aj.error("cpassword","Please enter confirm password.","add_error");
				
				isValid=false;
			}
			if($("#password").val()!=$("#cpassword").val()){
				aj.error("cpassword","New password and Confirm password must be matched.","add_error");
				isValid=false
			}
			if(isValid)
			{
				return true;
			}			
			else
			{
				return false;
			}
		}
		</script>
    </body>
</html>