<?php
$page_id="517";
include("connect.php");

// PAGE DECLARATION
$main_page 	= "dashboard";
$page 		= "Department";
$page_title	= "Add/Edit Department";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"dashboard"),array("link"=>"department_manage.php","title"=>"Manage Department"),array("link"=>"department_crud.php","title"=>"Add/Edit Department"));
$success_msg=array();
$error_msg=array();
// PAGE DECLARATION

// INCLUDE CLASS
include('../include/class.department.php');

$department_obj=new Department();
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:"a";

// Variable Definations
$id='';;$name='';

if(isset($_REQUEST['submit'])){
	
	// Variable Declaration
	// GET SUBMITTED FORM VALUES
$params=array();
if(isset($_REQUEST['id']))
$params['id']=trim($db->clean($_REQUEST['id']));
$params['name']=trim($db->clean($_REQUEST['name']));

	if($mode=='a')
	{
	
	    $reply=$department_obj->insert($params,array("key"=>"name","value"=>$params['name']));
		//print_r($reply);exit;
		if($reply['ack']==1)
		{
			$success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
			$db->rp_location("department_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='e')
	{
		$reply=$department_obj->update($params,$params['id'],$params['id']);
		if($reply['ack']==1)
		{
			$success_msg[]=$reply['ack_msg'];
			$_SESSION['success_msg']= $success_msg;
            $db->rp_location("department_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='d')
	{
		$params['id']=$_REQUEST['id'];
		$detail=array("isDelete"=>"1");
		//print_r($detail);exit;
		$reply=$department_obj->delete(array("key"=>"id","value"=>$params['id']),$detail);
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("department_manage.php");
		}
		else
		{
		    $error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("department_manage.php");
		}
	}
	else if($mode=='ac')
	{
	   //
        $params['isActive']=$_REQUEST['status'];
		$reply=$department_obj->active(array("key"=>"id","value"=>$params['id'],"status"=>$params['isActive']));
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']=$success_msg;
            $db->rp_location("department_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
          
		}
	}
}

if($mode=="e")
{

	// GET REQUIRED VALUE FROM DATABASE

	$id=trim($db->clean($_REQUEST['id']));

	$reply=$department_obj->view("id='".$id."'");
	if($reply['ack']==1)
	{
		extract($reply['result'][0]);
	}
	else
	{
		$error_msg[]=$reply['ack_msg'];
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo SITETITLE; ?> | Add/Edit Image</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php include("include_css.php");?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
		<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

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
                        <h1 class="page-title"> Add/Edit Department
                            <small>Add/Edit Department</small>
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
                            
                        </div>						
                        <!-- END PAGE HEADER-->
                        <div class="row">
						<!-- FORM START -->
						<form method="POST" role="form" id="form_department" name="form_department" class="" action="">
                            <div class="col-md-6">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> <i class="fa fa-plus"></i> &nbsp; Add/Edit Department</span>
                                        </div>
                                        <div class="actions">


											<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
									<div class="form-group form-md-line-input form-md-floating-label">
										<input class="form-control " value="<?php echo $name; ?>" name="name" id="name" type="text"  data-validation="required"     >
										<label for="longitude">Name</label>
										<span class="help-block"></span>
									</div>
                                	
                                    </div>
									<div class="form-actions noborder">
                                                            <button type="submit" name="submit" class="btn blue">Submit</button>

                                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
							
                            </div>
                           
                        	</form>
							<!-- FORM END -->
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
 
 <!-- START PAGELEVEL JS -->
  <!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
<script>
  $.validate({
	lang: 'en'
  });
 $(document).ready(function(){$(".form-control").bind("keyup change",function(){ if($(this).parent().hasClass("has-error")) {$(this).parent().find('.help-block').html(""); $(this).parent().removeClass("has-error"); } }); });
function check_form(){
	var isValid=true;
	
	
	if($("#name").val()=="" || $("#name").val().split(" ").join("")==""){	
		aj.error('name',"Please enter Name.","add_error");
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
}  
$('#birth_date').datepicker({ autoclose: true, dateFormat: 'yy-mm-dd'});
</script>
<!-- END PAGELEVEL JS -->
    </body>
</html>	