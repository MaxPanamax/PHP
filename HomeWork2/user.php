<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи</title>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <?php
    include_once("class.php");
    if (isset($_POST["login"])) {
        $db = new db();
        $user = new User(
            htmlspecialchars(trim($_POST['fullname']), ENT_QUOTES, 'UTF-8'),
            htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8'),
            htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8'),
            htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8'),
            $db
        );
        $user->show();
        $user->toDB('localhost', 'root', '', 'testdb');
    }
    ?>
</body>

</html>