<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Gestionnaire - Bon de commande</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/suiviv.css">
</head>
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parc_auto";

// Connexion à la base de données
$con = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$con) {
    die("La connexion a échoué: " . mysqli_connect_error());
}

// Requête pour récupérer toutes les données des véhicules par défaut
$query_vehicules = "SELECT * FROM véhicule";
$result_vehicules = mysqli_query($con, $query_vehicules);

//Requete pour comptre les row
$sqlt = "SELECT COUNT(*) as total_elements FROM véhicule";
$resultt = mysqli_query($con, $sqlt);
$rowt = mysqli_fetch_assoc($resultt);

// Si le formulaire de recherche est soumis
//Si le formulaire de Suivi est soumis 
if(isset($_POST["Terminer"])) {
    // Vérification si les champs sont vides
    if(empty($_POST['matricule_v']) || empty($_POST['km_dep']) || empty($_POST['km_ret']) || empty($_POST['consom_car']) || empty($_POST['date_s'])) {
        showErrorAlert("Veuillez remplir tous les champs.");
        if($km_dep > $seuil_v || $km_ret > $seuil_v || $km_dep > $km_ret ){
        showErrorAlert('Il y\'a une erreur dans les entrés');
    }
    } else {
        $matricule_v = $_POST['matricule_v'];
        $km_dep = $_POST['km_dep'];
        $km_ret = $_POST['km_ret'];
        $consom_car = $_POST['consom_car'];
        $date_s = $_POST['date_s'];
        // Vérifier si km_dep et km_ret ne dépassent pas le seuil
        $query_seuil_v = "SELECT seuil_v FROM véhicule WHERE matricule_v = '$matricule_v'";
        $result_seuil_v = mysqli_query($con, $query_seuil_v);
        $row_seuil_v = mysqli_fetch_assoc($result_seuil_v);
        $seuil_v = $row_seuil_v['seuil_v'];
            try {
                // Préparation et exécution de la requête d'insertion
                $sql_insert = "INSERT INTO suivi_v (matricule_v, km_dep, km_ret, consom_car, date_s) 
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $sql_insert);
                mysqli_stmt_bind_param($stmt, 'siiis', $matricule_v, $km_dep, $km_ret, $consom_car, $date_s);
                mysqli_stmt_execute($stmt);

                // Mise à jour de la valeur km_actuel dans la table véhicule
                $sql_update_km = "UPDATE véhicule 
                                  SET km_actuel = km_actuel + ($km_ret - $km_dep) 
                                  WHERE matricule_v = '$matricule_v'";
                if (mysqli_query($con, $sql_update_km)) {
                    showSuccessAlert("Les informations ont été enregistrées avec succès.");
                } else {
                    showErrorAlert("Erreur lors de la mise à jour du kilométrage actuel : " . mysqli_error($con));
                }
            } catch (PDOException $e) {
                showErrorAlert("Une erreur est survenue lors de l'enregistrement : " . $e->getMessage());
            }
        }
    }
else {
    showErrorAlert("Le matricule et/ou le véhicule n'existent pas dans la base de données.");
}

function showErrorAlert($message) {
    echo '<script>Swal.fire("Erreur", "' . $message . '", "error")</script>';
}

function showSuccessAlert($message) {
    echo '<script>Swal.fire("Succès", "' . $message . '", "success")</script>';
}

// Tableau pour stocker les données des véhicules
$vehicules_data = array();

// Récupérer les données des véhicules et les stocker dans le tableau
while($row = mysqli_fetch_assoc($result_vehicules)) {
    $vehicules_data[] = $row;
}
?>
<body>
    <div class="grid-container">
        <!-- Entete -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
            </div>
            <div class="header-right">
            
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
                    <a href="dashboardGest.html" target="_self">
                        <i class='bx bxs-dashboard icon'></i>
                        <span class="text nav-text">Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
            <a href="demandeGest.php" target="_self">
              <i class='bx bx-git-pull-request icon'></i>
                  <span class="text nav-text">Demande de véhicule</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#BC" target="_self">
              <i class='bx bx-receipt icon'></i>
                    <span class="text nav-text">Bon de Commande</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="Ordremiss.php" target="_self">
              <i class='bx bx-list-check icon'></i>
                    <span class="text nav-text">Ordres de Mission</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="suiviv.php" target="_self">
              <i class='bx bxs-car-mechanic icon'></i>
                    <span class="text nav-text">Suivi de Véhicule</span>

            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="RA" target="_self">
              <i class='bx bxs-car-crash icon'></i>
                    <span class="text nav-text">Rapport d'Accident</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="parametre" target="_self">
              <i class='bx bx-cog icon' ></i>
                <span class="text nav-text">Paramétres</span>
            </a>
          </li>
                <!-- Autres éléments du menu ici -->
            </ul>
        </aside>
        <!-- Fin du menu -->
        <!-- Main -->
        <main class="main-container">    
            <!-- Formulaire de recherche -->
            <form method="post" action="">
                <div class="search">
                    <input autocomplete="off"type="text" name="search" id="search" placeholder="Recherche par Matricule....">
                    <button type="submit"><i class='bx bx-search-alt'></i></button>
                </div>
            </form>  
            
            <!-- Tableau des véhicules -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Active</th>
                            <th>Puissance</th>
                            <th>Année</th> 
                            <th>Couleur</th>  
                            <th>km_actuel</th> 
                            <th>Actions</th>
                            <th>Suivi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($vehicules_data as $row) { ?>
                            <?php 
                                $km_actuel = $row['km_actuel'];
                                $seuil_v= $row['seuil_v'];
                                $seuil_pch=$row['seuil_pch'];

                                $vidange = ($km_actuel / $seuil_v) * 100;


                                if ($vidange >= 90) {
                                    $displays = 'inline-block;'; //Affiche le boutton  
                                }else{
                                    $displays = 'none;'; // Masquer le bouton
                                }
                                

                                $chaine=($km_actuel / $seuil_pch ) *100;
                                if ($chaine > 90 ) {
                                $display='inline-block;';// Afficher le bouton
                                 } else {
                                $display='none;';    
                            }

                                ?>
                            <tr  style="background-color: <?php echo $color; ?>;">
                                <td><?php echo $row['matricule_v']; ?></td>
                                <td><?php echo $row['marque']; ?></td>
                                <td><?php echo $row['modele']; ?></td>
                                <td><?php if ($row['flag'] == 1) { ?>
                                        <span> Active </span>
                                    <?php } else { ?>
                                        <span>Non active</span>
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['puissance']; ?></td>   
                                <td><?php echo $row['anne_v']; ?></td>                       
                                <td><?php echo $row['couleur']; ?></td>
                                <td><?php echo $km_actuel; ?></td>
                                <td>   
                                <button class="vidange" style="display: <?php echo $displays; ?>;" onclick="showDiVidangeForm('<?php echo $row['matricule_v']; ?>')"><i class='bx bx-gas-pump'></i></button>
                                <button class="Chaine"  style="display: <?php echo $display; ?>;"><i class='bx bx-cog' ></i></button>
                                <button class="plaque"  style="display: <?php echo $display; ?>;"><i class='bx bx-wrench' ></i></button>
                                    
                                </td>
                                <td><button class="suivi" title="Suivi" onclick="showSuiviForm('<?php echo $row['matricule_v']; ?>')"><i class='bx bx-receipt'></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="10">Nombre de véhicules: <?php echo $rowt['total_elements']?></td>
                    </tr>
                    </tfoot>
                </table>
            </div>  
            <div id="myModal" class="modal">
            <div class="modal-content" id="modal-content">
            <div class="close"><i class='bx bx-x-circle'></i></div>    
            <div class="formulaire">
            <form method="post" action="">
                <header><h2>Suivi de véhicule</h2></header>
                <input autocomplete="off"type="hidden" name="matricule_v" id="matricule_v">
                <div class="input"><label>Kilométrage de départ:</label><input autocomplete="off"type="number" name="km_dep"  maxlength="5"></div>
                <div class="input"><label>Kilométrage de Retour:</label><input autocomplete="off"type="number" name="km_ret" maxlength="5"></label></div>
                <div class="input"><label>Consommation carburant:</label><input autocomplete="off"type="number" name="consom_car" maxlength="5"></label></div>
                <div class="input"><label>Date:</label><input autocomplete="off"type="date" name="date_s"></div>
                <footer>
                <button name="Terminer">Terminer</button>
                </footer>
            </form>   
            </div>
            </div>
            
            </div>
            <div id="vidange" class="modal"> <!-- Sectio de demande d'intervention de Vidange-->
            <div class="modal-content" id="modal-vidange">
            <div class="close"><i class='bx bx-x-circle'></i></div>    
            <div class="formulaire">
            <form method="post" action="">
                <header><h2>Demande D'Intervention</h2>
                <h3 style="color:;">Vidange </h3></header>
                <input autocomplete="off"type="hidden" name="matricule_v" id="matricule_v">
                <input type="hidden" value="vidange">
                <div class="input"><label>Kilométrage de départ:</label><input autocomplete="off"type="number" name="km_dep"  maxlength="5"></div>
                <div class="input"><label>Kilométrage de Retour:</label><input autocomplete="off"type="number" name="km_ret" maxlength="5"></label></div>
                <div class="input"><label>Consommation carburant:</label><input autocomplete="off"type="number" name="consom_car" maxlength="5"></label></div>
                <div class="input"><label>Date:</label><input autocomplete="off"type="date" name="date_di" id="date" ></div>
                <footer>
                <button name="Terminer">Terminer</button>
                </footer>
            </form>   
            </div>
            </div>
            
            </div>
            

        </main>
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../js/suiviv.js"></script>
    </div>
</body>
</html>
<?php mysqli_close($con); ?>