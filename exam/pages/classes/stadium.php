<?php
include_once("team.php");

class Stadium
{
    public $Id;
    public $Name;
    public $DateCreate;
    public $Info;
    public $Photo;

    public function __construct($Name, $DateCreate, $Info, $Photo, $id = 0, $ListTeams = null)
    {
        $this->Id = $id;
        $this->Name = $Name;
        $this->DateCreate = $DateCreate;
        $this->Info = $Info;
        $this->Photo = $Photo;
    }

    static function getAllStadiumFromDb(): array|bool
    {
        $stadiums = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Stadium');
            $ps->execute();
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $stadium = new Stadium($row['Name'], $row['DateCreate'], $row['Info'], $row['Photo'], $row['Id']);
                    $stadiums[] = $stadium;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $stadiums;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function fromDb($Id): bool|Stadium
    {
        $stadium = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Stadium WHERE Id=? LIMIT 1');
            $ps->execute(array($Id));
            if ($ps->rowCount() > 0) {
                $row = $ps->fetch();
                $stadium = new Stadium($row['Name'], $row['DateCreate'], $row['Info'], $row['Photo'], $row['Id']);
            } else {
                echo "<h3><span style='color:red;'>Стадион не найден</span></h3>";
                return false;
            }
            return $stadium;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function getAllTeams()
    {
        $teams = Team::getAllTeamsByStadium($this->Id);
        if ($teams == null) {
            return false;
        }
        return $teams;
    }

    function getInfoToHTML()
    {
        $img = base64_encode($this->Photo);
        echo '<h1 style="text-align: center;">' . $this->Name . '</h1>';
        echo '<h3 style="text-align: center;">Дата основания стадиона ' . $this->DateCreate . '</h3>';
        echo '<p><img src="data:image/jpeg; base64, ' . $img . '" style="float:left; margin: 4px 10px 2px 0px; width:10%; height: 10%;" />';
        echo '' . $this->Info . '';
        echo '</p>';
        echo '<h1 style="text-align: center;">Команды</h1>';
        if ($this->getAllTeams() != null) {
            echo '<p>Стадион является домашней ареной для следующий команд АПЛ:</p>';
            echo '<ul>';
            foreach ($this->getAllTeams() as $stadium) {
                echo '<li>' . $stadium->Name . '</li>';
            }
            echo '</ul>';
        }
    }
}
