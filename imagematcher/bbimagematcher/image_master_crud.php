<?php
$page_id="516";
include("connect.php");

// PAGE DECLARATION
$main_page 	= "dashboard";
$page 		= "image_master";
$page_title	= "Add/Edit Image";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"dashboard"),array("link"=>"image_master_manage.php","title"=>"Manage Image"),array("link"=>"image_master_crud.php","title"=>"Add/Edit Image"));
$success_msg=array();
$error_msg=array();
// PAGE DECLARATION

// INCLUDE CLASS
include('../include/class.image_master.php');

$image_obj=new Image();
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:"a";

// Variable Definations
$id='';$department_id='';$name='';$email='';$mobile='';$birth_date='';$blood_group='';$address='';$image_path='';

if(isset($_REQUEST['submit'])){
	
	// Variable Declaration
	// GET SUBMITTED FORM VALUES
$params=array();
if(isset($_REQUEST['id']))
$params['id']=trim($db->clean($_REQUEST['id']));
$params['department_id']=trim($db->clean($_REQUEST['department_id']));
$params['name']=trim($db->clean($_REQUEST['name']));
$params['email']=trim($db->clean($_REQUEST['email']));
$params['mobile']=trim($db->clean($_REQUEST['mobile']));
$params['birth_date']=trim(date("Y-m-d",strtotime($db->clean($_REQUEST['birth_date']))));
$params['blood_group']=trim($db->clean($_REQUEST['blood_group']));
$params['address']=trim($db->clean($_REQUEST['address']));
$params['image_path']=trim($db->clean($_REQUEST['image_path']));


	if($mode=='a')
	{
	
	    $reply=$image_obj->insert($params,array("key"=>"name","value"=>$params['name']),$_FILES);
		//print_r($reply);exit;
		if($reply['ack']==1)
		{
			$success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("image_master_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='e')
	{
		
		$reply=$image_obj->update($params,$params['id'],$params['id'],$_FILES);
		if($reply['ack']==1)
		{
			
			$success_msg[]=$reply['ack_msg'];
			$_SESSION['success_msg']= $success_msg;
            $db->rp_location("image_master_manage.php");
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
		$reply=$image_obj->delete(array("key"=>"id","value"=>$params['id']),$detail);
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("image_master_manage.php");
		}
		else
		{
		    $error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("image_master_manage.php");
		}
	}
	else if($mode=='ac')
	{
	   //
        $params['isActive']=$_REQUEST['status'];
		$reply=$image_obj->active(array("key"=>"id","value"=>$params['id'],"status"=>$params['isActive']));
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']=$success_msg;
            $db->rp_location("image_master_manage.php");
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

	$reply=$image_obj->view("id='".$id."'");
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
                        <h1 class="page-title"> Add/Edit Image
                            <small>Add/Edit Image</small>
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
						<form method="POST" role="form" id="form_image" name="form_image" class="" enctype="multipart/form-data" action="">
                            <div class="col-md-6 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> <i class="fa fa-plus"></i> &nbsp; Add/Edit Image</span>
                                        </div>
                                        <div class="actions">


											<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
									<div class="form-group form-md-line-select form-md-floating-label">
										<label for="cid">Department</label>
										<select name="department_id" id="department_id" class="form-control department_id"  data-validation="required">
										  <option >Select Department Name</option>
																<?php
																
																$department_r = $db->rp_getData("department","*",1);
																if(mysql_num_rows($department_r)>0){
																	while($department_d = mysql_fetch_array($department_r)){
																	?>
																<option value="<?php echo $department_d['id']; ?>" "<?php if($department_d['id']==$department_id){?>" selected <?php } ?>><?php echo $department_d['name']; ?></option>
																<?php
																	}
																}
																?>
										</select>
										<span class="help-block"></span>
										</div>
								
									<div class="form-group form-md-line-input form-md-floating-label">
										<input class="form-control " value="<?php echo $name; ?>" name="name" id="name" type="text"  data-validation="required"     >
										<label for="longitude">Name</label>
										<span class="help-block"></span>
									</div>
									<div class="form-group form-md-line-input form-md-floating-label">
										<input class="form-control " value="<?php echo $email; ?>" name="email" id="email" type="text"  data-validation="required"     >
										<label for="email">Email</label>
										<span class="help-block"></span>
									</div>
									<div class="form-group form-md-line-input form-md-floating-label">
										<input class="form-control " value="<?php echo $mobile; ?>" name="mobile" id="mobile" type="text"  data-validation="required"     >
										<label for="mobile">Mobile No</label>
										<span class="help-block"></span>
									</div>
									  <div class="form-group form-md-line-input form-md-floating-label">
										<input class="form-control " value="<?php echo $birth_date; ?>" name="birth_date" id="birth_date" type="text"  data-validation="required"     >
										<label for="birth_date">Birth Date</label>
										<span class="help-block"></span>
									</div>
									  <div class="form-group form-md-line-input form-md-floating-label">
										<input class="form-control " value="<?php echo $blood_group; ?>" name="blood_group" id="blood_group" type="text"  data-validation="required"     >
										<label for="blood_group">Blood Group</label>
										<span class="help-block"></span>
									</div>
									  <div class="form-group form-md-line-input form-md-floating-label">
										<input class="form-control " value="<?php echo $address; ?>" name="address" id="address" type="text"  data-validation="required"     >
										<label for="address">Address</label>
										<span class="help-block"></span>
									</div>
								 </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
							</div>
                           <div class="col-md-6">
                               <!--BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> <i class="fa fa-map-marker"></i> &nbsp;Image</span>
                                        </div>
										<div class="portlet-body">

                                            <div class="form-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                <div class="form-group form-md-line-input form-md-floating-label">
												<input class="form-control " value="<?php echo $image_path; ?>" name="image_path" id="image_path" type="file">
												<label for="image_path">Image</label>
												<span class="help-block"></span>
												</div>
                                                </div>
											</div>
											<div class="row">
												<div class="col-sm-10" style="margin-top:25px;">	
													<?php
													if($image_path!="" && file_exists(USER_MAIN.$image_path)){
													?>
														<div class="mainImg">
															<img src="<?php echo USER_MAIN.$image_path;?>" width="175" ><br>
													</div>
													<?php } ?>
												
												</div>
											</div>
											&nbsp;&nbsp;&nbsp;&nbsp;
											<div class="row">
												<div class="form-actions noborder">
                                                            <button type="submit" name="submit" class="btn blue">Submit</button>

                                                </div>
                                            </div>
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
	
	if($("#department_id").val()=="" || $("#department_id").val().split(" ").join("")==""){		
		vd=aj.error('department_id',"Please Select department.","add_error");
		isValid=false;
	}
	
	if($("#name").val()=="" || $("#name").val().split(" ").join("")==""){	
		aj.error('name',"Please enter Name.","add_error");
		isValid=false;
	}
	if($("#email").val()=="" || $("#email").val().split(" ").join("")==""){	
		aj.error('email',"Please enter email.","add_error");
		isValid=false;
	}
	if($("#mobile").val()=="" || $("#mobile").val().split(" ").join("")==""){	
		aj.error('mobile',"Please enter Mobile No.","add_error");
		isValid=false;
	}
	if($("#birth_date").val()=="" || $("#birth_date").val().split(" ").join("")==""){	
		aj.error('birth_date',"Please enter Birth Date.","add_error");
		isValid=false;
	}
	if($("#blood_group").val()=="" || $("#blood_group").val().split(" ").join("")==""){	
		aj.error('blood_group',"Please enter Blood group.","add_error");
		isValid=false;
	}
	if($("#address").val()=="" || $("#address").val().split(" ").join("")==""){	
		aj.error('address',"Please enter Address.","add_error");
		isValid=false;
	}
	if($("#email").val()!="")
	{
		 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())){
	}
	else
	{
	alert('Please enter valid email!!');
	return false;
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
$('#birth_date').datepicker({ autoclose: true, dateFormat: 'yy-mm-dd' });
</script>
<!-- END PAGELEVEL JS -->
    </body>
</html>	