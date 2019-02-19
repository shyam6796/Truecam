<?php
class Media extends Functions
{
	public $detail=array();
	public $db;
	public $ctable="media";
	public $media_type= array("image","audio","video","file");
	public $media_path=array("user_profile_picture"=>USER_MAIN,"user_banner"=>USER_BANNER);
	public $allowed_media_exetension= array(array("jpg","jpeg","png","gif"),array("mp3","wav"),array("mp4","mkv","avi"),array("zip","doc","xls","ppt"));
	function __construct($id="") 
	{
		$this->db = new Functions();
		$conn = $this->db->connect();		
    }

	function addMedia($detail,$file)
	{
		
		$detail=$this->db->cleanArray($detail);
		$actual_file_name=basename($file["file"]["name"]);
		$extention=pathinfo($actual_file_name,PATHINFO_EXTENSION);
		$error=0;
		// File Name, Title, Media Type , Reference Type, Reference Id
		if(!empty($detail) && $detail['url']!="" && $detail['reference_type']!="" && $detail['reference_id']!="")
		{
			// Upload Media to Appropriate Folder
			$root_path=$this->media_path[$detail['reference_type']];
			if(!in_array($extention,$this->allowed_media_exetension[$detail['media_type']]))
			{
				$error=1;
				$error_msg[]="File type not supported!!";
			}
			
			if($file['file']['size']>5000000)
			{
				$error=1;
				$error_msg[]="File is too large!!";
			}
			
			if($error==0)
			{
				
				$target_file_name="media_".time().".".$extention;			
				$filepath=$root_path.$target_file_name;
				move_uploaded_file($file["file"]["tmp_name"], $filepath);
				$values=array($target_file_name,$detail['title'],$detail['media_type'],$detail['reference_type'],$detail['reference_id'],$this->db->today());
				$columns=array("url","title","media_type","reference_type","reference_id","adate");
				$media_id=$this->db->rp_insert($this->ctable,$values,$columns,0);
				if($media_id!=0)
				{					
					$reply=array("ack"=>1,"developer_msg"=>"Media Detail Added Successfully!!","ack_msg"=>"Media Uploaded Successfully!!","media_id"=>$media_id,"error"=>array());
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid Database Error!!","ack_msg"=>"Internal Error!! Try later","error"=>array("Internal Error!!"));
					return $reply;
				}	
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Invalid Media!!","ack_msg"=>"Invalid Media!! Try again","error"=>$error_msg);
				return $reply;
			}			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid!!","ack_msg"=>"Internal Error!! Try later","error"=>array("Internal Error!!"));
			return $reply;
		}
	}	
	
	function removeMedia($detail)
	{
		// Media Id
		if($detail['media_id']!="")
		{
			$isUpdated=$this->rp_update($this->ctable,array("isDelete"=>1),"id='".$detail['mid']."'");
			if($isUpdated)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Media Detail Removed Successfully!!","ack_msg"=>"Media Removed Successfully!!");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid Database Error!!","ack_msg"=>"Internal Error!! Try later");
				return $reply;
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid!!","ack_msg"=>"Internal Error!! Try later");
			return $reply;
		}
	}
	function getMedia($detail,$required_columns=array())
	{
		$required_columns=$this->getRequiredColumns($required_columns);	
		if(!empty($detail) && array_key_exists("mid",$detail) && $detail['mid']!="" && $detail['mid']!=0)
		{
			$mids=implode(",",$detail['mid']);
			$media_detail=$this->rp_getData("media",$required_columns,"id IN (".$mids.")");// Get Cart detail if there are any cart with In Progress status
			if($media_detail)
			{			
				$media_detail_result=array();
				while($m=mysql_fetch_assoc($media_detail)){
					
					// Do Modification Here
					
					$m['adate']=$this->formateDate($m['adate']);
					$m['url']=$this->media_path[$m['reference_type']].$m['url'];
					$media_detail_result[]=$m;
				}
				
				$reply=array("ack"=>1,"developer_msg"=>"Media Detail Fetched Successfully!!","ack_msg"=>"Media Fetched Successfully!!","result"=>$media_detail_result);
				return $reply;	
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"No media found!!","ack_msg"=>"No media found!!");
				return $reply;
			}
					
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"media ids not found!!","ack_msg"=>"Internal Error!! Try later");
			return $reply;
		}
	}
	function countMedia($where)
	{		
		$countMedia = $this->db->getTotalRecord($this->ctable,"id",$where,0);
		return $countMedia;	
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
	function getLimit($limit=array())
	{
		$limit=$this->db->getLimit();	
		if(!empty($limit) && array_key_exists("ul",$limit))
		{
			$ul=$limit['ul'];
			if(array_key_exists("ll",$limit) && $limit['ll']!="")
			{
				$ll=$limit['ll'];
			}
			else
			{
				$ll="18446744073709551615";
			}			
			$limit_string="".$ul.",".$ll;
			return $limit_string;
		}
		else
		{
			return "";
		}
	}	
	function formateDate($date)
	{
	
		if($date!="" && $date!="null" && $date!="0000-00-00 00:00:00")
		{
			return date('D, d M Y', strtotime($date));
		}
		else
		{
			return "--";
		}
	}
}
?>