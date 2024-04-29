<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parc_auto";

try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    showErrorAlert("La connexion a échoué : " . $e->getMessage());
}

if (isset($_POST['Enregistrer'])) {
    $matricule = $_POST['matricule'];
    $nom_prenom = $_POST['nom_prenom'];
    $adress_admin = $_POST['adress_admin'];
    $matricule_v = $_POST['matricule_v'];
    $date_dep = $_POST['date_dep'];
    $date_ret = $_POST['date_ret'];
    $raison = $_POST['raison'];

    if (empty($matricule) || empty($nom_prenom) || empty($adress_admin) || empty($matricule_v)
        || empty($date_dep) || empty($date_ret) || empty($raison)) {
        showErrorAlert("Veuillez remplir tous les champs.");
    } else {
            // Le matricule et le véhicule existent, donc vous pouvez l'insérer dans la table ordre_mission
            try {
                // Préparation et exécution de la requête d'insertion
                $sql = "INSERT INTO ordre_mission (matricule, nom_prenom, adress_admin, matricule_v, date_dep, date_ret, raison) 
                        VALUES (:matricule, :nom_prenom, :adress_admin, :matricule_v, :date_dep, :date_ret, :raison)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':matricule', $matricule);
                $stmt->bindParam(':nom_prenom', $nom_prenom);
                $stmt->bindParam(':adress_admin', $adress_admin);
                $stmt->bindParam(':matricule_v', $matricule_v);
                $stmt->bindParam(':date_dep', $date_dep);
                $stmt->bindParam(':date_ret', $date_ret);
                $stmt->bindParam(':raison', $raison);
                $stmt->execute();
                showSuccessAlert("L'Ordre de mission a été enregistré avec succès.");
            } catch (PDOException $e) {
                showErrorAlert("Une erreur est survenue lors de l'enregistrement : " . $e->getMessage());
            }
        } 
    }   


function showErrorAlert($message) {
    echo '<script>Swal.fire("Erreur", "' . $message . '", "error")</script>';
}

function showSuccessAlert($message) {
    echo '<script>Swal.fire("Succès", "' . $message . '", "success")</script>';
}
?>