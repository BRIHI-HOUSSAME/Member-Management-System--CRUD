<?php

$dsn = 'mysql:host=localhost;dbname=brihi__compnay';
$user = 'root';
$pass = 'Hossam2003@SQL';

try {
    $DB = new PDO($dsn, $user, $pass);

    if (isset($_GET['Matricule'])) {
        $Matricule = $_GET['Matricule'];

        $prepareSql = "DELETE FROM employe WHERE matricule = :Matricule";
        $statement = $DB->prepare($prepareSql);
        $statement->bindParam(':Matricule', $Matricule);
        $statement->execute();

        header("location: USERS.php");
        exit;
    }
} catch (PDOException $e) {
    print $e->getMessage();
}
 