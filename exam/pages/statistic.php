<?php
if (isset($_POST["SelectShowStatistic"])){
    require './procedure/procedures.php';
    require './classes/player.php';
    $SeasonId = $_POST['SeasonId'];
    $standings = showStandings($SeasonId);
    if ($standings!=false){
        echo '<h1 style="text-align:center;">Турнирная таблица</h1>';
        echo '<table class="table table-bordered table-hover">';
        echo '<thead>
                <tr>
                    <th>Место</th>
                    <th>Команда</th>
                    <th>Количество игр</th>
                    <th>Выигрышей</th>
                    <th>Проигрышей</th>
                    <th>Ничья</th>
                    <th>Голов забито</th>
                    <th>Голов пропущено</th>
                    <th>Разница</th>
                    <th>Количество очков</th>
                </tr>
               </thead>';
        foreach ($standings as $place) {
            echo '<tr>';
            echo '<td>'.$place['Place'].'</td>';
            echo '<td><a href="/exam/pages/info.php?Id=' . $place['TeamId'] . '&info=team" target="_blank">'.$place['Team'].'</a></td>';
            echo '<td>'.$place['game'].'</td>';
            echo '<td>'.$place['win'].'</td>';
            echo '<td>'.$place['loss'].'</td>';
            echo '<td>'.$place['draw'].'</td>';
            echo '<td>'.$place['goalScored'].'</td>';
            echo '<td>'.$place['goalMissed'].'</td>';
            echo '<td>'.$place['difference'].'</td>';
            echo '<td>'.$place['points'].'</td>';
            echo '</tr>';
        }
        echo '</table>';

        echo '<h1 style="text-align:center;">Бомбардиры</h1>';
        $scorers = showGoalsScored($SeasonId);
        if ($scorers!=false){
            echo '<table class="table table-bordered table-hover">';
            echo '<thead>
                    <tr>
                        <th>Место</th>
                        <th>Фото игрока</th>
                        <th>ФИО игрока</th>
                        <th>Количество забитых мячей</th>
                        <th>Текущая команда</th>
                    </tr>
                </thead>';
            foreach ($scorers as $bombardier) {
                $avarat = base64_encode(player::fromDb($bombardier['PlayerId'])->Avatar);
                echo '<tr>';
                echo '<td>'.$bombardier['Place'].'</td>';
                echo '<td><img height="50px" width="50px" src="data:image/jpeg; base64, ' . $avarat . '"></td>';
                echo '<td><a href="/exam/pages/info.php?Id=' . $bombardier['PlayerId'] . '&info=player" target="_blank">'.$bombardier['FullName'].'</a></td>';
                echo '<td>'.$bombardier['GoalsScored'].'</td>';
                echo '<td>'.$bombardier['team'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }
}
else {
    include_once("./pages/classes/season.php");
    include_once("./pages/procedure/procedures.php");
    $seasons = Season::getAllSeasonFromDb();
    echo '<p></p>';
    echo '<form action="" method="post" id="Statistic">
            <div class="form-group">
                <label for="SelectSeason">Сезон: </label>
                <select class="form-select" name="SeasonId" id="SelectSeason">';
                foreach ($seasons as $season) {
                    echo "<option value='" . $season->Id . "'>" . $season->Name . "</option>";
                }
                echo '</select>
            </div>
            <input type="submit" class="btn btn-primary" name="SelectShowStatistic" value="Вывести статистику за сезон"/>
        </form>';
echo '<div id="mes"></div>';
}
?>
<script>
    let form = document.getElementById('Statistic');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        let SeasonId = document.getElementById("SelectSeason").value;
        $.ajax({
		    url: './pages/statistic.php',
		    data: {'SeasonId':SeasonId, 'SelectShowStatistic': 'Вывести статистику'},
		    dataType: "html",
		    method: "post",
		    success: function(data){
			    $('#mes').html(data);
		    },
	    });
    });
</script>
