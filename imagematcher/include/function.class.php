<?php
include("main.class.php");

class Functions extends Database
{
	/*
		*** Main Function Developed By Ravi Patel :) <<<
			-> rp_getData()
				- return single and multi records
			-> rp_getValue() 
				- return single records
			-> rp_getTotalRecord()
				- return number of records
			-> rp_getMaxVal()
				- return maximum value
			-> rp_insert()
				- insert record
			-> rp_delete()
				- delete record
			-> rp_update()
				- update record
			-> tableExists()
				- check whether table exist or not
			-> rp_limitChar()
				- return trimed character string
			-> rp_dupCheck()
				- check for duplicate record in table
			-> rp_location()
				- redirect to given URL
			-> rp_getDisplayOrder()
				- get next display order
			-> rp_createSlug()
				- create alias of given string
			-> rp_getTotalReview()
				- number of total review of product
			-> rp_catData()
				- get cid/sid/ssid from slug
			-> clean()
				- prevent mysql injction
			-> rp_productQty()
				- Current Product Qty
			-> rp_getProductPriceDiv()
				- Product Price Div
			-> aj_updateUserPassword()
				- update change password
			-> rp_location_post()
				- pass url data into post
	*/
	
	public function rp_getData($table, $rows = '*', $where = null, $order = null,$die=0,$limit="") // Select Query, $die==1 will print query By Ravi Patel
    {
		$results = array();
        $q = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
        if($order != null)
            $q .= ' ORDER BY '.$order;
		if($limit != null)
            $q .= ' LIMIT '.$limit;
		if($die==1){
			echo $q;die;
		}
        if($this->tableExists($table))
       	{
			if(mysql_num_rows(mysql_query($q))>0){
				$results = @mysql_query($q);
				return $results;
			}else{
				return false;
			}
        }
		else{
			return false;
		}
    }
	
	public function rp_getValue($table, $row=null, $where=null,$die=0) // single records ref HB function
    {
		if($this->tableExists($table) && $row!=null && $where!=null)
       	{
			$q = 'SELECT '.$row.' FROM '.$table.' WHERE '.$where;
			if($die==1){
				echo $q;die;
			}
			if(mysql_num_rows(mysql_query($q))>0){
				$results = @mysql_fetch_array(mysql_query($q));
				return $results[$row];
			}else{
				return false;
			}
        }
		else{
			return false;
		}
    }
	
	public function rp_getMaxVal($table, $row=null, $where=null,$die=0)
    {
		if($this->tableExists($table) && $row!=null && $where!=null)
       	{
			$q = 'SELECT MAX('.$row.') as '.$row.' FROM '.$table.' WHERE '.$where;
			if($die==1){
				echo $q;die;
			}
			if(mysql_num_rows(mysql_query($q))>0){
				$results = @mysql_fetch_array(mysql_query($q));
				return $results[$row];
			}else{
				return 0;
			}
        }
		else{
			return 0;
		}
    }
	public function rp_getMinVal($table, $row=null, $where=null,$die=0)
    {
		if($this->tableExists($table) && $row!=null && $where!=null)
       	{
			$q = 'SELECT MIN('.$row.') as '.$row.' FROM '.$table.' WHERE '.$where;
			if($die==1){
				echo $q;die;
			}
			if(mysql_num_rows(mysql_query($q))>0){
				$results = @mysql_fetch_array(mysql_query($q));
				return $results[$row];
			}else{
				return 0;
			}
        }
		else{
			return 0;
		}
    }
	
	public function rp_getSumVal($table, $row=null, $where=null,$die=0)
    {
		if($this->tableExists($table) && $row!=null && $where!=null)
       	{
			$q = 'SELECT SUM('.$row.') as '.$row.' FROM '.$table.' WHERE '.$where;
			if($die==1){
				echo $q;die;
			}
			if(mysql_num_rows(mysql_query($q))>0){
				$results = @mysql_fetch_array(mysql_query($q));
				return $results[$row];
			}else{
				return 0;
			}
        }
		else{
			return 0;
		}
    }
	
	public function rp_getAvgVal($table, $row=null, $where=null,$die=0)
    {
		if($this->tableExists($table) && $row!=null && $where!=null)
       	{
			$q = 'SELECT AVG('.$row.') as '.$row.' FROM '.$table.' WHERE '.$where;
			if($die==1){
				echo $q;die;
			}
			if(mysql_num_rows(mysql_query($q))>0){
				$results = @mysql_fetch_array(mysql_query($q));
				return $results[$row];
			}else{
				return 0;
			}
        }
		else{
			return 0;
		}
    }
	
	
	public function rp_getTotalRecord($table, $where = null,$die=0,$limit=null) // return number of records By Ravi Patel
    {
		$q = 'SELECT * FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
         if($limit != null)
            $q .= ' LIMIT '.$limit;
		if($die==1){
			echo $q;die;
		}
        if($this->tableExists($table))
			return mysql_num_rows(mysql_query($q))+0;
        else
			return 0;
    }
	
	public function rp_insert($table,$values,$rows = 0,$die=0) // rp_insert - Insert and Die Values By Rav-i Pa-tel
    {         
		if($this->tableExists($table))
        {
            $insert = 'INSERT INTO '.$table;
            if(count($rows) > 0)
            {
                $insert .= ' ('.implode(",",$rows).')';
            }
 
            for($i = 0; $i < count($values); $i++)
            {
                if(is_string($values[$i]))
                    $values[$i] = '"'.$values[$i].'"';
            }
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.')';

			if($die==1){
				echo $insert;die;
			}
            $ins = @mysql_query($insert);           
            if($ins)
            {
				$last_id = mysql_insert_id();
                return $last_id;
            }
            else
            {
                return false;
            }
        }
    }
	
	public function rp_delete($table,$where = null,$die=0)
    {
        if($this->tableExists($table))
        {
            if($where != null)
            {
                $delete = 'DELETE FROM '.$table.' WHERE '.$where;
				if($die==1){
					echo $delete;die;
				}
				$del = @mysql_query($delete);
            }
            if($del)
            {
                return true;
            }
            else
            {
               return false;
            }
        }
        else
        {
            return false;
        }
    }
    public function rp_update($table,$rows,$where,$die=0) //update query by Ravi Patel
    {
        if($this->tableExists($table))
        {
            // Parse the where values
            // even values (including 0) contain the where rows
            // odd values contain the clauses for the row
			//print_r($where);die;
            
            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
           	{
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }
                 
                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
            $update .= ' WHERE '.$where;
			if($die==1){
				echo $update;die;
			}
			//$update = trim($update," AND");
            $query = @mysql_query($update);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
	
	public function tableExists($table)
    {
		$tablesInDb = @mysql_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if($tablesInDb)
        {
            if(mysql_num_rows($tablesInDb)==1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
	
	public function rp_limitChar($content,$limit,$url="javascript:void(0);",$txt="&hellip;")
    {
        if(strlen($content)<=$limit){
			return $content;
		}else{
			$ans = substr($content,0,$limit);
			if($url!=""){
				$ans .= "<a href='$url' class='desc'>$txt</a>";
			}else{
				$ans .= "&hellip;";
			}
			return $ans;
		}
    }
	
	public function rp_dupCheck($table, $where = null,$die=0)
    {
        $q = 'SELECT id FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
		if($die==1){
			echo $q;die;
		}
		if($this->tableExists($table))
       	{
			$results = @mysql_num_rows(mysql_query($q));
			if($results>0){
				return true;
			}else{
				return false;
			}
        }
		else
      		return false;
    }
	
	public function rp_location($redirectPageName=null)
    {
		if($redirectPageName==null){
			header("Location:".$this->SITEURL);
			exit;
		}else{
			header("Location:".$redirectPageName);
			exit;
		}
    }
	
	public function rp_getDisplayOrder($table,$where=null,$die=0)
    {
        $q = 'SELECT MAX(display_order) as display_order FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
		if($die==1){
			echo $q;die;
		}
        if($this->tableExists($table))
       	{
			$results = @mysql_query($q);
			if(@mysql_num_rows($results)>0){
				$disp_d = mysql_fetch_array($results);
				return intval($disp_d['display_order'])+1;
			}else{
				return 1;
			}
        }
		else{
      		return 1;
		}
    }
	
	public function rp_createSlug($string)   
	{   
		$slug = strtolower(trim(preg_replace('/-{2,}/','-',preg_replace('/[^a-zA-Z0-9-]/', '-', $string)),"-"));
		return $slug;
	}
	
	public function rp_createProSlug($string)   
	{   
		$slug = strtolower(trim(preg_replace('/-{2,}/','-',preg_replace('/[^a-zA-Z0-9-.]/', '-', $string)),"-"));
		return $slug;
	}
	
	public function getDBName()   
	{   
		$dbData = $this->db_host.",".$this->db_user.",".$this->db_pass.",".$this->db_name;
		return $dbData;
	}
	
	public function setViewCounter($tableName,$counterFieldName,$setCounterOnField,$setCounterOnFieldValue)
	{  
		setcookie($counterFieldName.'_'.$setCounterOnFieldValue,"productViewCookie",time() + 3600);
		$counterUpdateQuery = "UPDATE ".$tableName." SET ".$counterFieldName." = ".$counterFieldName."+1 WHERE ".$setCounterOnField."=".$setCounterOnFieldValue;
		//echo $counterUpdateQuery; exit;
		mysql_query($counterUpdateQuery);
	}
	
	public function rp_num($val,$deci="2",$sep=".",$thousand_sep=""){
		return number_format($val,$deci,$sep,$thousand_sep);
	}
	
	public function catData($cslug=null,$sslug=null,$ssslug=null){
		if($cslug!=null && $sslug==null && $ssslug==null){
			return $this->rp_getData("category","*","slug='".$cslug."' AND isDelete=0");
		}else if($cslug!=null && $sslug!=null && $ssslug==null){
			$cid	= $this->rp_getValue("category","id","slug='".$cslug."'");
			return $this->rp_getData("sub_category","*","cid='".$cid."' AND slug='".$sslug."' AND isDelete=0");
		}else if($cslug!=null && $sslug!=null && $ssslug!=null){
			$cid	= $this->rp_getValue("category","id","slug='".$cslug."'");
			$sid	= $this->rp_getValue("sub_category","id","slug='".$sslug."'");
			return $this->rp_getData("sub_sub_category","*","cid='".$cid."' AND sid='".$sid."' AND slug='".$ssslug."' AND isDelete=0");
		}else{
			return false;
		}
		return number_format($val,$deci,$sep,$thousand_sep);
	}
	
	public function rp_getTotalReview($pid)
    {
		return $this->rp_getTotalRecord("product_review","pid = '".$pid."'");
    }
	
	public function clean($string)
	{
		$string = trim($string);								// Trim empty space before and after
		if(get_magic_quotes_gpc()) {
			$string = stripslashes($string);					        // Stripslashes
		}
		$string = mysql_real_escape_string($string);			        // mysql_real_escape_string
		return $string;
	}
	public function cleanArray($array)
	{
		$result=array();
		foreach($array as $key=>$value)
		{
			$result[$key]=$this->clean($value);
		}
		return $result;
	}
	public function rp_getProductQty($pid)
    {
		$proQty = $this->rp_getValue("product","qty","id='".$pid."'"); 
		return $proQty;
    }
	public function rp_getProductPriceDiv($max_price,$sell_price)
    {
		if($sell_price<$max_price && $sell_price!=$max_price){ 
		?>
			<span class="price"><?php echo CURR; ?><?php echo $sell_price; ?></span>
			<span class="price-before-discount"><?php echo CURR; ?><?php echo $max_price; ?></span>
		<?php
		}else{
		?>
			<span class="price"><?php echo CURR; ?><?php echo $sell_price; ?></span>
			<span class="price-before-discount"></span>
		<?php
		}
    }
	public function rp_getShippingCharge($pincode,$pid,$subpid=0)
    {
		if($subpid>0){
			$tabName= "sub_product";
			$pro_id	= $subpid;
		}else{
			$tabName = "product";
			$pro_id	= $pid;
		}
		$deliveryPin_r = $this->rp_getData("delivery_pincode","*","pincode='".$pincode."' AND isDelivery=1","",0);
		if($deliveryPin_r){
			$deliveryPin_d = mysql_fetch_array($deliveryPin_r);
			$area_type 	= $deliveryPin_d["area_type"];
			$area_type;
			if($area_type==0){
				$shipping_charge = $this->rp_num($this->rp_getValue($tabName,"local_ship_charge","id='".$pro_id."'"));
			}else if($area_type==1){
				$shipping_charge = $this->rp_num($this->rp_getValue($tabName,"zonal_ship_charge","id='".$pro_id."'"));
			}else{
				$shipping_charge = $this->rp_num($this->rp_getValue($tabName,"national_ship_charge","id='".$pro_id."'"));
			}
			return $shipping_charge;
		}else{
			return 0;//$this->rp_num($this->rp_getValue($tabName,"national_ship_charge","id='".$pro_id."'"));
		}
    }
	public function rp_checkDeliveryAndShipping($pincode,$pid)
    {
		if($this->rp_getTotalRecord("delivery_pincode","pincode='".$pincode."'")>0){
			if($this->rp_getTotalRecord("delivery_pincode","pincode='".$pincode."' AND isDelivery=1")>0){
				$shipping_charge = $this->rp_getShippingCharge($pincode,$pid);
				if($shipping_charge==0.00){
					$shipping_charge = "Free";
				}else{
					$shipping_charge = CURR.$shipping_charge;
				}
				$_SESSION['SHOPWALA_SESS_PINCODE'] = $pincode;
				
				?>
				<div class="col-md-5"><strong>Delivery available at pincode:</strong> <?php echo $pincode; ?></div>
				<div class="col-md-5"><strong>Shipping Charges:</strong> <?php echo $shipping_charge; ?></div>
				<?php
			}else{
				?>
				<div class="col-md-12"><strong>Delivery not available at pincode:</strong> <?php echo $pincode; ?></div>
				<?php
			}
		}else{
			?>
			<div class="col-md-12"><strong>Sorry, we couldn't find pincode:</strong><?php echo $pincode; ?></div>
			<?php
		}
    }
	public function printr($val,$isDie=1){
		echo "<pre>";
		print_r($val);
		if($isDie){die;}
	}
	public function SToA($array,$val,$die=0){
		
		if($val!="")
		{
			$array[]=$val;			
		}
		return $array;
		
		if($die)
		exit();
	}
	public function today()
	{
		return date("Y-m-d H:i:s");		
	}
	public function getLimit()
	{
		$ul=$this->getRequestedParam("ul"); //upper_limit
		$ll=$this->getRequestedParam("ll"); //lower_limit
		if($ul!="")
		{			
			return array("ul"=>$ul,"ll"=>$ll);
		}
		else
		{
			return array();
		}
		
	}
	public function generateWhere($where,$append,$die=0){
		if($where!="")
		{
			return $where." AND ".$append;
		}
		else
		{
			return $append;
		}
		if($die)
		exit();
	}
	public function generateLike($query,$append,$separator ,$die=0){
		if($query!="")
		{
			return $query." ".$separator." ".$append;
		}
		else
		{
			return $append;
		}
		if($die)
		exit();
	}public function printJSON($val,$die=0){
		$val["extra"]=array("requested_params"=>$_REQUEST);
		echo json_encode($val);
		if($die)
		exit();
	}
	public function getRequestedParam($val,$die=0){		
		if($val!="")
		{
			return (isset($_REQUEST[$val]) && $_REQUEST[$val]!="")?$_REQUEST[$val]:"";
		}
		else
		{
			return "";
		}
		if($die)
		exit();
	}
	public function checkAPI($api_slug,$die=0)
	{
		$count=$this->rp_getTotalRecord("api_table","api_slug='".$api_slug."' OR id='".$api_slug."'");
		if($count>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}  
	public function checkAPIKey($key,$die=0)
	{
		$count=$this->rp_getTotalRecord("api_key_table","api_key='".$key."'");
		if($count>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}  
	
	public function rp_randomString($len=5){
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$str = "";
		for ($i = 0; $i < $len; $i++) {
			$str .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $str;
	}
	public function rp_get_client_ip(){
	  $ipaddress = '';
	  if (getenv('HTTP_CLIENT_IP'))
		  $ipaddress = getenv('HTTP_CLIENT_IP');
	  else if(getenv('HTTP_X_FORWARDED_FOR'))
		  $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	  else if(getenv('HTTP_X_FORWARDED'))
		  $ipaddress = getenv('HTTP_X_FORWARDED');
	  else if(getenv('HTTP_FORWARDED_FOR'))
		  $ipaddress = getenv('HTTP_FORWARDED_FOR');
	  else if(getenv('HTTP_FORWARDED'))
		  $ipaddress = getenv('HTTP_FORWARDED');
	  else if(getenv('REMOTE_ADDR'))
		  $ipaddress = getenv('REMOTE_ADDR');
	  else
		  $ipaddress = 'UNKNOWN';
	
	  return $ipaddress;
	}
	function getCustomers($debug=0)
	{
		$result=array();
		$rows=$this->rp_getData("customer","*","isDelete='0'","",$debug);
			while($data=mysql_fetch_assoc($rows)){
				$result[]=$data;
			}			
		
		return $result;
	}
	function getPayees($debug=0)
	{
		$result=array();
		$rows=$this->rp_getData("payee","*","isDelete='0'","",$debug);
			while($data=mysql_fetch_assoc($rows)){
				$result[]=$data;
			}			
		
		return $result;
	}
	function getCustomerInfo($cid="",$debug=0)
	{
		$result=array();
		if($cid!="")
		{
			$result=mysql_fetch_assoc($this->rp_getData("customer","*","id='".$cid."' AND isDelete=0","",$debug));			
		}
		return $result;
	}
	function getCustomerBranches($cid="",$debug=0)
	{
	
		$result=array();
		if($cid!="")
		{
			$rows=$this->rp_getData("customer_branch","*","cid='".$cid."' AND isDelete=0","",$debug);
			while($data=mysql_fetch_assoc($rows)){
				$result[]=$data;
			}			
		}

		return $result;
	}
	function getCustomerBranchInfo($cid="",$cbranchid="",$debug=0)
	{
	
		$result=array();
		if($cid!="" && $cbranchid!="")
		{
			$result=mysql_fetch_assoc($this->rp_getData("customer_branch","*","id='".$cbranchid."' AND cid='".$cid."' AND isDelete=0","",0));			
		}
		return $result;
	}
	
	function getProducts($debug=0)
	{
		$result=array();
		$rows=$this->rp_getData("product","*","isDelete=0 AND 1=1","",$debug);
		while($data=mysql_fetch_assoc($rows)){
				$result[]=$data;
		}
		return $result;
	}
	function getProductInfo($pid="",$debug=0)
	{
		
		$result=array();
		if($pid!="")
		{
			$result=mysql_fetch_assoc($this->rp_getData("product","*","id='".$pid."' AND isDelete=0 ","",$debug));			
		}
		
		return $result;
	}
	function getLab($job_id,$debug=0)
	{
		$result=array();
		$rows=$this->rp_getData("lab","*","job_id='".$job_id."' AND isDelete=0","",$debug);
		while($data=mysql_fetch_assoc($rows)){
				$result[]=$data;
		}
		return $result;
	}
	function getTest($pid,$debug=0)
	{
		$result=array();
		$rows=$this->rp_getData("product_map_test","*","product_id='".$pid."'","",$debug);
		while($data=mysql_fetch_assoc($rows)){
				$test_id=$data['test_id'];
				$r=$this->rp_getData("test","*","id='".$test_id."'","",0);
				$test=mysql_fetch_assoc($r);
				$result[]=$test;
		}
		return $result;
	}
	function getJobStatus($jobStatus,$html)
	{
		$status=array("In Progress","Completed");
		$statusHtml=array("<span class='text-warning'><i class='fa fa-clock-o'></i> &nbsp;In Progress</span>","<span class='text-success'><i class='fa fa-check'></i> &nbsp;Completed</span>");
		$jobStatus=intval($jobStatus);
		if(array_key_exists($jobStatus,$status))
		{
			if($html)
			{
				return $statusHtml[$jobStatus];
			}
			else
			{
				return $status[$jobStatus];
			}
			
		}
		else
		{
			return false;
		}
	}
	function getLabStatus($labStatus,$html)
	{
		$status=array("In Progress","Completed");
		$statusHtml=array("<span class='text-warning'><i class='fa fa-clock-o'></i> &nbsp;In Progress</span>","<span class='text-success'><i class='fa fa-check'></i> &nbsp;Completed</span>");
		$labStatus=intval($labStatus);
		if(array_key_exists($labStatus,$status))
		{
			if($html)
			{
				return $statusHtml[$labStatus];
			}
			else
			{
				return $status[$labStatus];
			}
			
		}
		else
		{
			return false;
		}
	}
	function labAssistant($lab_id,$debug)
	{
		$lab_assistant_id=$this->rp_getValue("lab","lab_assistant_id","id='".$lab_id."' AND isDelete=0","",$debug);
		return $lab_assistant_id;	
		
	}
	function labTests($lab_id,$debug)
	{
		$tests=$this->rp_getValue("lab","tests","id='".$lab_id."' AND isDelete=0","",$debug);
		return $tests;	
		
	}
	function changeJobStatus($job_id)
	{
		$allLabStatus=intval($this->rp_getTotalRecord("lab","job_id='".$job_id."' AND status=0",0));
		
		if($allLabStatus==0)
		{
			
			$jobStatus=0;
			$rows=array(
				"status"=>1
			);
			if($job_id=$this->rp_update("job",$rows,"id='".$job_id."'",0))
			{
				$jobStatus=1;
			}
		}
		else
		{
			
			$rows=array(
				"status"=>0
			);
			if($job_id=$this->rp_update("job",$rows,"id='".$job_id."'",0))
			{
				$jobStatus=0;
			}
		}
		return $jobStatus;
	}
	function getAdmin($type,$debug)
	{
		$result=array();
		if($type!="")
		{
			$rows=$this->rp_getData("stern","*","type='".$type."' AND isDelete=0","",$debug);
			while($data=mysql_fetch_assoc($rows)){
				$result[]=$data;
			}
		}
		return $result;
	}
	public function aj_updateUserPassword($id,$newPassword,$password)
	{
		
			$rows=array("password"=>$newPassword);
			$where=" id='".$id."'";		
			return $this->rp_update("sales_executive",$rows,$where,0);
		
		
	}
	// Send Notification by GCM to Android
	public function send_notification( $data, $ids )
	{
		$apiKey = 'AIzaSyB_1pu5RG6g1hRxdfGbupUyEmmXjYxEFjQ'; // This is Server Legacy Key From Cloud Messaging Firebase
		$url = 'https://android.googleapis.com/gcm/send';
		$post = array(
						'registration_ids'  => $ids,
						'data'              => $data,
						);
	
		$headers = array( 
							'Authorization: key=' . $apiKey,
							'Content-Type: application/json'
						);
	
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//////// SSL Verifier False ////////
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );
		$result = curl_exec( $ch );
		curl_close( $ch );
		return $result;
	}
	function addCustomerBranch($uid="",$name="",$debug=0)
	{
		if($name!="" && $uid!="")
		{
			$adate	= date('Y-m-d H:i:s');
			$rows=array("aid","name","adate","isDelete");
			$values=array($uid,$name,$adate,0);
			$cbid=$this->rp_insert("attribute_val",$values,$rows,$debug);
			if($cbid!=0)
			{
				return $response=array('ack'=>1,'ack_msg'=>'Branch added Successfully !!!');
				
			}
			else
			{
				return $response=array('ack'=>0,'ack_msg'=>'Branch name can not be empty !!!');			
			}
		}
		else
		{
			return $response=array('ack'=>0,'ack_msg'=>'Branch name can not be empty !!!');	
		}
			
	}
}
include("admin.class.php");
?>