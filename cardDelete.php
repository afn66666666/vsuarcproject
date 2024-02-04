<nav id="cardMenu">
<?php include "cardMenu.html"; ?>
</nav>
<?php
$objectId = $_GET['objectId'];
if(true){
	echo "start <br>";
	echo $objectId;
	$conn = pg_connect("host=pg3.sweb.ru port=5432 dbname=avkuzbkru user=avkuzbkru password=Klizma000");
	if (!$conn) {
		echo "connection error occurred.\n";
		exit;
	}
	$statement = "DELETE FROM card_legacy WHERE \"Номер карточки\"=".$objectId.";";
	$result = pg_query($conn, $statement);
	if (!$result) {
		echo "query error occurred.\n";
		exit;
	}
	else{
		echo "delete success <br>";
	}
	}
?>
