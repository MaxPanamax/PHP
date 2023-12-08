<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <form action="index.php?page=1" class="navbar-form navbar-left" method="post">
                    <?php
                    include_once('pages/logon.php');
                    if (!isset($_SESSION["ruser"])) {
                    ?>
                        <div class="form-group">
                            <input type="text" name="login" class="input-sm" placeholder="login" required>
                            <input type="pass" name="pass" class="input-sm" placeholder="password" required>
                        </div>
                        <input type="submit" name="logon" class="btn btn-sm btn-default" value="Войти" />
                    <?php
                    } else {
                        echo '<label style="color:blue; font-size: 16pt;">Привет ' . $_SESSION['ruser'] . '</label>';
                        echo '<button type="submit" name="logout" class="btn btn-sm btn-default">Выйти</button>';
                    }
                    ?>
                </form>
                <?php
                ?>
            </ul>
            <ul class="nav navbar-nav">
                <li <?php echo ($page == 1) ? "class='active'" : "" ?>>
                    <a href="index.php?page=1">Стадионы</a>
                </li>
                <li <?php echo ($page == 2) ? "class='active'" : "" ?>>
                    <a href="index.php?page=2">Тренеры</a>
                </li>
                <li <?php echo ($page == 5) ? "class='active'" : "" ?>>
                    <a href="index.php?page=5">Команды</a>
                </li>
                <li <?php echo ($page == 6) ? "class='active'" : "" ?>>
                    <a href="index.php?page=6">Состав игроков</a>
                </li>

                <li <?php echo ($page == 7) ? "class='active'" : "" ?>>
                    <a href="index.php?page=7">Прошедшие игры</a>
                </li>

                <li <?php echo ($page == 8) ? "class='active'" : "" ?>>
                    <a href="index.php?page=8">Календарь будущих игр</a>
                </li>

                <li <?php echo ($page == 9) ? "class='active'" : "" ?>>
                    <a href="index.php?page=9">Статистика</a>
                </li>

                <li <?php echo ($page == 10) ? "class='active'" : "" ?>>
                    <a href="index.php?page=10">Новости АПЛ</a>
                </li>

                <?php
                if (!isset($_SESSION["ruser"])) {
                ?>
                    <li <?php echo ($page == 3) ? "class='active'" : "" ?>>
                        <a href="index.php?page=3">Registration</a>
                    </li>
                <?php
                }
                ?>

                <?php
                if (isset($_SESSION["radmin"])) {
                ?>
                    <li <?php echo ($page == 4) ? "class='active'" : "" ?>>
                        <a href="index.php?page=4">Admin - новости</a>
                    </li>
                <?php
                }
                ?>
               <?php
                if (isset($_SESSION["radmin"])) {
                ?>
                    <li <?php echo ($page == 11) ? "class='active'" : "" ?>>
                        <a href="index.php?page=11">Admin - игры</a>
                    </li>
                <?php
                }
                ?>
               <?php
                if (isset($_SESSION["radmin"])) {
                ?>
                    <li <?php echo ($page == 12) ? "class='active'" : "" ?>>
                        <a href="index.php?page=12">Admin - команды</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>