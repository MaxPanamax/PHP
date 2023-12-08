<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Города</title>
	<link rel="stylesheet" href="css.css" />
</head>
<body>

	<?php  
	require "../connect.php";
	$sql="SELECT id, country FROM country ORDER BY country";

	$rows = $pdo->query($sql);

	if ($rows==false || $rows->rowCount()==0) {
		echo "Нет данных";
	} else{
		echo "<label for='ChooseCountry'>Выберите страну: </label>";
		echo "<select name='countryId' id='ChooseCountry'>";
		foreach ($rows as $row){
			echo "<option value='".$row['id']."'>".$row['country']."</option>";
		}
		echo "</select>";
	}
	?>
	<div id="mes"></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="js.js"></script>
</body>
</html>