<?php
// Connect to Database
include('connect.php');
// You have DB object now use it as $db->
//First Check for API key if API key is valid then proceed other stop excute script
// Which service requested is given in params named "service"
// Response Structure given below.
/* $ack=array(
			"ack"=>1/0,(1= success,0=failure)
			"ack_msg"=>"Message will printed on View",("This message will be shown to user so make it user readable not for developers")
			"developer_msg"=>"Message for debugging",("This message will be shown to developer on debug mode")
			"extra"=>array("requested_params"=>$_REQUEST,"other"=>array()),"Extra field contains requested params array which returns all the requested params and other array will contains extra params which you want to show on debug mode"
		)
	echo json_encode($ack);
	
*/
if($is_valid_api_key)
{	
	if($is_valid_service)
	{
		include('../include/class.application.php');
	    $application=new Application();
		if($service=='get_country' || $service==1)
		{
			$cid=$db->getRequestedParam("cid"); //country_id
			$limit=$db->getLimit();			
			if($cid!="")
			{
				$ack=$application->getCountry($db->SToA(array(),$cid));
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getCountry();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_category' || $service==2)
		{
			$cid=$db->getRequestedParam("cid");
			if($cid!="")
			{
				$ack=$application->getCategory($db->SToA(array(),$cid)); //category_id
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getCategory();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_sub_category' || $service==3)
		{
			$cid=$db->getRequestedParam("cid");
			$scid=$db->getRequestedParam("sid");
			if($cid!="" || $scid!="")
			{
				
				$ack=$application->getSubCategory($db->SToA(array(),$scid),$db->SToA(array(),$cid)); //sub_category_id,category_id,
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getSubCategory();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_sub_sub_category' || $service==4)
		{
			$cid=$db->getRequestedParam("cid");
			$sid=$db->getRequestedParam("sid");
			$ssid=$db->getRequestedParam("ssid");
			if($cid!="" || $sid!="" || $ssid!="")
			{
				
				$ack=$application->getSubSubCategory($db->SToA(array(),$ssid),$db->SToA(array(),$sid),$db->SToA(array(),$cid)); //sub_sub_category_id,sub_category_id,category_id
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getSubSubCategory();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_brand' || $service==5)
		{
			$bid=$db->getRequestedParam("bid");
			if($bid!="")
			{
				$ack=$application->getBrand($db->SToA(array(),$bid)); //brand_id
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getBrand();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_attribute' || $service==6)
		{
			$aid=$db->getRequestedParam("aid");
			if($aid!="")
			{
				$ack=$application->getAttribute($db->SToA(array(),$aid)); //attribute_id
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getAttribute();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_attribute_value' || $service==7)
		{
			$avid=$db->getRequestedParam("avid");
			$aid=$db->getRequestedParam("aid");
			if($aid!="" || $avid!="")
			{
				$ack=$application->getAttributeValue($db->SToA(array(),$avid),$db->SToA(array(),$aid)); //attribute_val_id,attribute_id
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getAttributeValue();
				$db->printJSON($ack);
			}
			
		}	
		else if($service=='get_product' || $service==8)
		{
			$cid=$db->getRequestedParam("cid");
			$sid=$db->getRequestedParam("sid");
			$ssid=$db->getRequestedParam("ssid");
			$pid=$db->getRequestedParam("pid");
			$bid=$db->getRequestedParam("bid");
			$protag=$db->getRequestedParam("protag");
			$uid=$db->getRequestedParam("uid");
			$sort=$db->getRequestedParam("sort");
			$query=$db->getRequestedParam("query");
			if($cid!="" || $sid!="" || $ssid!="" || $pid!=""|| $bid!="" || $protag!="" || $query!="")
			{
				$ack=$application->getProduct($db->SToA(array(),$pid),$db->SToA(array(),$protag),$db->SToA(array(),$bid),$db->SToA(array(),$ssid),$db->SToA(array(),$sid),$db->SToA(array(),$cid),$uid,array("id","name","sid","ssid","cid","sell_price","max_price","discount_price","image_path","banner_image_path","rate","seller_id"),array(),true,array(),$sort,$query); // product_id,protag,,brand_id,sub_sub_category_id,sub_category_id,category_id
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getProduct($db->SToA(array(),$pid),$db->SToA(array(),$protag),$db->SToA(array(),$bid),$db->SToA(array(),$ssid),$db->SToA(array(),$sid),$db->SToA(array(),$cid),$uid,array("id","name","sid","ssid","cid","sell_price","max_price","discount_price","image_path","banner_image_path","rate","seller_id"),array(),true,array(),$sort,$query); // product_id,protag,,brand_id,sub_sub_category_id,sub_category_id,category_id
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_product_detail' || $service==15)
		{
			$cid=$db->getRequestedParam("cid");
			$sid=$db->getRequestedParam("sid");
			$ssid=$db->getRequestedParam("ssid");
			$pid=$db->getRequestedParam("pid");
			$bid=$db->getRequestedParam("bid");
			$protag=$db->getRequestedParam("protag");
			$uid=$db->getRequestedParam("uid");
			if($cid!="" || $sid!="" || $ssid!="" || $pid!=""|| $bid!="" || $protag!="")
			{
				$ack=$application->getProduct($db->SToA(array(),$pid),$db->SToA(array(),$protag),$db->SToA(array(),$bid),$db->SToA(array(),$ssid),$db->SToA(array(),$sid),$db->SToA(array(),$cid),$uid,array("*")); //product_id,protag,,brand_id,sub_sub_category_id,sub_category_id,category_id
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getProduct();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_home' || $service==14)
		{
			
			if(true)
			{
				$ack=$application->getAndroidHome(); //Nothing
				$db->printJSON($ack);
			}
			else
			{
				$ack=$application->getAndroidHome();
				$db->printJSON($ack);
			}
			
		}		
		else if($service=='check_delivery' || $service==27)
		{
			$detail=array();										
			$detail['zip']=$db->getRequestedParam("zip");  //id											
			if(!empty($detail) && $detail['zip']!="")
			{
				$cart=new AndroidCart();	
				$ack=$cart->checkDeliveryAtPincode($detail);//user_id,zip
				$db->printJSON($ack);
			}
			else
			{
				$ack=array( "ack"=>0,
					"ack_msg"=>"Internal error!!",
					"developer_msg"=>"Normal User registration =>Some Parameters missing!!",				
				);
				$db->printJSON($ack);
			}
		}
		else if($service=='refine_product' || $service==43)
		{
			$detail=array();										
			$detail['filter']=$db->getRequestedParam("filter");  //filter											
			$detail['uid']=$db->getRequestedParam("uid");  //uid											
			$detail['sid']=$db->getRequestedParam("sid");  //sid
			$sort=$db->getRequestedParam("sort");			
			if(!empty($detail) && $detail['filter']!="")
			{
				$detail['filter']=json_decode($detail['filter']);
				$ack=$application->getFilteredProduct($detail,array("id","name","sid","ssid","cid","sell_price","max_price","discount_price","image_path","banner_image_path","rate","seller_id"),array(),true,$sort);//filter
				$db->printJSON($ack);
			}
			else
			{
				$ack=array( "ack"=>0,
					"ack_msg"=>"Internal error!!",
					"developer_msg"=>"Refine Product =>Some Parameters missing!!",				
				);
				$db->printJSON($ack);
			}
		}
		else if($service=='get_coupan' || $service==66)
		{
			$cart=new AndroidCart();
			$ack=$cart->getCoupan();
			$db->printJSON($ack);
					
		}		
		else if($service=='get_offers' || $service==74)
		{
			$uid=$db->getRequestedParam("uid");			
			$ack=$application->getOffer(array(),array(),$uid); //brand_id
			$db->printJSON($ack);
		
			
		}
		else if($service=='get_recent_viewed_items' || $service==75)
		{
			$pids=$db->getRequestedParam("pids");			
			$uid=$db->getRequestedParam("uid");			
			$pids=json_decode($pids);		
			$ack=$application->getProduct($pids,array(),array(),array(),array(),array(),$uid,array("id","name","sid","ssid","cid","sell_price","max_price","discount_price","image_path","banner_image_path","rate","seller_id"),array(),true,array(),array(),""); // product_id,protag,,brand_id,sub_sub_category_id,sub_category_id,category_id
			$db->printJSON($ack);		
		}
		else if($service=='get_notification_detail' || $service==78)
		{
			$nid=$db->getRequestedParam("nid");			
			$uid=$db->getRequestedParam("uid");			
			$ack=$application->getNotificationDetail($nid,array(),$uid); //notification_id
			$db->printJSON($ack);
		
			
		}
		else
		{
			$ack=array( "ack"=>0,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"Service not valid!!",				
			);
			$db->printJSON($ack);
		}
			
	}
	else
	{
		$ack=array( "ack"=>1,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"Service Parameter missing or not valid!!",				
			);
		$db->printJSON($ack);
	}
	
}
else
{
	$ack=array( "ack"=>0,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"Check your API Key or contact Admin",				
			);
	$db->printJSON($ack);
}
?>