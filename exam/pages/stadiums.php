<?php
include_once("./pages/classes/stadium.php");
$arr = Stadium::getAllStadiumFromDb();

echo '<table class="table table-bordered table-hover">';
echo '<thead><tr><th>Название стадиона</th><th>Дата основания</th><th>Фото</th></tr></thead>';
foreach ($arr as $stadium) {
    echo '<tr>';
    echo '<td><a href="./pages/info.php?Id=' . $stadium->Id . '&info=stadium" target="_blank">' . $stadium->Name . '</a></td>';
    echo '<td>' . $stadium->DateCreate . '</td>';
    $img = base64_encode($stadium->Photo);
    echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $img . '"></td>';
    echo '</tr>';
}
echo '</table>';
