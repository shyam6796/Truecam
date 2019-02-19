<?php
class Admin extends Functions
{
	public $detail=array();
	public $db,$media;
	public $ctable=CTABLE_ADMIN;
	public $primary_column="id";
	public $id="";
	public $name		= "";
	public $username		= "";
	public $email			= "";
	public $mobile_no			= "";
	public $interest			= "";
	public$occupation			= "";
	public $about			= "";
	public $website			= "";
	public $twitter			= "";
	public $facebook			= "";
	public $valid_keys=array("id","name","username","email","mobile_no","interest","occupation","about","website","twitter","facebook","image_path");
	function __construct($id="") 
	{
		require_once("class.media.php");
		$db = new Functions();
		$media=new Media();
		$conn = $db->connect();
		$this->db=$db;		  	
		$this->media=$media;	
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
	function update($detail=array(),$primary_key)
	{
		// id,name,email,username,profile_picture, mobile_no,interest,occupation,about,website,twitter,facebook
		
		$detail=$this->db->cleanArray($detail);
		
		$validateKey=$this->validateKey($detail);	
		
		if($validateKey['ack']==1)
		{
			
				
			// check required column validation
			if(!empty($detail)&& $primary_key!="")
			{
				// count record from $primary_key
				$count=$this->countAdmin($this->primary_column,$primary_key);
				if($count>=1)
				{
					$where=$this->primary_column."=".$primary_key;
					$isUpdated=$this->db->rp_update($this->ctable,$detail,$where,0);
					if($isUpdated)
					{
						$reply=array("ack"=>1,"developer_msg"=>"Admin Detail Updated Successfully!!","ack_msg"=>"Admin Detail Updated Successfully!!","error"=>array());
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Admin Detail Not Valid Database Error!!","ack_msg"=>"Internal Error!! Try later","error"=>array("Internal Error!! Try later"));
						return $reply;
					}
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"No Record Found To Update","ack_msg"=>"Record Deleted!!","error"=>array("Internal Error!! Try later"));
					return $reply;
				}
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later","error"=>array("Internal Error!! Try later"));
				return $reply;
			}
		}
		else
		{
			$reply=array("ack"=>0,"error"=>$validateKey['error'],"developer_msg"=>"Invalid Key","ack_msg"=>"Internal Error!! Try later");
				return $reply;
		}
		
	}
	function getAdminDetail($user_id=0,$required_columns=array())
	{
		$required_columns=$this->getRequiredColumns($required_columns);
		if($user_id!=0)
		{
			$where="id='".$user_id."'";
			$result=$this->rp_getData($this->ctable,$required_columns,$where);
			if($result)
			{
				$detail=mysql_fetch_assoc($result);
				$detail['countFollower']=0;
				$detail['countFollowing']=$this->db->rp_getTotalRecord("seller_follower","follower_id='".$user_id."'");
				$detail['countNotification']=$this->db->rp_getTotalRecord("notification","1=1");
				$detail['countMessage']=$this->db->rp_getTotalRecord("chat_message","receiver='".$user_id."' AND sent_by=0");
				$detail['wallet_amount']=$this->db->rp_getValue("user_wallet","amount","uid='".$user_id."'");
				$detail['image_path']=$this->media->getMedia(array("mid"=>array($detail['image_path'])));
				if($detail['image_path']['ack']==1)
				{
					$detail['image_path']=$detail['image_path']['result'][0]['url'];	
				}
				else
				{
					$detail['image_path']=USER_DEFAULT."default_user.png";
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
	
	function getAdmins($user_id=0,$required_columns=array())
	{
		$required_columns=$this->getRequiredColumns($required_columns);
		if($user_id!=0)
		{
			
			$result_admins=$this->rp_getData($this->ctable,$required_columns,"1=1 AND id!='".$user_id."'");
			if($result_admins)
			{
				while($detail=mysql_fetch_assoc($result_admins))
				{
					$detail['countFollower']=0;
					$detail['countFollowing']=$this->db->rp_getTotalRecord("seller_follower","follower_id='".$user_id."'");
					$detail['countNotification']=$this->db->rp_getTotalRecord("notification","1=1");
					$detail['countMessage']=$this->db->rp_getTotalRecord("chat_message","receiver='".$user_id."' AND sent_by=0");
					$detail['wallet_amount']=$this->db->rp_getValue("user_wallet","amount","uid='".$user_id."'");
					$detail['image_path']=$this->media->getMedia(array("mid"=>array($detail['image_path'])));
					if($detail['image_path']['ack']==1)
					{
						$detail['image_path']=$detail['image_path']['result'][0]['url'];	
					}
					else
					{
						$detail['image_path']=USER_DEFAULT."default_user.png";
					}
					$result[]=$detail;
				}
				
				
				$reply=array("ack"=>1,"developer_msg"=>"Admin details found","ack_msg"=>"Admin details found.","result"=>$result);
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
	public function getAddButton($ctable,$url=null)
    {
		$rights=$_SESSION['rights'];	
		if($ctable!="" && $rights['insert_flag']==1 ){
			if($url!=null){
				?>
				<div class="btn-group">
					<a class="btn sbold blue-ebonyclay" href="<?php echo $url; ?>"> Add New
						<i class="fa fa-plus"></i>
					</a>
				</div>
				<?php
			}else{
				?>
				<div class="btn-group">
					<a class="btn sbold blue-ebonyclay" href="add_<?php echo $ctable; ?>.php?mode=add"> Add New
						<i class="fa fa-plus"></i>
					</a>
				</div>
				<?php
			}
		}	
    }
	public function getUpdateButton($frmId=null,$title="Update")
    {
		if($frmId!=null && $rights['update_flag']==1){
			?>
			<button class="btn btn-primary btn-flat sidebar" onClick="document.<?php echo $frmId; ?>.submit();"><?php echo $title ?></button>
			<?php
		}else{
			?>
			<button class="btn btn-primary btn-flat sidebar" onClick="document.frm.submit();"><?php echo $title; ?></button>
			<?php
		}
    }
	public function getAddApplicationPageButton()
	{
		?>
		<a class="btn btn-primary btn-flat sidebar" href="manage_page_table.php" >Application Pages</a>
		<?php
	}
	public function getLabel($content,$href,$type)
	{
		
		$label_type=array("danger"=>"label label-danger","success"=>"label label-success","warning"=>"label label-warning","info"=>"label label-info","default"=>"label label-default");
		if($type=='auto')
		{
			$header=$this->checkPageResponse($href);
			if($header=='200')
			{
				$class=$label_type['success'];
			}
			else if($header=='302')
			{
				$class=$label_type['success'];
			}
			else if($header=='404')
			{
				$class=$label_type['danger'];
			}
			else
			{
				$class=$label_type['info'];
			}
		}
		else if($type=='random')
		{
			$key = array_rand($label_type);
			$class = $label_type[$key];
		}
		else
		{
			if(array_key_exists($type,$label_type))
			{
				$class=$label_type[$type];
			}
			else
			{
				$class=$label_type['default'];
			}
		}
		
		
		return '<a class="'.$class .' col-sm-12" style="margin-top:10px" href="'. $href.'" >'.$content.'</a>';
		
	}
	public function rp_paginate_function($item_per_page, $current_page, $total_records, $total_pages)
	{
		
		$pagination = '';
		if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
			$right_links    = $current_page + 3; 
			$previous       = $current_page - 3; //previous link 
			$next           = $current_page + 1; //next link
			$first_link     = true; //boolean var to decide our first link
			
			if($current_page > 1){
				$previous_link = ($previous<=0)?1:$previous;
				$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="1" title="First">&laquo;</a></li>'; //first link
				$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
					for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
						if($i > 0){
							$pagination .= '<li class="paginate_button "><a href="#"  data-page="'.$i.'" aria-controls="datatable1" title="Page'.$i.'">'.$i.'</a></li>';
						}
					}   
				$first_link = false; //set first link to false
			}
			
			if($first_link){ //if current active page is first link
				$pagination .= '<li class="paginate_button active"><a aria-controls="datatable1">'.$current_page.'</a></li>';
			}elseif($current_page == $total_pages){ //if it's the last active link
				$pagination .= '<li class="paginate_button active"><a aria-controls="datatable1">'.$current_page.'</a></li>';
			}else{ //regular current link
				$pagination .= '<li class="paginate_button active"><a aria-controls="datatable1">'.$current_page.'</a></li>';
			}
					
			for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
				if($i<=$total_pages){
					$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
				}
			}
			if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages)? $total_pages : $i;
				$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
				$pagination .= '<li class="paginate_button "><a href="#" aria-controls="datatable1" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
			}
		}
		return $pagination; //return pagination links
	}
	function checkPageResponse( $url )
	{
		
		$post=["skip_security"=>1224];
		 if($url == NULL) return false;  
    $ch = curl_init($url);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $post );
	
 $data = curl_exec($ch);  
  $redirectURL = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL );
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
    curl_close($ch);	
        return $httpcode;  
    /* file_get_contents($url);		
		foreach( $http_response_header as $k=>$v )
		{
			$t = explode( ':', $v, 2 );
			if( isset( $t[1] ) )
				$head[ trim($t[0]) ] = trim( $t[1] );
			else
			{
				$head[] = $v;
				if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
					$head['reponse_code'] = intval($out[1]);
			}
		}
		return $head;*/
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
	
	function countAdmin($key,$value)
	{		
		$countAdmin = $this->db->rp_getTotalRecord($this->ctable,$key."=".$value,0);
		return $countAdmin;	
	}
}
?>