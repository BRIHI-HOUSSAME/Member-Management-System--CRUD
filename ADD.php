<?php
$dsn = 'mysql:host=localhost;dbname=brihi__compnay';
$user = 'root';
$pass = 'Hossam2003@SQL';

try {
    $DB = new PDO($dsn, $user, $pass);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<form method='post'>";
    echo "<table border='1'>";
    echo "<th>Prenom</th><th>Nom</th><th>Date De Naissance</th><th>Fonction</th><th>Salaire</th><th>Service</th><th>DateEmbauche</th><th>ADD</th></tr>";

    echo "<tr>";
    echo "<td><input type='text' name='prenom' required></td>";
    echo "<td><input type='text' name='nom' required></td>";
    echo "<td><input type='date' name='dateDeNaissance' required></td>";
    echo "<td>
    <select class='form-select' name='fonction' required >";

    $fonctionQuery = $DB->prepare("SELECT DISTINCT fonction FROM employe");
    $fonctionQuery->execute();
    while ($fonctionRow = $fonctionQuery->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $fonctionRow['fonction'] . "'>" . $fonctionRow['fonction'] . "</option>";
    }
    echo "</select> <br></td>";
    echo "<td><input type='text' name='salaire' required></td>";
    echo "<td>
    <select class='form-select' name='service' required >";

    $serviceQuery = $DB->prepare("SELECT * FROM service");
    $serviceQuery->execute();
    while ($serviceRow = $serviceQuery->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $serviceRow['IdService'] . "'>" . $serviceRow['nomService'] . "</option>";
    }
    echo "</select> <br></td>";
    echo "<td><input type='date' name='dateEmbauche' required></td>";
    echo "<td><input type='submit' name='ADD_DONE' value='DONE'></td>";
    echo "</tr>";

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

    $updateDATA = $DB->prepare("INSERT INTO employe (prenom,nom,dateDeNaissance, fonction, salaire, IdService, dateEmbauche) VALUES (:nom, :prenom, :dateDeNaissance, :fonction, :salaire, :IdService, :dateEmbauche)");
    $updateDATA->bindParam(':prenom', $prenom);
    $updateDATA->bindParam(':nom', $nom);
    $updateDATA->bindParam(':dateDeNaissance', $dateDeNaissance);
    $updateDATA->bindParam(':fonction', $fonction);
    $updateDATA->bindParam(':salaire', $salaire);
    $updateDATA->bindParam(':IdService', $service);
    $updateDATA->bindParam(':dateEmbauche', $dateEmbauche);
    $updateDATA->execute();

    header("Location: USERS.php"); 
    exit();
}
?>
