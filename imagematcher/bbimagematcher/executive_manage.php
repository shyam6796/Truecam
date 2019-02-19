<?php
$page_id=400;
$page_slug="dashboard";
$main_page = "home";
$page_hierarchy=array(array("link"=>"dashboard.php","title"=>"Dashboard"),array("link"=>"empty_manage.php","title"=>"Manage Empty"),array("link"=>"empty_manage.php","title"=>"Manage Empty"));
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
        <title>Dashboard | <?php echo SITETITLE; ?></title>
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
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Dashboard
                            <small>dashboard & statistics</small>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN MAIN CONTENT-->
                        <div class="row">
							<div class="col-md-12">
								 <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <i class="icon-settings font-red-sunglo"></i>
                                            <span class="caption-subject bold uppercase"> Line Inputs</span>
                                        </div>
                                        <div class="actions">
                                            <div class="btn-group">
                                                <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-trash-o"></i> Delete </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-ban"></i> Ban </a>
                                                    </li>
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;"> Make admin </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form">
                                            <div class="form-body">
                                                
                                                <div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name">
                                                    <label for="form_control_1">Regular input</label>
                                                    <span class="help-block">Some help goes here...</span>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control" id="form_control_1" placeholder="Enter your email">
                                                    <label for="form_control_1">Input with help</label>
                                                    <span class="help-block">Some help goes here...</span>
                                                </div>
                                                <div class="form-group form-md-line-input has-success">
                                                    <input type="text" class="form-control" id="form_control_1" placeholder="Success state">
                                                    <label for="form_control_1">Success input</label>
                                                </div>
                                                <div class="form-group form-md-line-input has-warning">
                                                    <input type="text" class="form-control" id="form_control_1" placeholder="Warning state">
                                                    <label for="form_control_1">Warning input</label>
                                                </div>
                                                <div class="form-group form-md-line-input has-error">
                                                    <input type="text" class="form-control" id="form_control_1" placeholder="Error state">
                                                    <label for="form_control_1">Error input</label>
                                                </div>
                                                <div class="form-group form-md-line-input has-info">
                                                    <input type="text" class="form-control" id="form_control_1" placeholder="Info state">
                                                    <label for="form_control_1">Info input</label>
                                                </div>
                                                <div class="form-group form-md-line-input has-info">
                                                    <select class="form-control" id="form_control_1">
                                                        <option value=""></option>
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                        <option value="4">Option 4</option>
                                                    </select>
                                                    <label for="form_control_1">Dropdown sample</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <textarea class="form-control" rows="3" placeholder="Enter more text"></textarea>
                                                    <label for="form_control_1">Textarea input</label>
                                                </div>
                                                <div class="form-group form-md-line-input has-error">
                                                    <input type="text" class="form-control" disabled id="form_control_1" placeholder="Disable">
                                                    <label for="form_control_1">Disabled</label>
                                                </div>
                                                <div class="form-group form-md-line-input has-error">
                                                    <input type="text" class="form-control" readonly value="You can't edit this" id="form_control_1">
                                                    <label for="form_control_1">Readonly</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <div class="form-control form-control-static"> email@example.com </div>
                                                    <label for="form_control_1">Static Control</label>
                                                </div>
                                                <div class="form-group form-md-line-input has-info">
                                                    <input type="text" class="form-control input-sm" id="form_control_1" placeholder=".input-sm">
                                                    <label for="form_control_1">Small input</label>
                                                </div>
                                                <div class="form-group form-md-line-input has-info">
                                                    <input type="text" class="form-control input-lg" id="form_control_1" placeholder=".input-lg">
                                                    <label for="form_control_1">Large input</label>
                                                </div>
                                            </div>
                                            <div class="form-actions noborder">
                                                <button type="button" class="btn blue">Submit</button>
                                                <button type="button" class="btn default">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

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

		<!-- END PAGE LEVEL SCRIPTS -->

    </body>