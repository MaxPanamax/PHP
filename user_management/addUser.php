<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
    <title>Add User</title>
</head>
<body>
    <h1>Add User</h1>
    <form action="processUser.php" method="POST">
        <label for="login">Login:</label></br>
        <input type="text" name="login" id="login" required><br><br>
        
        <label for="password">Password:</label></br>
        <input type="password" name="password" id="password" required><br><br>
        
        <label for="email">Email:</label></br>
        <input type="email" name="email" id="email" required><br><br>
        
        <!-- Другие поля формы -->
        
        <input id="submit" type="submit" value="Submit">
    </form>
</body>
</html>