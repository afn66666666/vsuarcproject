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

$stmt = $pdo->query('SELECT id, description FROM card');
for ($i = 0; $i < $stmt->rowCount(); $i++) {
$row = $stmt->fetch();

$words = explode(' ', $row['description'], 3);
$name =  $words[0]." ".$words[1]." \n";
echo $name;

$sql = "UPDATE card SET name = :name WHERE id = :id";
 $newstmt = $pdo->prepare($sql);
$newstmt->bindParam(':id', $row['id']);
$newstmt->bindParam(':name', $name);
 $newstmt->execute();
}

}catch (PDOException $e) {
    echo $e->getMessage();
}
	
}
?>