<!DOCTYPE html>
<html>
<head>
    <title>Show Users</title>
</head>
<body>
    <h1>Show Users</h1>
    <table>
        <tr>
            <th>Login</th>
            <th>Email</th>
            <!-- Другие заголовки столбцов -->
        </tr>
        <?php
        $users = file("users.txt", FILE_IGNORE_NEW_LINES);
        foreach ($users as $user) {
            $userData = explode(":", $user);
            echo "<tr>";
            echo "<td>".$userData[0]."</td>";
            echo "<td>".$userData[2]."</td>";
            // Вывод других полей
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>