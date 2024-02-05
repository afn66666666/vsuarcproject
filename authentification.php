<?php

require 'designFile.php';

 session_start();

$inputLogin = $_POST['username'];
$inputPassword = $_POST['password'];

if($inputLogin == $login && $inputPassword == $password){
	unset($_session['inputerror']);
	header('Location:cardMenu.html');
	die();
}
else{
	$_SESSION['inputError'] = 'Неправильный логин/пароль.';
	 header('Location: authentificationForm.php');
	 exit();
}


?>