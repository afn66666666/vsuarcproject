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
	$stmt = $pdo->query("SELECT * FROM role WHERE id = '".$id."'");
$row = $stmt->fetch();
echo $row['description'];

}
catch (PDOException $e) {
    echo $e->getMessage();
}
}
?>