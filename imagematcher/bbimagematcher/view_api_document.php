<?php
$ctable 	= "api_table";
$ctable1 	= "APIs";
$main_page 	= $ctable;
$page 		= "view_".$ctable;
$page_title = "View ".$ctable1;

include("connect.php");

$design_type=1;

/*$report_r = $db->rp_getData("report","*","id='".$rid."'");
$report_d = mysql_fetch_array($report_r);
$pid		= $report_d['pid'];
$cid		= $report_d['cid'];
$pro_name	= stripslashes($db->rp_getValue("product","name","id='".$pid."'"));
if($rtid==3){
	$cname = "INTERVALVE POONAWALLA LTD.";
}else{
	$cname = stripslashes($db->rp_getValue("customer","cname","id='".$cid."'"));;
}*/
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> W<![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $page_title; ?> | <?php echo SITETITLE; ?></title>
<?php include("include_css.php"); ?>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
</head>
<body class="page-md">
<div class="transCover"><img src="assets/admin/layout/img/89.gif" alt="" style="margin-top:20%;padding-left:48%;" ></div>
<?php include("header.php"); ?>
<div class="page-container">
	
	<div class="page-head bg-grey">
		<div class="container">
			<div class="page-title">
				<h2>Sagar Webservice APIs</h2>
				
			</div>
			<div class="page-toolbar">
					<div class="btn-group btn-theme-panel">
						<a class="btn dropdown-toggle blue-ebonyclay" href="javascript:;" onClick="genReport('<?php echo $design_type; ?>');" title="Save">Save</a>
					</div>
					<div class="btn-group btn-theme-panel">
						<a class="btn dropdown-toggle blue-ebonyclay" href="dashboard.php" title="Back">Back</a>
					</div>
				</div>
		</div>
	</div>
	
	<div class="page-content">
		<div class="container">
			<div class="row">
				
				<div class="col-md-12" id="report_content">
					<?php 
						
							include("api_document_design/design".$design_type.".php");
					
					?>
				</div>
			</div>
		</div>
	</div>
	
</div>
<?php include("footer.php"); ?>
<?php include("include_js.php"); ?>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script>
function genReport(bid){
	var rc = encodeURIComponent($("#report_content").html());
	$.ajax({
		type: "POST",
		url: "ajax_genAPIReport.php",
		data: 'rc='+rc,
		beforeSend: function() {
			$(".transCover").fadeIn(800);
		},
		success: function(result){ //alert(result);
				setTimeout(function(){
					$(".transCover").fadeOut(100);
				
				},1500);
			}
	});
}
</script>
</body>
</html>