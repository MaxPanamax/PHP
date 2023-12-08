<?php
class Employee
{
    public $Id;
    public $Login;
    public $Pass;
    public $RoleId;

    public function __construct($Login, $Pass, $Id = 0)
    {
        $this->Id = $Id;
        $this->Login = $Login;
        $this->Pass = $Pass;
        $this->RoleId = 2;
    }

    public function intoDb()
    {
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare("INSERT INTO Employee (Login, Pass, RoleId) VALUES (:Login, :Pass, :RoleId)");
            $array = get_object_vars($this);
            array_shift($array);
            $ps->execute($array);
        } catch (PDOException $e) {
            $err = $e->getMessage();
            if (substr($err, 0, strrpos($err, ":")) == 'SQLSTATE[23000]: Integrity constraint violation')
                return 1062;
            else
                return $e->getMessage();
        }
    }

    static function fromDb($Login, $Pass): bool|Employee
    {
        $employee = null;
        $Login = TRIM(htmlspecialchars($Login));
        $Pass = TRIM(htmlspecialchars($Pass));
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Employee WHERE Login=? LIMIT 1');
            $ps->execute(array($Login));
            if ($ps->rowCount() > 0) {
                $row = $ps->fetch();
                $employee = new Employee($row['Login'], $row['Pass'], $row['Id']);
                if ($Pass != $employee->Pass) {
                    echo "<h3><span style='color:red;'>Не правильный пароль</span></h3>";
                    return false;
                }
                $employee->RoleId = $row['RoleId'];
            } else {
                echo "<h3><span style='color:red;'>Пользователь не найден</span></h3>";
                return false;
            }
            return $employee;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


}
