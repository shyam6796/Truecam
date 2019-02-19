<?php
include("../connect.php");

include("../include/no_to_word.php");
$cart_id	= $_REQUEST['cart_id'];
$cart_detail_r 	= $db->rp_getData("cartdetails","*","cart_id='".$cart_id."'");
$cart_detail_d 	= mysql_fetch_array($cart_detail_r);
$invoice_id 	= $db->rp_getValue("invoice","id","cart_id='".$cart_detail_d['cart_id']."'");
$orderstatus 	= $cart_detail_d['orderstatus'];
$payment_method = $cart_detail_d['payment_method'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
    <style>
        *
        {
            margin:0;
            padding:0;
            font-family:Arial;
            font-size:10pt;
            color:#000;
        }
        body
        {
            width:100%;
            font-family:Arial;
            font-size:10pt;
            margin:0;
            padding:0;
        }
         
        p
        {
            margin:0;
            padding:0;
        }
         
        #wrapper
        {
            width:180mm;
            margin:0 15mm;
        }
         
        .page
        {
            height:297mm;
            width:210mm;
            page-break-after:always;
        }
 
        table
        {
            /*border-left: 1px solid #000000;
            border-top: 1px solid #000000;*/
             
            border-spacing:0;
            border-collapse: collapse; 
             
        }
         
        table td 
        {
           /* border-right: 1px solid #000000;
            border-bottom: 1px solid #000000;*/
            padding: 2mm;
        }
         
        table.heading
        {
           /* height:50mm;*/
        }
         
        h1.heading
        {
            font-size:14pt;
            color:#000;
            font-weight:normal;
        }
         
        h2.heading
        {
            font-size:9pt;
            color:#000;
            font-weight:normal;
        }
         
        hr
        {
            color:#ccc;
            background:#ccc;
        }
         
        #invoice_body
        {
            margin-bottom:2mm;
        }
         
        #invoice_body , #invoice_total
        {   
            width:100%;
        }
        #invoice_body table , #invoice_total table
        {
            width:100%;
           /* border-top: 1px solid #000000;*/
     
            border-spacing:0;
            border-collapse: collapse; 
             
            margin-top:5mm;
        }
         
        #invoice_body table td , #invoice_total table td
        {
            text-align:center;
            font-size:9pt;
            /*border-right: 1px solid #000000;
            border-bottom: 1px solid #000000;*/
            padding:2mm 0;
			
        }
         
        #invoice_body table td.rp_right  , #invoice_total table td.rp_right
        {
            text-align:right;
            padding-right:2mm;
            font-size:9pt;
        }
         
        #footer
        {   
            width:185mm;
            margin:0 15mm;
            padding-bottom:3mm;
        }
        #footer table
        {
            width:100%;
            border-left: 1px solid #000000;
            border-top: 1px solid #000000;
             
            background:#eee;
             
            border-spacing:0;
            border-collapse: collapse; 
        }
        #footer table td
        {
            width:25%;
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #000000;
            border-bottom: 1px solid #000000;
        }
		.lineThrClass{
		text-decoration:line-through;
	}
    </style>
</head>
<body>
<center>
	<div id="wrapper" style="border:1px solid #CCC;padding:2mm;">
     
    <table class="heading" style="width:100%;border-top:1px solid #000000;border-right:1px solid #000000;border-left:1px solid #000000;">
		<tr>
			<td><img src="<?php echo SITEURL; ?>/bbfalando/assets/admin/layout/img/logo-big_mail.jpg" width="100"></td>
			<td style="text-align:left;"><h4><strong>Invoice</strong></h4></td>
		</tr>
	</table>
	<table class="heading" style="width:100%;border-top:1px solid #000000;border-right:1px solid #000000;border-left:1px solid #000000;">
		<tr>
			<td><h4><strong>Invoice :</strong> #<?php echo $invoice_id; ?></h4></td>
			<td style="border-left:1px solid #000000;"><h4><strong>Order :</strong> #<?php echo $cart_id; ?></h4></td>
			<td style="border-left:1px solid #000000;">
				<h4>
					<strong>
						<?php if($cart_detail_d['payment_method']==2){ ?>
						PREPAID
						<?php }else{ ?>
						COD
						<?php } ?>
					</strong>
				</h4>
			</td>
			<td style="border-left:1px solid #000000;"><h4><strong>Order Date :</strong> <?php echo date_format(date_create($cart_detail_d['orderdate']),'d-m-Y H:i'); ?></h4></td>
		</tr>
	</table>
    <table class="heading" style="width:100%;" border="1">
       	<tr>
			<td style="width:50%;">
				<h2 class="heading"><strong>Seller Address</strong></h2>
				<h2 class="heading">
					CRAFTBOX TECHNOLOGY,<br>
					3rd Floor Royal Height Above Royal Uniform, <br>Satya Sai Road B/h Atmiya College<br> Kalawad Road Rajkot, Rajkot, Gujarat 360005<br>
					<strong>Email</strong>: info@falando.in <br>
					
				</h2>
			</td>
			<td style="width:50%;">
				<h2 class="heading" style="padding-top:0;"><strong>Delivery Address</strong></h2>
				<h2 class="heading">
					<strong><?php echo stripslashes($cart_detail_d['name']); ?></strong><br>
					<?php echo stripslashes($cart_detail_d['address1']); ?><br>
					<?php 
					$pincode= stripslashes($cart_detail_d['zip']); 
					$city 	= stripslashes($cart_detail_d['city']); 
					$state 	= stripslashes($cart_detail_d['state']);
					$country = stripslashes($db->rp_getValue("country","name","id='".$cart_detail_d['country']."'")); 
					$loc = $city." - ".$pincode.", ".$state.", ".$country;
					echo str_replace(",,",",",$loc);
					?>
					<br>
					<strong>Phone</strong>: <?php echo stripslashes($cart_detail_d['phone']); ?><br/>
					<strong>Email</strong>: <?php echo stripslashes($cart_detail_d['email']); ?>
				</h2>
			</td>
		</tr>
    </table>
     
    <div id="content">
         
        <div id="invoice_body">
            <table border="1">
            <tr style="background:#eee;">
                <td style="text-align:center;width:48%;" c>Product Name</td>
				<td style="text-align:center;width:5%;">Qty</td>
				<td style="text-align:center;width:10%;">Price</td>
				<td style="text-align:center;width:10%;">Tax</td>
				<td style="text-align:center;width:10%;">Shipping</td>
				<td style="text-align:center;width:10%;">Sub Total</td>
            </tr>
            </table>
             
            <table border="1">
            
			<?php
			$discount 	= 0;
				$sub_total	= 0;
				$total_ship_charge= 0;
				$total_qty	=0;
				$pro_tax_in_rup=0;
				$total_pro_tax_in_rup=0;
				$total_unitprice_without_tax=0;
				$unitprice_without_tax=0;
				$refundAmount=0;
			$shop_cart_r = $db->rp_getData("cartitems","*","cart_id='".$cart_id."' AND seller_id='".$_SESSION[SITE_SESS.'_ADMIN_SESS_ID']."'","","0");
			if(mysql_num_rows($shop_cart_r)>0){
				
				while($shop_cart_d = mysql_fetch_array($shop_cart_r)){
					$id 		= $shop_cart_d['id'];
					$pid 		= $shop_cart_d['pid'];
					$subpid 	= $shop_cart_d['subpid'];
					$pro_name 	= stripslashes($shop_cart_d['name']);
					$qty 		= $shop_cart_d['qty'];
					$orderitemstatus = $shop_cart_d['orderstatus'];
					$attr_val	= unserialize($shop_cart_d["attr_val"]);
					$ship_charge= $db->rp_num($shop_cart_d["ship_charge"]);
					$ship_days	= intval($shop_cart_d["ship_days"]);
					$unitprice 	= $db->rp_num($shop_cart_d['unitprice']);
					$pro_tax	= stripslashes($shop_cart_d["pro_tax"]);
					$pro_tax_in_rup			= $db->rp_num(($unitprice*($pro_tax/100))*$qty);
					$unitprice_without_tax 	= $db->rp_num($unitprice - $pro_tax_in_rup);
					$totalprice = $db->rp_num($shop_cart_d['totalprice']);
					if($orderitemstatus!=0 && $orderitemstatus!=5){
						$total_qty	+= $qty;
						$total_pro_tax_in_rup	+= $pro_tax_in_rup;
						$total_unitprice_without_tax += $unitprice_without_tax;
						$total_ship_charge += $ship_charge;
						$discount	+= $db->rp_num($shop_cart_d['discount']);
						$sub_total 	+= $totalprice;
					}else if($orderstatus==0 || $orderstatus==5){
						$total_qty	+= $qty;
						$total_pro_tax_in_rup	+= $pro_tax_in_rup;
						$total_unitprice_without_tax += $unitprice_without_tax;
						$total_ship_charge += $ship_charge;
						$discount	+= $db->rp_num($shop_cart_d['discount']);
						$sub_total 	+= $totalprice;
					}
					if($subpid>0){
						$sub_pro_r = $db->rp_getData("sub_product","*","id='".$subpid."'");
						if(mysql_num_rows($sub_pro_r)>0){
							$sub_pro_d 	= mysql_fetch_array($sub_pro_r);
							$pro_sku	= stripslashes($sub_pro_d["sku"]);
						}
					}else{
						$pro_r = $db->rp_getData("product","*","id='".$pid."'");
						if(mysql_num_rows($pro_r)>0){
							$pro_d 		= mysql_fetch_array($pro_r);
							$pro_sku	= stripslashes($pro_d["sku"]);
						}
					}
					?>
				<tr>
					<td style="text-align:left;width:47%;padding-left:2mm;">
						<span class="<?php if($orderitemstatus==0 || $orderitemstatus==5){ echo "lineThrClass";}?>"><?php echo $pro_name; ?></span>
						<?php  //echo "<u>SKU</u> : ".$pro_sku; ?>
					</td>
					<td style="text-align:center;width:5%;" class="rp_right  <?php if($orderitemstatus==0 || $orderitemstatus==5){ echo "lineThrClass";}?>"><?php echo $qty; ?></td>
					<td style="width:10%;" class="rp_right  <?php if($orderitemstatus==0 || $orderitemstatus==5){ echo "lineThrClass";}?>"><?php echo CURR.$unitprice_without_tax; ?></td>
					<td style="width:10%;" class="rp_right  <?php if($orderitemstatus==0 || $orderitemstatus==5){ echo "lineThrClass";}?>"><?php echo CURR.$pro_tax_in_rup; ?> </td>
					<td style="width:10%;" class="rp_right  <?php if($orderitemstatus==0 || $orderitemstatus==5){ echo "lineThrClass";}?>"><?php echo CURR.$ship_charge; ?> </td>
					<td style="width:10%;" class="rp_right  <?php if($orderitemstatus==0 || $orderitemstatus==5){ echo "lineThrClass";}?>">
						<?php echo CURR.$totalprice; ?>
						<?php if($shop_cart_d['discount']>0){ ?>
						<br>
						-<?php echo CURR.$db->rp_num($shop_cart_d['discount']); ?>
						<?php } 
						
						if($orderstatus==2 || $orderstatus==3 || $orderstatus==4 || $orderstatus==5){
							if($orderitemstatus==2){
							
							}else if($orderitemstatus==5 || $orderitemstatus==0){
								$singleRefund = $db->rp_getSingleItemRefundAmount($cart_id,$id);
								$singleShippingRefund = $db->rp_getSingleItemShippingRefundAmount($cart_id,$id);
								$singleCODRefund = $db->rp_getSingleItemCODRefundAmount($cart_id,$id,$payment_method);
								$totalSingleRefund += $singleRefund;
								$totalSingleShippingRefund += $singleShippingRefund;
								$totalSingleCODRefund += $singleCODRefund;
							} 
						} 
						?>
					</td>
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
				$shipping_charge 	= $db->rp_num($total_ship_charge);
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
			  
            <tr>
                <td colspan="6"></td>
            </tr>
             
            <tr>
				<td style="text-align:center;">Total</td>
				<td style="text-align:center;width:5%;"><?php echo $total_qty; ?></td>
				<td style="width:10%;" class="rp_right"><?php echo CURR.$db->rp_num($total_unitprice_without_tax); ?></td>
				<td style="width:10%;" class="rp_right"><?php echo CURR.$db->rp_num($total_pro_tax_in_rup); ?></td>
				<td style="width:10%;" class="rp_right"><?php echo CURR.$shipping_charge; ?></td>
				<td style="width:10%;" class="rp_right"><?php echo CURR.$sub_total; ?></td>
			</tr>
        </table>
			
			<table width="40%" align="right" style="width:40%" border="1">
				<?php
				if($discount>0){
				?>
				<tr>
					<td>Discount:</td>
					<td class="rp_right">-<?php echo CURR.$db->rp_num($discount); ?></td>
				</tr>
				<?php
				}
				?>
				<?php
				if($shipping_discount>0){
				?>
				<tr>
					<td>Shipping Discount:</td>
					<td class="rp_right">-<?php echo CURR.$db->rp_num($shipping_discount); ?></td>
				</tr>
				<?php
				}
				?>
				<?php 
				if($payment_method==1){ 
					$final_total= $db->rp_num($final_total+$cod_charge);
				?>
				<tr>
					<td>COD Handling Charge</td>
					<td class="rp_right"><?php echo CURR.$cod_charge; ?></td>
				</tr>
				<?php } ?>
				<tr>
					<td>Grand Total:</td>
					<td class="rp_right"><?php echo CURR.$final_total; ?></td>
				</tr>
				<?php if(($orderstatus==0 && $payment_method!=1) || $orderstatus==5){ ?>
				<tr>
					<td>Refundable Amount:</td>
					<td class="rp_right">-<?php echo CURR.$refundAmount; ?></td>
				</tr>
				<?php }else if($totalSingleRefund>0){ ?>
					<?php
					if(($orderstatus==0 && $payment_method==2) || $orderstatus==5){
					?>
					<tr>
						<td>Refundable Amount:</td>
						<?php				
						$refSing = $db->rp_num(
											$totalSingleRefund
											+$totalSingleShippingRefund
											+$totalSingleCODRefund
										);
						$t1 = $refSing - $totalSingleRefund;
						$t2 = $shipping_charge - $t1;
						$t3 = $refSing - $t1;
						$t4 = $t3 - $t2;
						?>
						<td class="rp_right">-<?php echo CURR.$db->rp_num($t4); ?></td>
					</tr>
					<?php } ?>
				<?php } ?>
			</table>
        </div>
        <div id="invoice_total" style="margin-top:1mm;">
            <table border="1">
                <tr>
                    <td style="padding-left:10px;text-align:left;">
						<strong>AMOUNT IN WORDS: </strong>
						<?php 
						$ntw = new NumToWord_RP;
						echo $ntw->rp_convertNumToWord($final_total);
						?>
					</td>
                </tr>
				<tr>
                    <td style="padding-left:10px;text-align:left;">
						<strong>DECLARATION: </strong>
						We  declare  that  this  invoice  shows  the  actual  price  of  the  goods  described  inclusive  of  taxes  and  that  all  particulars  are  true  and correct. 
						If you find selling price on this invoice to be more than MRP mentioned on the product, please inform us at <?php echo SITEURL."contact-us/" ?> 
						Goods sold as part of this invoice are intended for end user consumption/retail sale and not for re-sale.
					</td>
                </tr>
				<tr>
                    <td style="padding-left:10px;text-align:left;">
						<strong>CUSTOMER ACKNOWLEDGEMENT: </strong>
						I  <u><?php echo stripslashes($cart_detail_d['name']); ?></u>  confirm  that  the  said  products  are  being  purchased  for  my  internal/personal  consumption  and  not  for  re-sale.  I further understand and agree with mufat.in terms and conditions for sale.
					</td>
                </tr>
            </table>
        </div>
    </div>
     
      
    </div>
     
    <htmlpagefooter name="footer">
        <hr />
        <div id="footer"> 
            <table>
                <tr><td><strong>THIS IS A COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE</strong></td></tr>
            </table>
        </div>
    </htmlpagefooter>
    <sethtmlpagefooter name="footer" value="on" />
</center>     
</body>
</html>