<?php
include_once("db.php");
include_once("team.php");
include_once("coach.php");
include_once("stadium.php");
include_once("season.php");
include_once("goal.php");
include_once("player.php");

class Game
{
    public $Id;
    public $DateBegin;
    public $StadiumId;
    public $Tour;
    public $SeasonId;
    public $TeamHome;
    public $TeamGuest;
    public $CoachTeamHome;
    public $CoachTeamGuest;
    public $GoalScoredTeamHome;
    public $GoalScoredTeamGuest;

    public function __construct($DateBegin, $StadiumId, $Tour, $SeasonId, $TeamHome, $TeamGuest, $CoachTeamHome, $CoachTeamGuest, $GoalScoredTeamHome,  $GoalScoredTeamGuest, $Id = 0)
    {
        $this->DateBegin = $DateBegin;
        $this->StadiumId = $StadiumId;
        $this->Tour = $Tour;
        $this->SeasonId = $SeasonId;
        $this->TeamHome = $TeamHome;
        $this->TeamGuest = $TeamGuest;
        $this->CoachTeamHome = $CoachTeamHome;
        $this->CoachTeamGuest = $CoachTeamGuest;
        $this->GoalScoredTeamHome = $GoalScoredTeamHome;
        $this->GoalScoredTeamGuest = $GoalScoredTeamGuest;
        $this->Id = $Id;
    }

    public function getTeam($TeamId): bool|Team
    {
        $team = Team::fromDb($TeamId);
        if ($team === null) {
            echo '<h3>Нет данных!</h3>';
            return false;
        }
        return $team;
    }

    public function getCoach($CoachId): bool|Coach
    {
        $coach = Coach::fromDb($CoachId);
        if ($coach === null) {
            echo '<h3>Нет данных!</h3>';
            return false;
        }
        return $coach;
    }

    public function getStaduim(): bool|Stadium
    {
        $stadium = Stadium::fromDb($this->StadiumId);
        if ($stadium  === null) {
            echo '<h3>Нет данных!</h3>';
            return false;
        }
        return $stadium;
    }

    public function getAllLineUpGamePlayer($GameId,$TeamId):array|bool{
        $lineUpGamePlayer = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM lineupgame WHERE GameId=? AND TeamId=?');
            $ps->execute(array($GameId, $TeamId));
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $PlayerId = $row['PlayerId'];
                    $player = Player::fromDb($PlayerId);
                    $lineUpGamePlayer[] = $player;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $lineUpGamePlayer;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getSeason(): bool|Season
    {
        $season = Season::fromDb($this->SeasonId);
        if ($season  === null) {
            echo '<h3>Нет данных!</h3>';
            return false;
        }
        return $season;
    }
    static function fromDb($Id): bool|Game
    {
        $game = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Game WHERE Id=? LIMIT 1');
            $ps->execute(array($Id));
            if ($ps->rowCount() > 0) {
                $row = $ps->fetch();
                $game = new Game($row['DateBegin'], $row['StadiumId'], $row['Tour'], $row['SeasonId'], $row['TeamHome'], $row['TeamGuest'], $row['CoachTeamHome'], $row['CoachTeamGuest'], $row['GoalScoredTeamHome'], $row['GoalScoredTeamGuest'], $row['Id']);
            } else {
                echo "<h3><span style='color:red;'>Нет данных</span></h3>";
                return false;
            }
            return $game;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    static function getAllPastGames($SeasonId, $Tour): array|bool
    {
        $games = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Game WHERE SeasonId=? AND ? IN (0, Tour) AND GoalScoredTeamHome IS NOT NULL AND GoalScoredTeamGuest IS NOT NULL AND DateBegin<CURDATE() ORDER BY Tour');
            $ps->execute(array($SeasonId, $Tour));
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $game = new Game($row['DateBegin'], $row['StadiumId'], $row['Tour'], $row['SeasonId'], $row['TeamHome'], $row['TeamGuest'], $row['CoachTeamHome'], $row['CoachTeamGuest'], $row['GoalScoredTeamHome'], $row['GoalScoredTeamGuest'], $row['Id']);
                    $games[] = $game;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $games;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function getAllFutureGames(): array|bool
    {
        $games = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Game WHERE DateBegin>CURDATE() ORDER BY SeasonId, Tour');
            $ps->execute();
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $game = new Game($row['DateBegin'], $row['StadiumId'], $row['Tour'], $row['SeasonId'], $row['TeamHome'], $row['TeamGuest'], $row['CoachTeamHome'], $row['CoachTeamGuest'], $row['GoalScoredTeamHome'], $row['GoalScoredTeamGuest'], $row['Id']);
                    $games[] = $game;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $games;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function getAllGamesSeason($SeasonId): array|bool
    {
        $games = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Game WHERE SeasonId=? ORDER BY Tour, DateBegin');
            $ps->execute(array($SeasonId));
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $game = new Game($row['DateBegin'], $row['StadiumId'], $row['Tour'], $row['SeasonId'], $row['TeamHome'], $row['TeamGuest'], $row['CoachTeamHome'], $row['CoachTeamGuest'], $row['GoalScoredTeamHome'], $row['GoalScoredTeamGuest'], $row['Id']);
                    $games[] = $game;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $games;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function deleteGame($Id){
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('DELETE FROM Game WHERE Id=?');
            $ps->execute(array($Id));
            if ($ps->rowCount() > 0) {
                echo "Успешное удаление игры";
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

    public function updateGameInDb()
    {
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare("UPDATE Game SET DateBegin=:DateBegin, StadiumId=:StadiumId, Tour=:Tour, SeasonId=:SeasonId, TeamHome=:TeamHome, TeamGuest=:TeamGuest, CoachTeamHome=:CoachTeamHome, CoachTeamGuest=:CoachTeamGuest, GoalScoredTeamHome=:GoalScoredTeamHome,  GoalScoredTeamGuest=:GoalScoredTeamGuest WHERE Id=:Id");
            $array = get_object_vars($this);
            $ps->execute($array);
            echo "Успешное обновление игры";
        } catch (PDOException $e) {
            echo $e->getMessage();
            $err = $e->getMessage();
            if (substr($err, 0, strrpos($err, ":")) == 'SQLSTATE[23000]: Integrity constraint violation')
                return 1062;
            else
                return $e->getMessage();
        }
    }

    public function intoDb()
    {
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare("INSERT INTO Game (DateBegin, StadiumId, Tour, SeasonId, TeamHome, TeamGuest, CoachTeamHome, CoachTeamGuest, GoalScoredTeamHome, GoalScoredTeamGuest) VALUES (:DateBegin, :StadiumId, :Tour, :SeasonId, :TeamHome, :TeamGuest, :CoachTeamHome, :CoachTeamGuest, :GoalScoredTeamHome, :GoalScoredTeamGuest)");
            $array = get_object_vars($this);
            array_shift($array);
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

    function getInfoToHTML()
    {
        $stadium = $this->getStaduim();
        $teamHome = $this->getTeam($this->TeamHome);
        $teamGuest = $this->getTeam($this->TeamGuest);
        $coachTeamHome = $this->getCoach($this->CoachTeamHome);
        $coachTeamGuest = $this->getCoach($this->CoachTeamGuest);
        $imgStadium = base64_encode($stadium->Photo);
        //$playersTeamHome = Player::getAllPlayersByTeamId($this->TeamHome);
        //$playersTeamGuest = Player::getAllPlayersByTeamId($this->TeamGuest);


        $infoTeamWinnner = ($this->GoalScoredTeamHome > $this->GoalScoredTeamGuest) ? "Встреча завершилась победой хозяев." : (($this->GoalScoredTeamHome < $this->GoalScoredTeamGuest) ? "Встреча завершилась победой гостей." : "Встреча завершилась вничью.");
        echo '<h1 style="text-align: center;">Общая информация</h1>';
        echo '<p style="font-size: 20pt;"><img src="data:image/jpeg; base64, ' . $imgStadium . '" style="float:left; margin: 4px 10px 2px 0px; width:10%; height: 10%;" />';
        echo '<b>' . $this->DateBegin . '</b> состоялась игра между футбольными командами ' . $teamHome->Name . ' и ' . $teamGuest->Name . '. Встреча проходила на стадионе <a href="/exam/pages/info.php?Id=' . $this->getStaduim()->Id . '&info=stadium" target="_blank">' . $this->getStaduim()->Name . '</a><br>';
        echo 'Хозяева - команда <a href="/exam/pages/info.php?Id=' . $teamHome->Id . '&info=team" target="_blank">' . $teamHome->Name . '</a>. ';
        echo 'Гости - команда <a href="/exam/pages/info.php?Id=' . $teamGuest->Id . '&info=team" target="_blank">' . $teamGuest->Name . '</a>. ' . $infoTeamWinnner . ' Счет встречи ' . $this->GoalScoredTeamHome . ' : ' . $this->GoalScoredTeamGuest . '<br>';
        echo '</p>';

        echo '<h1 style="text-align: center;">Состав на игру команды ' . $teamHome->Name . '</h1>';
        echo '<ul>';
        echo '<li>Главный тренер команды: <a href="/exam/pages/info.php?Id=' . $coachTeamHome->Id . '&info=coach" target="_blank">' . $coachTeamHome->FullName . '</a></li>';
        $playersTeamHome = $this->getAllLineUpGamePlayer($this->Id,$this->TeamHome);
        if ($playersTeamHome!=false){
            foreach ($playersTeamHome as $player) {
                echo '<li><a href="/exam/pages/info.php?Id=' . $player->Id . '&info=player" target="_blank">' . $player->FullName . '</a></li>';
            }
        }
        echo '</ul>';

        echo '<h1 style="text-align: center;">Состав на игру команды ' . $teamGuest->Name . '</h1>';
        echo '<ul>';
        echo '<li>Главный тренер команды: <a href="/exam/pages/info.php?Id=' . $coachTeamGuest->Id . '&info=coach" target="_blank">' . $coachTeamGuest->FullName . '</a></li>';
        $playersTeamGuest = $this->getAllLineUpGamePlayer($this->Id,$this->TeamGuest);
        if ($playersTeamGuest!=false){
            foreach ($playersTeamGuest as $player) {
                echo '<li><a href="/exam/pages/info.php?Id=' . $player->Id . '&info=player" target="_blank">' . $player->FullName . '</a></li>';
            }
        }
        echo '</ul>';

        echo '<h1 style="text-align: center;">Забитые мячи</h1>';
        $goals = Goal::getAllGoalsGame($this->Id); //Забитые мячи
        if ($goals != false) {
            echo '<ul>';
            foreach ($goals as $goal) {
                echo '<li>' . Player::fromDb($goal->PlayerId)->FullName . ' на ' . $goal->Minute . ' минуте матча</li>';
            }
            echo '</ul>';
        }
    }
}
