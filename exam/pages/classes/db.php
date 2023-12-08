<?php
class Db
{
    static function connect($host = "localhost", $user = "root", $pass = "", $dbname = "fc")
    {
        $cs = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8;';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        );
        try {
            $pdo = new PDO($cs, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function register($login, $pass)
    {
        $login = trim($login);
        $pass = trim($pass);
        if ($login == "" || $pass == "") {
            echo "<h3><span style='color:red;'>Fill All Required Fields!</span></h3>";
            return false;
        }
        if (strlen($login) < 3 || strlen($login) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
            echo "<h3><span style='color:red;'>Values Length Be Between 3 And 30!</span></h3>";
            return false;
        }
        $employee = new Employee($login, $pass);
        $err = $employee->intoDb();
        if ($err) {
            if ($err == 1062) {
                echo "<h3><span style='color:red;'>This Login Is Already Taken!</span></h3>";
                return false;
            } else {
                echo "<h3><span style='color:red;'>Error code:" . $err . "!</span></h3>";
                return false;
            }
        }
        return true;
    }
}
