<?php
class Application extends Functions
{
	public $detail=array();
	public $db,$seller;
	public $home_item_type=array("offer","advertise");
	public $product_from=array("android_home_item","sub_sub_category","wishlist");
	public $sortby=array("popularity","whats_new","discount","price_h_to_l","price_l_to_h");
	function __construct($id="") 
	{
		
		$db = new Functions();
		$conn = $db->connect();		
		$this->db=$db;		  
    }

	function getCountry($country_ids=array(),$required_columns=array(),$limit=array())
	{
		$result=array();
		$required_columns=$this->getRequiredColumns($required_columns);
		$limit=$this->getLimit();		
		if(!empty($country_ids))
		{
			$country_ids=implode(",",$country_ids);
			$country=$this->db->rp_getData("country",$required_columns,"id IN (".$country_ids.")","",0,$limit);			
		}
		else
		{
			$country=$this->db->rp_getData("country",$required_columns,"1=1","",0,$limit);
		}
		
		if($country)
		{
			while($r=mysql_fetch_assoc($country))
			{
				$result[]=$r;
			}
			$reply=array("ack"=>1,"result"=>$result,"developer_msg"=>"country found in database.","ack_msg"=>"Great !! Country  fetched.");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"no country found in database.","ack_msg"=>"Sorry !! No country found.");
			return $reply;
		}
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
}
?>