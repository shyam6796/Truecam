<?php
$page_id=401;
include("connect.php");
require_once(":classs_file");
$page_title	= ":page_name";
$page_hierarchy=:page_hierarchy;

// Create Object of Class 
$obj=new :class_name;
// For Submit
:form_variable
if(isset($_REQUEST['submit'])){

	:collect_form_data
	if(isset($_REQUEST['mode']) && $_REQUEST['mode']=="add")
	{
		
		if($rights['insert_flag']!=1)
		{
			$db->rp_location('access_denied.php?msg=insert_access_denied');
		}
	
		$reply=$obj->insert($detail,:dup_check_array);
		if($reply['ack']==1)
		{
			$db->rp_location(:success_redirect_url);	
		}
		else
		{
			$db->rp_location(:fail_redirect_url);
		}
		
	}
	else if(isset($_REQUEST['mode']) && $_REQUEST['mode']=="edit")
	{
		
		if($rights['update_flag']!=1)
		{
			$db->rp_location('access_denied.php?msg=update_access_denied');
		}
		
		$reply=$obj->update($detail,:primary_key);
		if($reply['ack']==1)
		{
			$db->rp_location(:success_redirect_url);	
		}
		else
		{
			$db->rp_location(:fail_redirect_url);
		}
	}
}

if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="edit"){
	
	if($rights['update_flag']!=1)
	{
		$db->rp_location('access_denied.php?msg=update_access_denied');
	}
	
	$detail=$obj->view(":primary_key='".$_REQUEST['id']."'");
	if($detail['ack']==1)
	extract($detail);
	
}
if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="delete"){
	
	if($rights['delete_flag']!=1)
	{
		$db->rp_location('access_denied.php?msg=delete_access_denied');
	}
	
	$reply=$obj->delete(array("key"=>".:primary_key.","value=>'".$_REQUEST['id']."'");
	if($reply['ack']==1)
	{
		$db->rp_location(:success_redirect_url);	
	}
	else
	{
		$db->rp_location(:fail_redirect_url);
	}
}
if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="isActive" && isset($_REQUEST['status'])  && $_REQUEST['status']!=""){
	$reply=$obj->(array("isActive",$_REQUEST['status']),:primary_key);
	if($reply['ack']==1)
	{
		$db->rp_location(:success_redirect_url);	
	}
	else
	{
		$db->rp_location(:fail_redirect_url);
	}
}
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
		:include_css	
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
                        <h1 class="page-title"> :page_name
                            <small>:sub_page_name</small>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
							<div class="col-md-12">
								<?php 
								if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="1"){
									?>			
									<div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i>
										<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
										<b>Success! </b>:success_msg
									</div>
									<?php
									}else if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="2"){
									?>
									<div class="alert alert-danger alert-dismissable"> <i class="fa fa-ban"></i>
										<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
										<b>Error! </b>:fail_msg

									</div>
									<?php
									}
									?>
							</div>
                            <div class="col-md-12">
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">:page_name</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">
                                                       :tabs                                                  
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                           <form role="form" action="" name=":form_name" onSubmit="return check_form();" method="post">
                                                                :form_control
                                                                <div class="margiv-top-10">
                                                                    <button type="submit" name="submit" class="btn green"> Save Changes </button>&nbsp;
                                                                    <a class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>                       
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
                 <?php include('rightbar.php'); ?>
            </div>
            <!-- END CONTAINER -->
             <?php include('footer.php'); ?>
        </div>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
		 <?php include('include_js.php');?>
		:include_js	
		
    </body>
</html>	