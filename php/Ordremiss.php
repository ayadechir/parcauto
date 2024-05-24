<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parc_auto";

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    showErrorAlert("La connexion a échoué : " . $e->getMessage());
}  

// Requête pour récupérer les données de la table employe
$sql_mat = "SELECT matricule FROM employe";
$result_mat = $pdo->query($sql_mat);

// Requête pour récupérer toutes les demandes par défaut
$query_ordremiss = "SELECT * FROM ordre_mission WHERE flag = 1";
$stmt = $pdo->prepare($query_ordremiss);
$stmt->execute();
$query_ordremiss = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlt = "SELECT COUNT(*) as total_elements FROM demande_v WHERE flag = 0";
$resultt = $pdo->query($sqlt);
$rowt = $resultt->fetch(PDO::FETCH_ASSOC);

// Traitement du formulaire
if(isset($_POST['matricule'])) {
    // Récupération du matricule sélectionné
    $matricule = $_POST['matricule'];

    // Requête SQL pour récupérer les informations associées au matricule
    $query = "SELECT nom, prenom FROM employe WHERE matricule = :matricule";
    $statement = $pdo->prepare($query);
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
                    <a href="../php/demandeGest.php" target="_self">
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
        <div class="choose">
        <button id="creer">Rédiger des Ordres de mission</button>
        <button id="imprime">Imprimer les Ordres Mission Reçu</button>  
        </div> 
        <div id="form-container" style="display:none;">
        <form method="post" action="" onSubmit="return validateForm()">
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
                </footer>
            </form>   
        </div>
        <div id="tabular--wrapper" style="display:none;">
          <div class="table-container">
            <h1>Les Demande de Véhicule</h1>
            <table>
              <thead><!--header of table (title)-->
                <tr>
                  <th>Num d'OR</th>
                  <th>nom_prenom</th>
                  <th>matricule de chauffeur</th> 
                  <th>adress_admin</th>
                  <th>Destination</th>
                  <th>Motif</th>
                  <th>date_dep</th>
                  <th>date_ret</th> 
                  <th>matricule_véhicule</th>
                  <th>Imprimer</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($query_ordremiss as $or) { ?>
                  <form method="post" action="">
                    <tr class="data-row">   
                      <td><?php echo $or['id_or']; ?></td>
                      <td><?php echo $or['nom_prenom']; ?></td>
                      <td><?php echo $or['matricule']; ?></td>    
                      <td><?php echo $or['adress_admin']; ?></td>
                      <td><?php echo $or['emplacement']; ?></td>   
                      <td><?php echo $or['raison']; ?></td>                       
                      <td><?php echo $or['date_dep']; ?></td> 
                      <td><?php echo $or['date_ret']; ?></td>
                      <td><?php echo $or['matricule_v']; ?></td>
                      <td><button type="button" class="print" onclick="showOr('<?php echo $or['id_or']; ?>', 
                      '<?php echo $or['nom_prenom']; ?>', '<?php echo $or['matricule']; ?>','<?php echo $or['adress_admin']; ?>',
                      '<?php echo $or['emplacement']; ?>', '<?php echo $or['raison']; ?>', '<?php echo $or['date_dep']; ?>',
                      '<?php echo $or['date_ret']; ?>','<?php echo $or['matricule_v']; ?>')"><i class='bx bx-printer'></i></button></td>
                    </tr>
                  </form>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="10">Nombre d'OR: <?php echo $rowt['total_elements']; ?></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div id="myModal" class="modal">
            <div class="modal-content" id="modal-content">
              <div class="close"><i class='bx bx-x-circle'></i></div>    
              <div class="formulaire" id="formulaire">
              <header><h2>Ordre de Mission</h2>
                  <div class="logo">
                  <img src="../pictures/logo-naftal.png" alt="">
                  </div>
                  </header>
                <form method="post" action="">
                  <label>Num d'Ordre de mission<input name="id_or" class="id_or"></label>
                  <label>Nom prénom:<input name="nom_prenom_" id="nom_prenom_"></label>
                  <label>Matricule de chauffeur:<input name="matricule_" id="matricule_"></label>
                  <label>Adresse administratif:<input name="adress_admin_" id="adress_admin_"></label>
                  <label>Destination:<input name="emplacement_" id="emplacement_" ></label>
                  <label>Motif:<input name="raison_" id="raison_" ></label>
                  <label>Date de départ:<input name="date_dep_" id="date_dep_" ></label>
                  <label>Date de Retour:<input name="date_ret_" id="date_ret_" ></label>
                  <label>Matricule de véhicule:<input name="matricule_v_" id="matricule_v_" ></label>
                  <label>Rédiger le :<input type="text" id="dateInput" readonly></label>
                </form>   
              </div>
              <footer>
                    <button name="Imprimer" onclick="imprimerPage()">Imprimer</button>
                  </footer>
            </div>
          </div>
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
                $stmt = $pdo->prepare($sql);
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
