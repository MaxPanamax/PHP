<?php
include_once("city.php");
include_once("stadium.php");
include_once("coach.php");
include_once("player.php");
class Team
{
    public $Id;
    public $Name;
    public $Info;
    public $Avatar;
    public $CityId;
    public $CoachId;
    public $StadiumId;

    public function __construct($Name, $Info, $Avatar, $CityId, $CoachId, $StadiumId, $Id = 0)
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Info = $Info;
        $this->Avatar = $Avatar;
        $this->CityId = $CityId;
        $this->CoachId = $CoachId;
        $this->StadiumId = $StadiumId;
    }

    public function intoDb()
    {
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare("INSERT INTO Team (Name, Info, Avatar, CityId, CoachId, StadiumId) VALUES (:Name, :Info, '".$this->Avatar."', :CityId, :CoachId, :StadiumId)");
            $array = get_object_vars($this);
            array_shift($array);
            unset($array['Avatar']);
            $ps->execute($array);
        } catch (PDOException $e) {
            $err = $e->getMessage();
            echo $e->getMessage();
            if (substr($err, 0, strrpos($err, ":")) == 'SQLSTATE[23000]: Integrity constraint violation')
                return 1062;
            else
                return $e->getMessage();
        }
    }

    public function getStadiumInfo(): bool|Stadium
    {
        $stadium = Stadium::fromDb($this->StadiumId);
        if ($stadium === null) {
            echo '<h3>Стадион не найден!</h3>';
            return false;
        }
        return $stadium;
    }

    public function getCityInfo(): bool|City
    {
        $city = City::fromDb($this->CityId);
        if ($city === null) {
            echo '<h3>Стадион не найден!</h3>';
            return false;
        }
        return $city;
    }

    public function getCoachInfo(): bool|Coach
    {
        $coach = Coach::fromDb($this->CoachId);
        if ($coach === null) {
            echo '<h3>Стадион не найден!</h3>';
            return false;
        }
        return $coach;
    }

    static function getAllTeamsFromDb(): array|bool
    {
        $teams = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Team');
            $ps->execute();
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $team = new Team($row['Name'], $row['Info'], $row['Avatar'], $row['CityId'], $row['CoachId'], $row['StadiumId'], $row['Id']);
                    $teams[] = $team;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $teams;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function getAllTeamsByStadium($StadiumId): array|bool
    {
        $teams = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Team WHERE StadiumId=?');
            $ps->execute(array($StadiumId));
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $team = new Team($row['Name'], $row['Info'], $row['Avatar'], $row['CityId'], $row['CoachId'], $row['StadiumId'], $row['Id']);
                    $teams[] = $team;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $teams;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function getTeamByCoach($CoachId): Team|false
    {
        $team = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Team WHERE CoachId=?');
            $ps->execute(array($CoachId));
            if ($ps->rowCount() > 0) {
                $row = $ps->fetch();
                $team = new Team($row['Name'], $row['Info'], $row['Avatar'], $row['CityId'], $row['CoachId'], $row['StadiumId'], $row['Id']);
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return  $team;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function updateAvatarTeam($Id, $Avatar){
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('UPDATE team SET Avatar="'.$Avatar.'" WHERE Id=?');
            $ps->bindParam(1, $Id);
            $ps->execute();
            if ($ps->rowCount() > 0) {
                echo "Успешное удаление команды";
                return true;
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateTeamInDb()
    {
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare("UPDATE Team SET Name=:Name, Info=:Info, CityId=:CityId, CoachId=:CoachId, StadiumId=:StadiumId WHERE Id=:Id");
            $array = get_object_vars($this);
            unset($array['Avatar']);
            $ps->execute($array);
            echo "Успешное обновление команды";
        } catch (PDOException $e) {
            echo $e->getMessage();
            $err = $e->getMessage();
            if (substr($err, 0, strrpos($err, ":")) == 'SQLSTATE[23000]: Integrity constraint violation')
                return 1062;
            else
                return $e->getMessage();
        }
    }

    

    static function fromDb($Id): bool|Team
    {
        $team = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Team WHERE Id=? LIMIT 1');
            $ps->execute(array($Id));
            if ($ps->rowCount() > 0) {
                $row = $ps->fetch();
                $team = new Team($row['Name'], $row['Info'], $row['Avatar'], $row['CityId'], $row['CoachId'], $row['StadiumId'], $row['Id']);
            } else {
                echo "<h3><span style='color:red;'>Нет данных</span></h3>";
                return false;
            }
            return $team;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function deleteTeam($Id){
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('DELETE FROM Team WHERE Id=?');
            $ps->execute(array($Id));
            if ($ps->rowCount() > 0) {
                echo "Успешное удаление команды";
                return true;
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function getInfoToHTML()
    {
        $img = base64_encode($this->Avatar);
        echo '<h1 style="text-align: center;">' . $this->Name . '</h1>';
        echo '<p><img src="data:image/jpeg; base64, ' . $img . '" style="float:left; margin: 4px 10px 2px 0px; width:10%; height: 10%;" />';
        echo '' . $this->Info . '';
        echo '</p>';

        echo '<h1 style="text-align: center;">Тренер</h1>';
        $coach = $this->getCoachInfo();
        echo '<p><img src="data:image/jpeg; base64, ' . base64_encode($coach->Avatar) . '" style="float:left; margin: 4px 10px 2px 0px; width:10%; height: 10%;" />';
        echo '' . $coach->Info . '';
        echo '</p>';

        echo '<h1 style="text-align: center;">Домашний стадион</h1>';
        $stadium = $this->getStadiumInfo();
        echo '<p><img src="data:image/jpeg; base64, ' . base64_encode($stadium->Photo) . '" style="float:left; margin: 4px 10px 2px 0px; width:10%; height: 10%;" />';
        echo '' . $stadium->Info . '';
        echo '</p>';

        echo '<h1 style="text-align: center;">Город</h1>';
        $city = $this->getCityInfo();
        echo '<p>Город: ' . $city->Name . '</p>';

        $players = Player::getAllPlayersByTeamId($this->Id);
        echo '<h1 style="text-align: center;">Состав команды</h1>';
        echo '<ul>';
        if ($players!=false){
            foreach ($players as $player) {
                echo '<li><a href="./info.php?Id=' . $player->Id . '&info=player" target="_blank">' . $player->FullName . '</a></li>';
            }
        }
        else{
            echo '<p>Нет данных</p>';
        }

        echo '</ul>';
    }
}
