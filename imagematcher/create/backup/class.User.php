<?php
class User extends Functions
{
	public $detail=array();
	public $db,$rights;
	public $ctable="user";
	public $primary_column="id";
	// Public Varibale
	public $id='';public $name='';public $email='';public $phone ='';public $address='';public $city='';
	public $valid_keys=array("id","name","email","phone ","address","city");
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
		
		if(empty($error))
		{
			$result=array("ack"=>1);
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
			// Count Total Record Without any limit
			$total_count=$this->rp_getTotalRecord($this->ctable,$where);
			// Count Show Record With limit
			$show_count=$this->rp_getTotalRecord($this->ctable,$where." LIMIT ".$limit);
			// Get Actual Records
			$result_r=$this->db->rp_getData($this->ctable,$required_columns,$where,$orderby,0,$limit);
			if($result_r)
			{
				while($d=mysql_fetch_assoc($result_r))
				{
					// Do Modification IN $d Here If Required
					$result[]=$d;
				}
				
				$reply=array("ack"=>1,"developer_msg"=>"User deail fetched successfully!!","ack_msg"=>"User deail fetched successfully!!","result"=>$result,"total_count"=>$total_count,"show_count"=>$show_count);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"User detail can’t be fetch!","ack_msg"=>"User detail can’t be fetch!");
				return $reply;
			}
		}
		else
		{
			$this->db->rp_location("access_denied.php?msg=view");
			$reply=array("ack"=>0,"developer_msg"=>"User detail can’t be fetch!","ack_msg"=>"User detail can’t be fetch!");
			return $reply;
		}
		
	}
	
	function insert($detail=array(),$dup_check_array=array())
	{
		if($this->rights['insert_flag']==1)
		{
			// id,name,email,phone ,address,city		
			$detail=$this->db->cleanArray($detail);
			$validateKey=$this->validateKey($detail);		
			if($validateKey['ack']==1)
			{
				// check required column validation
				if(!empty($detail))
				{
					// count record from duplicate column if required else skip checking
					if(!empty($dup_check_array))
					$count=$this->countUser($dup_check_array['key'],$dup_check_array['value']);
					else
					$count=0;	
					if($count<=0)
					{
						// This is just for my F*ucking Mistake while creating database class :/
						$extracted_array=$this->extractArray($detail);
						$inserted_id=$this->db->rp_insert($this->ctable,$extracted_array['value'],$extracted_array['columns'],0);
						if($inserted_id!=0)
						{
							$reply=array("ack"=>1,"developer_msg"=>"User detail inserted successfully!!","ack_msg"=>"User detail inserted successfully!!");
							return $reply;
						}
						else
						{
							$reply=array("ack"=>0,"developer_msg"=>"User deail can't be insert!!","ack_msg"=>"User deail can't be insert!!");
							return $reply;
						}
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"User deail can't be insert!!","ack_msg"=>"User deail can't be insert!!");
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
				$reply=array("ack"=>0,"error"=>$validateKey['error'],"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later");
					return $reply;
			}
		}
		else
		{
			$this->db->rp_location("access_denied.php?msg=insert");
			$reply=array("ack"=>0,"developer_msg"=>"User detail can’t be fetch!","ack_msg"=>"User detail can’t be fetch!");
			return $reply;
		}
	}
	
	function update($detail=array(),$primary_key)
	{
		if($rights['update_flag']==1)
		{
			// id,name,email,phone ,address,city
			
			$detail=$this->db->cleanArray($detail);
			$validateKey=$this->validateKey($detail);		
			if($validateKey['ack']==1)
			{
				// check required column validation
				if(!empty($detail)&& $primary_key!="")
				{
					// count record from $primary_key
					$count=$this->countUser($this->primary_column,$primary_key);
					if($count>=1)
					{
						$where=$this->primary_column."=".$primary_key;
						$isUpdated=$this->db->rp_update($this->ctable,$detail,$where,0);
						if($isUpdated)
						{
							$reply=array("ack"=>1,"developer_msg"=>"User detail updated successfully!!","ack_msg"=>"User detail updated successfully!!");
							return $reply;
						}
						else
						{
							$reply=array("ack"=>0,"developer_msg"=>"User detail can’t be updated!!","ack_msg"=>"User detail can’t be updated!!");
							return $reply;
						}
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"No Record Found To Update","ack_msg"=>"Record Deleted!!");
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
				$reply=array("ack"=>0,"error"=>$validateKey['error'],"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later");
					return $reply;
			}
		}
		else
		{
			$this->db->rp_location("access_denied.php?msg=insert");
			$reply=array("ack"=>0,"developer_msg"=>"User detail can’t be fetch!","ack_msg"=>"User detail can’t be fetch!");
			return $reply;
		}
		
	}
	
	function delete($delete_array)
	{
		if($rights['delete_flag']==1)
		{
			// Hey Its Really Delete Your Row i am not kidding :| !!
			if(!empty($dup_check_array))
			{
				$count=$this->countUser($delete_array['key'],$delete_array['value']);
				if($count>=1)
				{
					$this->db->rp_delete($this->ctable,$delete_array['key']."=".$delete_array['value']);
					$reply=array("ack"=>1,"developer_msg"=>"User deail deleted successfully!!","ack_msg"=>"User deail deleted successfully!!");
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"User detail can’t be updated!!","ack_msg"=>"User detail can’t be updated!!");
					return $reply;
				}	
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"User detail can’t be updated!!","ack_msg"=>"User detail can’t be updated!!");
				return $reply;
			}
		}
		else
		{
			$this->db->rp_location("access_denied.php?msg=insert");
			$reply=array("ack"=>0,"developer_msg"=>"User detail can’t be fetch!","ack_msg"=>"User detail can’t be fetch!");
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
			$values[]=$value
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
	
	function countUser($key,$value)
	{		
		$countUser = $this->db->rp_getTotalRecord($this->cptable,$key."=".$value,0);
		return $countUser;	
	}
}
?>