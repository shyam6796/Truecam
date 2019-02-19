<?php
$page_id="507";
include("connect.php");

// PAGE DECLARATION
$main_page 	= "dashboard";
$page 		= "user";
$page_title	= "Add/Edit User";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"dashboard"),array("link"=>"user_manage.php","title"=>"Manage user"),array("link"=>"user_crud.php","title"=>"Add/Edit User"));
$success_msg=array();
$error_msg=array();
// PAGE DECLARATION

// INCLUDE CLASS
include('../include/class.user.php');
$user_obj=new User();
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:"a";

// Variable Definations
$id='';$bus_no='';$latitude='';$longitude='';$driver_name="";$driver_contact_number="";

if(isset($_REQUEST['submit'])){
	// Variable Declaration
	// GET SUBMITTED FORM VALUES
$params=array();
if(isset($_REQUEST['id']))
$params['id']=trim($db->clean($_REQUEST['id']));

	if($mode=='d')
	{

		$reply=$user_obj->delete(array("key"=>"id","value"=>$params['id']));
		
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("user_manage.php");
		}
		else
		{
		    $error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("user_manage.php");
		}
	}
	else if($mode=='ac')
	{
	   //
	  
        $params['status']=$_REQUEST['status'];
		$reply=$user_obj->active(array("key"=>"id","value"=>$params['id'],"status"=>$params['status']));
		if($reply['ack']==1)
		{
		    $success_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']=$success_msg;
            $db->rp_location("user_manage.php");
		}
		else
		{
			$error_msg[]=$reply['ack_msg'];
            $_SESSION['success_msg']= $success_msg;
            $db->rp_location("user_manage.php");
		}
	}
}

if($mode=="e")
{

	// GET REQUIRED VALUE FROM DATABASE

	$id=trim($db->clean($_REQUEST['id']));

	$reply=$user_obj->view("id='".$id."'");
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
								<div class="col-md-12 page-404">
									<div class="number font-green"> 404 </div>
									<div class="details">
										<h3>Oops! You're lost.</h3>
										<p> We can not find the page you're looking for.
											<br>
											<a href="index.php"> Return home </a> or try the search bar below. </p>
									
									</div>
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