<?php

header('Access-Control-Allow-Origin: *');

class header
{
	public $userid;
	public $header;
	public $bullets=array();
}

class bullet
{
	public $bullet;
	public $date;
	public $image;
}

include 'DB.php';

if(isset($_POST[POSTVAR_CARD]) && isset($_POST[POSTVAR_USERID])){
   	$cards=$_POST[POSTVAR_CARD];
   	$cards = preg_replace('/[^\x20-\x7E]/','', $cards);
   	$userid=$_POST[POSTVAR_USERID];
}else exit;

$card=json_decode($cards);

$CONNECTION=getSQLConnection();
if(!$CONNECTION){
	endSQLConnection($CONNECTION);
	echo "(DBERROR) Database error";
}

// $sql="DELETE FROM resonate.cards where user_id=".$userid;
// mysqli_query($CONNECTION,$sql)  or die ("(DELETE ".$userid." ERROR)");

$headerstr=$card->header;
$headerstr="\"".$headerstr."\"";
foreach($card->bullets as $bullet){

	if(is_null($bullet->bullet)) $bulletname="NULL"; else $bulletname="\"".$bullet->bullet."\"";
	if(is_null($bullet->date)) $date="NULL"; else $date="\"".$bullet->date."\"";
	if(is_null($bullet->image)) $image="NULL"; else $image="\"".$bullet->image."\"";
	if(is_null($bullet->link)) $link="NULL"; else $link="\"".$bullet->link."\"";

	$sql="INSERT INTO resonate.cards (user_id, bullet, date, image, header, link) VALUES (".$userid.", ".$bulletname.", ".$date.", ".$image.", ".$headerstr.", ".$link.")";
	mysqli_query($CONNECTION,$sql)  or die ("(SET ".$bulletname." ERROR)");
}



?>