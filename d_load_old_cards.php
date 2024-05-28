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
$stmt = $pdo->query('SELECT * FROM card fetch first 10 rows only');

$cards = [];

for ($i = 0; $i < $stmt->rowCount(); $i++) {
$row = $stmt->fetch();
		$users[] = (object) array(
            'id' => $row['id'],
	'card_date' => $row['object_card_date'],
	'card_author' => $row['object_card_author'],
	'information_year' => $row['object_information_year'],
	'information_source' => $row['object_information_source'],
	'information_receive_type' => $row['object_information_receive_type'],
	'information_act_number' => $row['object_information_act_number'],
	'excavation_date' => $row['object_excavation_date'],
	'description' => $row['object_description'],
	'count' => $row['object_count'],
	'material' => $row['object_material'],			 		 
       	'size' => $row['object_size'],
	'preservation' => $row['object_preservation'],
	'egistration_number	' => $row['object_registration_number	'],
	'storage_place' => $row['object_storage_place'],
	'inventory_number' => $row['object_inventory_number'],
	'media' => $row['object_media'],
	'geodata' => $row['object_geodata'],
        );
	}

header('Content-Type: application/json');
echo json_encode($users);

}catch (PDOException $e) {
    echo $e->getMessage();
}
	
}
?>