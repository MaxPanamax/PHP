<?php
@session_start();
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if (!isset($_GET['page'])) {
	$page = 1;
}
include_once("pages/classes/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fullball clubs</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet/less" href="css/style.less">

			<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous"> -->

</head>

<body>
	<?php
	include_once('pages/menu.php');
	?>
	<main>
		<?php
		if (isset($_GET['page'])) {
			if ($page == 1) include_once("pages/stadiums.php");
			if ($page == 2) include_once("pages/coach.php");
			if (($page == 3) && (!isset($_SESSION['ruser']))) include_once("pages/registration.php");
			if (($page == 4) && (isset($_SESSION['radmin']))) include_once("pages/admin/adminNews.php");
			if ($page == 5) include_once("pages/teams.php");
			if ($page == 6) include_once("pages/teamPlayerList.php");
			if ($page == 7) include_once("pages/pastGames.php");
			if ($page == 8) include_once("pages/calendar.php");
			if ($page == 9) include_once("pages/statistic.php");
			if ($page == 10) include_once("pages/newsShow.php");
			if (($page == 11) && (isset($_SESSION['radmin']))) include_once("pages/admin/adminGame.php");
			if (($page == 12) && (isset($_SESSION['radmin']))) include_once("pages/admin/adminTeam.php");
		} else {
			include_once("pages/stadiums.php");
		}
		?>
	</main>
	<script src="js/jquery-2.0.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/less.min.js"></script>
	<script src="js/myJs.js"></script>

</body>

</html>