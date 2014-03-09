<?php

header('Access-Control-Allow-Origin: *');

include 'DB.php';

class userData
{
	public $userid;
	public $name;
	public $title;
	public $location;
	public $objective;
	public $email;
	public $linkedin;
	public $cood;
	public $phone;
}

if(isset($_GET[GETVAR_USERID])) 
   	$userid=$_GET[GETVAR_USERID];
else exit;

// echo "aa";

$CONNECTION=getSQLConnection();
if(!$CONNECTION){
	endSQLConnection($CONNECTION);
	echo "(DBERROR) Database error";
}

$sql="SELECT * FROM userbio where user_id=".$userid;
$result = mysqli_query($CONNECTION,$sql)  or die ("(DBERROR)");
while($row = mysqli_fetch_array($result)){
	$userData=new userData();
	$userData->userid=$row["user_id"];
	$userData->name=$row["name"];
	$userData->title=$row["title"];
	$userData->location=$row["location"];
	$userData->objective=$row["objective"];
	$userData->email=$row["email"];
	$userData->linkedin=$row["linkedin"];
	$userData->cood=$row["cood"];
	$userData->phone=$row["phone"];
}

echo json_encode($userData);

?>