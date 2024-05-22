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
                Ordres Missions
            </div>
            <div class="header-right">
            <img src="../pictures/logo-naftal.png" alt="">
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
                    <a href="../php/dashboardGest.php" target="_self">
                        <i class='bx bxs-dashboard icon'></i>
                        <span class="text nav-text">Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="../php/demandeGest.php" target="_blank">
                        <i class='bx bx-git-pull-request icon'></i>
                        <span class="text nav-text">Demande de véhicule</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="../php/bondecommande.php" target="_self">
                        <i class='bx bx-receipt icon'></i>
                        <span class="text nav-text">Bon de Commande</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="../php/Ordremiss.php" target="_self">
                        <i class='bx bx-list-check icon'></i>
                        <span class="text nav-text">Ordres de Mission</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="../php/suiviv.php" target="_self">
                        <i class='bx bxs-car-mechanic icon'></i>
                        <span class="text nav-text">Suivi de Véhicule</span>
                    </a>
                </li>

                <li class="sidebar-list-item">
                    <a href="RA" target="_blank">
                        <i class='bx bxs-car-crash icon'></i>
                        <span class="text nav-text">Rapport d'Accident</span>
                    </a>
                </li>
 
            </ul>
        </aside>
        <main class="main-container">    
        <div id="form-container">
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
                <select id="matricule" autocomplete="off"type="number" name="matricule" onchange="this.form.submit()">
                <?php while($row = $result_mat->fetch(PDO::FETCH_ASSOC))  { ?>
                    <option value="<?php echo $row ['matricule']?>"><?php echo $row ['matricule']?></button></option>
                    <?php } ?>
                </select></label>
                </div>
                <div class="input">
                    <label>adresse administratif :<input type="text" name="adress_admin" id="adress_admin"></label>
                    <label>Fonction:<input type="text" name="adress_admin"></label>
                </div>
                <div class="input">
                    <label>Moyen de déplacement:<input type="text" name="matricule_v" id="matricule_v"></label>
                    <label>Déstination:<input type="text" name="emplacement" id="emplacement"></label>
                </div>
                <div class="motif">
                <label>Motif:</label><input type="text" name="raison" id="raison">
                </div>
                <div class="input">
                    <label>Date de déplacement:<input type="date" name="date_dep" id="date_dep"></label>
                    <label>Date De Retour:<input type="date" name="date_ret" id="date_ret"></label>
                </div>
                <footer>
                    <button type="submit" name="Enregistrer">Enregistrer</button>
                    <button onclick="imprimerPage()">Imprimer</button>
                    <button onclick="convertToPDF()">Convertir en PDF</button>
                </footer>
            </form>   
        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
<script>
    function convertToPDF() {
        // Créer un nouvel objet jsPDF
        const doc = new jsPDF();

        // Récupérer les valeurs des champs du formulaire
        const nom_prenom = document.getElementById('nom_prenom').value;
        const matricule = document.getElementById('matricule').value;
        const adress_admin = document.getElementById('adress_admin').value;
        const fonction = document.getElementById('fonction').value;
        const moyen_deplacement = document.getElementById('matricule_v').value;
        const emplacement = document.getElementById('emplacement').value;
        const raison = document.getElementById('raison').value;
        const date_dep = document.getElementById('date_dep').value;
        const date_ret = document.getElementById('date_ret').value;

        // Ajouter le contenu au PDF
        doc.text(20, 20, `Nom et Prénom: ${nom_prenom}`);
        doc.text(20, 30, `Matricule: ${matricule}`);
        doc.text(20, 40, `Adresse administratif: ${adress_admin}`);
        doc.text(20, 50, `Fonction: ${fonction}`);
        doc.text(20, 60, `Moyen de déplacement: ${moyen_deplacement}`);
        doc.text(20, 70, `Destination: ${emplacement}`);
        doc.text(20, 80, `Motif: ${raison}`);
        doc.text(20, 90, `Date de déplacement: ${date_dep}`);
        doc.text(20, 100, `Date de retour: ${date_ret}`);

        // Télécharger le PDF
        doc.save('ordre_de_mission.pdf');
    }
</script>

</html>
<?php
if (isset($_POST['Enregistrer'])) {
    $matricule = $_POST['matricule'];
    $nom_prenom = $_POST['nom_prenom'];
    $adress_admin = $_POST['adress_admin'];
    $matricule_v = $_POST['matricule_v'];
    $emplacement = $_POST['emplacement'];
    $date_dep = $_POST['date_dep'];
    $date_ret = $_POST['date_ret'];
    $raison = $_POST['raison'];


    if (empty($matricule) || empty($nom_prenom) || empty($adress_admin) || empty($matricule_v)
        || empty($date_dep) || empty($date_ret) || empty($raison) || empty($emplacement)) {
                   echo '<script>
                        Swal.fire({
                            title: "Veuillez remplir tous les champs.",
                            icon: "warning",
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                      </script>';
    } else {
            // Le matricule et le véhicule existent, donc vous pouvez l'insérer dans la table ordre_mission
            try {
                // Préparation et exécution de la requête d'insertion
                $sql = "INSERT INTO ordre_mission (matricule, nom_prenom, adress_admin, matricule_v,emplacement, date_dep, date_ret, raison) 
                        VALUES (:matricule, :nom_prenom, :adress_admin, :matricule_v,:emplacement, :date_dep, :date_ret, :raison)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':matricule', $matricule);
                $stmt->bindParam(':nom_prenom', $nom_prenom);
                $stmt->bindParam(':adress_admin', $adress_admin);
                $stmt->bindParam(':matricule_v', $matricule_v);
                $stmt->bindParam(':emplacement', $emplacement);
                $stmt->bindParam(':date_dep', $date_dep);
                $stmt->bindParam(':date_ret', $date_ret);
                $stmt->bindParam(':raison', $raison);
                $stmt->execute();
                echo '<script>
                Swal.fire({
                    title: "Les informations ont été mises à jour avec succès.",
                    icon: "success",
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
              </script>';
            } catch (PDOException $e) {
                showErrorAlert("Une erreur est survenue lors de l'enregistrement : " . $e->getMessage());
            }
        } 
    } 
    
    ?>