<?php
include_once("./pages/classes/team.php");
include_once("./pages/classes/db.php");
include_once("./pages/classes/city.php");
include_once("./pages/classes/coach.php");
include_once("./pages/classes/stadium.php");

$titleForm = "Добавление команды";
if (isset($_POST["delTeam"])) {
    $id = $_POST["Id"];
    Team::deleteTeam($id);
}

if (isset($_POST["editTeam"])) {
    $id = $_POST["Id"];
    $team = Team::fromDb($id);
    $titleForm = "Редактирование команды с Id " . $id . "";
}

if (isset($_POST["updateTeam"])) {
    $team = new Team($_POST['Name'],$_POST['Info'], null, $_POST['CityId'],$_POST['CoachId'],$_POST['StadiumId'], $_POST['Id']);
    $team->updateTeamInDb();
}

if (isset($_POST["updateAvatar"])){
    $id = $_POST["Id"];
    $fn = $_FILES['Avatar']['tmp_name'];
    $file = fopen($fn, 'rb');
    $img = fread($file, filesize($fn));
    fclose($file);
    $img = addslashes($img);
    Team::updateAvatarTeam($id, $img);
}

if (isset($_POST["addTeam"])) {
    $fn = $_FILES['Avatar']['tmp_name'];
    $file = fopen($fn, 'rb');
    $img = fread($file, filesize($fn));
    fclose($file);
    $img = addslashes($img);



    $team = new Team($_POST['Name'],$_POST['Info'], $img, $_POST['CityId'],$_POST['CoachId'],$_POST['StadiumId'], 0);
    $team->intoDb();
}



$teams = Team::getAllTeamsFromDb();

?>

<div class="container" style="margin-bottom: 10px;">
    <h1><?= $titleForm ?></h1>
    <form action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="Id" id="Id" value="<?= isset($_POST["editTeam"]) ? $team->Id : 0 ?>" required>

         <div class="form-group">
            <label for="Name">Наименование команды</label>
            <input type="text" class="form-control" name="Name" value="<?= isset($_POST["editTeam"]) ? $team->Name : "" ?>" required>
        </div>

        <div class="form-group">
            <label for="Info">Информация</label>
            <textarea name="Info" class="form-control" cols="40" rows="5" required><?= isset($_POST["editTeam"]) ? $team->Info : "" ?></textarea>
        </div>



         <div class="form-group">
            <label for="City">Город</label>
            <select class="form-control" name="CityId" id="City">
            <?php
            $cities = City::getAllCityFromDb();
            foreach ($cities as $city) {
                if ((isset($_POST["editTeam"])) && ($city->id==$team->CityId)){
                    echo "<option selected value='" . $city->id . "'>" . $city->Name . "</option>";
                }
                else{
                    echo "<option value='" . $city->id . "'>" . $city->Name . "</option>";
                }
            }
            ?>
            </select>
        </div>

        <?php
        if (!isset($_POST["editTeam"])) {
            echo '<input type="file" id="Avarat" class="btn btn-sm btn-info" name="Avatar" accept="image/*" required>';
        }
        ?>
        <div class="form-group">
            <label for="Coach">Главный тренер</label>
            <select class="form-control" name="CoachId" id="Coach">
            <?php
            $coaches = Coach::getAllCoachFromDb();
            foreach ($coaches as $coach) {
                if ((isset($_POST["editTeam"])) && ($coach->Id==$team->CoachId)){
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
            <label for="Stadium">Стадион</label>
            <select class="form-control" name="StadiumId" id="Stadium">
            <?php
            $stadiums = Stadium::getAllStadiumFromDb();
            foreach ($stadiums as $stadium) {
                if ((isset($_POST["editTeam"])) && ($stadium->Id==$team->StadiumId)){
                    echo "<option selected value='" . $stadium->Id . "'>" . $stadium->Name . "</option>";
                }
                else{
                    echo "<option value='" . $stadium->Id . "'>" . $stadium->Name . "</option>";
                }
            }
            ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="<?= isset($_POST["editTeam"]) ? "updateTeam" : "addTeam" ?>"><?= isset($_POST["editTeam"]) ? "Редактирование команды" : "Добавление команды" ?></button>
    </form>
</div>

<?php


echo '<h1 style="text-align: center;">Список команд</h1>';
if ($teams != false) {
    echo '<table class="table table-bordered table-hover">';
    echo '<thead>
            <tr>
                <th>Id команды</th>
                <th>Наименование команды</th>
                <th>Информация</th>
                <th>Эмблема</th>
                <th>Город</th>
                <th>Главный тренер</th>
                <th>Домашний стадион</th>
                <th>Изменить аватар</th>
                <th>Изменить данные команды</th>
                <th>Удалить команду</th>
            </tr>
          </thead>';
    foreach ($teams as $team) {
        if ($team->Avatar != null) {
            $avatar = base64_encode($team->Avatar);
        }
        echo '<tr>';
        echo '<td>' . $team->Id . '</td>';
        echo '<td><a href="/exam/pages/info.php?Id=' . $team->Id . '&info=team" target="_blank">' . $team->Name . '</a></td>';
        echo '<td>' . $team->Info . '</td>';
        echo '<td><img height="50px" src="data:image/jpeg; base64, ' . $avatar . '"></td>';
        echo '<td>' . $team->getCityInfo()->Name . '</td>';
        echo '<td><a href="/exam/pages/info.php?Id=' . $team->getCoachInfo()->Id . '&info=coach" target="_blank">' . $team->getCoachInfo()->FullName . '</a></td>';
        echo '<td><a href="/exam/pages/info.php?Id=' . $team->getStadiumInfo()->Id . '&info=stadium" target="_blank">' . $team->getStadiumInfo()->Name . '</a></td>';
        echo '<td><form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="Id" id="Id" value="' . $team->Id . '"/>
                    <input type="file" id="Avarat" class="btn btn-sm btn-info" name="Avatar" accept="image/*" required>
                    <input type="submit" name="updateAvatar" class="btn btn-primary" value="Обновить аватар">
                  </form>
              </td>';
        echo '<td><form action="" method="post">
                    <input type="hidden" name="Id" id="Id" value="' . $team->Id . '"/>
                    <input type="submit" name="editTeam" class="btn btn-primary" value="Изменить данные">
                   </form>
              </td>';
        echo '<td><form action="" method="post">
                    <input type="hidden" name="Id" id="Id" value="' . $team->Id . '"/>
                    <input type="submit" name="delTeam" class="btn btn-primary" value="Удалить команду">
                  </form>
              </td>';
        echo '</tr>';
    }
    echo '</table>';
}
