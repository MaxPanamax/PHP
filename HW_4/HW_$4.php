<?php
class User {
    private $login;
    private $pass;
    private $email;
    
    public function __construct($login, $pass, $email) {
        $this->login = $login;
        $this->pass = $pass;
        $this->email = $email;
    }
    
    public function show() {
        echo "<div>";
        echo "Логин: " . $this->login . "<br>";
        echo "Пароль: " . $this->pass . "<br>";
        echo "Email: " . $this->email . "<br>";
        echo "</div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $pass = $_POST["pass"];
    $email = $_POST["email"];
    
    $user = new User($login, $pass, $email);
    $user->show();
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Форма регистрации</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        form {
            margin-bottom: 20px;
            width: 12cm; /* Set the width to 8cm */
            margin: 0 auto; /* Center the form on the screen */
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
            border-radius: 5px;
            background: rgb(210, 214, 217);
        }
        
        label {
            display: block;
            margin-bottom: 10px;
        }
        
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 8cm; /* Set the width to 8cm */
            margin: 0 auto; /* Center the form on the screen */
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
            border-radius: 5px;
            background: rgb(210, 214, 217);
        }
        
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 8cm; /* Set the width to 8cm */
            margin: 0 auto; /* Center the form on the screen */
        }
        
        div {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Форма регистрации пользователя</h1>
    <form method="post">
        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" required>
        
        <label for="pass">Пароль:</label>
        <input type="password" id="pass" name="pass" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>
