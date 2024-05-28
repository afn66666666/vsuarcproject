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
if($pdo == null){
die("Connection failed: ");
}
	$stmt = $pdo->query('SELECT * FROM users');

	if($stmt->rowCount() != 1) return;


	$row = $stmt->fetch();
	if($row['login'] == $login && $row['password'] == $password){


$response = [

        'name' => $row['name'],
        'surname' => $row['surname'],
	'login'=> $row['login'],
	'organization'=> $row['organization'],
	'role'=>$row['role'],
//	'id'=> $row['id']
    ];

header('Content-Type: application/json');
echo json_encode($response);
}
} catch (PDOException $e) {
    echo $e->getMessage();
}

   
}
?>