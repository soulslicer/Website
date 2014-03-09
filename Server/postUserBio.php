<?php

header('Access-Control-Allow-Origin: *');

header('Content-Type: text/html; charset=UTF-8');

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


if(isset($_POST[POSTVAR_BIOJSON]) && isset($_POST[POSTVAR_USERID])){
   	$biojson=$_POST[POSTVAR_BIOJSON];
   	$biojson = preg_replace('/[^\x20-\x7E]/','', $biojson);
   	$userid=$_POST[POSTVAR_USERID];
}else exit;

$biojson=json_decode($biojson);

//var_dump($biojson);

$CONNECTION=getSQLConnection();
if(!$CONNECTION){
	endSQLConnection($CONNECTION);
	echo "(DBERROR) Database error";
}

$sql="SELECT * FROM userbio where user_id=".$userid;
$result = mysqli_query($CONNECTION,$sql)  or die ("(DBERROR)");
$dataExists=false;
while($row = mysqli_fetch_array($result)){
	if($row["user_id"]) $dataExists=true;
}

if(!$dataExists) exit;

foreach ($biojson as $key => $value) {
	if($key=="userid") continue;
	$sql="UPDATE resonate.userbio set ".$key."=\"".$value."\" where user_id=".$userid;
	mysqli_query($CONNECTION,$sql)  or die ("(SET ".$key." ERROR)");
}

endSQLConnection($CONNECTION);

?>