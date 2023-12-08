<?php

include_once("./pages/classes/game.php");
$games = GAME::getAllFutureGames();

echo "<h1>Будущие игры</h1>";
if ($games != false) {
    echo '<table class="table table-bordered table-hover">';
    echo '<thead>
                <tr>
                    <th>Сезон</th>
                    <th>Номер тура</th>
                    <th>Стадион</th>
                    <th>Дата матча</th>
                    <th>Эмблема команды хозяев</th>
                    <th>Название команды хозяев</th>
                    <th>Эмблема команды гостей</th>
                    <th>Название команды гостей</th>
                </tr>
               </thead>';
    foreach ($games as $game) {
        $teamHome = $game->getTeam($game->TeamHome);
        $avaratTeamHome = base64_encode($teamHome->Avatar);

        $teamGuest = $game->getTeam($game->TeamGuest);
        $avaratTeamGuest = base64_encode($teamGuest->Avatar);

        echo '<tr>';
        echo '<td>' . $game->getSeason()->Name . '</td>';
        echo '<td>' . $game->Tour . '</td>';
        echo '<td>' . $game->getStaduim()->Name . '</td>';
        echo '<td>' . $game->DateBegin . '</td>';

        echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $avaratTeamHome . '"></td>';
        echo '<td>' . $teamHome->Name . '</td>';

        echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $avaratTeamGuest . '"></td>';
        echo '<td>' . $teamGuest->Name . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
