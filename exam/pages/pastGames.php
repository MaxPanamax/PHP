<?php
if (isset($_POST["SelectPastGame"])){
    require './classes/game.php';
    $SeasonId = $_POST['SeasonId'];
    $Tour = $_POST['Tour'];
    $games = GAME::getAllPastGames($SeasonId, $Tour);
    echo "<h1>Прошедшие игры</h1>";
    if ($games!=false){
        echo '<table class="table table-bordered table-hover">';
        echo '<thead>
                <tr>
                    <th>Сезон</th>
                    <th>Номер тура</th>
                    <th>Стадион</th>
                    <th>Дата матча</th>
                    <th>Эмблема команды хозяев</th>
                    <th>Название команды хозяев</th>
                    <th>Эмблема команды гостей</th>
                    <th>Название команды гостей</th>
                    <th>Счет</th>
                    <th>Подробнее о матче</th>
                </tr>
               </thead>';
        foreach ($games as $game) {
            $teamHome = $game->getTeam($game->TeamHome);
            $avaratTeamHome = base64_encode($teamHome->Avatar);
    
            $teamGuest = $game->getTeam($game->TeamGuest);
            $avaratTeamGuest = base64_encode($teamGuest->Avatar);

            echo '<tr>';
            echo '<td>'.$game->getSeason()->Name.'</td>';
            echo '<td>'.$game->Tour.'</td>';
            echo '<td>'.$game->getStaduim()->Name.'</td>';
            echo '<td>'.$game->DateBegin.'</td>';

            echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $avaratTeamHome . '"></td>';
            echo '<td>'.$teamHome->Name.'</td>';
    
            echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $avaratTeamGuest . '"></td>';
            echo '<td>'.$teamGuest->Name.'</td>';
    
            echo '<td>'.$game->GoalScoredTeamHome.' : '.$game->GoalScoredTeamGuest.'</td>';
            
            echo '<td><a href="/exam/pages/info.php?Id=' . $game->Id . '&info=game" target="_blank">Подробнее</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}
else {
    include_once("./pages/classes/game.php");
    include_once("./pages/classes/season.php");
    $seasons = Season::getAllSeasonFromDb();
    echo '<p></p>';
    echo '<form action="" method="post" id="PastGames">
            <div class="form-group">
                <label for="SelectSeason">Сезон: </label>
                <select class="form-select" name="SeasonId" id="SelectSeason">';
                foreach ($seasons as $season) {
                    echo "<option value='" . $season->Id . "'>" . $season->Name . "</option>";
                }
                echo '</select>
            </div>
            <div class="form-group">
                <label for="SelectTour">Выберите тур: </label>
                <select class="form-select" name="Tour" id="SelectTour">';
                for ($i = 0; $i <= 38; $i++) { 
                    if ($i == 0) {
                        echo "<option value='" . $i . "'>Все игры тура</option>";
                    }
                    else{
                        echo "<option value='" . $i . "'>" . $i . "</option>";
                    }
                }
                echo '</select>
            </div>
            <input type="submit" class="btn btn-primary" name="SelectPastGame" value="Вывести список игр"/>
        </form>';
echo '<div id="mes"></div>';
}
?>
<script>
    let form = document.getElementById('PastGames');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        let SeasonId = document.getElementById("SelectSeason").value;
        let Tour = document.getElementById("SelectTour").value;
        $.ajax({
		    url: './pages/pastGames.php',
		    data: {'SeasonId':SeasonId, 'Tour': Tour, 'SelectPastGame': 'Вывести список игр'},
		    dataType: "html",
		    method: "post",
		    success: function(data){
			    $('#mes').html(data);
		    },
	    });
    });
</script>


