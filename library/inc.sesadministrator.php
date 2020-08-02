<?php
if($_SESSION['SES_LEVEL_CCR'] != 'Administrator') 
	{
	include_once "license.php";
	exit;
	}  
	
?>