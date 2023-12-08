<?php 
 class db{
    private $mysqli;
    public function connect($host,$user,$pass,$dbname):bool{
        $this->mysqli = new mysqli($host,$user,$pass,$dbname);
        if ($this->mysqli->connect_errno) {
            return false;
        } else{
            return true;
        }
    }

    public function getMySqlli(){
        return $this->mysqli;
    }

    public function close(){
        $this->mysqli->close();
    }
}

class User{
    private $db;
    private $id;
    private $fullname;
    private $login;
    private $password;
    private $email;
    public function __construct($fullname, $login, $password, $email, $db){
        $this->fullname = $fullname;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->db = $db;
    }
    public function getId(){
        return $this->id;
    }
    public function getFullName(){
            return $this->fullname;
    }
    public function getLogin(){
        return $this->login;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getDb(){
        return $this->db;
    }

    public function show(){
        echo "<h3>Переданные данные с формы</h3>";
        echo "<div class='user'>";
        echo "<b>Имя пользователя: </b>".$this->fullname."<br>".
            "<b>Логин: </b>".$this->login."<br>".
            "<b>Email: </b>".$this->email."<br>";
        echo "<div><hr>";
    }
    public function toDB($host,$user,$pass,$dbname){
        try {
            if ($this->db->connect($host,$user,$pass,$dbname)){
                $query = "INSERT INTO users VALUES(null, '".$this->getFullName()."', '". $this->getLogin()."', '". $this->getPassword()."', '". $this->getEmail()."')";
                $this->db->getMySqlli()->query($query);
                echo "<br><h2 class='goodInsert'>Пользователь добавлен в базу данных</h2>";
            }
            else{
                echo "Ошибка при подключении к БД";
            }
        } catch (Exception $e) {
            echo "<b class='error'>Ошибка при добавлении пользователя в БД</b></br>";
            echo "".$e->getMessage()."<br/>";    
        } finally{
            $this->db->getMySqlli()->close();
        }
    }
}
