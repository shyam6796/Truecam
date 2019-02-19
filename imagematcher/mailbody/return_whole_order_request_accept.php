<?php
include("../connect.php");
$cart_id = $_REQUEST['cart_id'];
$payment_method_arr = array("1"=>"Cash On Delivery", "2"=>"Online Payment");
$order_status_arr = array("0"=>"Cancelled", "1"=>"In Progress", "2"=>"Completed", "3"=>"Shipped", "4"=>"Delivered");
$cart_detail_r = $db->rp_getData("cartdetails","*","cart_id='".$cart_id."'");
$cart_detail_d = mysql_fetch_array($cart_detail_r);
$invoice_id 	= $db->rp_getValue("invoice","id","cart_id='".$cart_detail_d['cart_id']."'");
$orderstatus 	= $cart_detail_d['orderstatus'];
$totalSingleRefund			= 0;
$totalSingleShippingRefund	= 0;
$totalSingleCODRefund		= 0;
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
<title><?php echo SITENAME; ?> | Order Return Request Accepted</title>
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
																	<td class="mcnTextContent" style="padding-top:9px; padding-bottom: 9px;" valign="top"><strong><span style="font-family:calibri,sans-serif; font-size:14.0pt; line-height:107%">Dear <?php echo stripslashes($cart_detail_d['name']); ?>,</span></strong>
																		<div style="text-align:justify;padding-top:5px;">We have accepted return request for your order <a href="<?php echo SITEURL; ?>order/<?php echo $cart_id; ?>/" style="color:#2baadf;font-weight:normal;text-decoration:underline" target="_blank">#<?php echo $cart_id; ?></a></div>
																		<div style="text-align:justify;padding-top:5px;">Pickup has been scheduled for the original item(s) and refund will be initiated once the pickup is done successfully. Our courier partner will pick the item(s) below by next 5 days.</div></td>
																</tr>
															</tbody>
														</table></td>
												</tr>
											</tbody>
										</table>
										<div id="header" style="margin: 20px 0;padding: 8px 0;border: 0;font: bold 15px Helvetica, Sans-Serif;overflow: hidden;resize: none;height: 15px;width: 100%;background: #222;text-align: center;color: white;text-decoration: uppercase;letter-spacing: 20px">Order Details</div>
										<div id="identity" style="margin: 0;padding: 0">
											<div id="address" style="margin: 0;padding: 0;border: 0;font: 14px Georgia, Serif;overflow: hidden;resize: none;width: 250px;height: 150px;float: left"> Delivery Address :-<br>
												<?php
												echo stripslashes($cart_detail_d['name']); echo "<br>";
												echo stripslashes($cart_detail_d['address1']); echo "<br>";
												echo stripslashes($cart_detail_d['zip']); echo "<br>";
												?>
												<br>
												Email: <?php echo stripslashes($cart_detail_d['email']); ?> <br>
												Phone: <?php echo stripslashes($cart_detail_d['phone']); ?> </div>
											<div id="logo" style="margin: 0;padding: 0;text-align: right;float: right;position: relative;margin-top: 25px;border: 1px solid #fff;max-width: 540px;max-height: 100px;overflow: hidden">
												<div id="logohelp" style="margin: 0;padding: 10px 5px;text-align: left;font-style: italic"> <img id="image" src="<?php echo SITEURL; ?>assets/images/logo.png" alt="logo" style="margin: 0;padding: 0"/> </div>
											</div>
											<div style="clear: both;margin: 0;padding: 0">
												<div id="customer" style="margin: 0;padding: 0;overflow: hidden">
													<table id="meta" style="margin: 0;padding: 0;border-collapse: collapse;margin-top: 1px;width: 300px;float: right">
														<tr style="margin: 0;padding: 0">
															<td class="meta-head" style="margin: 0;padding: 5px;border: 1px solid black;text-align: left;background: #eee">Invoice #</td>
															<td style="margin: 0;padding: 5px;border: 1px solid black;text-align: right"><div style="margin: 0;padding: 0;border: 0;font: 14px Georgia, Serif;overflow: hidden;resize: none;width: 100%;height: 20px;text-align: right"><?php echo $invoice_id; ?></div></td>
														</tr>
														<tr style="margin: 0;padding: 0">
															<td class="meta-head" style="margin: 0;padding: 5px;border: 1px solid black;text-align: left;background: #eee">Date</td>
															<td style="margin: 0;padding: 5px;border: 1px solid black;text-align: right"><div id="date" style="margin: 0;padding: 0;border: 0;font: 14px Georgia, Serif;overflow: hidden;resize: none;width: 100%;height: 20px;text-align: right"><?php echo date_format(date_create($cart_detail_d['orderdate']),'Y-m-d H:i:s'); ?></div></td>
														</tr>
														<tr style="margin: 0;padding: 0">
															<td class="meta-head" style="margin: 0;padding: 5px;border: 1px solid black;text-align: left;background: #eee">Amount Paid</td>
															<td style="margin: 0;padding: 5px;border: 1px solid black;text-align: right"><div class="due" style="margin: 0;padding: 0"><?php echo CURR.$db->rp_num($cart_detail_d['finaltotal']); ?></div></td>
														</tr>
													</table>
												</div>
												<table id="items" style="margin: 30px 0 0 0;padding: 0;border-collapse: collapse;clear: both;width: 100%;border: 1px solid black">
													<tr style="margin: 0;padding: 0">
														<th colspan="2" style="margin: 0;padding: 5px;border: 1px solid black;background: #eee">Product Name</th>
														<th style="margin: 0;padding: 5px;border: 1px solid black;background: #eee">Price</th>
													</tr>
													<?php
									$shop_cart_r = $db->rp_getData("cartitems","*","cart_id='".$cart_id."'");
									if(mysql_num_rows($shop_cart_r)>0){
										$discount = 0;
										$sub_total= 0;
										$total_ship_charge= 0;
										
										while($shop_cart_d = mysql_fetch_array($shop_cart_r)){
											
											$id 		= $shop_cart_d['id'];
											$pid 		= $shop_cart_d['pid'];
											$subpid 	= $shop_cart_d['subpid'];
											$qty 		= $shop_cart_d['qty'];
											$orderitemstatus = $shop_cart_d['orderstatus'];
											$attr		= unserialize($shop_cart_d["attr"]);
											$ship_charge= $db->rp_num($shop_cart_d["ship_charge"]);
											$total_ship_charge += $ship_charge;
											$ship_days	= intval($shop_cart_d["ship_days"]);
											$unitprice 	= $db->rp_num($shop_cart_d['unitprice']);
											$single_discount	= $db->rp_num($shop_cart_d['discount']);
											$discount	+= $shop_cart_d['discount'];
											$totalprice = $db->rp_num($shop_cart_d['totalprice']);
											$sub_total 	+= $totalprice;
											if($orderitemstatus==0 || $orderitemstatus==5){
												$singleRefund = $db->rp_getSingleItemRefundAmount($cart_id,$id);
												$singleShippingRefund = $db->rp_getSingleItemShippingRefundAmount($cart_id,$id);
												$singleCODRefund = $db->rp_getSingleItemCODRefundAmount($cart_id,$id,$cart_detail_d['payment_method']);
												$totalSingleRefund += $singleRefund;
												$totalSingleShippingRefund += $singleShippingRefund;
												$totalSingleCODRefund += $singleCODRefund;
											}
												if($subpid>0){
													$sub_pro_r = $db->rp_getData("sub_product","*","id='".$subpid."'");
													if(mysql_num_rows($sub_pro_r)>0){
														$sub_pro_d 	= mysql_fetch_array($sub_pro_r);
														
														$cid 		= stripslashes($sub_pro_d['cid']);
														$sid 		= stripslashes($sub_pro_d['sid']);
														$pro_name	= stripslashes($sub_pro_d["name"]);
														$pro_slug	= stripslashes($db->rp_getValue("product","slug","id='".$pid."'"));
														$spslug		= stripslashes($sub_pro_d["slug"]);
														
														$cat_d		= mysql_fetch_array($db->rp_getData("category","slug,name","id=".$cid));
														$catSlug	= stripslashes($cat_d['slug']);
														
														$hscat_slug = stripslashes($db->rp_getValue("sub_category","slug","id='".$sid."'"));
														
														$pro_sku	= stripslashes($sub_pro_d["sku"]);
														$status		= stripslashes($sub_pro_d["status"]);
														$image_path = stripslashes($sub_pro_d["image_path"]);
														$folder = SUB_PRODUCT_THUMB_SMALL;
														$url 	= SITEURL.$catSlug."/".$hscat_slug."/p/".$pro_slug."/s/".$spslug;
													}
												}else{
													$pro_r = $db->rp_getData("product","*","id='".$pid."'");
													if(mysql_num_rows($pro_r)>0){
														$pro_d 		= mysql_fetch_array($pro_r);
														
														$cid 		= stripslashes($pro_d['cid']);
														$sid 		= stripslashes($pro_d['sid']);
														$pro_name	= stripslashes($pro_d["name"]);
														$pro_slug	= stripslashes($pro_d["slug"]);
														
														$cat_d		= mysql_fetch_array($db->rp_getData("category","slug,name","id=".$cid));
														$catSlug	= stripslashes($cat_d['slug']);
														
														$hscat_slug = stripslashes($db->rp_getValue("sub_category","slug","id='".$sid."'"));
														
														$pro_sku	= stripslashes($pro_d["sku"]);
														$status		= stripslashes($pro_d["status"]);
														$image_path = stripslashes($pro_d["image_path"]);
														$folder = PRODUCT_THUMB_SMALL;
														$url 	= SITEURL.$catSlug."/".$hscat_slug."/p/".$pro_slug;
													}
												}
												?>
													<tr class="item-row" style="margin: 0;padding: 0">
														<td class="item-name" style="margin: 0;padding: 5px;border: 0;vertical-align: top;width: 500px;border-right: 1px solid black;" colspan="2"><div class="delete-wpr" style="margin: 0;padding: 0;position: relative"> <?php echo $pro_name; ?></div></td>
														<td style="margin: 0;padding: 5px;border: 0;vertical-align: top;text-align: right;width: 150px;"><span class="price" style="margin: 0;padding: 0">
															<?php
																if($discount>0){
																	echo CURR.$totalprice.'<br>';
																	echo '-'.CURR.$db->num($discount);
																}else{
																	echo CURR.$totalprice;
																}
																echo ' x '.$qty;
																?>
															</span> </td>
													</tr>
													<?php
											}
										}
												
										$sub_total = $db->rp_num($sub_total);
										$temp_total = $sub_total-$discount;
										$cod_charge	= $db->rp_num($temp_total*($cart_detail_d['COD_PER']/100));
										if($cod_charge<$cart_detail_d['COD_FLAT']){
											$cod_charge = $db->rp_num($cart_detail_d['COD_FLAT']);
										}
										$shipping_charge = $db->rp_num($total_ship_charge);
										$shipping_discount 	= $cart_detail_d['total_shipping_discount'];
										if($shipping_discount>0){
											if($sub_total<$cart_detail_d['MOTAFSD']){
												$shipping_discount = 0.00;
											}else{
												if($sub_total>=$cart_detail_d['MOTAFSD']){
													$disc_amount = $db->rp_num(($shipping_charge*$cart_detail_d['SDP'])/100);
													if($disc_amount<=$shipping_charge){
														$shipping_discount = $db->rp_num($disc_amount);
													}else{
														$shipping_discount = 0.00;
													}
												}else{
													$shipping_discount = 0.00;
												}
											}
										}
										$tax = $db->rp_num(0.00);
										$final_total = $db->rp_num(($sub_total + $shipping_charge + $tax) - $discount - $shipping_discount);
																		
											?>
													<tr id="hiderow" style="margin: 0;padding: 0;">
														<td colspan="3" style="margin: 0;padding: 5px;border: 1px solid black">&nbsp;</td>
													</tr>
													<tr style="margin: 0;padding: 0">
														<td colspan="2" class="total-line" style="margin: 0;padding: 5px;border: 1px solid black;border-right: 1px solid black;text-align: right">Subtotal</td>
														<td class="total-value" style="margin: 0;padding: 10px;border: 1px solid black;border-left: 0;text-align: right;"><div id="subtotal" style="margin: 0;padding: 0"><?php echo CURR.$sub_total; ?> </div></td>
													</tr>
													<?php
											if($discount>0){		
												?>
													<tr style="margin: 0;padding: 0">
														<td class="total-line" style="margin: 0;padding: 5px;border: 1px solid black;border-right: 1px solid black;text-align: right" colspan="2">Coupon Discount</td>
														<td class="total-value" style="margin: 0;padding: 10px;border: 1px solid black;border-left: 0;text-align: right;"><div id="subtotal" style="margin: 0;padding: 0">-<?php echo CURR.$db->rp_num($discount);?></div></td>
													</tr>
													<?php
											}	
											?>
													<tr style="margin: 0;padding: 0">
														<td colspan="2" class="total-line" style="margin: 0;padding: 5px;border: 1px solid black;border-right: 1px solid black;text-align: right">Shipping Charge</td>
														<td class="total-value" style="margin: 0;padding: 10px;border: 1px solid black;border-left: 0;text-align: right;"><div id="subtotal" style="margin: 0;padding: 0"><?php echo CURR.$shipping_charge;?></div></td>
													</tr>
													<?php
											if($shipping_discount>0){		
											?>
											<tr style="margin: 0;padding: 0">
												<td class="blank" style="margin: 0;padding: 5px;border: 0"/>
												<td class="total-line" style="margin: 0;padding: 5px;border: 1px solid black;border-right: 1px solid black;text-align: right">Shipping Discount</td>
												<td class="total-value" style="margin: 0;padding: 10px;border: 1px solid black;border-left: 0;text-align: right;">
													<div id="subtotal" style="margin: 0;padding: 0">-<?php echo CURR.$shipping_discount;?></div>
												</td>
											</tr>
											<?php
											}	
											?>
											<?php
											if($cart_detail_d['payment_method']==1){ 
												$final_total = $db->rp_num($final_total+$cod_charge);
												?>
													<tr style="margin: 0;padding: 0">
														<td class="blank" style="margin: 0;padding: 5px;border: 0"/>
														<td class="total-line" style="margin: 0;padding: 5px;border: 1px solid black;border-right: 1px solid black;text-align: right">COD Handling Charge</td>
														<td class="total-value" style="margin: 0;padding: 10px;border: 1px solid black;border-left: 0;text-align: right;"><div id="subtotal" style="margin: 0;padding: 0"><?php echo CURR.$cod_charge;?></div></td>
													</tr>
													<?php	
											}
											?>
												<tr style="margin: 0;padding: 0">
													<td colspan="2" class="total-line" style="margin: 0;padding: 5px;border: 1px solid black;border-right: 1px solid black;text-align: right">Total</td>
													<td class="total-value" style="margin: 0;padding: 10px;border: 1px solid black;border-left: 0;text-align: right;"><div id="total" style="margin: 0;padding: 0"><?php echo CURR.$final_total;?></div></td>
												</tr>
												<?php
												if($totalSingleRefund>0){
													if(($orderstatus==0 && $payment_method==2) || $orderstatus==5){
													?>
													<tr style="margin: 0;padding: 0">
														<td colspan="2" class="total-line" style="margin: 0;padding: 5px;border: 1px solid black;border-right: 1px solid black;text-align: right">Refundable Amount</td>
														<td class="total-value" style="margin: 0;padding: 10px;border: 1px solid black;border-left: 0;text-align: right;">
															<?php	
															$refSing = $db->rp_num($totalSingleRefund+$totalSingleShippingRefund+$totalSingleCODRefund);
															$t1 = $refSing - $totalSingleRefund;
															$t2 = $shipping_charge - $t1;$t3 = $refSing - $t1;
															$t4 = $t3 - $t2;
															?>
															<div id="total" style="margin: 0;padding: 0">-<?php echo CURR.$db->rp_num($t4); ?></div>
														</td>
													</tr>
													<?php	
													}
												}
												?>
												</table>
											</div>
										</div>
										<table class="mcnTextBlock" style="min-width:100%;" width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody class="mcnTextBlockOuter">
												<tr>
													<td class="mcnTextBlockInner" valign="top"><table style="min-width:100%;" class="mcnTextContentContainer" width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td class="mcnTextContent" style="padding-top:9px;  padding-bottom: 9px; " valign="top"><strong>Important things to remember:</strong><br>
																		<ul>
																			<li><strong>STEP 1: Ready for pickup</strong>
																				<ul style="list-style-type:circle;">
																					<li>Please ensure that the item/s is ready with original product box, along with all the contents including accessories, price tags, labels, invoice, etc.</li>
																					<li>Please note that in absence of above courier partner will not be able to do the pickup of original item.</li>
																					<li>Do not seal the package as the contents will be verified, packed and sealed by our Courier Executive.</li>
																				</ul>
																			</li>
																		</ul>
																		<ul>
																			<li><strong>STEP 2: Verification and Handover</strong>
																				<ul style="list-style-type:circle;">
																					<li>Courier partner will verify the contents for return of original item.</li>
																					<li>On successful verification courier partner will pick the item/s and will give you an acknowledgement slip for the same.</li>
																					<li>Retain the acknowledgment slip provided to you and make a note of the Return Id for future reference.</li>
																				</ul>
																			</li>
																		</ul>
																		<ul>
																			<li><strong>STEP 3: Refund Initiated</strong>
																				<ul style="list-style-type:circle;">
																					<li>On successful pickup, we will initiate the refund.</li>
																				</ul>
																			</li>
																		</ul>
																		We apologize for any inconvenience caused to you.<br>
																		&nbsp; </td>
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
