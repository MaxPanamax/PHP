<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home work1</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="country" , placeholder="Введите название страны" required>
        <input type="submit" value="Отправить">
    </form>

    <?php
    require_once("functions.php");
    define("FILE_WRITE", "countries.txt"); //Файл для записи
    define("FILE_DB_COUNTRIES", "dictionary.txt"); //Изначальный заполненный файл со со списком стран
    //print_r($_POST);
    if (isset($_POST['country'])) {
        $country = htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8');
        if (findCountryInFile(FILE_DB_COUNTRIES, $country)) { //Проводим поиск в заполненном файле
            if (findCountryInFile(FILE_WRITE, $country)) { //Проводим поиск в файле, куда будем записывать страну
                echo "<h2>" . "Страна существует в файле" . "</h2>";
            } else {
                writeCountryInFile(FILE_WRITE, $country);
            }
            getAllCountriesFromFileInTagSelect(FILE_WRITE);
        } else {
            echo "<h2>" . "Вы ввели не корректное название страны  или страна отсутствует в базе данных!" . "</h2>";
        }
    }
    ?>
</body>

</html>