<?php
include_once("./pages/classes/team.php");
$arr = Team::getAllTeamsFromDb();

echo '<table class="table table-bordered table-hover">';
echo '<thead><tr><th>Название команды</th><th>Город</th><th>Герб</th></tr></thead>';
foreach ($arr as $team) {
    echo '<tr>';
    echo '<td><a href="./pages/info.php?Id=' . $team->Id . '&info=team" target="_blank">' . $team->Name . '</a></td>';
    echo '<td>' . ($team->getCityInfo())->Name;
    '</td>';
    $img = base64_encode($team->Avatar);
    echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $img . '"></td>';
    echo '</tr>';
}
echo '</table>';
