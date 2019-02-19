<?php
$page_id="852";
include("connect.php");

// PAGE DECLARATION
$main_page 	= "dashboard";
$page 		= "user";
$page_title	= "Add/Edit User";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"dashboard"),array("link"=>"user_manage.php","title"=>"Manage User"),array("link"=>"user_crud.php","title"=>"Add/Edit User"));
$success_msg=array();
$error_msg=array();
// PAGE DECLARATION

// INCLUDE CLASS
include('../include/class.User.php');
$user_obj=new User();
$mode=isset($_REQUEST['MODE'])?$_REQUEST['MODE']:"a";

// Variable Definations
$id='';$name='';$email='';$phone='';$bdate='';$address='';$city='';$state='';$country='';

if(isset($_REQUEST['submit'])){
	// Variable Declaration
	// GET SUBMITTED FORM VALUES	
	$params=array();$params['id']=trim($db->clean($_REQUEST['id']));
$params['name']=trim($db->clean($_REQUEST['name']));
$params['email']=trim($db->clean($_REQUEST['email']));
$params['phone']=trim($db->clean($_REQUEST['phone']));
$params['bdate']=trim($db->clean($_REQUEST['bdate']));
$params['address']=trim($db->clean($_REQUEST['address']));
$params['city']=trim($db->clean($_REQUEST['city']));
$params['state']=trim($db->clean($_REQUEST['state']));
$params['country']=trim($db->clean($_REQUEST['country']));

	
	if($mode=='a')
	{
		
		$reply=$db->insert($params,array("key"=>"id","value"=>$params['id']));
		if($reply['ack']==1)
		{
			$success_msg[]=$reply['ack_msg'];
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='e')
	{
		
		$reply=$user_obj->update($params,$params['email'],$params['id']);
		if($reply['ack']==1)
		{
			echo $success_msg[]=$reply['ack_msg'];
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='d')
	{
		//[[:PAGE_DELETE:]]
	}
	else if($mode=='a')
	{
		//[[:PAGE_ACTIVE:]]
	}
}

if($mode=="e")
{
	// GET REQUIRED VALUE FROM DATABASE
	//[[:PAGE_VARIABLE_FETCHING_LOGIC:]]
}
?>
<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo SITETITLE; ?> | Add/Edit User</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php include("include_css.php");?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<br/>
							<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
							<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">		
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
                        <h1 class="page-title"> Add/Edit User
                            <small>Add/Edit User</small>
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
						<form role="form" id="form_user" name="form_user" class="[[:FORM_CLASS:]]" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="col-md-6 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> Add/Edit User</span>
                                        </div>
                                        <div class="actions">
                                           
											<button type="submit" name="submit" class="btn blue">Submit</button>                        
											<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">                                                
                                            </a> 											
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
											<div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " name="name" id="name" type="text"  data-validation="required,length"   data-validation-length="min10" data-validation-error-msg="Enter atleast 10 Characters."  >
									<label for="name">Name</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " name="email" id="email" type="email"  data-validation="required,email"    data-validation-error-msg="Enter Valid Email."  >
									<label for="email">Email</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " name="phone" id="phone" type="text"  data-validation="required,length"   data-validation-length="min10" data-validation-error-msg="Enter atleast 10 Digits"  >
									<label for="phone">Phone</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label has-info">
										<div class="input-group date date-picker margin-bottom-5" data-validation="date"  data-validation-format="dd-mm-yyyy" data-validation-error-msg="Enter Birthdate in DD-MM-YYYY Format" >
										<input class="form-control form-filter input-sm date-picker" readonly="" id="bdate" name="bdate"  placeholder="From" type="text">
										<span class="input-group-btn">
											<button class="btn btn-sm default " type="button">
												<i class="fa fa-calendar"></i>
											</button>
										</span>
										<label for="bdate">Bdate</label>
										<span class="help-block"></span>
									</div>
									</div><div class="form-group form-md-line-input form-md-floating-label">
										<textarea name="address" class="form-control " id="address" rows="3"   ></textarea>
										<label for="address">Address</label>
										<span class="help-block"></span>
									</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " name="city" id="city" type="text"   >
									<label for="city">City</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " name="state" id="state" type="text"   >
									<label for="state">State</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label has-info">
										<select class="form-control edited " id="country" name="country"  >
											<option value=""></option>
											<option value="1" selected="">Option 1</option>
											<option value="2">Option 2</option>
											<option value="3">Option 3</option>
											<option value="4">Option 4</option>
										</select>
										<label for="country">Country</label>
										<span class="help-block"></span>
									</div>
                                            <div class="form-actions noborder">
                                                <button type="submit" name="submit" class="btn blue">Submit</button>
                                                <button type="button" class="btn default">Cancel</button>
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
		 <!-- START PAGELEVEL JS -->
		  <br/>
						  <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>		  
		  <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		  <script type="text/javascript">
		   $(".date-picker-btn").on("click",function(){
			   $(this).closest("input.date-picker").datepicker("show");
		   })
		  $(".date-picker").datepicker();
		  </script>
						  
		  <script>
		  $.validate({
			lang: 'en'
		  });
		</script>	
		<!-- END PAGELEVEL JS -->
    </body>
</html>	