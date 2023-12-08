<?php
include_once("./pages/classes/db.php");
include_once("./pages/classes/coach.php");
include_once("./pages/classes/stadium.php");
include_once("./pages/classes/season.php");
include_once("./pages/classes/game.php");

$titleForm = "Добавление игры";
$seasons = Season::getAllSeasonFromDb();
if (!isset($_SESSION['lastClickSeason'])){
    $SeasonId = $seasons[0]->Id;
}
else{
    $SeasonId = $_SESSION['lastClickSeason'];
}
if (isset($_POST["SelectAllGameSeason"])){
    $_SESSION['lastClickSeason'] = $_POST['SeasonId'];
    $SeasonId = $_SESSION['lastClickSeason'];
}

if (isset($_POST["delGame"])) {
    $id = $_POST["Id"];
    Game::deleteGame($id);
}

echo '<p></p>';
echo '<form action="" method="post">
        <div class="form-group">
            <label for="SelectSeason">Сезон: </label>
            <select class="form-select" name="SeasonId" id="SelectSeason">';
            foreach ($seasons as $season) {
                echo "<option value='" . $season->Id . "'>" . $season->Name . "</option>";
            }
            echo '</select>
        </div>
        <input type="submit" class="btn btn-primary" name="SelectAllGameSeason" value="Вывести список игр"/>
    </form>';
echo '<div id="mes"></div>';

if (isset($_POST["editGame"])) {
    $id = $_POST["Id"];
    $game = Game::fromDb($id);
    $titleForm = "Редактирование игры с Id " . $id . "";
}

if (isset($_POST["updateGame"])) {
    $game = new Game($_POST['DateBegin'],$_POST['StadiumId'],$_POST['Tour'],$_POST['SeasonId'],$_POST['TeamHome'],$_POST['TeamGuest'],$_POST['CoachTeamHome'],$_POST['CoachTeamGuest'],$_POST['GoalScoredTeamHome'],$_POST['GoalScoredTeamGuest'],$_POST['Id']);
    $game->updateGameInDb();
}

if (isset($_POST["addGame"])) {
    $game = new Game($_POST['DateBegin'],$_POST['StadiumId'],$_POST['Tour'],$_POST['SeasonId'],$_POST['TeamHome'],$_POST['TeamGuest'],$_POST['CoachTeamHome'],$_POST['CoachTeamGuest'],$_POST['GoalScoredTeamHome'],$_POST['GoalScoredTeamGuest'],$_POST['Id']);
    $game->intoDb();
}

?>
<div class="container" style="margin-bottom: 10px;">
    <h1><?= $titleForm ?></h1>
    <form action="" method="post">
         <input type="hidden" name="Id" id="Id" value="<?= isset($_POST["editGame"]) ? $game->Id : 0 ?>" required>

         <div class="form-group">
            <label for="DateBegin">Дата матча</label>
            <input type="date" class="form-control" name="DateBegin" value="<?= isset($_POST["editGame"]) ? $game->DateBegin : "" ?>" required>
        </div>

         <div class="form-group">
            <label for="Stadium">Стадион</label>
            <select class="form-control" name="StadiumId" id="Stadium">
            <?php
            $stadiums = Stadium::getAllStadiumFromDb();
            foreach ($stadiums as $stadium) {
                if ((isset($_POST["editGame"])) && ($stadium->Id==$game->StadiumId)){
                    echo "<option selected value='" . $stadium->Id . "'>" . $stadium->Name . "</option>";
                }
                else{
                    echo "<option value='" . $stadium->Id . "'>" . $stadium->Name . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="Tour">Тур</label>
            <select class="form-control" name="Tour" id="Tour">
            <?php
            for ($i = 1; $i <= 38; $i++) { 
                if ((isset($_POST["editGame"])) && ($i==$game->Tour)){
                    echo "<option selected value='" . $i . "'>" . $i . "</option>";
                }
                else{
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <input type="hidden" name="SeasonId" id="SeasonId" value="<?= isset($_POST["editGame"]) ? $game->SeasonId : $SeasonId ?>" required>

        <div class="form-group">
            <label for="TeamHome">Команда хозяев</label>
            <select class="form-control" name="TeamHome" id="TeamHome">
            <?php
            $teams = Team::getAllTeamsFromDb();
            foreach ($teams as $team) {
                if ((isset($_POST["editGame"])) && ($team->Id==$game->TeamHome)){
                    echo "<option selected value='" . $team->Id . "'>" . $team->Name . "</option>";
                }
                else{
                    echo "<option value='" . $team->Id . "'>" . $team->Name . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="TeamGuest">Команда гостей</label>
            <select class="form-control" name="TeamGuest" id="TeamGuest">
            <?php
            $teams = Team::getAllTeamsFromDb();
            foreach ($teams as $team) {
                if ((isset($_POST["editGame"])) && ($team->Id==$game->TeamGuest)){
                    echo "<option selected value='" . $team->Id . "'>" . $team->Name . "</option>";
                }
                else{
                    echo "<option value='" . $team->Id . "'>" . $team->Name . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="CoachTeamHome">Тренер команды хозяев</label>
            <select class="form-control" name="CoachTeamHome" id="CoachTeamHome">
            <?php
            $coaches = Coach::getAllCoachFromDb();
            foreach ($coaches as $coach) {
                if ((isset($_POST["editGame"])) && ($coach->Id==$game->CoachTeamHome)){
                    echo "<option selected value='" . $coach->Id . "'>" . $coach->FullName . "</option>";
                }
                else{
                    echo "<option value='" . $coach->Id . "'>" . $coach->FullName . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="CoachTeamGuest">Тренер команды гостей</label>
            <select class="form-control" name="CoachTeamGuest" id="CoachTeamGuest">
            <?php
            foreach ($coaches as $coach) {
                if ((isset($_POST["editGame"])) && ($coach->Id==$game->CoachTeamGuest)){
                    echo "<option selected value='" . $coach->Id . "'>" . $coach->FullName . "</option>";
                }
                else{
                    echo "<option value='" . $coach->Id . "'>" . $coach->FullName . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="GoalScoredTeamHome">Голов забито командой хозяев</label>
            <select class="form-control" name="GoalScoredTeamHome" id="GoalScoredTeamHome">
            <?php
            for ($i = 0; $i <= 38; $i++) { 
                if ((isset($_POST["editGame"])) && ($i==$game->GoalScoredTeamHome)){
                    echo "<option selected value='" . $i . "'>" . $i . "</option>";
                }
                else{
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="GoalScoredTeamGuest">Голов забито командой гостей</label>
            <select class="form-control" name="GoalScoredTeamGuest" id="GoalScoredTeamGuest">
            <?php
            for ($i = 0; $i <= 38; $i++) { 
                if ((isset($_POST["editGame"])) && ($i==$game->GoalScoredTeamGuest)){
                    echo "<option selected value='" . $i . "'>" . $i . "</option>";
                }
                else{
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="<?= isset($_POST["editGame"]) ? "updateGame" : "addGame" ?>"><?= isset($_POST["editGame"]) ? "Редактирование игры" : "Добавление игры" ?></button>
    </form>
</div>


<?php



$games = GAME::getAllGamesSeason($SeasonId);
echo '<h1 style="text-align: center;">Список игр сезона '.Season::fromDb($SeasonId)->Name.'</h1>';
if ($games!=false){
    echo '<table class="table table-bordered table-hover">';
    echo '<thead>
            <tr>
                <th>Id игры</th>
                <th>Сезон</th>
                <th>Номер тура</th>
                <th>Дата начала игры</th>
                <th>Стадион</th>
                <th>Дата матча</th>
                <th>Эмблема команды хозяев</th>
                <th>Название команды хозяев</th>
                <th>Тренер команды хозяев</th>
                <th>Эмблема команды гостей</th>
                <th>Название команды гостей</th>
                <th>Тренер команды гостей</th>
                <th>Счет</th>
                <th>Подробнее о матче</th>
                <th>Изменить игру</th>
                <th>Удалить игру</th>
            </tr>
          </thead>';
    foreach ($games as $game) {
        $teamHome = $game->getTeam($game->TeamHome);
        $avaratTeamHome = base64_encode($teamHome->Avatar);
    
        $teamGuest = $game->getTeam($game->TeamGuest);
        $avaratTeamGuest = base64_encode($teamGuest->Avatar);

        echo '<tr>';
        echo '<td>'.$game->Id.'</td>';
        echo '<td>'.$game->getSeason()->Name.'</td>';
        echo '<td>'.$game->Tour.'</td>';
        echo '<td>'.$game->DateBegin.'</td>';
        echo '<td>'.$game->getStaduim()->Name.'</td>';
        echo '<td>'.$game->DateBegin.'</td>';

        echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $avaratTeamHome . '"></td>';
        echo '<td>'.$teamHome->Name.'</td>';

        echo '<td>'.$game->getCoach($game->CoachTeamHome)->FullName.'</td>';
    
        echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $avaratTeamGuest . '"></td>';
        echo '<td>'.$teamGuest->Name.'</td>';

        echo '<td>'.$game->getCoach($game->CoachTeamGuest)->FullName.'</td>';
    
        echo '<td>'.$game->GoalScoredTeamHome.' : '.$game->GoalScoredTeamGuest.'</td>';
            
        echo '<td><a href="/exam/pages/info.php?Id=' . $game->Id . '&info=game" target="_blank">Подробнее</a></td>';

        echo '<td><form id="newsDelete" action="" method="post">
                    <input type="hidden" name="Id" id="Id" value="' . $game->Id . '"/>
                    <input type="submit" name="editGame" class="btn btn-primary" value="Изменить данные">
                   </form>
              </td>';
        echo '<td><form id="newsDelete" action="" method="post">
                    <input type="hidden" name="Id" id="Id" value="' . $game->Id . '"/>
                    <input type="submit" name="delGame" class="btn btn-primary" value="Удалить игру">
                  </form>
              </td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>