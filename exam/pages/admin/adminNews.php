<?php
include_once("./pages/classes/news.php");
include_once("./pages/classes/db.php");

$titleForm = "Добаление новости";
if (isset($_POST["delNews"])) {
    $id = $_POST["Id"];
    News::deleteNews($id);
}

if (isset($_POST["updateNews"])) {
    $news = new News($_POST["Title"],$_POST["DateNews"],$_POST["Info"],$_POST["Id"]);
    $news->updateNewsInDb();
}

if (isset($_POST["addNews"])) {
    $news = new News($_POST["Title"],$_POST["DateNews"],$_POST["Info"],$_POST["Id"]);
    $news->intoDb();
}


if (isset($_POST["editNews"])) {
    $id = $_POST["Id"];
    $news = News::fromDb($id);
    $titleForm = "Редактирование новости с Id " . $id . "";
}
?>




<div class="container" style="margin-bottom: 10px;">
    <h1><?= $titleForm ?></h1>
    <form action="" method="post">
        <input type="hidden" name="Id" id="Id" value="<?= isset($_POST["editNews"]) ? $news->Id : 0 ?>" required>
        <div class="form-group">
            <label for="Title">Заголовок</label>
            <input type="text" class="form-control" name="Title" value="<?= isset($_POST["editNews"]) ? $news->Title : "" ?>" required>
        </div>
        <div class="form-group">
            <label for="DateNews">Дата публикации</label>
            <input type="date" class="form-control" name="DateNews" value="<?= isset($_POST["editNews"]) ? $news->DateNews : "" ?>" required>
        </div>
        <div class="form-group">
            <label for="Info">Содержание ноновсти</label>
            <textarea name="Info" class="form-control" cols="40" rows="5" required><?= isset($_POST["editNews"]) ? $news->Info : "" ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="<?= isset($_POST["editNews"]) ? "updateNews" : "addNews" ?>"><?= isset($_POST["editNews"]) ? "Редактирование новости" : "Добавление новости" ?></button>
    </form>
</div>

<?php
$newsArr = News::getAllNewsFromDb();
echo '<table class="table table-bordered table-hover">';
echo '<thead><tr><th>Id новости</th><th>Заголовок</th><th>Дата публикации</th><th>Текстовая информация</th><th>Изменить новость</th><th>Удалить новость</th></tr></thead>';
if ($newsArr != false) {
    foreach ($newsArr as $news) {
        echo '<tr>';
        echo '<td>' . $news->Id . '</td>';
        echo '<td><a href="./pages/info.php?Id=' . $news->Id . '&info=news" target="_blank">' . $news->Title . '</a></td>';
        echo '<td>' . $news->DateNews . '</td>';
        echo '<td>' . $news->Info . '</td>';
        echo '<td><form id="newsDelete" action="" method="post">
                    <input type="hidden" name="Id" id="Id" value="' . $news->Id . '"/>
                    <input type="submit" name="editNews" class="btn btn-primary" value="Изменить новость">
                  </form>
              </td>';
        echo '<td><form id="newsDelete" action="" method="post">
                        <input type="hidden" name="Id" id="Id" value="' . $news->Id . '"/>
                        <input type="submit" name="delNews" class="btn btn-primary" value="Удалить новость">
                   </form>
              </td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>