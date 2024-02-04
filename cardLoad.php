<nav id="cardMenu">
<?php include "cardMenu.html"; ?>
</nav>
<?php
$objectId = $_POST['objectId'];
echo $objectId;
if(true){
	echo "start <br>";
	$conn = pg_connect("host=pg3.sweb.ru port=5432 dbname=avkuzbkru user=avkuzbkru password=Klizma000");
	if (!$conn) {
		echo "connection error occurred.\n";
		exit;
	}
	$statement = "SELECT * FROM card_legacy WHERE \"Номер карточки\"=".$objectId.";";
	$result = pg_query($conn, $statement);
	if (!$result) {
		echo "query error occurred.\n";
		exit;
	}
	else{
		echo "load success <br>";

		$resRow = pg_fetch_row($result); 
		$out = "<style>
		table, th, td {
		  border:1px solid black;
		}</style>
		<h2>Карточка №".$objectId."</h2>
		<table style=\"width:100%\">
		<tr><td>Наименование объекта</td>
		<td>".$resRow[1]."</td></tr>
		<tr><td>Обиходные названия*</td>
		<td>".$resRow[2]."</td></tr>
		<tr><td>Место размещения объекта</td>	
		<td>".$resRow[3]."</td></tr>
		<tr><td>Время возникновения, открытия объекта</td>
		<td>".$resRow[4]."</td></tr>
		<tr><td>Краткая история объекта</td>
		<td>".$resRow[5]."</td></tr>
		<tr><td>Внешние признаки (особенности стиля, общая характеристика, сохранность)
		<td>".$resRow[6]."</td></tr>
		<tr><td>Данные об авторах объекта</td>
		<td>".$resRow[7]."</td></tr>
		<tr><td>Источники сведений об объекте</td>		
		<td>".$resRow[8]."</td></tr>
		<tr><td>Фотографии или видеоматериалы</td>
		<td><img src=\"data:image/png;base64,".$resRow[9]."\"/></td></tr>
		<tr><td>Дата составления карточки</td>
		<td>".$resRow[10]."</td></tr>
		</table>
		<p>* данная строка используется при необходимости</p>";
		echo $out;
		
		pg_close($conn);
	}
}
?>