<?php include "cardMenu.html"; ?>

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

$cardFormEdit = $_POST['formEditAction'];

if(true){
	echo "start <br>";
	$conn = pg_connect("host=pg3.sweb.ru port=5432 dbname=avkuzbkru user=avkuzbkru password=Klizma000");
	if (!$conn) {
		echo "connection error occurred.\n";
		exit;
	}
	if ($cardFormEdit == 0)
	{
	$statement = "INSERT INTO card_legacy VALUES (DEFAULT, '".$objectName."','".$objectCommonName."','".$objectPlace."','".$objectCreationTime."','".$objectShortStory."','".$objectFeatures."','".$objectAuthorsData."','".$objectInformationSource."','".$objectImageData."','".$objectCardDate."');";
	echo $statement."<br>";
	}
	else {
	$statement = "UPDATE card_legacy SET (\"Наименование объекта\",\"Обиходные названия*\",\"Место размещения объекта\",\"Время возникновения, открытия объ\",\"Краткая история объекта\",\"Внешние признаки (особенности сти\",\"Данные об авторах объекта\",\"Источники сведений об объекте\",\"Фотографии или видеоматериалы\",\"Дата составления карточки\") = ('".$objectName."','".$objectCommonName."','".$objectPlace."','".$objectCreationTime."','".$objectShortStory."','".$objectFeatures."','".$objectAuthorsData."','".$objectInformationSource."','".$objectImageData."','".$objectCardDate."') WHERE \"Номер карточки\"=".$cardFormEdit.";";	
	}
	$result = pg_query($conn, $statement);
	if (!$result) {
		echo "query error occurred.\n";
		exit;
	}
	else{
		echo "write success <br>";
		pg_close($conn);
		//if (@$_SERVER['HTTP_REFERER'] != null) {
        	//    	header("Location: ".$_SERVER['HTTP_REFERER']);
        	//}
        	//else{
        	//Sys::GoHome();
        	//}
	}
}
?>
