<?php
$page_id="513";
include("connect.php");

// PAGE DECLARATION
$main_page 	= "dashboard";
$page 		= "bus";
$page_title	= "Add/Edit Bus";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"dashboard"),array("link"=>"bus_manage.php","title"=>"Manage Bus"),array("link"=>"bus_crud.php","title"=>"Add/Edit Bus"));
$success_msg=array();
$error_msg=array();
// PAGE DECLARATION

// INCLUDE CLASS
include('../include/class.Bus.php');
$bus_obj=new Bus();
$mode=isset($_REQUEST['MODE'])?$_REQUEST['MODE']:"a";

// Variable Definations
$id='';$bus_no='';$latitude='';$longitude='';$='';$='';

if(isset($_REQUEST['submit'])){
	// Variable Declaration
	// GET SUBMITTED FORM VALUES	
	$params=array();$params['id']=trim($db->clean($_REQUEST['id']));
$params['bus_no']=trim($db->clean($_REQUEST['bus_no']));
$params['latitude']=trim($db->clean($_REQUEST['latitude']));
$params['longitude']=trim($db->clean($_REQUEST['longitude']));
$params['']=trim($db->clean($_REQUEST['']));
$params['']=trim($db->clean($_REQUEST['']));

	
	if($mode=='a')
	{
		
		$reply=$bus_obj->insert($params,array("key"=>"bus_no","value"=>$params['bus_no']));
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
		
		$reply=$bus_obj->update($params,$params['bus_no'],$params['id']);
		if($reply['ack']==1)
		{
			$success_msg[]=$reply['ack_msg'];
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='d')
	{
		//
		$reply=$bus_obj->delete(array("key"=>"id","value"=>$params['id']));
		if($reply['ack']==1)
		{
			extract($reply['result']);
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='a')
	{
		//[[:PAGE_ACTIVE:]]
	}
}

if($mode=="e")
{
	// GET REQUIRED VALUE FROM DATABASE
	
		$id=trim($db->clean($_REQUEST['id']));

		$reply=$bus_obj->view("id='".$id."'");
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
        <title><?php echo SITETITLE; ?> | Add/Edit Bus</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php include("include_css.php");?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
				
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
                        <h1 class="page-title"> Add/Edit Bus
                            <small>Add/Edit Bus</small>
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
						<form method="POST" role="form" id="form_bus" name="form_bus" class="[[:FORM_CLASS:]]" action="">
                            <div class="col-md-6 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> Add/Edit Bus</span>
                                        </div>
                                        <div class="actions">
                                           
											<button type="submit" name="submit" class="btn blue">Submit</button>                        
											<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">                                                
                                            </a> 											
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
											<div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $bus_no; ?>" name="bus_no" id="bus_no" type="text"  data-validation="required,length"   data-validation-length="min6" data-validation-error-msg="Enter atleast 6 Characters."  >
									<label for="bus_no">Bus Number</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $latitude; ?>" name="latitude" id="latitude" type="text"  data-validation="required"     >
									<label for="latitude">Latitude</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $longitude; ?>" name="longitude" id="longitude" type="text"  data-validation="required"     >
									<label for="longitude">Longitude</label>
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
  
<script>
  $.validate({
	lang: 'en'
  });
</script>	
<!-- END PAGELEVEL JS -->
    </body>
</html>	