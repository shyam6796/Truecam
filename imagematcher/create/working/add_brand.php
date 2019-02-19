<?php
$page_id=506;$page_slug='page_brand';
include("connect.php");

if(isset($_REQUEST['submit'])){

	if(isset($_REQUEST['mode']) && $_REQUEST['mode']=="add")
	{
		
		if($rights['insert_flag']!=1)
		{
			$db->rp_location('access_denied.php?msg=insert_access_denied');
		}
	
			$db->rp_location("manage_".$ctable.".php?msg=inserted");
		
	}
	else if(isset($_REQUEST['mode']) && $_REQUEST['mode']=="edit")
	{
		
		if($rights['update_flag']!=1)
		{
			$db->rp_location('access_denied.php?msg=update_access_denied');
		}
		
	}
}

if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="edit"){
	
	if($rights['update_flag']!=1)
	{
		$db->rp_location('access_denied.php?msg=update_access_denied');
	}
}
if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="delete"){
	
	if($rights['delete_flag']!=1)
	{
		$db->rp_location('access_denied.php?msg=delete_access_denied');
	}
}
if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="isActive" && isset($_REQUEST['status'])  && $_REQUEST['status']!=""){
	
	$db->rp_location("manage_".$ctable.".php?msg=updated");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_title; ?> | <?php echo ADMINTITLE; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include("include_css.php"); ?>
		<link href="assets/global/plugins/croppic/croppic.css" rel="stylesheet" type="text/css">
		
    </head>
    <body class="page-md">
<?php include("header.php"); ?>
<div class="page-container">
	<div class="page-head bg-grey">
		<div class="container">
			<div class="page-title">
				<h1><a href="<?php echo "manage_".$ctable.".php";?>" class="btn primary"><i class="fa  fa-arrow-circle-o-left"></i>&nbsp;back</a> &nbsp;<?php echo $page_title; ?></h1>
				
			</div>
		</div>
	</div>
	<div class="page-content">
		<div class="container">
		<form role="form" action="" onSubmit="return check_form();" method="post">
			<div class="row">
				
				
				<div class="col-sm-9">
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-list"></i>General Information</div>							
						</div>
						<div class="portlet-body">
								<?php if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="duplicate"){ ?>
								<div class="alert alert-danger alert-dismissable"> <i class="fa fa-ban"></i>
									<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
									<b>Error! This Phone Number is Already Exist. Please Try Another Phone Number.</b> </div>
								<?php } ?>
								
								<div class="form-body">
									<div class="form-group">
										<div class="row">										
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-12">													
															<div class="form-group form-md-line-input form-md-floating-label">
																<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" autofocus>
																<label for="form_control_1">Brand name *</label>
																<span class="help-block">Enter Brand name.</span>
															</div>
														<div class="form-actions">
															<button type="submit" name="submit" class="btn green">Submit</button>															
														</div>
													</div>
													
												</div>									
											</div>
										</div>
									</div>						
									
								</div>
						</div>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-camera"></i>Media </div>							
						</div>
						<div class="portlet-body">
							<div class="form-body">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">											
											<div class="form-group">
												<label>Brand Image</label>
												<div id="img_upload" class="img_upload">
													<a class="btn btn-danger delete-img"><i class="fa fa-trash"></i></a>
												</div>
												<input type="hidden" id="image_path" name="image_path"  value="<?php echo $image_path; ?>" data-preview-value="<?php echo $preview_image_path; ?>" data-default-value="<?php echo $default_image_path; ?>" />
												<input type="hidden" id="old_image_path" name="old_image_path" data-value="<?php echo $image_path; ?>" />
												<p class="help-block"></p>
											</div>
											
										</div>
										<div class="col-md-offset-1 col-md-8">											
											<div class="form-group">
												<label>Brand Banner Image</label>
												<div id="img_banner_upload" class="img_banner_upload" >
												<a class="btn btn-danger delete-img"><i class="fa fa-trash"></i></a>
												</div>
												<input type="hidden" id="banner_image_path" name="banner_image_path" value="<?php echo $banner_image_path; ?>" data-preview-value="<?php echo $preview_banner_image_path; ?>"  data-default-value="<?php echo $default_banner_image_path; ?>" />
												<input type="hidden" id="old_banner_image_path" name="old_banner_image_path" data-value="<?php echo $banner_image_path; ?>" />
												<p class="help-block"></p>
											</div>											
										</div>												
									</div>
								</div>									
							</div>	
						</div>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
	<div class="page-head bg-grey">
		<div class="container">
			<div class="page-title">
				<h1><a href="<?php echo "manage_".$ctable.".php";?>" class="btn primary"><i class="fa  fa-arrow-circle-o-left"></i>&nbsp;back</a> &nbsp;<?php echo $page_title; ?></h1>
				
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
<?php include("include_js.php"); ?>
<script src="assets/global/plugins/croppic/croppic.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	
	aj.cropTool("img_upload",250,320,$("#image_path").val(),$("#image_path").data("preview-value"),$("#image_path").data("default-value"),"category/orignal","category/main",null,onMainImageCropCallback,null,uploadUrl="",cropUrl="")
	aj.cropTool("img_banner_upload",500,320,$("#banner_image_path").val(),$("#banner_image_path").data("preview-value"),$("#banner_image_path").data("default-value"),"category/orignal","category/banner",null,onBannerImageCropCallback,null,uploadUrl="",cropUrl="")
})
function onMainImageCropCallback(data)
{
	$("#image_path").val(data.filename);
}
function onBannerImageCropCallback(data)
{
	$("#banner_image_path").val(data.filename);
}
function check_form()
	{
		var isValid=true;
		$(".form-body").children().removeClass("has-error");
		if($("#name").val()=="" || $("#name").val().split(" ").join("")==""){
			aj.error('name','Please Enter Name!!','add_error');
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
</script>
</body>
</html>
