<?php

require 'd_connection.php';

// Проверяем, был ли отправлен POST-запрос
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Получаем данные из тела запроса
    $id= $_GET['id'];
	$connection = Connection::get();
try {
     $pdo = $connection->connect();
if($pdo == null){
die("Connection failed: ");
}
	$stmt = $pdo->query("SELECT * FROM excavations");

for ($i = 0; $i < $stmt->rowCount(); $i++) {
$row = $stmt->fetch();
$users[] = (object) array('id'=>$row['id'],
	'geodata' => $row['data']);
}

header('Content-Type: application/json');
echo json_encode($users);

}
catch (PDOException $e) {
    echo $e->getMessage();
}
}
?>