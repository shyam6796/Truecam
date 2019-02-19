<?php
include("../connect.php");
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<!-- NAME: 1 COLUMN - BANDED -->
<!--[if gte mso 15]>
		<xml>
			<o:OfficeDocumentSettings>
			<o:AllowPNG/>
			<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml>
		<![endif]-->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo SITENAME; ?> | Wishlist</title>
<style type="text/css">
p {
	margin:10px 0;
	padding:0;
}
table {
	border-collapse:collapse;
}
h1, h2, h3, h4, h5, h6 {
	display:block;
	margin:0;
	padding:0;
}
img, a img {
	border:0;
	height:auto;
	outline:none;
	text-decoration:none;
}
body, #bodyTable, #bodyCell {
	height:100%;
	margin:0;
	padding:0;
	width:100%;
}
#outlook a {
	padding:0;
}
img {
	-ms-interpolation-mode:bicubic;
}
table {
	mso-table-lspace:0pt;
	mso-table-rspace:0pt;
}
.ReadMsgBody {
	width:100%;
}
.ExternalClass {
	width:100%;
}
p, a, li, td, blockquote {
	mso-line-height-rule:exactly;
}
 a[href^=tel], a[href^=sms] {
 color:inherit;
 cursor:default;
 text-decoration:none;
}
p, a, li, td, body, table, blockquote {
	-ms-text-size-adjust:100%;
	-webkit-text-size-adjust:100%;
}
.ExternalClass, .ExternalClass p, .ExternalClass td, .ExternalClass div, .ExternalClass span, .ExternalClass font {
	line-height:100%;
}
a[x-apple-data-detectors] {
	color:inherit !important;
	text-decoration:none !important;
	font-size:inherit !important;
	font-family:inherit !important;
	font-weight:inherit !important;
	line-height:inherit !important;
}
.templateContainer {
	max-width:600px !important;
}
a.mcnButton {
	display:block;
}
.mcnImage {
	vertical-align:bottom;
}
.mcnTextContent {
	word-break:break-word;
}
.mcnTextContent img {
	height:auto !important;
}
.mcnDividerBlock {
	table-layout:fixed !important;
}
/*
	@tab Page
	@section Background Style
	@tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.
	*/
		body, #bodyTable {
	/*@editable*/background-color:#FAFAFA;
}
/*
	@tab Page
	@section Background Style
	@tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.
	*/
		#bodyCell {
	/*@editable*/border-top:0;
}
/*
	@tab Page
	@section Heading 1
	@tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
	@style heading 1
	*/
		h1 {
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:26px;
	/*@editable*/font-style:normal;
	/*@editable*/font-weight:bold;
	/*@editable*/line-height:125%;
	/*@editable*/letter-spacing:normal;
	/*@editable*/text-align:left;
}
/*
	@tab Page
	@section Heading 2
	@tip Set the styling for all second-level headings in your emails.
	@style heading 2
	*/
		h2 {
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:22px;
	/*@editable*/font-style:normal;
	/*@editable*/font-weight:bold;
	/*@editable*/line-height:125%;
	/*@editable*/letter-spacing:normal;
	/*@editable*/text-align:left;
}
/*
	@tab Page
	@section Heading 3
	@tip Set the styling for all third-level headings in your emails.
	@style heading 3
	*/
		h3 {
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:20px;
	/*@editable*/font-style:normal;
	/*@editable*/font-weight:bold;
	/*@editable*/line-height:125%;
	/*@editable*/letter-spacing:normal;
	/*@editable*/text-align:left;
}
/*
	@tab Page
	@section Heading 4
	@tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
	@style heading 4
	*/
		h4 {
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:18px;
	/*@editable*/font-style:normal;
	/*@editable*/font-weight:bold;
	/*@editable*/line-height:125%;
	/*@editable*/letter-spacing:normal;
	/*@editable*/text-align:left;
}
/*
	@tab Preheader
	@section Preheader Style
	@tip Set the background color and borders for your email's preheader area.
	*/
		#templatePreheader {
	/*@editable*/background-color:#FAFAFA;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:9px;
	/*@editable*/padding-bottom:9px;
}
/*
	@tab Preheader
	@section Preheader Text
	@tip Set the styling for your email's preheader text. Choose a size and color that is easy to read.
	*/
		#templatePreheader .mcnTextContent, #templatePreheader .mcnTextContent p {
	/*@editable*/color:#656565;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:12px;
	/*@editable*/line-height:150%;
	/*@editable*/text-align:left;
}
/*
	@tab Preheader
	@section Preheader Link
	@tip Set the styling for your email's preheader links. Choose a color that helps them stand out from your text.
	*/
		#templatePreheader .mcnTextContent a, #templatePreheader .mcnTextContent p a {
	/*@editable*/color:#656565;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
}
/*
	@tab Header
	@section Header Style
	@tip Set the background color and borders for your email's header area.
	*/
		#templateHeader {
	/*@editable*/background-color:#FFFFFF;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:9px;
	/*@editable*/padding-bottom:0;
}
/*
	@tab Header
	@section Header Text
	@tip Set the styling for your email's header text. Choose a size and color that is easy to read.
	*/
		#templateHeader .mcnTextContent, #templateHeader .mcnTextContent p {
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:16px;
	/*@editable*/line-height:150%;
	/*@editable*/text-align:left;
}
/*
	@tab Header
	@section Header Link
	@tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
	*/
		#templateHeader .mcnTextContent a, #templateHeader .mcnTextContent p a {
	/*@editable*/color:#2BAADF;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
}
/*
	@tab Body
	@section Body Style
	@tip Set the background color and borders for your email's body area.
	*/
		#templateBody {
	/*@editable*/background-color:#FFFFFF;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:9px;
	/*@editable*/padding-bottom:9px;
}
/*
	@tab Body
	@section Body Text
	@tip Set the styling for your email's body text. Choose a size and color that is easy to read.
	*/
		#templateBody .mcnTextContent, #templateBody .mcnTextContent p {
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:16px;
	/*@editable*/line-height:150%;
	/*@editable*/text-align:left;
}
/*
	@tab Body
	@section Body Link
	@tip Set the styling for your email's body links. Choose a color that helps them stand out from your text.
	*/
		#templateBody .mcnTextContent a, #templateBody .mcnTextContent p a {
	/*@editable*/color:#2BAADF;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
}
/*
	@tab Footer
	@section Footer Style
	@tip Set the background color and borders for your email's footer area.
	*/
		#templateFooter {
	/*@editable*/background-color:#FAFAFA;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:9px;
	/*@editable*/padding-bottom:9px;
}
/*
	@tab Footer
	@section Footer Text
	@tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
	*/
		#templateFooter .mcnTextContent, #templateFooter .mcnTextContent p {
	/*@editable*/color:#656565;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:12px;
	/*@editable*/line-height:150%;
	/*@editable*/text-align:center;
}
/*
	@tab Footer
	@section Footer Link
	@tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
	*/
		#templateFooter .mcnTextContent a, #templateFooter .mcnTextContent p a {
	/*@editable*/color:#656565;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
}
 @media only screen and (min-width:768px) {
 .templateContainer {
 width:600px !important;
}
}
@media only screen and (max-width: 480px) {
 body, table, td, p, a, li, blockquote {
 -webkit-text-size-adjust:none !important;
}
}
@media only screen and (max-width: 480px) {
 body {
 width:100% !important;
 min-width:100% !important;
}
}
@media only screen and (max-width: 480px) {
 #bodyCell {
 padding-top:10px !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnImage {
 width:100% !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnCaptionTopContent, .mcnCaptionBottomContent, .mcnTextContentContainer, .mcnBoxedTextContentContainer, .mcnImageGroupContentContainer, .mcnCaptionLeftTextContentContainer, .mcnCaptionRightTextContentContainer, .mcnCaptionLeftImageContentContainer, .mcnCaptionRightImageContentContainer, .mcnImageCardLeftTextContentContainer, .mcnImageCardRightTextContentContainer {
 max-width:100% !important;
 width:100% !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnBoxedTextContentContainer {
 min-width:100% !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnImageGroupContent {
 padding:9px !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnCaptionLeftContentOuter .mcnTextContent, .mcnCaptionRightContentOuter .mcnTextContent {
 padding-top:9px !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnImageCardTopImageContent, .mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent {
 padding-top:18px !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnImageCardBottomImageContent {
 padding-bottom:9px !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnImageGroupBlockInner {
 padding-top:0 !important;
 padding-bottom:0 !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnImageGroupBlockOuter {
 padding-top:9px !important;
 padding-bottom:9px !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnTextContent, .mcnBoxedTextContentColumn {
 padding-right:18px !important;
 padding-left:18px !important;
}
}
@media only screen and (max-width: 480px) {
 .mcnImageCardLeftImageContent, .mcnImageCardRightImageContent {
 padding-right:18px !important;
 padding-bottom:0 !important;
 padding-left:18px !important;
}
}
@media only screen and (max-width: 480px) {
 .mcpreview-image-uploader {
 display:none !important;
 width:100% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Heading 1
	@tip Make the first-level headings larger in size for better readability on small screens.
	*/
		h1 {
			/*@editable*/font-size:22px !important;
			/*@editable*/line-height:125% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Heading 2
	@tip Make the second-level headings larger in size for better readability on small screens.
	*/
		h2 {
			/*@editable*/font-size:20px !important;
			/*@editable*/line-height:125% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Heading 3
	@tip Make the third-level headings larger in size for better readability on small screens.
	*/
		h3 {
			/*@editable*/font-size:18px !important;
			/*@editable*/line-height:125% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Heading 4
	@tip Make the fourth-level headings larger in size for better readability on small screens.
	*/
		h4 {
			/*@editable*/font-size:16px !important;
			/*@editable*/line-height:150% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Boxed Text
	@tip Make the boxed text larger in size for better readability on small screens. We recommend a font size of at least 16px.
	*/
		.mcnBoxedTextContentContainer .mcnTextContent, .mcnBoxedTextContentContainer .mcnTextContent p {
			/*@editable*/font-size:14px !important;
			/*@editable*/line-height:150% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Preheader Visibility
	@tip Set the visibility of the email's preheader on small screens. You can hide it to save space.
	*/
		#templatePreheader {
			/*@editable*/display:block !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Preheader Text
	@tip Make the preheader text larger in size for better readability on small screens.
	*/
		#templatePreheader .mcnTextContent, #templatePreheader .mcnTextContent p {
			/*@editable*/font-size:14px !important;
			/*@editable*/line-height:150% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Header Text
	@tip Make the header text larger in size for better readability on small screens.
	*/
		#templateHeader .mcnTextContent, #templateHeader .mcnTextContent p {
			/*@editable*/font-size:16px !important;
			/*@editable*/line-height:150% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Body Text
	@tip Make the body text larger in size for better readability on small screens. We recommend a font size of at least 16px.
	*/
		#templateBody .mcnTextContent, #templateBody .mcnTextContent p {
			/*@editable*/font-size:16px !important;
			/*@editable*/line-height:150% !important;
}
}
@media only screen and (max-width: 480px) {
	/*
	@tab Mobile Styles
	@section Footer Text
	@tip Make the footer content text larger in size for better readability on small screens.
	*/
		#templateFooter .mcnTextContent, #templateFooter .mcnTextContent p {
			/*@editable*/font-size:14px !important;
			/*@editable*/line-height:150% !important;
}
}
</style>
</head>
<body>
<center>
	<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
		<tr>
			<td align="center" valign="top" id="bodyCell"><!-- BEGIN TEMPLATE // -->
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td align="center" valign="top" id="templatePreheader"><!--[if gte mso 9]>
									<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
									<tr>
									<td align="center" valign="top" width="600" style="width:600px;">
									<![endif]-->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
								<tr>
									<td valign="top" class="preheaderContainer"><table class="mcnTextBlock" style="min-width:100%;" width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody class="mcnTextBlockOuter">
												<tr>
													<td class="mcnTextBlockInner" valign="top"><table style="min-width:100%;" class="mcnTextContentContainer" width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td class="mcnTextContent" style="padding-top:9px; padding-bottom: 9px;" valign="top"><img src="<?php echo SITEURL; ?>assets/images/logo.png" style="width: 132px; height: 37px; margin: 0px;" height="37" width="132" align="none"> </td>
																</tr>
															</tbody>
														</table></td>
												</tr>
											</tbody>
										</table></td>
								</tr>
							</table>
							<!--[if gte mso 9]>
									</td>
									</tr>
									</table>
									<![endif]-->
						</td>
					</tr>
					<tr>
						<td align="center" valign="top" id="templateHeader"><!--[if gte mso 9]>
									<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
									<tr>
									<td align="center" valign="top" width="600" style="width:600px;">
									<![endif]-->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
								<tr>
									<td valign="top" class="headerContainer"><table class="mcnDividerBlock" style="min-width:100%;" width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody class="mcnDividerBlockOuter">
												<tr>
													<td class="mcnDividerBlockInner" style="min-width:100%;"><table class="mcnDividerContent" style="min-width: 100%;border-top: 2px solid #0461C5;" width="100%" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td><span></span> </td>
																</tr>
															</tbody>
														</table>
														<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
													</td>
												</tr>
											</tbody>
										</table></td>
								</tr>
							</table>
							<!--[if gte mso 9]>
									</td>
									</tr>
									</table>
									<![endif]-->
						</td>
					</tr>
					<tr>
						<td align="center" valign="top" id="templateBody"><!--[if gte mso 9]>
									<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
									<tr>
									<td align="center" valign="top" width="600" style="width:600px;">
									<![endif]-->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
								<tr>
									<td valign="top" class="bodyContainer"><table class="mcnTextBlock" style="min-width:100%;" width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody class="mcnTextBlockOuter">
												<tr>
													<td class="mcnTextBlockInner" valign="top"><table style="min-width:100%;" class="mcnTextContentContainer" width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td class="mcnTextContent" style="padding-top:9px; padding-bottom: 9px;" valign="top"><strong><span style="font-family:calibri,sans-serif; font-size:14.0pt; line-height:107%">Dear <?php echo ucwords(stripslashes($db->rp_getValue("user","name","id='".$_REQUEST['uid']."'"))); ?>,</span></strong>
																		<div style="text-align:justify;padding-top:5px;">You have some product(s) in your wishlist. You may like to purchase it with single click from here...!</div>
																	</td>
																</tr>
															</tbody>
														</table></td>
												</tr>
											</tbody>
										</table>
										<div id="identity" style="margin: 0;padding: 0">
											<div style="clear: both;margin: 0;padding: 0">
												<table id="items" style="margin: 30px 0 0 0;padding: 0;border-collapse: collapse;clear: both;width: 100%;border: 1px solid black">
												<tr style="margin: 0;padding: 0">
														<th style="margin: 0;padding: 5px;border: 1px solid black;background: #eee" colspan="2">Product</th>
														<th style="margin: 0;padding: 5px;border: 1px solid black;background: #eee">Price</th>
														<th style="margin: 0;padding: 5px;border: 1px solid black;background: #eee">Action</th>
													</tr>
									<?php
								$ctable_where = " uid='".$_REQUEST['uid']."' ";
								$wishlist_r = $db->rp_getData("wishlist","*",$ctable_where,"rand(),id desc LIMIT 5");
								if(mysql_num_rows($wishlist_r)>0){
									while($wishlist_d = mysql_fetch_array($wishlist_r)){
										$pid	= $wishlist_d['pid'];
										$subpid	= $wishlist_d['subpid'];
										if($subpid>0){
											$sub_pro_r = $db->rp_getData("sub_product","*","id='".$subpid."'");
											if(mysql_num_rows($sub_pro_r)>0){
												$sub_pro_d 	= mysql_fetch_array($sub_pro_r);
												
												$cid 		= stripslashes($sub_pro_d['cid']);
												$sid 		= stripslashes($sub_pro_d['sid']);
												$name	= stripslashes($sub_pro_d["name"]);
												$pro_slug	= stripslashes($db->rp_getValue("product","slug","id='".$pid."'"));
												$spslug		= stripslashes($sub_pro_d["slug"]);
												
												$cat_d		= mysql_fetch_array($db->rp_getData("category","slug,name","id=".$cid));
												$catSlug	= stripslashes($cat_d['slug']);
												
												$hscat_slug = stripslashes($db->rp_getValue("sub_category","slug","id='".$sid."'"));
												
												$pro_sku	= stripslashes($sub_pro_d["sku"]);
												$status		= stripslashes($sub_pro_d["status"]);
												$image_path = stripslashes($sub_pro_d["image_path"]);
												$max_price 	= stripslashes($sub_pro_d['max_price']);
												$sell_price	= stripslashes($sub_pro_d['sell_price']);
												$folder = SUB_PRODUCT_THUMB_SMALL;
												$url 	= SITEURL.$catSlug."/".$hscat_slug."/p/".$pro_slug."/s/".$spslug;
											}
										}else{
											$pro_r = $db->rp_getData("product","*","id='".$pid."'");
											if(mysql_num_rows($pro_r)>0){
												$pro_d 		= mysql_fetch_array($pro_r);
												
												$cid 		= stripslashes($pro_d['cid']);
												$sid 		= stripslashes($pro_d['sid']);
												$name	= stripslashes($pro_d["name"]);
												$pro_slug	= stripslashes($pro_d["slug"]);
												
												$cat_d		= mysql_fetch_array($db->rp_getData("category","slug,name","id=".$cid));
												$catSlug	= stripslashes($cat_d['slug']);
												
												$hscat_slug = stripslashes($db->rp_getValue("sub_category","slug","id='".$sid."'"));
												$isAffiliate 	= $pro_d['isAffiliate']; 
												$aff_image_path = $pro_d['aff_image_path'];
												
												$pro_sku	= stripslashes($pro_d["sku"]);
												$status		= stripslashes($pro_d["status"]);
												$image_path = stripslashes($pro_d["image_path"]);
												$max_price 	= stripslashes($pro_d['max_price']);
												$sell_price	= stripslashes($pro_d['sell_price']);
												$folder = PRODUCT_THUMB_SMALL;
												$url 	= SITEURL.$catSlug."/".$hscat_slug."/p/".$pro_slug;
											}
										}
										?>
										<?php
										$imgP = $image_path;
										if($isAffiliate==1 && $aff_image_path!="" && true == file_get_contents($aff_image_path,0,null,0,1)) {
											$pimg_path = $aff_image_path;
										}else if($imgP!="" && file_exists("../".$folder.$imgP)){
											$pimg_path = SITEURL.$folder.$imgP;
										}else{
											$pimg_path = SITEURL."images/noimage.jpg";
										}
										?>
											<tr class="item-row" style="margin: 0;padding: 0">
												<td align="center" style="margin: 0;padding: 5px;border: 0;vertical-align: top;width: 120px;">
													<div class="delete-wpr" style="margin: 0;padding: 0;position: relative">
														<a href="<?php echo $url; ?>/" title="<?php echo $name; ?>">
															<div style="background-image:url('<?php echo $pimg_path; ?>');background-position: center center;background-repeat: no-repeat;background-size: contain;height: 73px;width: 58px;">
																	
															</div>
														</a>
													</div>
												</td>
												<td style="margin: 0;padding: 5px;border: 0;vertical-align: middle;text-align: left;width: 250px;border-right: 1px solid black;">
													<a href="<?php echo $url; ?>/" title="<?php echo $name; ?>"><?php echo $db->rp_limitChar($name,90); ?></a>
												</td>
												<td style="margin: 0;padding: 5px;border: 0;vertical-align: middle;text-align: right;width: 100px;border-right: 1px solid black;">
													<span class="price" style="margin: 0;padding: 0">
													<?php 
													if($sell_price<$max_price && $sell_price!=$max_price){ 
														echo CURR.$sell_price; 
													}else{
														echo CURR.$sell_price;
													}
													?>
													</span>
												</td>
												<td style="margin: 0;padding: 5px;border: 0;vertical-align: middle;text-align: right;width: 100px;">
													<a href="<?php echo $url; ?>/">Add to cart</a>
												</td>
											</tr>
											<?php
											}
										}
										
											?>
												</table>
											</div>
										</div>
										</td>
								</tr>
							</table>
							<!--[if gte mso 9]>
									</td>
									</tr>
									</table>
									<![endif]-->
						</td>
					</tr>
					<tr>
						<td align="center" valign="top" id="templateFooter"><!--[if gte mso 9]>
									<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
									<tr>
									<td align="center" valign="top" width="600" style="width:600px;">
									<![endif]-->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
								<tr>
									<td valign="top" class="footerContainer"><table class="mcnFollowBlock" style="min-width:100%;" width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody class="mcnFollowBlockOuter">
												<tr>
													<td style="padding:9px" class="mcnFollowBlockInner" valign="top" align="center"><table class="mcnFollowContentContainer" style="min-width:100%;" width="100%" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td style="padding-left:9px;padding-right:9px;" align="center"><table style="min-width:100%;" class="mcnFollowContent" width="100%" border="0" cellpadding="0" cellspacing="0">
																			<tbody>
																				<tr>
																					<td style="padding-top:9px; padding-right:9px; padding-left:9px;" valign="top" align="center"><table align="center" border="0" cellpadding="0" cellspacing="0">
																							<tbody>
																								<tr>
																									<td valign="top" align="center"><!--[if mso]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <![endif]-->
																										<!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
																										<table style="display:inline;" align="left" border="0" cellpadding="0" cellspacing="0">
																											<tbody>
																												<tr>
																													<td style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer" valign="top"><table class="mcnFollowContentItem" width="100%" border="0" cellpadding="0" cellspacing="0">
																															<tbody>
																																<tr>
																																	<td style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;" valign="middle" align="left"><table width="" align="left" border="0" cellpadding="0" cellspacing="0">
																																			<tbody>
																																				<tr>
																																					<td class="mcnFollowIconContent" valign="middle" width="24" align="center"><a href="<?php echo SITEURL; ?>" target="_blank"><img src="<?php echo SITEURL; ?>images/color-link-48.png" style="display:block;" class="" height="24" width="24"></a> </td>
																																				</tr>
																																			</tbody>
																																		</table></td>
																																</tr>
																															</tbody>
																														</table></td>
																												</tr>
																											</tbody>
																										</table>
																										<!--[if mso]>
                                        </td>
                                        <![endif]-->
																										<!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
																										<table style="display:inline;" align="left" border="0" cellpadding="0" cellspacing="0">
																											<tbody>
																												<tr>
																													<td style="padding-right:0; padding-bottom:9px;" class="mcnFollowContentItemContainer" valign="top"><table class="mcnFollowContentItem" width="100%" border="0" cellpadding="0" cellspacing="0">
																															<tbody>
																																<tr>
																																	<td style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;" valign="middle" align="left"><table width="" align="left" border="0" cellpadding="0" cellspacing="0">
																																			<tbody>
																																				<tr>
																																					<td class="mcnFollowIconContent" valign="middle" width="24" align="center"><a href="mailto:info@mufat.in" target="_blank"><img src="<?php echo SITEURL; ?>images/color-forwardtofriend-48.png" style="display:block;" class="" height="24" width="24"></a> </td>
																																				</tr>
																																			</tbody>
																																		</table></td>
																																</tr>
																															</tbody>
																														</table></td>
																												</tr>
																											</tbody>
																										</table>
																										<!--[if mso]>
                                        </td>
                                        <![endif]-->
																										<!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
																									</td>
																								</tr>
																							</tbody>
																						</table></td>
																				</tr>
																			</tbody>
																		</table></td>
																</tr>
															</tbody>
														</table></td>
												</tr>
											</tbody>
										</table>
										<table class="mcnDividerBlock" style="min-width:100%;" width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody class="mcnDividerBlockOuter">
												<tr>
													<td class="mcnDividerBlockInner" style="min-width: 100%; padding: 10px 18px 25px;"><table class="mcnDividerContent" style="min-width: 100%;border-top: 2px solid #0461C5;" width="100%" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td><span></span> </td>
																</tr>
															</tbody>
														</table>
														<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
													</td>
												</tr>
											</tbody>
										</table>
										<table class="mcnTextBlock" style="min-width:100%;" width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody class="mcnTextBlockOuter">
												<tr>
													<td class="mcnTextBlockInner" valign="top"><table style="min-width:100%;" class="mcnTextContentContainer" width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td class="mcnTextContent" style="padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;" valign="top"><div style="text-align: center;">Copyright &copy; <?php echo date("Y"); ?> <?php echo SITENAME; ?> - All rights Reserved</div></td>
																</tr>
															</tbody>
														</table></td>
												</tr>
											</tbody>
										</table></td>
								</tr>
							</table>
							<!--[if gte mso 9]>
									</td>
									</tr>
									</table>
									<![endif]-->
						</td>
					</tr>
				</table>
				<!-- // END TEMPLATE -->
			</td>
		</tr>
	</table>
</center>
</body>
</html>
