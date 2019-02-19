<?php
require_once("class.application.php");
include('compareImages.php');
class User extends Functions
{
	public $detail=array();
	public $user_type=array(0=>"email",1=>"Facebook account",2=>"Google account",3=>"Twitter account");
	public $ctable="user";
	public $ctableWallet="user_wallet";
	public $ctableWalletTransaction="wallet_transaction";
	public $ctableFeedLike="feed_like";
	public $rights;
	public $db,$application;
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->application = new Application();
		$this->db=$db;
		$this->rights=$_SESSION['rights'];
    }     	
	function addNormalUser($detail)
	{
		if(!empty($detail))
		{
			$isValid=$this->validateDetail($detail,array("name","email","password","phone"));
			if($isValid['ack']==1)
			{
				$countFromEmail=$this->countUser($detail['email'],"email");
				$countFromPhone=$this->countUser($detail['phone'],"phone");
				if($countFromEmail<=0 && $countFromPhone<=0)
				{
					// Registration  of normal user
					$value=array($detail['name'],$detail['email'],md5($detail['password']),$detail['phone'],$detail['imei'],$detail['refresh_token'],$this->db->today());
					$rows=array("name","email","password","phone","imei","refresh_token","regDate");
					$registerd_user_id=$this->rp_insert($this->ctable,$value,$rows,0);
					if($registerd_user_id!=0)
					{

						$user_detail=$this->getUserDetail($registerd_user_id);
						$reply=array("ack"=>1,"developer_msg"=>"User Registered.","ack_msg"=>"Registration Successfull.","result"=>$user_detail['result']);
						return $reply;
					}				
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Registration Failed.");
						return $reply;
					}
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Email or Phone already exits","ack_msg"=>"Email or phone already associated to another account.");
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
				return $reply;
			}
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
			return $reply;
		}
	}

	function loginNormalUser($detail,$required_columns=array())
	{
		if(!empty($detail))
		{
			$isValid=$this->validateDetail($detail,array("email","password"));
			if($isValid['ack']==1)
			{
				$countFromEmail=$this->countUser($detail['email'],"email");
				if($countFromEmail>=1)
				{
					$registerd_user_id=$this->db->rp_getValue($this->ctable,"id","email='".$detail['email']."'",0);
					$user_detail=$this->getUserDetail($registerd_user_id);
					$user_detail=$user_detail['result'];
					if($user_detail['user_type']==0)
					{
						if(($user_detail['password']==md5($detail['password'])))
						{

							$values=array("imei"=>$detail['imei'],"refresh_token"=>$detail['refresh_token'],"last_login"=>$this->db->today());
			            	$this->db->rp_update($this->ctable,$values,"id='".$user_detail['id']."'",0);
                             $user_detail=$this->getUserDetail($registerd_user_id,$required_columns);
		            		$reply=array("ack"=>1,"developer_msg"=>"Returned Normal User.","ack_msg"=>"Successfully Logged in","result"=>$user_detail['result']);
			            	return $reply;
							
						}
						else
						{							
							$reply=array("ack"=>0,"developer_msg"=>"Email and password not match.","ack_msg"=>"Email and password not match.");
							return $reply;
						}
					}
					else
					{
						$type=(array_key_exists(intval($user_detail['user_type']),$this->user_type))?$this->user_type[intval($user_detail['user_type'])]:$this->user_type[0];
						$msg="You are registered with ".$type.". Please login with it.";
						$reply=array("ack"=>0,"developer_msg"=>$msg,"ack_msg"=>$msg,"user_type"=>$user_detail['user_type']);
						return $reply;
					}
					
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"email not registered","ack_msg"=>"Email not registered.");
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
				return $reply;
			}
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
			return $reply;
		}
	}	

	function updateUserContactNumberPart1($detail)
	{
		if(!empty($detail))
		{
			$countFromId=$this->countUser($detail['id'],"id");
			$countFromPhone=$this->countUser($detail['phone'],"phone");
			if($countFromId>=1)
			{
				if($countFromPhone<=0)
				{
					$isValid=$this->validateDetail($detail,array("phone"));
					if($isValid['ack']==1)
					{
						
						return $reply=$this->sendOTPToContactNumber($detail);			
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
						return $reply;
					}
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"mobile number already registerd","ack_msg"=>"Mobile number already registerd. Try diffrent one.");
					return $reply;
				}
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Internal Error!! You are blocked or account suspended.");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
		}
	}
	function updateUserContactNumberPart2($detail)
	{
		
		if(!empty($detail))
		{
			$countFromId=$this->countUser($detail['id'],"id");
			$countFromPhone=$this->countUser($detail['phone'],"phone");
			if($countFromId>=1)
			{
				
				if($countFromPhone<=0)
				{
					
					$isValid=$this->validateDetail($detail,array("phone"));
					if($isValid['ack']==1)
					{
						
						 $reply=$this->verifyOTP($detail);			
						 if($reply['ack']==1)
						 {
							 // Update Contact Number
							 $activationCode=$this->generateActivationCode();
							 $values=array("otp"=>$activationCode,"phone"=>$detail['phone']);
							 $isUpdated=$this->rp_update("user",$values,"id='".$detail['id']."'",0);
							 if($isUpdated==1)
							 {
								$reply=array("ack"=>1,"developer_msg"=>"Contact Number updated","ack_msg"=>"Contact number updated successfully!!");
								return $reply;
							 }
							 else
							 {
								 $reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Internal Error. Contact number not changed!!");
								return $reply;
							 }
						 }
						 else
						 {
							return $reply; 
						 }
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
						return $reply;
					}
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"mobile number already registerd","ack_msg"=>"Mobile number already registerd. Try diffrent one.");
					return $reply;
				}
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Internal Error!! You are blocked or account suspended.");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
		}
	}
	function verifyUserAccountMobile($detail)
	{
		
		if(!empty($detail))
		{
			$countFromId=$this->countUser($detail['id'],"id");			
			$countFromPhone=$this->countUser($detail['phone'],"phone");
			if($countFromId>=1)
			{
					
				$isValid=$this->validateDetail($detail,array("phone"));
				if($isValid['ack']==1)
				{
					
					 $reply=$this->verifyOTP($detail);			
					 if($reply['ack']==1)
					 {
						 // Update OTP 
						 $activationCode=$this->generateActivationCode();
						 $values=array("otp"=>$activationCode,"phone"=>$detail['phone'],"isMobileVerified"=>1);
						 $isUpdated=$this->rp_update($this->ctable,$values,"id='".$detail['id']."'",0);
						 if($isUpdated==1)
						 {
							$user_detail=$this->getUserDetail($detail['id']);
							$user_detail=$user_detail['result'];
							
							$reply=array("ack"=>1,"developer_msg"=>"Contact Number verfied","ack_msg"=>"Contact number verfied successfully!!","result"=>$user_detail);
							return $reply;
						 }
						 else
						 {
							 $reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Internal Error. Contact number not verfied !!");
							return $reply;
						 }
					 }
					 else
					 {
						return $reply; 
					 }
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
					return $reply;
				}
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Internal Error!! You are blocked or account suspended.");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
		}
	}
	function updateUserPassword($detail)
	{
		if(!empty($detail))
		{
			$countFromId=$this->countUser($detail['id'],"id");			
			if($countFromId>=1)
			{				
				$count=$this->rp_getTotalRecord("user","id='".$detail['id']."' AND password='".md5($detail['old_password'])."'");
				if($count>=1)
				{
					 // Update password
					 $values=array("password"=>md5($detail['new_password']));
					 $isUpdated=$this->rp_update("user",$values,"id='".$detail['id']."'",0);
					 if($isUpdated==1)
					 {
						$reply=array("ack"=>1,"developer_msg"=>"Password updated","ack_msg"=>"Password updated successfully!!");
						return $reply;
					 }
					 else
					 {
						 $reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Internal Error. Password not updated!!");
						return $reply;
					 }
				}
				else
				{
					$reply=array("ack"=>2,"developer_msg"=>"Old password not matched.","ack_msg"=>"Old password not matched");
					return $reply;
				}
																			
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Internal Error!! You are blocked or account suspended.");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
		}
	}
	function verifyOTP($detail)
	{
		if(!empty($detail))
		{
			$countFromId=$this->countUser($detail['id'],"id");
			$countFromPhone=$this->countUser($detail['phone'],"phone");
			if($countFromId>=1)
			{				
			
				$isValid=$this->validateDetail($detail,array("phone"));
				if($isValid['ack']==1)
				{
					$count=$this->db->rp_getTotalRecord("user","id='".$detail['id']."' AND otp='".$detail['otp']."'");
					if($count>0)
					{
						// Update OTP 
					    $activationCode=$this->generateActivationCode();
					    $values=array("otp"=>$activationCode,"phone"=>$detail['phone'],"isMobileVerified"=>1);
					    $isUpdated=$this->rp_update($this->ctable,$values,"phone='".$detail['phone']."'",0);
						$reply=array("ack"=>1,"developer_msg"=>"Otp Verified.","ack_msg"=>"Otp Verified.");
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Wrong OTP","ack_msg"=>"Wrong otp!!");
						return $reply;
					}
						
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
					return $reply;
				}
			
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Internal Error!! You are blocked or account suspended.");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
		}
	}
	function sendOTPToContactNumber($detail)
	{
		
		if(!empty($detail))
		{
			$countFromId=$this->countUser($detail['phone'],"phone");
			if($countFromId>=1)
			{
				$isValid=$this->validateDetail($detail,array("phone"));
				if($isValid['ack']==1)
				{
					
					$activationCode=$this->generateActivationCode();
					// Detail of normal user
					$where=" phone='".$detail['phone']."'";
					$values=array("otp"=>$activationCode);			
					$registerd_user_id=$this->rp_update($this->ctable,$values,$where);
					if($registerd_user_id!=0)
					{
						$name=$this->rp_getValue("user","name",$where);
						$reply=$this->aj_sendSecurityCode($name,$detail['phone'],$activationCode);						
						return $reply;
					}				
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Internal Error!! Try Later");
						return $reply;
					}				
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Mobile number not found!!");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
			return $reply;
		}
	}
	
	function updateUserProfile($detail)
	{
		
		if(!empty($detail))
		{
			$countFromId=$this->countUser($detail['id'],"id");
			if($countFromId>=1)
			{
				$isValid=$this->validateDetail($detail,array("name"));
				if($isValid['ack']==1)
				{
					
					// Detail of normal user
					$where=" id='".$detail['id']."'";
					$values=array("name"=>$detail['name'],"phone"=>$detail['phone'],"address"=>$detail['address'],"locality"=>$detail['locality'],"city"=>$detail['city'],"zip"=>$detail['zip'],"state"=>$detail['state'],"country"=>$detail['country']);			
					$registerd_user_id=$this->rp_update($this->ctable,$values,$where);
					if($registerd_user_id!=0)
					{
						$user_detail=$this->getUserDetail($detail['id']);
						$reply=array("ack"=>1,"developer_msg"=>"User Registered.","ack_msg"=>"Profile updated successfully.","result"=>$user_detail['result']);
						return $reply;
					}				
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Profile couldn't be updated. Try later!!");
						return $reply;
					}				
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Internal Error!!");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
			return $reply;
		}
	}
	function updateUserProfilePicture($detail)
	{
		
		if(!empty($detail))
		{
			$countFromId=$this->countUser($detail['id'],"id");
			if($countFromId>=1)
			{
				if (isset($_FILES["file"])) {
					$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
					$temp = explode(".", $_FILES["file"]["name"]);
					 $extension = end($temp);
				 
					if($_FILES["file"]["error"]>0) {
						$error .= "Error opening the file. ";
					}
					if($_FILES["file"]["type"]=="application/x-msdownload"){	
						$error .= "Mime type not allowed. ";
					}
					if(!in_array($extension, $allowedExts)){
						$error .= "Extension not allowed. ";
					}
					if($_FILES["file"]["size"] > 26214400){ //26214400 Bytes = 25 MB, 102400 = 100KB
						$error .= "File size shoud be less than 25 MB ";
					}
					if($error=="") {
						
						$fileName 	= $db->clean($_FILES["file"]["name"]);			
						$fileSize 	= round($_FILES["file"]["size"]); // BYTES			
						
						$adate 		= date('Y-m-d H:i:m');
						$r = checkUserStorage($id,$totalStorage,$usedStorage,$fileSize);

						if($r=='success'){
							
							$extension	= end(explode(".", $fileName));				
							$fileName	= $id.'_'.substr(sha1(time()), 0, 6).".".$extension;
							$filePath 	= "aws/tempImg/".$fileName;
							$temp2="tempImg/".$fileName;	
							move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
							$responses=file_get_contents("http://ednurture.net/ednurture_app/webservice/aws/aws.php?filepath=".$temp2."&filename=".$fileName."&user_id=".$id);	
							$responses=json_decode($resposes);				
							if($responses['ack']=1)
							{
									
												  include('aws/awsService.php');
												  
												   $aws=new AWS();
																						 
									   $resp=$aws->deleteObject($oldFileName);	

									   $rows=array('used_storage'=>$usedStorage-$resp['fileSize']);
									   $db->rp_update('user_personal_info',$rows,"id='".$id."'",0);
									   $response = array(
										"status"		=> 1,
										"res"			=> "success",
										"msg"			=> "File uploaded successfully",
										"fileName"		=> $fileName,
										"result"=>$responses,
										"deleteFileResult"=>$resp
									);
								
									unlink($filePath);	
									
							}
							else
							{	
								$response = array(
										"status"		=> 0,
										"res"			=> "Error occurred while storing file!!",
										"fileName"		=> $fileName,
										"result"=>$responses
										
									);
							}
						
						}
						else
						{
							$response = array(
										"status"		=> 0,
										"res"			=> $r

										
									);
						}
						
						
						
						
					}
					else
					{
						
					}
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"image type not valid","ack_msg"=>"Invalid image or image not found.");
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Internal Error!!");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
			return $reply;
		}
	}	
	function getUserDetail($user_id=0,$required_columns=array())
	{
		$required_columns=$this->getRequiredColumns($required_columns);
		if($user_id!=0)
		{
			$where="id='".$user_id."'";
			$result=$this->rp_getData($this->ctable,$required_columns,$where);
			if($result)
			{
				$detail=mysql_fetch_assoc($result);
                if( array_key_exists("image_path",$detail) &&	$detail['image_path']!="")
				$detail['image_path']=ADMINSITEURL.USER_MAIN.$detail['image_path'];
                if( array_key_exists("regDate",$detail) && $detail['regDate']!="")
                {
                   	$detail['display_regDate']=date("d M Y",strtotime($detail['regDate']));
                }
			   if(array_key_exists("country",$detail) && $detail['country']!="")
				{
                   $country_detail_r=$this->application->getCountry(array($detail['country']));
                   if($country_detail_r['ack']==1)
                   {
                        $detail['country']= $country_detail_r['result'][0]['name'];
                        $detail['country_slug']= $country_detail_r['result'][0]['id'];
                   }
                   else
                   {
                        $detail['country']= "";
                        $detail['country_slug']= 0;
                   }
				}
                else
                {
                    $detail['country']= "";
                    $detail['country_slug']= 0;
                }

				$reply=array("ack"=>1,"developer_msg"=>"user detail found","ack_msg"=>"User detail found.","result"=>$detail);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"User not found.");
				return $reply;
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"User not found.");
			return $reply;
		}
	}
	function delete($delete_array)
	{
		
            $count=$this->countUser($delete_array['value'],$delete_array['key']);
            if($count>=1)
            {
            	$this->db->rp_delete($this->ctable,$delete_array['key']."=".$delete_array['value'],0);
            	$reply=array("ack"=>1,"developer_msg"=>"User deleted successfully!!","ack_msg"=>"User deleted successfully!!");
            	return $reply;
            }
            else
            {
            	$reply=array("ack"=>0,"developer_msg"=>"No record found!!","ack_msg"=>"No record found!!");
            	return $reply;
            }
				

				
	}
    function active($active_array)
	{
		

				$count=$this->countUser($active_array['value'],$active_array['key']);
				if($count>=1)
				{
					$this->db->rp_update($this->ctable,array("isActive"=>$active_array['status']),$active_array['key']."=".$active_array['value'],0);
					$reply=array("ack"=>1,"developer_msg"=>"User status updated successfully!!","ack_msg"=>"User status updated successfully!!");
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"No record found!!","ack_msg"=>"No record found!!");
					return $reply;
				}

		
	}
	// Forget Password
	public function findAccount($email)
	{
		$check=$this->db->rp_getValue("user","COUNT(*)","email='".$email."'",0);
		if($check>0)
		{
			$name=$this->db->rp_getValue("user","name","email='".$email."'",0);
			$phone=$this->db->rp_getValue("user","phone","email='".$email."'",0);
			$activationCode=$this->generateActivationCode();
			$rows=array("otp"=>$activationCode);
			$where=" email='".$email."'";
			$this->db->rp_update("user",$rows,$where,0);

			$ack=$this->aj_sendSecurityCode($name,$email,$phone,$activationCode);
			if($ack['ack']==1)
			{   
				$ack=array( "ack"=>1,
						"ack_msg"=>"Check Your Email Or Registerd Phone For Security Code!!",
						"developer_msg"=>"You got it!!",
						"result"=>array($check),
						);
						return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
						"ack_msg"=>"Sorry We Can't Proceed Right Now Try Later!!",
						"developer_msg"=>"Sorry We can't Procced!",
						);
						return $ack;
			}
		}
		else
		{
				$ack=array( "ack"=>0,
						"ack_msg"=>"Given Email not associated with any account!!",
						"developer_msg"=>"Given Email not associated with any account!!",
						);
						return $ack;
		}
	}
	function verifyOTPFromEmail($detail)
	{
		if(!empty($detail))
		{
			$countFromEmail=$this->countUser($detail['email'],"email");
			if($countFromEmail>=1)
			{				
			
				$isValid=$this->validateDetail($detail,array("email"));
				if($isValid['ack']==1)
				{
					$count=$this->db->rp_getTotalRecord("user","email='".$detail['email']."' AND otp='".$detail['otp']."'");
					if($count>0)
					{
						// Update OTP 
					    $activationCode=$this->generateActivationCode();
					    $values=array("otp"=>$activationCode);
					    $isUpdated=$this->rp_update($this->ctable,$values,"email='".$detail['email']."'",0);
						$reply=array("ack"=>1,"developer_msg"=>"Otp Verified.","ack_msg"=>"Otp Verified.");
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Wrong OTP","ack_msg"=>"Wrong otp!!");
						return $reply;
					}
						
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"user detail not valid","ack_msg"=>"Invalid details.","invalid_field"=>$isValid['invalid']);
					return $reply;
				}
			
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"user id not valid","ack_msg"=>"Email not associated with any account!!");
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>"user detail not found","ack_msg"=>"Internal Error!!.");
		}
	}
	function updateForgetPassword($detail)
	{
		$countFromEmail=$this->countUser($detail['email'],"email");
		if($countFromEmail>=1)
		{

			 // Update password
			 $values=array("password"=>md5($detail['new_password']));
			 $isUpdated=$this->rp_update("user",$values,"email='".$detail['email']."'",0);
			 if($isUpdated==1)
			 {
				$reply=array("ack"=>1,"developer_msg"=>"Password updated","ack_msg"=>"Password updated successfully!!");
				return $reply;
			 }
			 else
			 {
				 $reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Internal Error. Password not updated!!");
				return $reply;
			 }


		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Email not associated with any account.","ack_msg"=>"Email not associated with any account.");
			return $reply;
		}

		
	}
	function addImages($file,$detail=array())
	{
		
		if($this->rights['insert_flag']==1)
		{
		
			
			$detail=$this->db->cleanArray($detail);
			
			// check required column validation
				if($file["file"] && !empty($detail))
				{
					$result = array();
					$error="";
					if (isset($file["file"])) 
					{
						$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
						$temp = explode(".", $file["file"]["name"]);
						 $extension = end($temp);

						if($file["file"]["error"]>0) {
							$error .= "Error opening the file. ";
						}
						if($file["file"]["type"]=="application/x-msdownload"){
							$error .= "Mime type not allowed. ";
						}
						if(!in_array($extension, $allowedExts)){
							$error .= "Extension not allowed. ";
						}
						if($file["file"]["size"] > 26214400){ //26214400 Bytes = 25 MB, 102400 = 100KB
							$error .= "File size shoud be less than 25 MB ";
						}
						if($error=="") 
						{
						
							$fileName 	= $this->db->clean($file["file"]["name"]);
							$fileSize 	= round($file["file"]["size"]); // BYTES
							
							$extension	= end(explode(".", $fileName));
							$fileName	= substr(sha1(time()), 0, 6).".".$extension;
							$filePath 	= "../images/user/main/".$fileName;
							move_uploaded_file($file['file']['tmp_name'], $filePath);
					
							// count record from duplicate column if required else skip checking
							if(!empty($dup_check_array))
							$count=$this->countImage($dup_check_array['key'],$dup_check_array['value']);
							else
							$imagecount=0;	
							if($imagecount<=0)
							{

								// This is just for my F*ucking Mistake while creating database class :/
								$extracted_array=$this->extractArray($detail);
								$extracted_array['values'][]=$fileName;
								$extracted_array['columns'][]="image_path";
								$inserted_id=$this->db->rp_insert("image_master",$extracted_array['values'],$extracted_array['columns'],0);
								if($inserted_id!=0)
								{
									$data=$this->db->rp_getData("image_master","*","id='".$inserted_id."'");
									$result=mysql_fetch_assoc($data);
									$reply=array("ack"=>1,"developer_msg"=>"Image detail inserted successfully!!","ack_msg"=>"Image detail inserted successfully!!","result"=>$result);
									return $reply;
								}
								else
								{
									$reply=array("ack"=>0,"developer_msg"=>"Image deail can't be insert!!","ack_msg"=>"Image deail can't be insert!!");
									return $reply;
								}
							}
							else
							{
								$reply=array("ack"=>0,"developer_msg"=>"Duplicate Record Found!!","ack_msg"=>"Duplicate Record Found!!");
								return $reply;
							}
						}
					}
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later");
					return $reply;
				}
			
		}
		else
		{
			$this->db->rp_location("access_denied.php?msg=insert");
			$reply=array("ack"=>0,"developer_msg"=>"Image detail cannot be fetch!","ack_msg"=>"Image detail cannot be fetch!");
			return $reply;
		}
	}
	function department($department_ids=array(),$required_columns=array(),$limit=array())
	{
	
		$result=array();
		$required_columns=$this->getRequiredColumns($required_columns);
		$limit=$this->getLimit();		
		if(!empty($department_ids))
		{
			$department_ids=implode(",",$department_ids);
			$department=$this->db->rp_getData("department",$required_columns,"id IN (".$department_ids.")","",0,$limit);			
		}
		else
		{
			$department=$this->db->rp_getData("department",$required_columns,"1=1","",0,$limit);
		}
		
		if($department)
		{
			while($r=mysql_fetch_assoc($department))
			{
				$result[]=$r;
			}
			$reply=array("ack"=>1,"result"=>$result,"developer_msg"=>"department found in database.","ack_msg"=>"Great !! department  fetched.");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"no department found in database.","ack_msg"=>"Sorry !! No department found.");
			return $reply;
		}
	} 
	function getImageData($ids=array(),$required_columns=array(),$limit=array())
	{
	
		$result=array();
		$required_columns=$this->getRequiredColumns($required_columns);
		$limit=$this->getLimit();		
		if(!empty($ids))
		{
			$ids=implode(",",$ids);
			$image_data=$this->db->rp_getData("image_master",$required_columns,"id IN (".$ids.")","",0,$limit);			
		}
		else
		{
			$image_data=$this->db->rp_getData("image_master",$required_columns,"1=1","",0,$limit);
		}
		
		if($image_data)
		{
			while($p=mysql_fetch_assoc($image_data))
			{
				$p['image_path']=USER_MAIN.$p['image_path'];
				$result_image[]=$p;
			}
			$reply=array("ack"=>1,"result"=>$result_image,"developer_msg"=>"image_data found in database.","ack_msg"=>"Great !! image_data  fetched.");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"no image_data found in database.","ack_msg"=>"Sorry !! No image_data found.");
			return $reply;
		}
	} 
	function searchImage($file,$uid="")
	{
	
		$result=array();
		if(isset($file["file"])) 
		{
		
				$fileName 	= $this->db->clean($file["file"]["name"]);
				$uploadedImageDetail=$this->addImageForSearch($file,$uid);
				if($uploadedImageDetail['ack']==1)
				{
					$filename_final = $uploadedImageDetail['image_path'];
					$inserted_id = $uploadedImageDetail['inserted_id'];
					$compareMachine = new compareImages($filename_final);
					$image3Hash = $compareMachine->getHasString(); 
					$data_r=$this->db->rp_getData("image_master","*","isDelete=0");
					if($data_r)
					{
							while($row=mysql_fetch_assoc($data_r))
							{
								$image_path_from_database=USER_MAIN.$row['image_path'];	
								if($row['image_path']!="" && file_exists($image_path_from_database))
								{
									$row['image_path']=SITEURL."images/".$image_path_from_database;
									$image4Hash = $compareMachine->hasStringImage($image_path_from_database); 
									$diff = $compareMachine->compareHash($image4Hash); 
									if($diff<11 || ($diff>11 && $diff<15))
									$result[]=$row;
								}
								
							}
					}
					
					if(!empty($result)){
						
							$reply=array("ack"=>1,"developer_msg"=>"match found.","ack_msg"=>"match found!!","result"=>$result,"inserted_id"=>$inserted_id);
							return $reply;
						
					}
					else
					{
							$reply=array("ack"=>0,"developer_msg"=>"No Match Found!!","ack_msg"=>"No Match Found!!");
							return $reply;	
							
					}
				}
				else
				{
					
					$reply=array("ack"=>1,"result"=>$result,"developer_msg"=>"Image you uploaded not moved successfully","ack_msg"=>"Internal Error!!");
					return $reply;	
				}
			
				
		}	
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"no image found.","ack_msg"=>"No image found.");
			return $reply;
		}
	}
	function addImageForSearch($file,$uid)
	{
		if($file["file"])
		{
			
			$error="";
			if (isset($file["file"])) 
			{
				$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
				$temp = explode(".", $file["file"]["name"]);
				 $extension = end($temp);

				if($file["file"]["error"]>0) {
					$error .= "Error opening the file. ";
				}
				if($file["file"]["type"]=="application/x-msdownload"){
					$error .= "Mime type not allowed. ";
				}
				if(!in_array($extension, $allowedExts)){
					$error .= "Extension not allowed. ";
				}
				if($file["file"]["size"] > 26214400){ //26214400 Bytes = 25 MB, 102400 = 100KB
					$error .= "File size shoud be less than 25 MB ";
				}
				if($error=="") 
				{
				
					$fileName 	= $this->db->clean($file["file"]["name"]);
					$fileSize 	= round($file["file"]["size"]); // BYTES
					
					$extension	= end(explode(".", $fileName));
					$fileName	= substr(sha1(time()), 0, 6).".".$extension;
					$filePath 	= "../images/user/main/".$fileName;
					move_uploaded_file($file['file']['tmp_name'], $filePath);
			
					// count record from duplicate column if required else skip checking
					if(!empty($dup_check_array))
					$count=$this->countImage($dup_check_array['key'],$dup_check_array['value']);
					else
					$imagecount=0;	
					if($imagecount<=0)
					{

						$inserted_id=$this->db->rp_insert("search_master",array($uid,$fileName),array("uid","image_path"),0);
						if($inserted_id!=0)
						{
						
							
							$reply=array("ack"=>1,"developer_msg"=>"Image detail inserted successfully!!","ack_msg"=>"Image detail inserted successfully!!","image_path"=>$filePath,"inserted_id"=>$inserted_id);
							return $reply;
						}
						else
						{
							$reply=array("ack"=>0,"developer_msg"=>"Image deail can't be insert!!","ack_msg"=>"Image deail can't be insert!!");
							return $reply;
						}
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Duplicate Record Found!!","ack_msg"=>"Duplicate Record Found!!");
						return $reply;
					}
				}
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later");
			return $reply;
		}
	}
	function updateSearchImageId($match_id,$inserted_id)
	{
		if($match_id!="" && $inserted_id!="")
		{
			$row = array("match_id"=>$match_id);
			$this->db->rp_update("search_master",$row,"id='".$inserted_id."'");
			$reply=array("ack"=>1,"developer_msg"=>"Match Image id inserted successfully!!","ack_msg"=>"Match image id inserted successfully!!");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later");
			return $reply;
		}
	}
	function getSearchData($uid)
	{
		
		$result=array();
		if($uid!="")
		{
			$image_data=$this->db->rp_getData("search_master","*","uid='".$uid."'","",0);
					
			if($image_data)
			{
				while($p=mysql_fetch_assoc($image_data))
				{
					$p['image_path']=SITEURL.USER_M.$p['image_path'];
					$match_image_data=$this->db->rp_getData("image_master","*","id='".$p['match_id']."'","",0);	
					if($match_image_data)
					{
						$m=mysql_fetch_assoc($match_image_data);
						$m['image_path']=SITEURL.USER_M.$m['image_path'];
						$p['matching_result']=$m;
					}
					else
					{
						$p['matching_result']="";
					}
					$result[]=$p;
					
				}
				$reply=array("ack"=>1,"result"=>$result,"developer_msg"=>"User search data found .","ack_msg"=>"Great !! Search_data  fetched.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"no search data found in database.","ack_msg"=>"Sorry !! No search data found.");
				return $reply;
			}
			
		}
		else
		{
				$reply=array("ack"=>0,"developer_msg"=>"user data not found in database.","ack_msg"=>"Sorry !! No search data found.");
				return $reply;
		}
		
	}
	function validateDetail($detail,$validateKey)
	{
		$isValid=true;
		$result=array("invalid"=>array());
		// Name Validation
		if(array_key_exists("name",$validateKey) && !array_key_exists("name",$detail) && strlen(trim(" ",$detail['name']))>0)
		{
			$result['invalid']['name']="Name must be entered.";
			$isValid=false;
		}
		
		// Email Validation
		if(array_key_exists("email",$validateKey) && !array_key_exists("email",$detail) && strlen($detail['email'])>0)
		{
			$result['invalid']['email']="Email must be entered.";
			$isValid=false;
		}
		else if(array_key_exists("email",$validateKey) && filter_var($detail['email'], FILTER_VALIDATE_EMAIL) === false)
		{
			$result['invalid']['email']="Email is not valid.";
			$isValid=false;
		}
		
		// Password Validation
		if(array_key_exists("password",$validateKey) && !array_key_exists("password",$detail) && strlen($detail['password'])>0)
		{
			$result['invalid']['password']="Password must be entered.";
			$isValid=false;
		}
		
		// Phone Validation
		if(array_key_exists("phone",$validateKey) && !array_key_exists("phone",$detail) && strlen($detail['phone'])==10)
		{
			$result['invalid']['phone']="Contact number must be 10 digit.";
			$isValid=false;
		}
		
		if($isValid)
		{
			return array("ack"=>1);
		}
		else
		{
			$result['ack']=0;
			return $result;
		}
		
	}
	function getUserId($val,$key)
	{
		$where=$key."='".$val."'";
		$count=$this->rp_getValue($this->ctable,"id",$where);
		return $count;
	}
	function countUser($val,$key)
	{
		$where=$key."='".$val."'";
		$count=$this->rp_getTotalRecord($this->ctable,$where,0);
		return $count;
	}
	function getRequiredColumns($required_columns=array())
	{
		if(!empty($required_columns))
		{
			$required_columns_string=implode(",",$required_columns);
			return $required_columns_string;
		}
		else
		{
			return "*";
		}
	}
	function aj_sendSecurityCode($name="User",$email="",$number,$activationCode)
	{
		require_once('notification.class.php');
	    $nt = new Notification();
		$sms="Hello ".$name.",\nYour Code:".$activationCode."\nThank You,\nTeam ".SITETITLE;			
		$msgId="NO";
		if($email!="")
		{
			$body="Hello User, Someone requested new password for your ".SITETITLE." account if its you then enter this security code to application.<br> Security Code:".$activationCode."<br> Thank You,<br> Team ".SITETITLE;
			$sms=$activationCode." is your ".SITETITLE." security code";
			$email=$nt->aj_sendSecurityCodeOnEmail($email,"Security Check ".SITETITLE,$body);				
			if($number!="")
			{
				$msgId=$nt->aj_sendSMSSecurity($number,$sms);
				if($msgId!=0)
				{
					return $deliveryStatus=array("ack"=>1,"ack_msg"=>"OTP sent to ".$number." successfully");	
				}
				else
				$deliveryStatus=array("ack"=>0,"ack_msg"=>"SMS sending failed on".$number,"reason"=>"Invalid mobile number or mobile switched off or out of coverage area!!");	
				return $deliveryStatus;			
			}
			return $deliveryStatus=array("ack"=>1,"ack_msg"=>"OTP sent to ".$email." AND registered phone successfully");					
		}
			
		return array('ack'=>0,'ack_msg'=>"Internal Error!","developer_msg"=>"Empty Mobile Number");
	}
	function generateActivationCode()
	{
		$characters='0123456789';
		$randStr="";
		for($i=0;$i<=5;$i++)
		{
			$randStr=$randStr.$characters[rand(0,strlen($characters)-1)];
		}
		return $randStr;
	}
	function extractArray($array)
	{
		$columns=array();
		$values=array();
		foreach($array as $key=>$value)
		{
			$columns[]=$key;
			$values[]=$value;
		}
		return array("columns"=>$columns,"values"=>$values);
	}
	
}
?>