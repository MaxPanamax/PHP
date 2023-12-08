<?php
require "../connect.php";

$countryId = $_POST["countryId"];

$sql="SELECT id, city FROM city WHERE country_id='$countryId'";
$rows = $pdo->query($sql);

if ($rows == false || $rows->rowCount()==0){
		echo "<h2>Нет данных</h2>";
	} else {
		echo "<table>";
		echo "<thead><tr><th>id города</th><th>Название города</th></tr></thead>";
		echo "<tbody>";
		foreach ($rows as $row){
			echo "<tr><td>".$row['id']."</td><td>".$row['city']."</td></tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
 ?>