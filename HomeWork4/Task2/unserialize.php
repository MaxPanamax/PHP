<?php
include_once("picture.php");

try{
    $strpoint = file_get_contents("picture.txt");

    echo $strpoint.'<br/>';
    $picture = unserialize($strpoint);
    echo "Десериализованный объект из файла:\n";
    echo $picture;

} catch(Exception $e){
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}

?>