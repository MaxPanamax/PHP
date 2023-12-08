<?php
//Функция записи в файл
function writeCountryInFile($filename, $country)
{
    $file = fopen($filename, "a");
    fwrite($file, trim($country) . PHP_EOL);
    fclose($file);
}
//Функция проверки существования страны в файле
function findCountryInFile($filename, $country)
{
    $isExist = false;
    $handle = fopen($filename, "r");
    while (($line = fgets($handle)) !== false) {
        if (mb_strtoupper(trim($line)) === mb_strtoupper(trim($country))) {
            $isExist = true;
            break;
        }
    }
    fclose($handle);
    return $isExist;
}
//Функция вывода тега select с названиями стран из файла
function getAllCountriesFromFileInTagSelect($filename)
{
    echo "<label for=\"countries\">Список стран из файла: </label>";
    echo "<select id=\"countries\">";
    $handle = fopen($filename, "r");
    while (($line = fgets($handle)) !== false) {
        echo "<option>" . trim($line) . "</option>";
    }
    echo "</select>";
    fclose($handle);
}
