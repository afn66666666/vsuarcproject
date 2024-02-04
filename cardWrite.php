<?php

$objectName = $_POST['objectName'];
$objectCommonName = $_POST['objectCommonName'];
$objectPlace = $_POST['objectPlace'];
$objectCreationTime = $_POST['objectCreationTime'];
$objectShortStory = $_POST['objectShortStory'];
$objectFeatures = $_POST['objectFeatures'];
$objectAuthorsData = $_POST['objectAuthorsData'];
$objectInformationSource = $_POST['objectInformationSource'];
//$objectMedia = $_POST['objectMedia'];
$objectCardDate = $_POST['objectCardDate'];

$objectImageFile = $_FILES['objectMedia']['tmp_name'];
$objectImageData = base64_encode(file_get_contents($objectImageFile));

if(true){
	echo "start <br>";
	$conn = pg_connect("host=pg3.sweb.ru port=5432 dbname=avkuzbkru user=avkuzbkru password=Klizma000");
	if (!$conn) {
		echo "connection error occurred.\n";
		exit;
	}
	$statement = "INSERT INTO card_legacy VALUES (DEFAULT, '".$objectName."','".$objectCommonName."','".$objectPlace."','".$objectCreationTime."','".$objectShortStory."','".$objectFeatures."','".$objectAuthorsData."','".$objectInformationSource."','".$objectImageData."','".$objectCardDate."');";
	echo $statement."<br>";
	$result = pg_query($conn, $statement);
	if (!$result) {
		echo "query error occurred.\n";
		exit;
	}
	else{
		echo "write success <br>";
		pg_close($conn);
	}
}
?>