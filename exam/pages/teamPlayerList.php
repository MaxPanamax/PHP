<?php

if (isset($_POST['TeamId'])) {
    require './classes/db.php';
    require './classes/team.php';
    $TeamId = $_POST['TeamId'];
    $players = Player::getAllPlayersByTeamId($TeamId);
    if ($players != false) {
        echo '<h1>Текущий состав команды!</h1>';
        echo '<div class="list-group">';
        for ($i = 0; $i < count($players); $i++) {
            if ($i == 0) {
                echo '<a href="/exam/pages/info.php?Id=' . $players[$i]->Id . '&info=player" target="_blank" class="list-group-item list-group-item-action active" aria-current="true">' . $players[$i]->FullName . '</a>';
            } else {
                echo '<a href="/exam/pages/info.php?Id=' . $players[$i]->Id . '&info=player" target="_blank" class="list-group-item list-group-item-action">' . $players[$i]->FullName . '</a>';
            }
        }
        echo '</div>';
    }
} else {
    include_once("./pages/classes/team.php");
    echo '<p></p>';
    $arr = Team::getAllTeamsFromDb();
    if (isset($_POST["TeamId"])) {
        echo "<h1>Дата</h1>";
    }
    echo "<label for='ChooseTeam'>Выберите команду: </label>";
    echo '<select class="form-select" name="TeamId" id="ChooseTeam">';
    foreach ($arr as $team) {
        echo "<option value='" . $team->Id . "'>" . $team->Name . "</option>";
    }
    echo "</select>";
    echo '<div id="mes"></div>';
}

