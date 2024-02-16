<?php
$dsn = 'mysql:host=localhost;dbname=brihi__compnay';
$user = 'root';
$pass = 'Hossam2003@SQL';

try {
    $DB = new PDO($dsn, $user, $pass);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<form method='post'>";
    echo "<table border='1'>";
    echo "<tr><th>Matricule</th><th>Prenom</th><th>Nom</th><th>Date De Naissance</th><th>Fonction</th><th>Salaire</th><th>Service</th><th>dateEmbauche</th><th>UPDATE</th></tr>";

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
            echo "<td><input type='date' name='dateDeNaissance' value='" . $row['dateDeNaissance'] . "'></td>";
            echo "<td>
            <select class='form-select' name='fonction' required >";
            // Fetch and display fonction options
            $fonctionQuery = $DB->prepare("SELECT DISTINCT fonction FROM employe");
            $fonctionQuery->execute();
            while ($fonctionRow = $fonctionQuery->fetch(PDO::FETCH_ASSOC)) {
                if ($fonctionRow['fonction'] == $row['fonction']) {
                    echo "<option selected value='" . $fonctionRow['fonction'] . "'>" . $fonctionRow['fonction'] . "</option>";
                } else {
                    echo "<option value='" . $fonctionRow['fonction'] . "'>" . $fonctionRow['fonction'] . "</option>";
                }
            }
            echo "</select> <br></td>";
            echo "<td><input type='text' name='salaire' value='" . $row['salaire'] . "'></td>";
            echo "<td>
            <select class='form-select' name='service' required >";
            // Fetch and display service options
            $serviceQuery = $DB->prepare("SELECT * FROM service");
            $serviceQuery->execute();
            while ($serviceRow = $serviceQuery->fetch(PDO::FETCH_ASSOC)) {
                if ($serviceRow['IdService'] == $row['IdService']) {
                    echo "<option selected value='" . $serviceRow['IdService'] . "'>" . $serviceRow['nomService'] . "</option>";
                } else {
                    echo "<option value='" . $serviceRow['IdService'] . "'>" . $serviceRow['nomService'] . "</option>";
                }
            }
            echo "</select> <br></td>";
            echo "<td><input type='date' name='dateEmbauche' value='" . $row['dateEmbauche'] . "'></td>";
            echo "<td><input type='submit' name='UPDATE_DONE' value='DONE'></td>";
            echo "</tr>";
        }
    }

    echo "</table>";
    echo "</form>";

} catch (PDOException $e) {
    echo 'failed ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateDeNaissance = $_POST['dateDeNaissance'];
    $fonction = $_POST['fonction'];
    $salaire = $_POST['salaire'];
    $service = $_POST['service'];
    $dateEmbauche = $_POST['dateEmbauche'];
    $Matricule = $_GET['Matricule']; // Added this line to retrieve Matricule

    $updateDATA = $DB->prepare("UPDATE employe 
                            INNER JOIN service ON employe.IdService = service.IdService 
                            SET nom = :nom, prenom = :prenom, dateDeNaissance = :dateDeNaissance, fonction = :fonction, salaire = :salaire, employe.IdService = :IdService, dateEmbauche = :dateEmbauche 
                            WHERE matricule = :Matricule");

    $updateDATA->bindParam(':nom', $nom);
    $updateDATA->bindParam(':prenom', $prenom);
    $updateDATA->bindParam(':dateDeNaissance', $dateDeNaissance);
    $updateDATA->bindParam(':fonction', $fonction);
    $updateDATA->bindParam(':salaire', $salaire);
    $updateDATA->bindParam(':IdService', $service);
    $updateDATA->bindParam(':dateEmbauche', $dateEmbauche);
    $updateDATA->bindParam(':Matricule', $Matricule);
    $updateDATA->execute();

    header("Location: USERS.php");
    exit();
}
?>
