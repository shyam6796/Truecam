<?php 
$page_id="507";
// Connect to Database
include('connect_api.php');
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
		// INCLUDE CLASS
		include('../include/class.User.php');
$user_obj=new User();

		
		
			if($service=="user_view_datatable_function" || $service==25)
			{
				// storing  request (ie, get/post) global array to a variable
				$requestData= $_REQUEST;
				$totalData = $user_obj->countUser("1","1");
				$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

				// Response Column Name Specify
				$columns = array(
				// datatable column index  => database column name
					0=>"id",1=>"name",2=>"email",3=>"phone",
				);
				// getting total number records without any search
				if( !empty($requestData['search']['value']) ) {
					"id LIKE %".$requestData['search']['value']."%  OR name LIKE %".$requestData['search']['value']."%  OR email LIKE %".$requestData['search']['value']."% ";
				}
				$totalFiltered = $user_obj->countUser("isDelete","0");
				// when there is a search parameter then we have to modify total number filtered rows as per search result.


				$order_by=$columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
				$limit=$requestData['start']." ,".$requestData['length']."   ";
				/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
				$projection=$columns;
				$data_row=$user_obj->view($condition,$projection,$order_by,$limit);
				$json_data = array(
							"draw"            => intval( $requestData['draw'] ),
							// for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
							"recordsTotal"    => intval( $totalData ),  // total number of records
							"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
							"data"            => $data_row['result']   // total data array
							);

				echo json_encode($json_data);
			}
			
		

	}
	else
	{
		$ack=array( "ack"=>1,
				"ack_msg"=>"Internal error!!",
				"developer_msg"=>"Service Parameter missing or not registered!!",				
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