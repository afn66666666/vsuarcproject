<?php

require 'd_connection.php';



// Проверяем, был ли отправлен POST-запрос
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Получаем данные из тела запроса
    $login = $_GET['login'];
    $password = $_GET['password'];

	$connection = Connection::get();
try {
     $pdo = $connection->connect();
	$stmt = $pdo->query('SELECT * FROM users');

if($stmt->rowCount() != 1) return;


$row = $stmt->fetch();
if($row['login'] == $login && $row['password'] == $password){
echo nice."\n"."dfd";
}
} catch (PDOException $e) {
    echo $e->getMessage();
}

   
}
?>