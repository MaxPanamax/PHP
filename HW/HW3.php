<!DOCTYPE html>
<html>
<head>
    <title>Случайные цвета</title>
</head>
<body>
    <?php
// Создаем массив с названиями цветов
$colors = array("red", "blue", "green", "yellow", "orange", "purple");

// Перемешиваем массив
shuffle($colors);

// Отображаем четыре div
for ($i = 0; $i < 4; $i++) {
    // Получаем случайный цвет из массива
    $color = $colors[$i];

    // Выводим div с заданным цветом
    echo "<div style='width: 100px; height: 100px; background-color: $color;'></div>";
}

function createCalendar($m) {
    // Получаем текущий год
    $year = date('Y');

    // Получаем количество дней в указанном месяце
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $m, $year);

    // Создаем таблицу
    echo '<table>';

    // Создаем заголовок таблицы
    echo '<tr>';
    echo '<th>Пн</th>';
    echo '<th>Вт</th>';
    echo '<th>Ср</th>';
    echo '<th>Чт</th>';
    echo '<th>Пт</th>';
    echo '<th style="color:red;">Сб</th>';
    echo '<th style="color:red;">Вс</th>';
    echo '</tr>';

    // Определяем первый день месяца
    $firstDay = date('N', strtotime("$year-$m-1"));

    // Определяем последний день месяца
    $lastDay = date('N', strtotime("$year-$m-$daysInMonth"));

    // Определяем количество пустых ячеек в начале календаря
    $emptyCells = $firstDay - 1;

    // Определяем количество пустых ячеек в конце календаря
    $remainingCells = 7 - $lastDay;

    // Определяем общее количество ячеек в календаре
    $totalCells = $emptyCells + $daysInMonth + $remainingCells;

    // Определяем количество строк в календаре
    $totalRows = ceil($totalCells / 7);

    // Счетчик для дней месяца
    $dayCounter = 1;

    // Создаем строки календаря
    for ($row = 1; $row <= $totalRows; $row++) {
        echo '<tr>';

        // Создаем ячейки календаря
        for ($col = 1; $col <= 7; $col++) {
            if ($emptyCells > 0) {
                // Пустая ячейка в начале календаря
                echo '<td></td>';
                $emptyCells--;
            } elseif ($dayCounter <= $daysInMonth) {
                // Ячейка с числом месяца
                echo '<td>' . $dayCounter . '</td>';
                $dayCounter++;
            } else {
                // Пустая ячейка в конце календаря
                echo '<td></td>';
            }
        }

        echo '</tr>';
    }

    echo '</table>';
}
createCalendar(1);
createCalendar(2);
createCalendar(3);
createCalendar(4);
createCalendar(4);
createCalendar(5);
createCalendar(6);
createCalendar(7);
createCalendar(8);
createCalendar(9);
createCalendar(10);
createCalendar(11); // Создаст календарь для ноября текущего года
createCalendar(12);
?>
</body>
</html>