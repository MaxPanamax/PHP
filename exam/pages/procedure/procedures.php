<?php
if (isset($_POST["SelectShowStatistic"])) {
    require './classes/db.php';
}

function showStandings($seasonId): array|bool
{
    $standings = null;
    try {
        $pdo = Db::connect();
        $ps = $pdo->prepare('CALL up_sel_showStandings(?)');
        $ps->execute(array($seasonId));
        if ($ps->rowCount() > 0) {
            while ($row = $ps->fetch()) {
                $standings[] = $row;
            }
        } else {
            echo '<h1>Нет данных</h1>';
            return false;
        }
        return $standings;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function showGoalsScored($seasonId): array|bool
{
    $scorers = null;
    try {
        $pdo = Db::connect();
        $ps = $pdo->prepare('CALL up_sel_showGoalsScored(?)');
        $ps->execute(array($seasonId));
        if ($ps->rowCount() > 0) {
            while ($row = $ps->fetch()) {
                $scorers[] = $row;
            }
        } else {
            echo '<h1>Нет данных</h1>';
            return false;
        }
        return $scorers;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
