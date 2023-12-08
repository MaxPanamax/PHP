<?php
class MyModel
{

    public function getAllRecordsModel(): array|bool
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");
            $sql = "SELECT * FROM picture";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
