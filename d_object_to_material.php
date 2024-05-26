<?php

require 'd_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$params = _GET['params'];

	$connection = Connection::get();
	 $pdo = $connection->connect();
	if($pdo == null){
	die("Connection failed: ");
	}
try {
$mainStatement = $pdo->query('SELECT id, material FROM card');
$rows = $mainStatement ->rowCount();
for($i = 0; $i < $rows;++$i){
$row = $mainStatement ->fetch();
echo "Итерация ".$i."\n";
$id = $row['id'];
$materialId = $row['material'];
echo "id".$id."\n";
echo "materialId".$materialId."\n";

$insertStatement = "INSERT INTO object_to_material (card_id, material_id) VALUES ('".$id."', '".$materialId."');";
echo $insertStatement;
$stmt = $pdo->query($insertStatement);

}
}catch (PDOException $e) {
    echo $e->getMessage();
}
}