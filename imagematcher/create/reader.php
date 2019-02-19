<?php 
require("../include/function.class.php");
require("class.User.php");
$user=new User();
$insert=$user->insert(array("name"=>"Jay","phone"=>997));
$view=$user->view("isDelete=0");
print_r($insert);
print_r($view);
?>