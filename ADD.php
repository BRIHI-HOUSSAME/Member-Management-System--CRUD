<?php
$dsn = 'mysql:host=localhost;dbname=brihi__compnay';
$user = 'root';
$pass = 'Hossam2003@SQL';

try {
    $DB = new PDO($dsn, $user, $pass);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<form method='post'>";
    echo "<table border='1'>";
    echo "<th>Nom</th><th>Prenom</th><th>Date De Naissance</th><th>Fonction</th><th>Salaire</th><th>Service</th><th>ADD</th></tr>";

   
            echo "<tr>";
            echo "<td><input type='text' name='nom' ></td>";
            echo "<td><input type='text' name='prenom' ></td>";
            echo "<td><input type='text' name='dateDeNaissance' ></td>";
            echo "<td><input type='text' name='fonction' ></td>";
            echo "<td><input type='text' name='salaire' ></td>";
            echo "<td><input type='text' name='nomService' ></td>";                
            echo "<td><input type='submit' name='ADD_DONE' value='DONE'></td>";
            echo "</tr>";

   

    echo "</table>"; 
    echo "</form>"; 

} 
    catch (PDOException $e) {
    echo 'failed ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateDeNaissance = $_POST['dateDeNaissance'];
    $fonction = $_POST['fonction'];
    $salaire = $_POST['salaire'];
    $nomService = $_POST['nomService'];

    
    $updateDATA = $DB->prepare("INSERT INTO employe (nom, prenom, dateDeNaissance, fonction, salaire) VALUES (:nom, :prenom, :dateDeNaissance, :fonction, :salaire)");
    $updateDATA->bindParam(':nom', $nom);
    $updateDATA->bindParam(':prenom', $prenom);
    $updateDATA->bindParam(':dateDeNaissance', $dateDeNaissance);
    $updateDATA->bindParam(':fonction', $fonction);
    $updateDATA->bindParam(':salaire', $salaire);
    // $updateDATA->bindParam(':Matricule', $Matricule);
    $updateDATA->execute();


    header("Location: USERS.php"); 
    exit();
 

}







?>
