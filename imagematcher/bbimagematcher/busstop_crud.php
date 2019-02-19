<?php
$page_id="514";
include("connect.php");

// PAGE DECLARATION
$main_page 	= "dashboard";
$page 		= "bus stop";
$page_title	= "Add/Edit Bus stop";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"dashboard"),array("link"=>"busstop_manage.php","title"=>"Manage Bus stop"),array("link"=>"busstop_crud.php","title"=>"Add/Edit Bus stop "));
$success_msg=array();
$error_msg=array();
// PAGE DECLARATION

// INCLUDE CLASS
include('../include/class.busstop.php');
$busstop_obj=new Busstop();
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:"a";

// Variable Definations
$id='';$bus_stop_title='';$bus_stop_address='';$bus_stop_locality='';$bus_stop_latitude='';$bus_stop_longitude='';

if(isset($_REQUEST['submit'])){
	// Variable Declaration
	// GET SUBMITTED FORM VALUES	
	$params=array();$params['id']=trim($db->clean($_REQUEST['id']));
$params['bus_stop_title']=trim($db->clean($_REQUEST['bus_stop_title']));
$params['bus_stop_address']=trim($db->clean($_REQUEST['bus_stop_address']));
$params['bus_stop_locality']=trim($db->clean($_REQUEST['bus_stop_locality']));
$params['bus_stop_latitude']=trim($db->clean($_REQUEST['bus_stop_latitude']));
$params['bus_stop_longitude']=trim($db->clean($_REQUEST['bus_stop_longitude']));

	
	if($mode=='a')
	{
		
		$reply=$busstop_obj->insert($params,array("key"=>"bus_stop_title","value"=>$params['bus_stop_title']));
		if($reply['ack']==1)
		{
			$success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("busstop_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='e')
	{
		
		$reply=$busstop_obj->update($params,$params['bus_stop_title'],$params['id']);
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
		$reply=$busstop_obj->delete(array("key"=>"id","value"=>$params['id']));
	    if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("busstop_manage.php");
		}
		else
		{
		    $error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("busstop_manage.php");
		}
	}
	else if($mode=='ac')
	{
	   //
        $params['status']=$_REQUEST['status'];
		$reply=$busstop_obj->active(array("key"=>"id","value"=>$params['id'],"status"=>$params['status']));
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("busstop_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("busstop_manage.php");
		}
	}
}

if($mode=="e")
{
	// GET REQUIRED VALUE FROM DATABASE

		$id=trim($db->clean($_REQUEST['id']));

		$reply=$busstop_obj->view("id='".$id."'");
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
        <title><?php echo SITETITLE; ?> | Add/Edit Bus stop</title>
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
                        <h1 class="page-title"> Add/Edit Bus stop
                            <small>Add/Edit Bus stop</small>
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
						<form method="POST" role="form" id="form_bus stop" name="form_bus stop" class="[[:FORM_CLASS:]]" action="">
                            <div class="col-md-6 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> Add/Edit Bus stop</span>
                                        </div>
                                        <div class="actions">
                                           
											<button type="submit" name="submit" class="btn blue">Submit</button>                        
											<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">                                                
                                            </a> 											
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
											<div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $bus_stop_title; ?>" name="bus_stop_title" id="bus_stop_title" type="text"   >
									<label for="bus_stop_title">Bus stop title</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $bus_stop_address; ?>" name="bus_stop_address" id="bus_stop_address" type="text"  data-validation="required"     >
									<label for="bus_stop_address">Address</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $bus_stop_locality; ?>" name="bus_stop_locality" id="bus_stop_locality" type="text"  data-validation="required"     >
									<label for="bus_stop_locality">Locality</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $bus_stop_latitude; ?>" name="bus_stop_latitude" id="bus_stop_latitude" type="text"  data-validation="required"     >
									<label for="bus_stop_latitude">Latitude</label>
									<span class="help-block"></span>
								</div><div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $bus_stop_longitude; ?>" name="bus_stop_longitude" id="bus_stop_longitude" type="text"  data-validation="required"     >
									<label for="bus_stop_longitude">Longitude</label>
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