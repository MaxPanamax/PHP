<?php
class Season
{
    public int $Id;
    public string $Name;
    public function __construct($Name, $Id = 0)
    {
        $this->Id = $Id;
        $this->Name = $Name;
    }

    static function fromDb($Id): bool|Season
    {
        $season = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Season WHERE Id=? LIMIT 1');
            $ps->execute(array($Id));
            if ($ps->rowCount() > 0) {
                $row = $ps->fetch();
                $season = new Season($row['Name'], $row['Id']);
            } else {
                echo "<h3><span style='color:red;'>Нет данных</span></h3>";
                return false;
            }
            return $season;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function getAllSeasonFromDb(): array|bool
    {
        $seasons = null;
        try {
            $pdo = Db::connect();
            $ps = $pdo->prepare('SELECT * FROM Season');
            $ps->execute();
            if ($ps->rowCount() > 0) {
                while ($row = $ps->fetch()) {
                    $season = new Season($row['Name'], $row['Id']);
                    $seasons[] = $season;
                }
            } else {
                echo '<h1>Нет данных</h1>';
                return false;
            }
            return $seasons;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
