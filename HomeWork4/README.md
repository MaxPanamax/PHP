# <b>Home work4</b>

Задание 1.<br>

В этом задании вам надо будет создать собственную упрощенную реализацию MVC паттерна.<br>
Создайте страницу view.php на которой создайте кнопку (или ссылку) с подписью All Records.<br>
Затем создайте два класса с именами MyController и MyModel.<br>
В классе MyController создайте метод с именем getAllRecords(). Этот метод должны стать обработчиками кнопки All Records.<br>
В классе MyModel создайте метод с именем getAllRecordsModel(). Этот метод должен выполнять запрос "select * from Pictures" и возвращать результат выполнения этого запроса (для этого задания вместо таблицы Pictures можно использовать любую другую таблицу).<br>
Вам надо использовать паттерн Dependancy Injection, чтобы в методе getAllRecords() класса MyController можно было вызывать метод getAllRecordsModel() класса MyModel. Результат вызова метода getAllRecordsModel() должен отображаться на странице view.php в табличном виде.<br>

<br>Задание 2.<br>

Для выполнения задания вам понадобится класс Picture со свойствами $id, $name, $size и $imagepath, созданный ранее. Если этого класса у вас нет, можно использовать любой другой.<br>
Создайте два файла с именами serialize.php и unserialize.php.<br>
В файле serialize.php создайте объект класса Picture (или другого класса). Сериализованный объект запишите в текстовый файл.<br>
Теперь в файле unserialize.php прочитайте из текстового файла строку и восстановите из нее исходный объект.<br>
Убедитесь, что восстановленный объект полностью функционален (вызовите от имени этого объекта какой-либо метод класса).<br>

# <b>Примечание</b>

В первом задании сначала создаем базу данных. Скрипт прилагаю (файл db.sql)
