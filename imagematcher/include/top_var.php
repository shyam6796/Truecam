<?php
/*
	>>> All Array's Parameter Description By Ravi Patel :) <<<
	
		*** Main Array Parameter Details
			-> 1 = left array [i]th element i.e. left_head_array[0]
		
		*** Left Title Array Parameter Details
			-> 0 = Title
			-> 1 = Main page name i.e. use $main_page variable value define on each page
			-> 2 = left_pages_array array(i) element i.e. left_pages_array0
		
		*** Pages Array Parameter Details
			-> 0 = Title
			-> 1 = Page name i.e. use page variable value define on each page
			-> 2 = Page URL
		
*/
/*-----------------------Pages Arrays Starts-----------------------------*/

$left_pages_array0 = array(
						"0"=>array("Manage Category","manage_category","manage_category.php"),
						
				);
$left_pages_array1 = array(
						"0"=>array("Manage Sub category","manage_sub_category","manage_sub_category.php"),
						
				);
$left_pages_array2 = array(
						"0"=>array("Manage Sub to sub category","manage_sub_sub_category","manage_sub_sub_category.php"),
						
				);
$left_pages_array3 = array(
						"0"=>array("Manage Product","manage_product","manage_product.php"),
						
				);
$left_pages_array4 = array(
		"0"=>array("Manage Attribute","manage_attribute","manage_attribute.php"),
		
);
$left_pages_array5 = array(
		"0"=>array("Manage Brand","manage_brand","manage_brand.php"),
		
);
$left_pages_array6 = array(
		"0"=>array("Manage User","manage_user","manage_user.php"),
		
);
$left_pages_array7 = array(
		"0"=>array("Manage Delivery Pincode","manage_delivery_pincode","manage_delivery_pincode.php"),
		
);


/*$left_pages_array9 = array(
		"0"=>array("view user cart status","view_user_cart_status","view_user_cart_status.php"),
		
);*/

$left_pages_array00 = array(
						"0"=>array("Manage Newslatter","manage_newsletter","manage_newsletter.php"),
						
				);
$left_pages_array11 = array(
						"0"=>array("Slide Show","manage_slideshow","manage_slideshow.php"),
						
				);
$left_pages_array22 = array(
						"0"=>array("View User Cart Status","view_user_cart_status","view_user_cart_status.php"),
						
				);
$left_pages_array33 = array(
						"0"=>array("Data base backup","database_backup","database_backup.php"),
						
				);
$left_pages_array44 = array(
		"0"=>array("Blocked Ips","manage_blocked_ips","manage_blocked_ips.php"),
		
);
$left_pages_array55 = array(
		"0"=>array("Manage Coupon Code","manage_coupon_code","manage_coupon_code.php"),
		
);
$left_pages_array56 = array(
		"0"=>array("Manage Notification","manage_notification","manage_notification.php"),
		
);

$left_pages_array10 = array(
						"0"=>array("Manage Seller","manage_seller","manage_seller.php"),
						
				);




/*----------------------End Of Transaction------------------------*/


/*----------------------Left Title Array Starts----------------------*/
$left_head_array = array(
				//0=>array("Customer","customer",$left_pages_array0),
				0=>array("Category","manage_category",$left_pages_array0),
				1=>array("Sub Category","manage_sub_category",$left_pages_array1),
				2=>array("Sub to sub category","manage_sub_sub_category",$left_pages_array2),
				3=>array("Product","manage_product",$left_pages_array3),				
				4=>array("Attribute","manage_attribute",$left_pages_array4),				
				5=>array("Brand","manage_attribute",$left_pages_array5),				
				6=>array("User","manage_user",$left_pages_array6),				
				7=>array("Pincode","manage_delivery_pincode",$left_pages_array7),				
				
				//9>array("User Cart","manage_user_cart_status",$left_pages_array9),				
				
			);

$left_head_array1 = array(
				//0=>array("Customer","customer",$left_pages_array0),
				0=>array("Newslatter","manage_newslatter",$left_pages_array00),
				1=>array("Slide Show","manage_slideshow",$left_pages_array11),
				2=>array("View User Cart Status","view_user_cart_status",$left_pages_array22),
				3=>array("Data base backup","database_backup",$left_pages_array33),				
				4=>array("Blocked Ips","manage_blocked_ips",$left_pages_array44),
				5=>array("Coupon code","manage_coupon_code",$left_pages_array55),
				5=>array("Notification","manage_notification",$left_pages_array56),
				//5=>array("Brand","manage_attribute",$left_pages_array5),				
				//6=>array("User","manage_user",$left_pages_array6),				
				//7=>array("Pincode","manage_delivery_pincode",$left_pages_array7),				
				//8=>array("Coupon code","manage_coupon_code",$left_pages_array8),
				//9>array("User Cart","manage_user_cart_status",$left_pages_array9),				
				
			);
$left_head_array2 = array(
				0=>array("Seller","manage_seller",$left_pages_array10),
				);	
/*----------------------Left Title Array Ends----------------------*/
/*----------------------Main Array Starts-------------------------*/
$left_main_array = array(
				0=>$left_head_array[0],
				1=>$left_head_array[1],
				2=>$left_head_array[2],				
				3=>$left_head_array[3],				
				4=>$left_head_array[4],				
				5=>$left_head_array[5],				
				6=>$left_head_array[6],				
				7=>$left_head_array[7],				
				//8=>$left_head_array[8],				
				//9=>$left_head_array[9],				
				
				
			);
			
$left_main_array1 = array(
				0=>$left_head_array1[0],
				1=>$left_head_array1[1],
				2=>$left_head_array1[2],				
				3=>$left_head_array1[3],				
				4=>$left_head_array1[4],				
				5=>$left_head_array1[5],				
				//6=>$left_head_array1[6],				
				//7=>$left_head_array1[7],				
				//8=>$left_head_array1[8],				
				//9=>$left_head_array[9],				
				
				
			);
$left_main_array2 = array(
				0=>$left_head_array2[0],
				);

/*----------------------Main Array Ends-----------------------------*/
?>