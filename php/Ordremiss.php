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

// Requête pour récupérer les données de la table employe
$sql_mat = "SELECT matricule FROM employe";
$result_mat = $conn->query($sql_mat);

// Traitement du formulaire
if(isset($_POST['matricule'])) {
    // Récupération du matricule sélectionné
    $matricule = $_POST['matricule'];

    // Requête SQL pour récupérer les informations associées au matricule
    $query = "SELECT nom, prenom FROM employe WHERE matricule = :matricule";
    $statement = $conn->prepare($query);
    $statement->bindParam(':matricule', $matricule);
    $statement->execute();
    
    // Récupération des informations dans des variables
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $nom = $row['nom'];
    $prenom = $row['prenom'];
}

function showErrorAlert($message) {
    echo '<script>Swal.fire("Erreur", "' . $message . '", "error")</script>';
}

function showSuccessAlert($message) {
    echo '<script>Swal.fire("Succès", "' . $message . '", "success")</script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Page Gestionnaire</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/Ordremiss.css">

</head>
<body>
    <div class="grid-container">
        <!-- Entete -->
        <header class="header">
            <div class="menu-icon">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
            </div>
            <div class="header-right">
                <span><i class='bx bx-bell'></i></span>
                <span><i class='bx bx-envelope'></i></span>
                <span><i class='bx bx-user'></i></span>
            </div>
        </header>
        <!-- Fin d'Entete -->

        <!-- menu -->
        <aside id="sidebar"> 
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <img src="../pictures/logo-naftal.png" alt="">
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="dashboardGest.html" target="_blank">
                        <i class='bx bxs-dashboard icon'></i>
                        <span class="text nav-text">Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="DV" target="_blank">
                        <i class='bx bx-git-pull-request icon'></i>
                        <span class="text nav-text">Demande de véhicule</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#BC" target="_blank">
                        <i class='bx bx-receipt icon'></i>
                        <span class="text nav-text">Bon de Commande</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="OM" target="_blank">
                        <i class='bx bx-list-check icon'></i>
                        <span class="text nav-text">Ordres de Mission</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="SV" target="_blank">
                        <i class='bx bxs-car-mechanic icon'></i>
                        <span class="text nav-text">Suivi de Véhicule</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="DI" target="_blank">
                        <i class='bx bx-wrench icon'></i>
                        <span class="text nav-text">Demande d'interventions</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="RA" target="_blank">
                        <i class='bx bxs-car-crash icon'></i>
                        <span class="text nav-text">Rapport d'Accident</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="parametre" target="_blank">
                        <i class='bx bx-cog icon' ></i>
                        <span class="text nav-text">Paramétres</span>
                    </a>
                </li>
            </ul>
        </aside>
        <main class="main-container">    
            <form method="post" action="">
                <h1>Ordre de Mission</h1>
                <h3>Veuillez Remplir Tous les champs!</h3>
                <div class="input">
                <?php
               // Assurez-vous que $nom et $prenom sont définis
               $nom = isset($nom) ? $nom : '';
               $prenom = isset($prenom) ? $prenom : '';
                ?>
                <label>Nom et Prénom  :<input type="text" name="nom_prenom" id="nom_prenom" value="<?php echo isset($nom) ? $nom . ' ' . $prenom : ''; ?>"></label>
                <label>Matricule  :
                <select autocomplete="off"type="number" name="matricule">
                <?php while($row = $result_mat->fetch(PDO::FETCH_ASSOC))  { ?>
                    <option><?php echo $row ['matricule']?></option>
                    <?php } ?>
                </select></label>
                </div>
                <div class="input">
                    <label>adresse administratif :<input type="text" name="adress_admin" id="adress_admin"></label>
                    <label>Fonction:<input type="text" name="adress_admin"></label>
                </div>
                <div class="input">
                    <label>Moyen de déplacement:<input type="text" name="matricule_v"></label>
                    <label>Déstination:<input type="text" name="emplacement"></label>
                </div>
                <div class="motif">
                <label>Motif:</label><input type="text" name="raison" id="raison">
                </div>
                <div class="input">
                    <label>Date de déplacement:<input type="date" name="date_dep"></label>
                    <label>Date De Retour:<input type="date" name="date_ret"></label>
                </div>
                <footer>
                    <button type="submit" name="Enregistrer">Enregistrer</button>
                    <button onclick="imprimerPage()">Imprimer</button>
                </footer>
            </form>   
        </main>
    </div>
</body>
<!-- Scripts -->
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/Ordremiss.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</html>
<?php
 echo "Matricule sélectionné : " . $matricule; 
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
    if ($statement->rowCount() > 0) {
        // Récupération des informations dans des variables
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $adresse_admin = $row['adresse_admin'];
    } else {
        showErrorAlert("Aucune information trouvée pour ce matricule.");
    }
    $adress_admin = isset($_POST['adress_admin']) ? $_POST['adress_admin'] : '';
$matricule_v = isset($_POST['matricule_v']) ? $_POST['matricule_v'] : '';
$date_dep = isset($_POST['date_dep']) ? $_POST['date_dep'] : '';
$date_ret = isset($_POST['date_ret']) ? $_POST['date_ret'] : '';
$raison = isset($_POST['raison']) ? $_POST['raison'] : '';
    ?>