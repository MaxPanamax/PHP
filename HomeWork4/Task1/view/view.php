<form action="" method="get">
    <button type="submit" name="record" value="getAllPicture">All Record</button>
</form>
<?php
$model = new MyModel();
$controller = new MyController($model);

if (isset($_GET['record']) && $_GET['record'] === 'getAllPicture') {
    $pictures = $controller->getAllRecords();
    if ($pictures != false) {
        echo '<table>';
        echo '<thead><tr><th>Id картинки</th><th>Наименование</th><th>Расширение</th><th>Размер (в Мб)</th><th>Путь в картинке</th></tr></thead>';
        echo '<tbody>';
        foreach ($pictures as $picture) {
            echo "<tr>";
            echo "<td>{$picture['Id']}</td>";
            echo "<td>{$picture['Name']}</td>";
            echo "<td>{$picture['Extension']}</td>";
            echo "<td>{$picture['Size']}</td>";
            echo "<td>{$picture['Path']}</td>";
            echo "</tr>";
        }
        echo '</tbody>';
        echo '</table>';
    }
}
?>