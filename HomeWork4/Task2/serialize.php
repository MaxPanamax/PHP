<?php
include_once("picture.php");
$picture = new Picture(1, "Академия ТОП.jpg", 2345, "D:\Top");
$strpoint = serialize($picture);
try {
    echo $strpoint . '<br>';
    file_put_contents('picture.txt', $strpoint);
    echo "Сериализация объекта picture прошла успешно!";
} catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
