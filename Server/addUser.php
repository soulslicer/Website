<?php

header('Access-Control-Allow-Origin: *');

include 'DB.php';

if(isset($_POST[POSTVAR_USER]) && isset($_POST[POSTVAR_PASS]) && isset($_POST[POSTVAR_NAME])){
   	$user=$_POST[POSTVAR_USER];
	$pass=$_POST[POSTVAR_PASS];
	$name=$_POST[POSTVAR_NAME];
}else exit;

$CONNECTION=getSQLConnection();
if(!$CONNECTION){
	endSQLConnection($CONNECTION);
	echo "(DBERROR) Database error";
}

$sql="INSERT INTO resonate.users (username,password) VALUES ("."\"".$user."\", "."\"".$pass."\"".")";
$result = mysqli_query($CONNECTION,$sql)  or die ("(INSERT DBERROR)");

$userid=mysqli_insert_id($CONNECTION);

$sql="INSERT INTO resonate.userbio (user_id,name) VALUES (".$userid.", "."\"".$name."\")";
//echo $sql;
$result = mysqli_query($CONNECTION,$sql)  or die ("(INSERT DBERROR)");

endSQLConnection($CONNECTION);

?>