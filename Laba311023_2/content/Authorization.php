<div class="authorization">
    <form action="./index.php?Authorization" id="myForm" method="post">
        <p><?php echo $errmassage;?></p>
        <label for="login">Логин: </label>
        <input type="text" id="login" name="login" />
        <label for="password">Пароль: </label>
        <input type="password" id="password" name="password" />
        <button type="submit">Отправить</button>
        <p>Если у тебя нет учетки, то <a href="./index.php?Registration">Зарегистрироваться</a></p>
    </form>
</div>