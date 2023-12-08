<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Регистрация</title>
</head>
<body>
 	<form action="reg.php" method="post" id="registration">
 		<label for="login">Введите логин</label>
		<input type="text" name="login" id="login" placeholder="Введите логин" required>
		<label for="password">Введите пароль</label>
		<input type="password" name="password" id="password" placeholder="Введите пароль" required>
		<input type="submit" value="Зарегистрироваться">
	</form>

	<div id="mes"></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="js.js"></script>
</body>
</html>