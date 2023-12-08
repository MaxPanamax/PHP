<?php
require "../connect.php";
$login = mb_strtoupper(trim(htmlspecialchars($_POST["login"], ENT_QUOTES, 'UTF-8')));
$password = $_POST["password"];

$main="SELECT login FROM users WHERE UPPER(login)='$login'";
$row=$pdo->query($main);
$user=$row->fetch(PDO::FETCH_ASSOC);
if (!empty($user["login"])){
	echo "<h1>Такой логин уже существует</h1>";
}
else{
	$sql = "INSERT INTO users (login, password) VALUES (?,?)";
	$query=$pdo->prepare($sql);
	$query->execute([$login, $password]);
	echo "<h1>Вы зарегистрировались</h1>";
}
?>