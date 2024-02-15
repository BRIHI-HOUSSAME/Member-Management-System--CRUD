<?php
    $dsn = 'mysql:host=localhost;dbname=brihi__compnay';
    $user = 'root';
    $pass = 'Hossam2003@SQL';

    try {
        $DB = new PDO($dsn, $user, $pass);
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
        echo "<table border='1'>";
        echo "<tr><th>Matricule</th><th>Nom</th><th>Prenom</th><th>Date De Naissance</th><th>Fonction</th><th>Salaire</th><th>Service</th><<th>UPDATE</th></tr>";

        if (isset($_GET['Matricule'])) {
            $Matricule = $_GET['Matricule'];
            $DATA = $DB->prepare("SELECT * FROM employe INNER JOIN service ON employe.IdService = service.IdService WHERE matricule = :Matricule");
            $DATA->bindParam(':Matricule', $Matricule);
            $DATA->execute();
    
            while ($row = $DATA->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['matricule'] . "</td>";
                echo "<td><input type='text' name='nom' value='" . $row['nom'] . "'></td>";
                echo "<td><input type='text' name='prenom' value='" . $row['prenom'] . "'></td>";
                echo "<td><input type='text' name='dateDeNaissance' value='" . $row['dateDeNaissance'] . "'></td>";
                echo "<td><input type='text' name='fonction' value='" . $row['fonction'] . "'></td>";
                echo "<td><input type='text' name='salaire' value='" . $row['salaire'] . "'></td>";
                echo "<td><input type='text' name='nomService' value='" . $row['nomService'] . "'></td>";                
                echo "<td> <a href='UPDATE.php?Matricule=" . $row['matricule'] ."'>UPDATE</a> </td>";
                echo "</tr>";
            }
        }  

    } catch (PDOException $e) {
        echo 'failed ' . $e->getMessage();
    }

?>
