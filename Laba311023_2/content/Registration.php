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
    <div class="authorization">
    <form action="./index.php?Registration" method="post" enctype="multipart/form-data">
        <p><?php echo $errmassage;?></p>
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
    </div>


</body>

</html>