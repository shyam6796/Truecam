<?php
$page_id=501;
$page_slug="dashboard";
$main_page = "home";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"Dashboard"),array("link"=>"api_manage.php","title"=>"Manage APIs"));
include("connect.php");

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
        <title>APIs | <?php echo SITETITLE; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
		<?php include("include_css.php");?>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
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

                        <?php $system->pageBar($page_hierarchy);?>
                         <div class="theme-panel hidden-xs hidden-sm">
                            <div class="toggler" style="display: block;"> </div>
                            <div class="toggler-close"> </div>
                            <div class="theme-options">

                                <div class="theme-option" style="margin-top:50px;">
                                    <span>Save</span>
                                  	<a class="btn btn-primary " href="javascript:;" onClick="genReport(this,'1');" title="Save">Save</a>
                                </div>
                            </div>

                        </div>
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Web APIs
                            <small>APIs</small>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN MAIN CONTENT-->
                        <div class="row">
								<div class="col-md-12" id="report_content">
                					<?php

                							include("api_document_design/design1.php");

                					?>
                				</div>
                        </div>
                        <!-- END MAIN CONTENT-->

				   </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
            <?php include('footer.php');?>
        </div>

        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
	  <?php include('include_js.php');?>
	   <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script>
function genReport(btn,bid){
    var last_text=$(btn).html();

	var rc = encodeURIComponent($("#report_content").html());
	$.ajax({
		type: "POST",
		url: "ajax_genAPIReport.php",
		data: 'rc='+rc,
		beforeSend: function() {
		     $(btn).attr("disabled","disabled");
                $(btn).html("Saving..");
		},
		success: function(result){ //alert(result);
				setTimeout(function(){
					$(".transCover").fadeOut(100);
                    $(btn).removeAttr("disabled");
                    $(btn).html(last_text);
                    window.location=  result;
				},1500);
			}
	});
}
</script>
		<!-- END PAGE LEVEL SCRIPTS -->

    </body>