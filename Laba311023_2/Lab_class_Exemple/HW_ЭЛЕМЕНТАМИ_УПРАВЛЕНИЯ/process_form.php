<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Получаем значение поля с названием страны
  $country = $_POST["country"];

  // Проверяем, что поле не пустое
  if (!empty($country)) {
    // Проверяем, что название страны еще не присутствует в файле
    $file = "countries.txt";
    $countries = file_get_contents($file);
    if (strpos($countries, $country) === false) {
      // Добавляем название страны в файл
      file_put_contents($file, $country . PHP_EOL, FILE_APPEND);
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Форма для ввода страны</title>
</head>
<body>
  <form method="post" action="process_form.php">
    <label for="country">Введите название страны:</label>
    <input type="text" id="country" name="country" required>
    <input type="submit" value="Submit">
  </form>

  <select>
    <?php
    // Выводим все страны из файла
    $file = "countries.txt";
    $countries = file_get_contents($file);
    $countries = explode(PHP_EOL, $countries);
    foreach ($countries as $country) {
      echo "<option>$country</option>";
    }
    ?>
  </select>
</body>
</html>