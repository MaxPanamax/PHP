<?php
$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];

// Проверка, существует ли пользователь с таким логином
$users = file("users.txt", FILE_IGNORE_NEW_LINES);
foreach ($users as $user) {
    $userData = explode(":", $user);
    if ($userData[0] == $login) {
        echo "Пользователь с таким логином уже существует.";
        exit;
    }
}

// Запись информации о новом пользователе в файл
$userData = $login.":".$password.":".$email;
file_put_contents("users.txt", $userData.PHP_EOL, FILE_APPEND);

echo "Пользователь успешно добавлен.";
?>