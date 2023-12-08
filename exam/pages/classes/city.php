<?php

class City
{
    public $id;
    public $Name;

    public function __construct($name, $id = 0)
    {
        $this->id = $id;
        $this->Name = $name;
    }

    static function fromDb($Id): bool|City
    {
        $City = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM City WHERE Id=? LIMIT 1');
            $ps->execute(array($Id));
            if ($ps->rowCount() > 0) {
                $row = $ps->fetch();
                $City = new City($row['Name'], $row['Id']);
            } else {
                echo "<h3><span style='color:red;'>Стадион не найден</span></h3>";
                return false;
            }
            return $City;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function getAllCityFromDb(): array|bool
    {
        $cities = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM City');
            $ps->execute();
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $city = new City($row['Name'], $row['Id']);
                    $cities[] = $city;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $cities;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
