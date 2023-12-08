<h3>Registration</h3>
<?php
include_once("./pages/classes/db.php");
include_once("./pages/classes/employee.php");
?>
<form action="" method="post">
    <div class="form-group">
        <label for="login">Login:</label>
        <input type="text" class="form-control" name="login" required>
    </div>
    <div class="form-group">
        <label for="pass1">Password:</label>
        <input type="password" class="form-control" name="pass1" required>
    </div>
    <div class="form-group">
        <label for="pass2">Confirm Password:</label>
        <input type="password" class="form-control" name="pass2" required>
    </div>
    <button type="submit" class="btn btn-primary" name="regbtn">Register</button>
</form>
<?php
if (isset($_POST['regbtn'])) {
    if (Db::register($_POST['login'], $_POST['pass1'])) {
        echo "<h3><span style='color:green;'>Вы успешно зарегистрировались. Выполните вход в систему</span></h3>";
    }
}
?>