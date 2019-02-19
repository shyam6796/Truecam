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
include('../include/class.bus.php');
include('../include/class.busstop.php');
$bus_obj=new Bus();
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:"a";

// Variable Definations
$id='';$bus_no='';$latitude='';$longitude='';$driver_name="";$driver_contact_number="";

if(isset($_REQUEST['submit'])){
	// Variable Declaration
	// GET SUBMITTED FORM VALUES
$params=array();
if(isset($_REQUEST['id']))
$params['id']=trim($db->clean($_REQUEST['id']));
$params['bus_no']=trim($db->clean($_REQUEST['bus_no']));
$params['latitude']=trim($db->clean($_REQUEST['latitude']));
$params['longitude']=trim($db->clean($_REQUEST['longitude']));
$params['driver_name']=trim($db->clean($_REQUEST['driver_name']));
$params['driver_contact_number']=trim($db->clean($_REQUEST['driver_contact_number']));
$bus_stops=isset($_REQUEST['bus_stops'])?$_REQUEST['bus_stops']:array();
	if($mode=='a')
	{
	    $params['created_date']=date("Y-m-d H:i:s");
	    $reply=$bus_obj->insert($params,array("key"=>"bus_no","value"=>$params['bus_no']),$bus_stops);
		if($reply['ack']==1)
		{
			$success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("bus_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
		}
	}
	else if($mode=='e')
	{
		$reply=$bus_obj->update($params,$params['bus_no'],$params['id'],$bus_stops);
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

		$reply=$bus_obj->delete(array("key"=>"id","value"=>$params['id']));
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("bus_manage.php");
		}
		else
		{
		    $error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("bus_manage.php");
		}
	}
	else if($mode=='ac')
	{
	   //
        $params['status']=$_REQUEST['status'];
		$reply=$bus_obj->active(array("key"=>"id","value"=>$params['id'],"status"=>$params['status']));
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']=$success_msg;
            $db->rp_location("bus_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("bus_manage.php");
		}
	}

    else if($mode=='re')
	{
	   //
        $reply=$bus_obj->updatePasscode($params['id']);
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("bus_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("bus_manage.php");
		}
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
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />

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
						<form method="POST" role="form" id="form_bus" name="form_bus" class="" action="">
                            <div class="col-md-6 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> <i class="fa fa-plus"></i> &nbsp; Add/Edit Bus</span>
                                        </div>
                                        <div class="actions">


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
                                <div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $driver_name; ?>" name="driver_name" id="driver_name" type="text"  data-validation="required"     >
									<label for="driver_name">Driver Name</label>
									<span class="help-block"></span>
								</div>
                                <div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control " value="<?php echo $driver_contact_number; ?>" name="driver_contact_number" id="driver_contact_number" type="text"  data-validation="required"     >
									<label for="driver_contact_number">Driver Contact Number</label>
									<span class="help-block"></span>
								</div>
                                            <div class="form-actions noborder">
                                                <button type="submit" name="submit" class="btn blue">Submit</button>

                                            </div>

                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->

                            </div>
                            <div class="col-md-6 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"> <i class="fa fa-map-marker"></i> &nbsp;Bus stops</span>
                                        </div>
                                        <div class="actions">

                                           <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body ">

                                            <div class="form-body">
                                                <div class="col-sm-10 col-sm-offset-1">
                                                <div class="form-group">
                                                         <?php

                                                           $busstop_r=$db->rp_getData("bus_stop","id,bus_stop_title","isDelete=0 AND isActive=1","bus_stop_title ASC","0");                                                      // MAPED BUSES
                                                            $map_busstops=array();
                                                            $map_busstops_reply=$bus_obj->getBusStop($id);
                                                            if($map_busstops_reply['ack']==1)
                                                            {
                                                                $result=$map_busstops_reply['result'];
                                                                foreach ($result as $b)
                                                                {
                                                                     $map_busstops[]=$b['id'];
                                                                }
                                                            }

                                                         ?>
                                                        <select multiple="multiple" class="multi-select col-sm-12" id="bus_stops" name="bus_stops[]">
                                                            <?php

                                                            if($busstop_r)
                                                            {
                                                                while($busstop=mysql_fetch_assoc($busstop_r))
                                                                {
                                                                    ?>
                                                                     <option <?php echo (in_array($busstop['id'],$map_busstops))?"selected":"" ?> value="<?php echo $busstop['id']; ?>"><?php echo $busstop['bus_stop_title']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            else
                                                            {

                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>
                                                    <br/>
                                                    <br/>

                                                    <div class="form-actions noborder">
                                                            <button type="submit" name="submit" class="btn blue">Submit</button>

                                                    </div>
                                                   &nbsp;
                                                   &nbsp;
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
    <!-- END PAGE LEVEL SCRIPTS -->
<script>
  $.validate({
	lang: 'en'
  });
  $('#bus_stops').multiSelect({
    selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search Bus stop'>",
    selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search Bus stop'>",
    afterInit: function(ms){
        var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
        .on('keydown', function(e){
            if (e.which === 40){
                that.$selectableUl.focus();
                return false;
            }
        });

        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
            if (e.which == 40){
                that.$selectionUl.focus();
                return false;
            }
        });
    },
    afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
    },
    afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
    }
});

</script>
<!-- END PAGELEVEL JS -->
    </body>
</html>	