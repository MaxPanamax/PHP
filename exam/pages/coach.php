<?php
include_once("./pages/classes/coach.php");
$arr = Coach::getAllCoachFromDb();

echo '<table class="table table-bordered table-hover">';
echo '<thead><tr><th>Полной имя</th><th>Футбольная команда</th><th>Фото</th></tr></thead>';
foreach ($arr as $coach) {
    echo '<tr>';
    echo '<td><a href="./pages/info.php?Id=' . $coach->Id . '&info=coach" target="_blank">' . $coach->FullName . '</a></td>';
    if ($coach->getTeam()==false){
        echo '<td>Нет команды</td>';
    }
    else{
        echo '<td>' . $coach->getTeam()->Name . '</td>';
    }
    $img = base64_encode($coach->Avatar);
    echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $img . '"></td>';
    echo '</tr>';
}
echo '</table>';
