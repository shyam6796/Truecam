<?php
class Image extends Functions
{
    public $detail=array();
    public $db,$rights;
    public $ctable="image_master";
    public $primary_column="id";
    public $unique_column="name";
    // Public Varibale
    public $id='';public $department_id='';public $name='';public $email='';public $mobile='';public $birth_date='';public $blood_group='';public $address='';public $image_path='';
    public $valid_keys=array("id","	department_id","name","email","mobile","birth_date","blood_group","address","image_path");
    function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;

		$this->rights=$_SESSION['rights'];
    	}
	function validateKey($detail)
	{
		$error=array();
		foreach($detail as $key=>$value)
		{
			if(!in_array($key,$this->valid_keys))
			{
				$error[]=$key;
			}
		}
		if(!empty($error))
		{
			$result=array("ack"=>1,"sucess"=>"sd");
			return $result;
			
		}
		else
		{
			$result=array("ack"=>0,"error"=>$error);
			return $result;
		}
	}
  function view($where="",$required_columns=array(),$orderby="",$limit="")
	{

        if($this->rights['view_flag']==1)
		{
           
			$result=array();
			
        	$required_columns=$this->getRequiredColumns($required_columns);
			$where=($where=="")?"1=1":$where;				
			// Count Total Record Without any limit
			$total_count=$this->rp_getTotalRecord($this->ctable,$where,0);
			// Count Show Record With limit
			
			$show_count=$this->rp_getTotalRecord($this->ctable,$where,0,$this->getLimits($limit));
			// Get Actual Records
			$result_r=$this->db->rp_getData($this->ctable,$required_columns,$where,$orderby,0,$this->getLimits($limit));
			//print_r($result_r);exit;
			if($result_r)
			{
				while($d=mysql_fetch_assoc($result_r))
				{
					//$image=$d['image_path']);
					// Do Modification IN $d Here If Required
					$result[]=$d;
					
				}
				
				$reply=array("ack"=>1,"developer_msg"=>"Image detail fetched successfully!!","ack_msg"=>"Image detail fetched successfully!!","result"=>$result,"total_count"=>$total_count,"show_count"=>$show_count);
				return $reply;
			}
			else
			{

				$reply=array("ack"=>0,"developer_msg"=>"Image detail can not be fetch!","ack_msg"=>"Image detail can not be fetch!");
				return $reply;
			}
		}
		else
		{
			$this->db->rp_location("access_denied.php?msg=view");
			$reply=array("ack"=>0,"developer_msg"=>"Image detail cannot be fetch!","ack_msg"=>"Image detail cannot be fetch!");
			return $reply;
		}
		
	}

	function insert($detail=array(),$dup_check_array=array(),$file)
	{
		
		if($this->rights['insert_flag']==1)
		{

			$detail=$this->db->cleanArray($detail);
			$validateKey=$this->validateKey($detail);
			if($validateKey['ack']==1)
			{
				// check required column validation
				if(!empty($detail))
				{

					// count record from duplicate column if required else skip checking
					if(!empty($dup_check_array))
					$count=$this->countSlider($dup_check_array['key'],$dup_check_array['value']);
					else
					$count=0;	
					if($count<=0)
					{
						//print_r($count);exit;
					if (isset($file["image_path"])) 
					{
						//print_r($detail);exit;
                    $allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
                    $temp = explode(".", $file["image_path"]["name"]);
                    $extension = end($temp);

                    if($file["image_path"]["error"]>0) {
                        $error .= "Error opening the file. ";
                    }
                    if($file["image_path"]["type"]=="application/x-msdownload"){
                        $error .= "Mime type not allowed. ";
                    }
                    if(!in_array($extension, $allowedExts)){
                        $error .= "Extension not allowed. ";
                    }
					
             
      
						$fileName  = $this->db->clean($file["image_path"]["name"]);
                        $fileSize  = round($file["image_path"]["size"]); // BYTES
						//echo $fileSize ;exit;
                        $adate   = date('Y-m-d H:i:m');

                        $extension = end(explode(".", $fileName));
					
                        $fileName = 'img'.substr(sha1(time()), 0, 6).".".$extension;
                        $filePath  = "../images/user/main/".$fileName;
						
						move_uploaded_file($file["image_path"]["tmp_name"], $filePath);
						$detail['image_path']=$fileName;
						// This is just for my F*ucking Mistake while creating database class :/
						$extracted_array=$this->extractArray($detail);
                        $inserted_id=$this->db->rp_insert($this->ctable,$extracted_array['values'],$extracted_array['columns'],0);
						if($inserted_id!=0)
						{
							$reply=array("ack"=>1,"developer_msg"=>"Image detail inserted successfully!!","ack_msg"=>"Image detail inserted successfully!!");
							return $reply;
						}
						else
						{
							$reply=array("ack"=>0,"developer_msg"=>"Image deatil can't be insert!!","ack_msg"=>"Image deatil can't be insert!!");
							return $reply;
						}
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Image Record Found!!","ack_msg"=>"Internal Error!!");
						return $reply;
					}
					
				}
				else
				{
					$reply=array("ack"=>0,"error"=>$validateKey['error'],"developer_msg"=>"Invalid Key","ack_msg"=>"Duplicate Record Found!! Try later");
					return $reply;
				}
			
			}
			else
			{
				$reply=array("ack"=>0,"error"=>$validateKey['error'],"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later");
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
}
  
	
  
	function update($detail=array(),$unique_key="",$primary_key,$file)
	{
		
		if($this->rights['update_flag']==1)
		{
			
			$detail=$this->db->cleanArray($detail);
			$validateKey=$this->validateKey($detail);		
			if($validateKey['ack']==1)
			{
				// check required column validation
				if(!empty($detail)&& $primary_key!="")
				{
					// count record from $primary_key
					$count=$this->countSlider($this->primary_column,$primary_key);
					if($count>=1)
					{
						$count=$this->duplicateImage($this->unique_column,$unique_key,$primary_key);
						if($count<=0)
						{
								if (isset($file["image_path"])) 
								{
									
									$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
									$temp = explode(".", $file["image_path"]["name"]);
									$extension = end($temp);

									if($file["image_path"]["error"]>0) {
										$error .= "Error opening the file. ";
									}
									if($file["image_path"]["type"]=="application/x-msdownload"){
										$error .= "Mime type not allowed. ";
									}
									if(!in_array($extension, $allowedExts)){
										$error .= "Extension not allowed. ";
									}
							
									$fileName  = $this->db->clean($file["image_path"]["name"]);
									$fileSize  = round($file["image_path"]["size"]); // BYTES
									//echo $fileSize ;exit;
									$adate   = date('Y-m-d H:i:m');

									$extension = end(explode(".", $fileName));
								
									$fileName	 = 'img'.substr(sha1(time()), 0, 6).".".$extension;
									$filePath  = "../images/user/main/".$fileName;
							
									move_uploaded_file($file["image_path"]["tmp_name"], $filePath);
									$detail['image_path']=$fileName;
									$where=$this->primary_column."=".$primary_key;
									$isUpdated=$this->db->rp_update($this->ctable,$detail,$where,0);
									if($isUpdated)
									{
									   
										$reply=array("ack"=>1,"developer_msg"=>"Image detail updated successfully!!","ack_msg"=>"Image detail updated successfully!!");
										return $reply;
									}
									else
									{
										$reply=array("ack"=>0,"developer_msg"=>"Image detail cannot be updated!!","ack_msg"=>"Image detail cannot be updated!!");
										return $reply;
									}
								}
								else
								{
									$reply=array("ack"=>0,"developer_msg"=>"Not file uploded!!","ack_msg"=>"Not file Uploded!!");
									return $reply;
								}
							}
							else
							{
								$reply=array("ack"=>0,"developer_msg"=>"Duplicate Record Found!!","ack_msg"=>"Duplicate Record Found!!");
								return $reply;
							}
						}
						else
						{
							$reply=array("ack"=>0,"developer_msg"=>"No Record Found To Update","ack_msg"=>"Record Not Found!!");
							return $reply;
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
				$reply=array("ack"=>0,"error"=>$validateKey['error'],"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later");
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

	
	function delete($delete_array,$detail)
	{
		if($this->rights['delete_flag']==1)
		{
			// Hey Its Really Delete Your Row i am not kidding :| !!

            $count=$this->countSlider($delete_array['key'],$delete_array['value']);
            if($count>=1)
            {
				
            	$this->db->rp_update($this->ctable,$detail,$delete_array['key']."=".$delete_array['value'],0);
            	$reply=array("ack"=>1,"developer_msg"=>"Image detail deleted successfully!!","ack_msg"=>"Image detail deleted successfully!!");
            	return $reply;
            }
            else
            {
            	$reply=array("ack"=>0,"developer_msg"=>"No record found!!","ack_msg"=>"No record found!!");
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
    function active($active_array)
	{
		if($this->rights['update_flag']==1)
		{

				$count=$this->countSlider($active_array['key'],$active_array['value']);
				if($count>=1)
				{
					$this->db->rp_update($this->ctable,array("isActive"=>$active_array['status']),$active_array['key']."=".$active_array['value'],0);
					$reply=array("ack"=>1,"developer_msg"=>"Image deatil status updated successfully!!","ack_msg"=>"Image status updated successfully!!");
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"No record found!!","ack_msg"=>"No record found!!");
					return $reply;
				}

		}
		else
		{
			$this->db->rp_location("access_denied.php?msg=insert");
			$reply=array("ack"=>0,"developer_msg"=>"Image detail cannot be fetch!","ack_msg"=>"Slider detail cannot be fetch!");
			return $reply;
		}
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
	
	function countSlider($key,$value)
	{		
		$countSlider = $this->db->rp_getTotalRecord($this->ctable,$key."='".$value."'",0);
		return $countSlider;	
	}
	function duplicateImage($key,$value,$primary_key)
	{		
		$countSlider = $this->db->rp_getTotalRecord($this->ctable,$key."='".$value."' AND ".$this->primary_column."!=".$primary_key,0);
		return $countSlider;	
	}
	
	function getLimits($limit)
	{
		if($limit!="" && !empty($limit) && array_key_exists("ul",$limit) && array_key_exists("ll",$limit))
		{
		   return $limit['ul'].",".$limit['ll'];
		}
		else
		{
			return "";
		}
	}
    function isValidPassCode($passcode)
    {
        $count=$this->db->rp_getTotalRecord($this->ctable,"bus_id='".$passcode."'");
         if($count>=1)
         {
            return true;
         }
         else
         {
             return false;
         }
    }
    function generatePasscode()
    {
		$characters='ABCDEFGHIJKLMNOPQRSTUVXYZ0123456789';
		$randStr="";
		for($i=0;$i<=5;$i++)
		{
			$randStr=$randStr.$characters[rand(0,strlen($characters)-1)];
		}


           	return $randStr;


    }

}


?>