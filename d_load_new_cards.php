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
$stmt = $pdo->query('SELECT * FROM card LIMIT 30 OFFSET 0');

$cards = [];

for ($i = 0; $i < $stmt->rowCount(); $i++) {
$row = $stmt->fetch();
$filePath = $row['media'];

$fullPath = realpath(__DIR__ . '/media/' . $filePath);

$mediaData = file_get_contents($fullPath);
$mediaBase64 = base64_encode($mediaData);

$users[] = (object) array(
            'id' => $row['id'],
	'name' => $row['name'],
	'card_date' => $row['card_date'],
	'card_author' => $row['author'],
	'information_year' => $row['info_year'],
	'information_source' => $row['info_source'],
	'information_receive_type' => $row['receive_type'],
	'information_act_number' => $row['info_act_number'],
	'excavation_date' => $row['excavation_date'],
	'description' => $row['description'],
	'count' => $row['count'],
	'material' => $row['material'],			 		 
       	'size' => $row['size'],
	'preservation' => $row['preservation'],
	'registration_number' => $row['registration_number'],
	'storage_place' => $row['storage_place'],
	'inventory_number' => $row['inventory_number'],
	'media' => $mediaBase64,
	'geodata' => $row['geodata'],
        );
	}

header('Content-Type: application/json');
echo json_encode($users);




}catch (PDOException $e) {
    echo $e->getMessage();
}
	
}
?>