<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/layout.css" type="text/css">
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <title>Document</title>
</head>

<body>

    <?php
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confPassword = $_POST['confPassword'];
    $email = $_POST['email'];

    if ($password != $confPassword) {
        ?>
        <p>Парли не совпадают</p>
    <?php }
    ?>


    <form action="./register.php" id="myForm" method="post">
        <label for="login">Логин: </label>
        <input type="text" id="login" name="login" />

        <label for="password">Пароль: </label>
        <input type="password" id="password" name="password" />

        <label for="confPassword">Подтверждение: </label>
        <input type="password" id="confPassword" name="confPassword" />

        <label for="email">Email: </label>
        <input type="email" id="email" name="email" />

        <input type="file" name="file" />
        <button type="submit">Зарегистрироваться</button>
        <p>Если у тебя есть учетка, то <a href="./index.php">Авторизуйся</a></p>
    </form>


</body>

</html>