<?php
include_once("team.php");
class Coach
{
    public $Id;
    public $FullName;
    public $Info;
    public $Avatar;

    public function __construct($FullName, $Info, $Avatar, $Id = 0)
    {
        $this->Id = $Id;
        $this->FullName = $FullName;
        $this->Info = $Info;
        $this->Avatar = $Avatar;
    }

    static function fromDb($Id): bool|Coach
    {
        $coach = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Coach WHERE Id=? LIMIT 1');
            $ps->execute(array($Id));
            if ($ps->rowCount() > 0) {
                $row = $ps->fetch();
                $coach = new Coach($row['FullName'], $row['Info'], $row['Avatar'], $row['Id']);
            } else {
                echo "<h3><span style='color:red;'>Тренер не найден</span></h3>";
                return false;
            }
            return $coach;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function getAllCoachFromDb(): array|bool
    {
        $coaches = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Coach');
            $ps->execute();
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $coach = new Coach($row['FullName'], $row['Info'], $row['Avatar'], $row['Id']);
                    $coaches[] = $coach;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $coaches;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function getTeam(): Team|false
    {
        $team = Team::getTeamByCoach($this->Id);
        if ($team === null) {
            return false;
        }
        return $team;
    }

    function getInfoToHTML()
    {
        $img = base64_encode($this->Avatar);
        echo '<h1 style="text-align: center;">' . $this->FullName . '</h1>';
        echo '<p><img src="data:image/jpeg; base64, ' . $img . '" style="float:left; margin: 4px 10px 2px 0px; width:10%; height: 10%;" />';
        echo '' . $this->Info . '';
        echo '</p>';
        echo '<h1 style="text-align: center;">Команды</h1>';
        if ($this->getTeam() != null) {
            echo '<p>На текущий момент является тренером футбольной команды ' . ($this->getTeam())->Name . '</p>';
        }
    }
}
