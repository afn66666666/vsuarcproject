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
$mainStatement = $pdo->query('SELECT * FROM card_legacy2 LIMIT 90 OFFSET 60');
$rows = $mainStatement ->rowCount();
echo $rows;
for($i = 0; $i < $rows;++$i){
$row = $mainStatement ->fetch();
echo "Итерация ".$row['object_id']."\n";
$author = $row['object_card_author'];
$info_source = $row['object_information_source'];
$receiveType = $row['object_information_receive_type'];
$info_act_number = $row['object_information_act_number'];
$description = $row['object_description'];
$size = $row['object_size'];
$preservation = $row['object_preservation'];
$registration_number = $row['object_registration_number'];
$inventory_number = $row['object_inventory_number'];
$note = $row['object_note'];
$media = $row['object_media'];
$geodata = $row['object_geodata'];
$count = intVal($row['object_count']);

$dateTime = date_create($row['object_card_date']);
$formattedCardDate = $dateTime->format('Y-m-d');

$infoYearSubstr = substr($row['object_information_year'],0,4);
$infoYear = intVal($infoYearSubstr);

$excavationDateStr = $row['object_excavation_date'];
$excavationDate = date_create_from_format('d.m.Y', $excavationDateStr);
$excavationFormattedDate = $excavationDate->format('Y-m-d');

$material = $row['object_material'];
$material = mb_strtolower($material);
$tag = '';
if(strpos($material, 'глина') !== false)
{
	$tag = 'Глина';
}
elseif(strpos($material, 'бронза') !== false)
{
	$tag = 'Бронза';
}
elseif(strpos($material, 'кость') !== false)
{
	$tag = 'Кость';
}
elseif(strpos($material, 'дерево') !== false)
{
	$tag = 'Дерево';
}
elseif(strpos($material, 'камень') !== false)
{
	$tag = 'Камень';
}
elseif(strpos($material, 'лен') !== false)
{
	$tag = 'Лен';
}
elseif(strpos($material, 'кремень') !== false)
{
	$tag = 'Кремень';
}

$findQuery = "SELECT * FROM material WHERE name = :name";
$stmt = $pdo->prepare($findQuery);
$stmt->bindParam(':name', $tag);
$stmt->execute();
$materialRow = $stmt->fetch();
$tag = $materialRow['id'];
echo "Материал ".$tag."\n";

$organizationName = $row['object_storage_place'];
$findQuery = "SELECT * FROM organization WHERE name = :name";
$stmt = $pdo->prepare($findQuery);
$stmt->bindParam(':name', $organizationName);
$stmt->execute();
$orgRow = $stmt->fetch();
$organizationId = $orgRow ['id'];
echo "Организация ".$organizationId."\n";

echo $infoYear;
$insertQuery = "INSERT INTO card (card_date,author,info_year, info_source,receive_type,info_act_number,excavation_date,description,count,material,size,preservation,registration_number,storage_place,inventory_number,note,media,geodata) VALUES (:formattedCardDate,:author,:infoYear,:infoSource,:receiveType,:infoActNumber,:excavationDate,:description,:count,:materialId,:size,:preservation,:registrationNumber,:storageId,:inventoryNumber,:note,:media,:geodata)";
$stmt = $pdo->prepare($insertQuery);
$stmt->bindParam(':formattedCardDate',$formattedCardDate);
$stmt->bindParam(':author',$author);
$stmt->bindParam(':infoYear', $infoYear);
$stmt->bindParam(':infoSource', $info_source);
$stmt->bindParam(':receiveType', $receiveType);
$stmt->bindParam(':infoActNumber', $info_act_number);
$stmt->bindParam(':excavationDate', $excavationFormattedDate);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':count',$count);
$stmt->bindParam(':materialId', $tag);
$stmt->bindParam(':size', $size);
$stmt->bindParam(':preservation', $preservation);
$stmt->bindParam(':registrationNumber', $registration_number);
$stmt->bindParam(':storageId', $organizationId);
$stmt->bindParam(':inventoryNumber', $inventory_number);
$stmt->bindParam(':note', $note);
$stmt->bindParam(':media', $media);
$stmt->bindParam(':geodata', $geodata);

$stmt->execute();


}


}catch (PDOException $e) {
    echo $e->getMessage();
}
	
}
?>