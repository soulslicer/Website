<?php
include_once('class.vCard.inc.php');

include '../DB.php';
error_reporting(E_ERROR | E_PARSE);

header('Access-Control-Allow-Origin: *');

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

$vCard = (object) new vCard('','');

$name=$userData->name;
$title=$userData->title;
$location=$userData->location;
$objective=$userData->objective;
$email=$userData->email;
$linkedin=$userData->linkedin;
$phone=$userData->phone;
$cood=$userData->cood;
$arr=explode(", ", $location);

$vCard->setFirstName($name);
$vCard->setJobTitle($title);
$vCard->setEMail($email);
$vCard->setURLWork($linkedin);
$vCard->setPreferredTelephone($phone);

$vCard->setHomeCity($arr[0]);
$vCard->setHomeRegion($arr[1]);
$vCard->setHomeCountry('USA');

// $vCard->setPostalCity('Testcity');
// $vCard->setPostalRegion('PA');
// $vCard->setPostalCountry('USA');

// $vCard->setFirstName('Max');
// $vCard->setMiddleName('Mobil');
// $vCard->setLastName('Mustermann');
// $vCard->setEducationTitle('Doctor');
// $vCard->setAddon('sen.');
// $vCard->setNickname('Maxi');
// $vCard->setCompany('Microsoft');
// $vCard->setOrganisation('Linux');
// $vCard->setDepartment('Product Placement');
// $vCard->setJobTitle('CEO');
// $vCard->setNote('Additional Note go here');
// $vCard->setTelephoneWork1('+43 (05555) 000000');
// $vCard->setTelephoneWork2('+43 (05555) 000000');
// $vCard->setTelephoneHome1('+43 (05555) 000000');
// $vCard->setTelephoneHome2('+43 (05555) 000000');
// $vCard->setCellphone('+43 (05555) 000000');
// $vCard->setCarphone('+43 (05555) 000000');
// $vCard->setPager('+43 (05555) 000000');
// $vCard->setAdditionalTelephone('+43 (05555) 000000');
// $vCard->setFaxWork('+43 (05555) 000000');
// $vCard->setFaxHome('+43 (05555) 000000');
// $vCard->setISDN('+43 (05555) 000000');
// $vCard->setPreferredTelephone('+43 (05555) 000000');
// $vCard->setTelex('+43 (05555) 000000');
// $vCard->setWorkStreet('123 Examplestreet');
// $vCard->setWorkZIP('11111');
// $vCard->setWorkCity('Testcity');
// $vCard->setWorkRegion('PA');
// $vCard->setWorkCountry('USA');
// $vCard->setHomeStreet('123 Examplestreet');
// $vCard->setHomeZIP('11111');
// $vCard->setHomeCity('Testcity');
// $vCard->setHomeRegion('PA');
// $vCard->setHomeCountry('USA');
// $vCard->setPostalStreet('123 Examplestreet');
// $vCard->setPostalZIP('11111');
// $vCard->setPostalCity('Testcity');
// $vCard->setPostalRegion('PA');
// $vCard->setPostalCountry('USA');
// $vCard->setURLWork('http://flaimo.com');
// $vCard->setRole('Student');
// $vCard->setBirthday(time());
// $vCard->setEMail('flaimo@gmx.net');

header("Content-type: text/x-vcard; charset=utf-8"); 
header("Content-Disposition: attachment; filename=\"iphonecontact.vcf\";");

//header('Content-Type: text/x-vcard');
//header('Content-Disposition: inline; filename=vCard_' .$name. '.vcf');
echo $vCard->getCardOutput();
//echo $name;
// $vCard->writeCardFile();
// header('Location:' . $vCard->getCardFilePath());
exit;

?>
