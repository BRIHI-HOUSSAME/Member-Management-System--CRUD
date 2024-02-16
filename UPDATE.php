<?php
$dsn = 'mysql:host=localhost;dbname=brihi__compnay';
$user = 'root';
$pass = 'Hossam2003@SQL';

try {
    $DB = new PDO($dsn, $user, $pass);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<form method='post'>";
    echo "<table border='1'>";
    echo "<tr><th>Matricule</th><th>Nom</th><th>Prenom</th><th>Date De Naissance</th><th>Fonction</th><th>Salaire</th><th>Service</th><th>UPDATE</th></tr>";

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
            echo "<td><input type='submit' name='UPDATE_DON' value='DONE'></td>";
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
    $nomService = $_POST['nomService'];

    
    $updateDATA = $DB->prepare("UPDATE employe SET nom = :nom, prenom = :prenom, dateDeNaissance = :dateDeNaissance, fonction = :fonction, salaire = :salaire WHERE matricule = :Matricule");
    $updateDATA->bindParam(':nom', $nom);
    $updateDATA->bindParam(':prenom', $prenom);
    $updateDATA->bindParam(':dateDeNaissance', $dateDeNaissance);
    $updateDATA->bindParam(':fonction', $fonction);
    $updateDATA->bindParam(':salaire', $salaire);
    $updateDATA->bindParam(':Matricule', $Matricule);
    $updateDATA->execute();


    header("Location: USERS.php"); 
    exit();
 

}







?>
