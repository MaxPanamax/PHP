<?php
include_once("./pages/classes/news.php");
if (isset($_SESSION['ruser'])) {
  $arr = News::getAllNewsFromDb();
  echo '<h1 style="text-align: center;">Новости АПЛ</h1>';
  if ($arr != false) {
    echo '<div class="container">';
    echo '<div class="row">';
    foreach ($arr as $news) {
      echo '<div class="col-md-3 col-sm-6 col-xs-12">
              <div class="card" style="width: 18rem; margin: 20px;">
                <div class="card-body">
                  <h3 class="card-title">'.$news->Title.'</h3>
                  <p class="card-text">'.substr($news->Info,0,100).'....</p>
                  <a href="/exam/pages/info.php?Id=' . $news->Id . '&info=news" target="_blank" class="btn btn-primary">Подробнее</a>
                </div>
              </div>
            </div>';
    }
    echo '</div>';
    echo '</div>';
  }
} else {
  echo '<h1>ТОЛЬКО ДЛЯ ЗАРЕГИСТРИРОАННЫХ ПОЛЬЗОВАТЕЛЕЙ</h1>';
}
?>