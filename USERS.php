<?php
    $dsn = 'mysql:host=localhost;dbname=brihi__compnay';
    $user = 'root';
    $pass = 'Hossam2003@SQL';

    try {
        $DB = new PDO($dsn, $user, $pass);
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $DATA = $DB->prepare("SELECT * FROM employe INNER JOIN service ON employe.IdService = service.IdService");
        $DATA->execute();

        echo "<table border='1'style='display: flex; justify-content: center; '>";
        echo "<tr><th>Matricule</th><th>Nom</th><th>Prenom</th><th>Date De Naissance</th><th>Fonction</th><th>Salaire</th><th>Service</th><th>DELETE</th><th>UPDATE</th></tr>";

        while ($row = $DATA->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['matricule'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['prenom'] . "</td>";
            echo "<td>" . $row['dateDeNaissance'] . "</td>";
            echo "<td>" . $row['fonction'] . "</td>";
            echo "<td>" . $row['salaire'] . "</td>";
            echo "<td>" . $row['nomService'] . "</td>";
            echo "<td> <a href='DELETE.php?Matricule=" . $row['matricule'] ."'>DELETE</a> </td>";
            echo "<td> <a href='UPDATE.php?Matricule=" . $row['matricule'] ."'>UPDATE</a> </td>";
        
            echo "</tr>";
        }

    } catch (PDOException $e) {
        echo 'failed ' . $e->getMessage();
    }



    echo "<a href='ADD.php'><h1 style='font-size: 24px; text-align: center;'>CLICK IF YOU WANT TO ADD A NEW MEMBER</h1></a>";




?>
