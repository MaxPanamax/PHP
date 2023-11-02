<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
    <h1>Add User</h1>
    <form action="processUser.php" method="POST">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <!-- Другие поля формы -->
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>