<?php
include("../connect.php");
?>
<!DOCTYPE html>
<html lang="en">
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
<title><?php echo SITENAME; ?> | Signup Successful</title>
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
	<table style="border-collapse:collapse;height:100%;margin:0;padding:0;width:100%;background-color:#fafafa" align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
	<tbody>
		<tr>
			<td style="height:100%;margin:0;padding:0;width:100%;border-top:0" align="center" valign="top"><table style="border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody>
						<tr>
							<td style="background-color:#fafafa;border-top:0;border-bottom:0;padding-top:9px;padding-bottom:9px" align="center" valign="top"><table style="border-collapse:collapse;max-width:600px!important" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td valign="top"><table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding-top:9px" valign="top"><table style="max-width:300px;border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td style="padding-top:0;padding-left:18px;padding-bottom:9px;padding-right:18px;word-break:break-word;color:#656565;font-family:Helvetica;font-size:12px;line-height:150%;text-align:left" valign="top"><img class="CToWUd" src="<?php echo SITEURL; ?>assets/images/logo.png" style="width:132px;min-height:37px;margin:0px;border:0;outline:none;text-decoration:none" align="none" height="37" width="132"> </td>
																		</tr>
																	</tbody>
																</table>
																<table style="max-width:300px;border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td style="padding-top:0;padding-left:18px;padding-bottom:9px;padding-right:18px;word-break:break-word;color:#656565;font-family:Helvetica;font-size:12px;line-height:150%;text-align:left" valign="top"><span>We're so excited you joined us.</span> </td>
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
						<tr>
							<td style="background-color:#ffffff;border-top:0;border-bottom:0;padding-top:9px;padding-bottom:0" align="center" valign="top"><table style="border-collapse:collapse;max-width:600px!important" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td valign="top"><table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding:9px" valign="top"><table style="min-width:100%;border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td style="padding-right:9px;padding-left:9px;padding-top:0;padding-bottom:0;text-align:center" valign="top"><a href="<?php echo SITEURL; ?>" title="" target="_blank" data-saferedirecturl="<?php echo SITEURL; ?>"> <img class="CToWUd" alt="" src="<?php echo SITEURL; ?>images/signup_img.jpg" style="max-width:848px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;min-height:auto;outline:none;text-decoration:none" align="middle" width="564"> </a> </td>
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
						<tr>
							<td style="background-color:#ffffff;border-top:0;border-bottom:0;padding-top:9px;padding-bottom:9px" align="center" valign="top"><table style="border-collapse:collapse;max-width:600px!important" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td valign="top"><table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding-top:9px" valign="top"><table style="max-width:100%;min-width:100%;border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td style="padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px;word-break:break-word;color:#202020;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left" valign="top">
																				<div style="text-align:center">Dear Mufat.in Member, Your temporary password is your mobile. You can change it at anytime by login in <a href="<?php echo SITEURL; ?>">mufat.in</a>.</div></td>
																		</tr>
																		<tr>
																			<td style="padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px;word-break:break-word;color:#202020;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left" valign="top"><h2 style="text-align:center;display:block;margin:0;padding:0;color:#202020;font-family:Helvetica;font-size:22px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing:normal">It's time to know about latest trends, special offers, and other benefits.</h2>
																				<div style="text-align:center">Buy your favorite product among 50+ categories and 5000+ products. get your product at your door step easily. Get the deals beyond your imagination.</div></td>
																		</tr>
																	</tbody>
																</table></td>
														</tr>
													</tbody>
												</table>
												<table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding-top:0;padding-right:18px;padding-bottom:18px;padding-left:18px" align="center" valign="top"><table style="border-collapse:separate!important;border-radius:3px;background-color:#167fbb" border="0" cellpadding="0" cellspacing="0">
																	<tbody>
																		<tr>
																			<td style="font-family:Arial;font-size:16px;padding:15px" align="center" valign="middle"><a title="Start Shopping now" href="<?php echo SITEURL; ?>" style="font-weight:bold;letter-spacing:normal;line-height:100%;text-align:center;text-decoration:none;color:#ffffff;display:block" target="_blank" data-saferedirecturl="<?php echo SITEURL; ?>">Start Shopping now</a> </td>
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
						<tr>
							<td style="background-color:#ffffff;border-top:0;border-bottom:2px solid #eaeaea;padding-top:0;padding-bottom:9px" align="center" valign="top"><table style="border-collapse:collapse;max-width:600px!important" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td valign="top">
												<?php
												$ctable_where 	= "isOffer=1 AND isDelete=0 AND status=0";
												$orderBy		= "rand() LIMIT 3";
												$ctable_r = $db->rp_getData("product","*",$ctable_where,$orderBy);
												if(mysql_num_rows($ctable_r)>0){
													
												}else{	
													$ctable_where 	= "isDelete=0 AND status=0";
													$ctable_r = $db->rp_getData("product","*",$ctable_where,$orderBy);
												}
												if(mysql_num_rows($ctable_r)>0){
													$count=0;
													while($ctable_d = mysql_fetch_array($ctable_r)){
													$count++;
													$hcat_slug 	= stripslashes($db->rp_getValue("category","slug","id='".$ctable_d['cid']."'"));
													$hscat_slug = stripslashes($db->rp_getValue("sub_category","slug","id='".$ctable_d['sid']."'"));
													$hpro_slug 	= stripslashes($ctable_d['slug']);
													if($ctable_d['subpid']>0){
														$spslug	= stripslashes($ctable_d['spslug']);
														$folder = SUB_PRODUCT_THUMB;
														$url 	= SITEURL.$hcat_slug."/".$hscat_slug;
													}else{
														$folder = PRODUCT_THUMB;
														$url 	= SITEURL.$hcat_slug."/".$hscat_slug;
													}
													?>
													<?php
													$imgP = $ctable_d['image_path'];
													if($ctable_d['isAffiliate']==1 && true == file_get_contents($ctable_d['aff_image_path'],0,null,0,1)) {
														$pimg_path = $ctable_d['aff_image_path'];
													}else if($imgP!="" && file_exists("../".$folder.$imgP)){
														$pimg_path = SITEURL.$folder.$imgP;
													}else{
														$pimg_path = SITEURL."images/no_product.jpg";
													}
													?>
													<table style="border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="200">
														<tbody>
															<tr>
																<td valign="top">
																	<table style="border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
																		<tbody>
																			<tr>
																				<td style="padding:9px" valign="top"><table style="border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="false">
																						<tbody>
																							<tr>
	
																								<td style="padding:0 9px 9px 9px" align="center" valign="top">
																								<a href="<?php echo $url; ?>/" title="<?php echo stripslashes($ctable_d['name']); ?>" target="_blank">
																								<div style="background-image:url('<?php echo $pimg_path; ?>');width:164px;border:0;height:248px;outline:none;text-decoration:none;vertical-align:bottom;background-position: center center;background-repeat: no-repeat;background-size: contain;">
																								
																								</div>
																								</a>
																								</td>
																							</tr>
																							<tr>
																								<td style="padding:0px 9px;text-align:left;word-break:break-word;color:#202020;font-family:Helvetica;font-size:16px;line-height:150%" valign="top" width="164">
																								<h1 style="display:block;margin:0;padding:0;color:#202020;font-family:Helvetica;font-size:26px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing:normal;text-align:left"><span style="font-family:georgia,times,times new roman,serif"><span style="font-size:14px"><a href="<?php echo $url; ?>/" style="display:block;margin:0;padding:0;color:#202020;font-family:Helvetica;font-size:12px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing:normal;text-align:left" title="<?php echo stripslashes($ctable_d['name']); ?>"><?php echo stripslashes($db->rp_limitChar($ctable_d['name'],42,"")); ?></a></span></span></h1>
																									<span>
																										<?php 
																										echo CURR.$ctable_d['sell_price'];
																										?>
																									</span>
																								</td>
																							</tr>
																						</tbody>
																					</table></td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
													<?php 
													}
												}
												?>
											</td>
										</tr>
									</tbody>
								</table></td>
						</tr>
						<tr>
							<td style="background-color:#fafafa;border-top:0;border-bottom:0;padding-top:9px;padding-bottom:9px" align="center" valign="top"><table style="border-collapse:collapse;max-width:600px!important" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td valign="top"><table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding:9px" align="center" valign="top"><table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td style="padding-left:9px;padding-right:9px" align="center"><table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
																					<tbody>
																						<tr>
																							<td style="padding-top:9px;padding-right:9px;padding-left:9px" align="center" valign="top"><table style="border-collapse:collapse" align="center" border="0" cellpadding="0" cellspacing="0">
																									<tbody>
																										<tr>
																											<td align="center" valign="top"><table style="display:inline;border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0">
																													<tbody>
																														<tr>
																															<td style="padding-right:10px;padding-bottom:9px" valign="top"><table style="border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
																																	<tbody>
																																		<tr>
																																			<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px" align="left" valign="middle"><table style="border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="">
																																					<tbody>
																																						<tr>
																																							<td align="center" valign="middle" width="24"><a href="https://www.facebook.com/mufatdotin/" target="_blank"><img class="CToWUd" src="<?php echo SITEURL; ?>images/mail_fb.png" style="display:block;border:0;min-height:auto;outline:none;text-decoration:none" height="24" width="24"></a> </td>
																																						</tr>
																																					</tbody>
																																				</table></td>
																																		</tr>
																																	</tbody>
																																</table></td>
																														</tr>
																													</tbody>
																												</table>
																												<table style="display:inline;border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0">
																													<tbody>
																														<tr>
																															<td style="padding-right:10px;padding-bottom:9px" valign="top"><table style="border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
																																	<tbody>
																																		<tr>
																																			<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px" align="left" valign="middle"><table style="border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="">
																																					<tbody>
																																						<tr>
																																							<td align="center" valign="middle" width="24"><a href="<?php echo SITEURL; ?>" target="_blank"><img class="CToWUd" src="<?php echo SITEURL; ?>images/color-link-48.png" style="display:block;border:0;min-height:auto;outline:none;text-decoration:none" height="24" width="24"></a> </td>
																																						</tr>
																																					</tbody>
																																				</table></td>
																																		</tr>
																																	</tbody>
																																</table></td>
																														</tr>
																													</tbody>
																												</table>
																												<table style="display:inline;border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0">
																													<tbody>
																														<tr>
																															<td style="padding-right:0;padding-bottom:9px" valign="top"><table style="border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
																																	<tbody>
																																		<tr>
																																			<td style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px" align="left" valign="middle"><table style="border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="">
																																					<tbody>
																																						<tr>
																																							<td align="center" valign="middle" width="24"><a href="mailto:care@mufat.in" target="_blank"><img class="CToWUd" src="<?php echo SITEURL; ?>images/color-forwardtofriend-48.png" style="display:block;border:0;min-height:auto;outline:none;text-decoration:none" height="24" width="24"></a> </td>
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
												<table style="min-width:100%;border-collapse:collapse;table-layout:fixed!important" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="min-width:100%;padding:10px 18px 25px"><table style="min-width:100%;border-top:2px solid #004fa3;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td><span></span> </td>
																		</tr>
																	</tbody>
																</table></td>
														</tr>
													</tbody>
												</table>
												<table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding-top:9px" valign="top"><table style="max-width:100%;min-width:100%;border-collapse:collapse" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td style="padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px;word-break:break-word;color:#656565;font-family:Helvetica;font-size:12px;line-height:150%;text-align:center" valign="top"><div style="text-align:center">Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo SITEURL; ?>" style="color:#656565;font-weight:normal;text-decoration:underline" target="_blank">Mufat</a> - All rights Reserved</div></td>
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
				</table></td>
		</tr>
	</tbody>
</table>
</center>
</body>
</html>
