<?php

header('Access-Control-Allow-Origin: *');

include 'DB.php';

$JSONARRAY=array();

if(isset($_POST[POSTVAR_USER]) && isset($_POST[POSTVAR_PASS])){
   	$user=$_POST[POSTVAR_USER];
	$pass=$_POST[POSTVAR_PASS];
}else exit;

$CONNECTION=getSQLConnection();
if(!$CONNECTION){
	endSQLConnection($CONNECTION);
	echo "(DBERROR) Database error";
}

$sql="SELECT * from resonate.users where username=\"".$user."\""." and password=\"".$pass."\"";
$result = mysqli_query($CONNECTION,$sql)  or die ("(INSERT DBERROR)");
$valid=0;
while($row = mysqli_fetch_array($result)){
	$valid=$row["idusers"];
}

array_push($JSONARRAY, $valid);

echo json_encode($JSONARRAY);

?>