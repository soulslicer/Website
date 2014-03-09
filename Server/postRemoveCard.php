<?php

header('Access-Control-Allow-Origin: *');

include 'DB.php';

if(isset($_POST[POSTVAR_HEADER]) && isset($_POST[POSTVAR_USERID])){
	$userid=$_POST[POSTVAR_USERID];
   	$header=$_POST[POSTVAR_HEADER];
}
else exit;

$CONNECTION=getSQLConnection();
if(!$CONNECTION){
	endSQLConnection($CONNECTION);
	echo "(DBERROR) Database error";
}

$sql="DELETE FROM resonate.cards where header="."\"".$header."\""." and user_id=".$userid;
mysqli_query($CONNECTION,$sql)  or die ("(DELETE ".$header." ERROR)");
