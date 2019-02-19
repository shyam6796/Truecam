<?php
include("connect.php");

if(isset($_REQUEST['submit']))
{

	require('../include/class.user.php');

	//var_dump($_FILES['file']);
	$user=new User();
	//$detail=array("department_id" => 2,"name"=>"baaad","email"=>"ajk@gmail.com","mobile"=>8866345343,"birth_date" =>2011-02-03,"blood_group" => "bsadasd","address" => "asdadadsdsadddsa");
	
	if(isset($_FILES['file']))
	{
		
		$reply=$user->searchImage($_FILES);
		print_r($reply); 
	}
	else
	{
		echo "Error";
	}
	
}
?>
<html>
<head>
<title>Image Upload</title>
</head>
<body>
<h1>Image Upload</h1>
<form method="post" role="form" action="service_user.php?key=1226&s=40" enctype='multipart/form-data' >
Image : <input type="file" name="file"/>
<br><br>
<input type="submit" name="submit" value="submit" />
</form>
</body>
<script type="text/javascript">

</script>
</html>