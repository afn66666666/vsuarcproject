<?php
if(true){
	echo "start <br>";
	echo "Список имеющихся карточек";
	$conn = pg_connect("host=pg3.sweb.ru port=5432 dbname=avkuzbkru user=avkuzbkru password=Klizma000");
	if (!$conn) {
		echo "connection error occurred.\n";
		exit;
	}

	else{
		echo "load success <br>";
		$statementIndices = "SELECT \"Номер карточки\" FROM card_legacy;";
		$resIndices = pg_query($conn, $statementIndices);
	if (!$resIndices) {
		echo "query error occurred.\n";
		exit;
	}
		while ($index = pg_fetch_row($resIndices)) {
  			echo $index[0];
  			echo "<br />\n";
		}
		echo "<p>Предыдущая карточка Следующая карточка</p>";
		//print_r($resIndices);
		pg_close($conn);
	}
}
?>
