<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подробная информация</title>
</head>

<body>
    <?php
    include_once('../pages/classes/db.php');
    if (isset($_GET['Id'])) {
        $info = $_GET['info'];
        switch ($info) {
            case 'stadium':
                include_once('../pages/classes/stadium.php');
                $stadium = Stadium::fromDb($_GET['Id']);
                if ($stadium != null) {
                    $stadium->getInfoToHTML();
                }
                break;
            case 'coach':
                include_once('../pages/classes/coach.php');
                $coach = Coach::fromDb($_GET['Id']);
                if ($coach != null) {
                    $coach->getInfoToHTML();
                }
                break;
            case 'team':
                include_once('../pages/classes/team.php');
                $team = Team::fromDb($_GET['Id']);
                if ($team != null) {
                    $team->getInfoToHTML();
                }
                break;
            case 'player':
                include_once('../pages/classes/player.php');
                $player = Player::fromDb($_GET['Id']);
                if ($player != null) {
                    $player->getInfoToHTML();
                }
                break;
            case 'game':
                    include_once('../pages/classes/game.php');
                    $game = Game::fromDb($_GET['Id']);
                    if ($game != null) {
                        $game->getInfoToHTML();
                    }
                    break;
            case 'news':
                        include_once('../pages/classes/news.php');
                        $news = News::fromDb($_GET['Id']);
                        if ($news != null) {
                            $news->getInfoToHTML();
                        }
                    break;
            default:
                echo "<h1>Не понятно</h1>";
                break;
        }
    }
    ?>
</body>

</html>