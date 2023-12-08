<?php
include_once("db.php");
include_once("player.php");
include_once("game.php");

class Goal
{
    public $Id;
    public $GameId;
    public $PlayerId;
    public $Minute;

    public function __construct($GameId, $PlayerId, $Minute, $Id = 0)
    {
        $this->GameId = $GameId;
        $this->PlayerId = $PlayerId;
        $this->Minute = $Minute;
        $this->Id = $Id;
    }

    static function getAllGoalsGame($GameId): array|bool
    {
        $goals = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM GoalsScored WHERE GameId=? ORDER BY Minute');
            $ps->execute(array($GameId));
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $goal = new Goal($row['GameId'], $row['PlayerId'], $row['Minute'], $row['Id']);
                    $goals[] = $goal;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $goals;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
