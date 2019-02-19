<?php
class :class_name extends Functions
{
	public $detail=array();
	public $db;
	public $ctable=:table;
	public $primary_column=:primary_column;
	// Public Varibale
	:column_variable_declaration
	public $valid_keys=array(:valid_keys);
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;		  		
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
			
			$reply=array("ack"=>1,"developer_msg"=>":view_success_message","ack_msg"=>":view_success_message","result"=>$result,"total_count"=>$total_count,"show_count"=>$show_count);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>":view_fail_message","ack_msg"=>":view_fail_message");
			return $reply;
		}
	}
	
	function insert($detail=array(),$dup_check_array=array())
	{
		
		// :require_column_name		
		$detail=$this->db->cleanArray($detail);
		$validateKey=$this->validateKey($detail);		
		if($validateKey['ack']==1)
		{
			// check required column validation
			if(!empty($detail))
			{
				// count record from duplicate column if required else skip checking
				if(!empty($dup_check_array))
				$count=$this->count:class_name($dup_check_array['key'],$dup_check_array['value']);
				else
				$count=0;	
				if($count<=0)
				{
					// This is just for my F*ucking Mistake while creating database class :/
					$extracted_array=$this->extractArray($detail);
					$inserted_id=$this->db->rp_insert($this->ctable,$extracted_array['value'],$extracted_array['columns'],0);
					if($inserted_id!=0)
					{
						$reply=array("ack"=>1,"developer_msg"=>":insert_success_message","ack_msg"=>":insert_success_message");
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>":insert_fail_message","ack_msg"=>":insert_fail_message");
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
	
	function update($detail=array(),$primary_key)
	{
		
		// :require_column_name
		
		$detail=$this->db->cleanArray($detail);
		$validateKey=$this->validateKey($detail);		
		if($validateKey['ack']==1)
		{
			// check required column validation
			if(!empty($detail)&& $primary_key!="")
			{
				// count record from $primary_key
				$count=$this->count:class_name($this->primary_column,$primary_key);
				if($count>=1)
				{
					$where=$this->primary_column."=".$primary_key;
					$isUpdated=$this->db->rp_update($this->ctable,$detail,$where,0);
					if($isUpdated)
					{
						$reply=array("ack"=>1,"developer_msg"=>":update_success_message","ack_msg"=>":update_success_message");
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>":update_fail_message","ack_msg"=>":update_fail_message");
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
	
	function delete($delete_array)
	{
		// Hey Its Really Delete Your Row i am not kidding :| !!
		if(!empty($dup_check_array))
		{
			$count=$this->count:class_name($delete_array['key'],$delete_array['value']);
			if($count>=1)
			{
				$this->db->rp_delete($this->ctable,$delete_array['key']."=".$delete_array['value']);
				$reply=array("ack"=>1,"developer_msg"=>":delete_success_message","ack_msg"=>":delete_success_message");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>":delete_fail_message","ack_msg"=>":delete_fail_message");
				return $reply;
			}	
			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>":delete_fail_message","ack_msg"=>":delete_fail_message");
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
	
	function count:class_name($key,$value)
	{		
		$count:class_name = $this->db->rp_getTotalRecord($this->cptable,$key."=".$value,0);
		return $count:class_name;	
	}
}
?>