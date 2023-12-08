<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная форма</title>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <form action="user.php" method="post">
        <label for="fullname">Полное имя</label>
        <input type="text" id="fullname" name="fullname" placeholder="Ваше ФИО" minlength="5" maxlength="50" required>
        <label for="login">Логин</label>
        <input type="text" id="login" name="login" placeholder="Ваш логин" minlength="5" maxlength="20" required>
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" placeholder="Ваш пароль" minlength="5" maxlength="20" required>
        <label for="email">Ваш email</label>
        <input type="email" id="email" name="email" placeholder="Ваш email" minlength="5" maxlength="50" required>
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>

</html>