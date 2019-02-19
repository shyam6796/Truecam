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
		include('../include/class.user.php');
		$user=new User();
        if($service=='register_user' || $service==26)
		{
			$detail=array();
			$detail['name']=$db->getRequestedParam("name"); //name
			$detail['email']=$db->getRequestedParam("email"); //email
			$detail['password']=$db->getRequestedParam("password"); //password
			$detail['phone']=$db->getRequestedParam("phone"); //phone
			$detail['imei']=$db->getRequestedParam("imei"); //imei
			$detail['refresh_token']=$db->getRequestedParam("refresh_token"); //firebase refresh_token
			if(!empty($detail) && $detail['name']!="" && $detail['email']!="" && $detail['password']!="" && $detail['phone']!="" && $detail['refresh_token']!="" && $detail['imei']!="")
			{
				$ack=$user->addNormalUser($detail);//name, email,password,imei,firebase refresh_token
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
	    else if($service=='login_user' || $service==27)
		{
			$detail=array();
			$detail['email']=$db->getRequestedParam("email"); //email
			$detail['password']=$db->getRequestedParam("password"); //password
			$detail['imei']=$db->getRequestedParam("imei"); //imei
			$detail['refresh_token']=$db->getRequestedParam("refresh_token"); //firebase refresh_token
            //print_r($detail);
			if(!empty($detail) && $detail['email']!="" &&  $detail['password']!="" && $detail['refresh_token']!="")
			{
				$ack=$user->loginNormalUser($detail,array("id","name","email","phone","address","zip","locality","city","state","country","image_path","regDate","user_type"));// email,password,imei,firebase refresh_token
				$db->printJSON($ack);
			}
			else
			{
					$ack=array( "ack"=>0,
						"ack_msg"=>"Internal error!!",
						"developer_msg"=>"Normal User Login =>Some Parameters missing!!",				
					);
				$db->printJSON($ack);
			}
			
		}
		else if($service=='update_profile' || $service==28)
		{
			$detail=array();
			$detail['id']=$db->getRequestedParam("uid"); //id
			$detail['name']=$db->getRequestedParam("name"); //name
			$detail['phone']=$db->getRequestedParam("phone"); //name
			$detail['address']=$db->getRequestedParam("address"); //address
			$detail['locality']=$db->getRequestedParam("locality"); //locality
			$detail['city']=$db->getRequestedParam("city"); //city	
			$detail['zip']=$db->getRequestedParam("pincode"); //pincode	
			$detail['state']=$db->getRequestedParam("state"); //state
			$detail['country']=$db->getRequestedParam("country"); //country					
			if(!empty($detail) && $detail['id']!="" && $detail['name']!="")
			{
				$ack=$user->updateUserProfile($detail);//id,name,address,locality,city,pincode,state,country
				$db->printJSON($ack);
			}
			else
			{
					$ack=array( "ack"=>0,
						"ack_msg"=>"Internal error!!",
						"developer_msg"=>"Profile update =>Some Parameters missing!!",				
					);
				$db->printJSON($ack);
			}
			
		}
		else if($service=='change_password' || $service==19)
		{
			$detail=array();
			$detail['id']=$db->getRequestedParam("uid"); //id
			$detail['old_password']=$db->getRequestedParam("old_password"); //old_password						
			$detail['new_password']=$db->getRequestedParam("new_password"); //new_password						
			if(!empty($detail) && $detail['id']!="" && $detail['old_password']!="" && $detail['new_password']!="" )
			{
				$ack=$user->updateUserPassword($detail);//id,old_password,new_password
				$db->printJSON($ack);
			}
			else
			{
					$ack=array( "ack"=>0,
						"ack_msg"=>"Internal error!!",
						"developer_msg"=>"Change password  =>Some Parameters missing!!",				
					);
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_user_profile' || $service==67)
		{
			$detail=array();
			$detail['id']=$db->getRequestedParam("uid"); //id														
			if(!empty($detail) && $detail['id']!="")
			{				
				$ack=$user->getUserDetail($detail['id'],array("id","name","email","image_path"));//id
				$db->printJSON($ack);
			}
			else
			{
					$ack=array( "ack"=>0,
						"ack_msg"=>"Internal error!!",
						"developer_msg"=>"get User Profile  =>Some Parameters missing!!",				
					);
				$db->printJSON($ack);
			}
		}
		else if($service=='find_account' || $service==35)
		{
			$email 	= isset($_REQUEST['email'])?$db->clean($_REQUEST['email']):"";
			if($email!="")
			{
				$ack=$user->findAccount($email);	
			}
			else
			{
				$ack=array( "ack"=>0,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"Forget Password: Find account:Service Parameter missing or not valid!!",				
			);
				
			}
			$db->printJSON($ack);

		}
		else if($service=='verify_otp_with_email' || $service==36)
		{
			$detail['email'] 	= isset($_REQUEST['email'])?$db->clean($_REQUEST['email']):"";
			$detail['otp'] 	= isset($_REQUEST['otp'])?$db->clean($_REQUEST['otp']):"";
			if(!empty($detail) && $detail['email']!="" && $detail['otp']!="")
			{
				$ack=$user->verifyOTPFromEmail($detail);	
			}
			else
			{
				$ack=array( "ack"=>0,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"Forget Password: Find account:Service Parameter missing or not valid!!",				
			);
				
			}
			$db->printJSON($ack);

		}
		else if($service=='change_forgot_password_with_email' || $service==37)
		{
			$detail['email'] 	= isset($_REQUEST['email'])?$db->clean($_REQUEST['email']):"";
			$detail['new_password'] 	= isset($_REQUEST['new_password'])?$db->clean($_REQUEST['new_password']):"";
			if(!empty($detail) && $detail['email']!="" && $detail['new_password']!="")
			{
				$ack=$user->updateForgetPassword($detail);	
			}
			else
			{
				$ack=array( "ack"=>0,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"Forget Password: Change Password:Service Parameter missing or not valid!!",				
			);
				
			}
			$db->printJSON($ack);

		}
		else if($service=='add_image' || $service==39)
		{
			
			    $detail['department_id']=$db->getRequestedParam("department_id");
			    $detail['name']=$db->getRequestedParam("name");
			    $detail['email']=$db->getRequestedParam("email");
			    $detail['mobile']=$db->getRequestedParam("mobile");
			    $detail['birth_date']=$db->getRequestedParam("birth_date");
			    $detail['gender']=$db->getRequestedParam("gender");
			    $detail['blood_group']=$db->getRequestedParam("blood_group");
			    $detail['address']=$db->getRequestedParam("address");
				
				    if($detail['department_id']!="")
		            {
		            	if(isset($_FILES['file']))
						{
		                $ack=$user->addImages($_FILES,$detail);
		                $db->printJSON($ack);
		                }
						else
						{
		                    $ack=array( "ack"=>0,
		    				"ack_msg"=>"Internal error!!",
		    				"developer_msg"=>"File not found!! ",
		    			);
							$db->printJSON($ack);
						}
				    }
		            else
		            {
		                    $ack=array( "ack"=>0,
		    				"ack_msg"=>"Internal error!!",
		    				"developer_msg"=>"Service Paramater Not valid!! ==>Enter Department ID ",
		    			);
		    			$db->printJSON($ack);
		            }
		
		}
		else if($service=='get_department' || $service==42)
		{
			$did=$db->getRequestedParam("did"); //country_id
			if($did!="")
			{
				$ack=$user->department($db->SToA(array(),$did));
				$db->printJSON($ack);
			}
			else
			{
				$ack=$user->department();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_image_data' || $service==41)
		{
			$id=$db->getRequestedParam("id"); //country_id
			if($id!="")
			{
				$ack=$user->getImageData($db->SToA(array(),$id));
				$db->printJSON($ack);
			}
			else
			{
				$ack=$user->getImageData();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='search_image' || $service==40)
		{
		$uid=$db->getRequestedParam("uid"); //u_id
			if($uid!="")
			{
				if(isset($_FILES['file']))
				{
				$ack=$user->searchImage($_FILES,$uid);
				$db->printJSON($ack);
				}
				else
				{
					$ack=array( "ack"=>0,
						"ack_msg"=>"Internal error!!",
						"developer_msg"=>"file not found or not valid!!",				
					);
					$db->printJSON($ack);
				}
			}
			else
			{	$ack=array( "ack"=>0,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"User id not valid!!",				
			);
			$db->printJSON($ack);
			}
		}
		else if($service=='add_image_for_search' || $service==43)
		{
			if($uid!="")
			{
				$ack=$user->addImageForSearch($_FILES,$uid);
				$db->printJSON($ack);
			}
			else
			{
				$ack=$user->addImageForSearch();
				$db->printJSON($ack);
			}
		}
		else if($service=='update_match_image' || $service==44)
		{
			$match_id 		= isset($_REQUEST['match_id'])?$db->clean($_REQUEST['match_id']):"";
			$inserted_id 	= isset($_REQUEST['inserted_id'])?$db->clean($_REQUEST['inserted_id']):"";
			if($match_id!="" && $inserted_id!="")
			{
				$ack=$user->updateSearchImageId($match_id,$inserted_id);	
				$db->printJSON($ack);
			}
			else
			{
				$ack=$user->updateSearchImageId();
				$db->printJSON($ack);
			}
			
		}
		else if($service=='get_search_data' || $service==45)
		{
			$uid 		= isset($_REQUEST['uid'])?$db->clean($_REQUEST['uid']):"";
			if($uid!="")
			{
				$ack=$user->getSearchData($uid);
				$db->printJSON($ack);
			}
			else
			{
				$ack=$user->getSearchData($uid);
				$db->printJSON($ack);
			}
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