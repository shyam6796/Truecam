<?php
//error_reporting(0);
session_start();
date_default_timezone_set('Asia/Kolkata');
include("../include/define.php");
include("../include/function.class.php");
include("../include/class.system.php");
$db = new Admin();
$conn = $db->connect();
$system=new System();
include("../include/security.php");
?>