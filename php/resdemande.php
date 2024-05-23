<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parc_auto";

try {
    // Créer une connexion PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Configurer PDO pour générer des exceptions en cas d'erreurs SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Requête pour récupérer toutes les demandes par défaut
    $query_demande_v = "SELECT * FROM demande_v WHERE flag = 4";
    $stmt = $pdo->prepare($query_demande_v);
    $stmt->execute();
    $result_demande_v = $stmt->fetchAll(PDO::FETCH_ASSOC);


    //requete pour récuperer les véhicule
    $query_véhicule="SELECT * FROM véhicule WHERE flag = 1" ;
    $stmt_v= $pdo ->prepare($query_véhicule);
    $stmt_v->execute();
    $query_véhicule = $stmt_v->fetchAll(PDO::FETCH_ASSOC);

    //requete selectionner les chauffeurs
    $result_mat="SELECT * FROM employe WHERE role = 'c'";
    $stmt_mat = $pdo->prepare($result_mat);
    $stmt_mat->execute();
    $result_mat = $stmt_mat->fetchAll(PDO::FETCH_ASSOC);


    $sqlt = "SELECT COUNT(*) as total_elements FROM demande_v WHERE flag = 4";
    $resultt = $pdo->query($sqlt);
    $rowt = $resultt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // En cas d'erreur de connexion
    die("La connexion a échoué: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/demandeGest.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Page Gestionnaire</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/demandeGest.css">
  </head>
  <body>
    <div class="grid-container">
      <!-- Entete -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          Demande de Véhicules
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
            <a href="dashboardGest.html" target="_self">
              <i class='bx bxs-dashboard icon'></i>
                  <span class="text nav-text">Tableau de Bord</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_self">
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
            <a href="Resordremiss.php" target="_self">
              <i class='bx bx-list-check icon'></i>
                    <span class="text nav-text">Ordres de Mission</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="suiviv.php" target="_self">
              <i class='bx bxs-car-mechanic icon'></i>
                    <span class="text nav-text">Liste Des véhicules</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="ajoute" target="_blank">
            <i class='bx bx-plus'></i>
                <span class="text nav-text">Gestion des utilsateurs</span>
            </a>
        </li>

        </ul>
      </aside>
      <!-- fin de main -->
      <!--nouveau Main-->
      <!--Demande de véhicule-->
      <main class="main-container">
        <div class="tabular--wrapper">
          <div class="table-container">
            <h1>Les Demande de Véhicule</h1>
              <table>
                  <thead><!--header of table (title)-->
                      <tr>
                          <th>Numéro de Demande</th>
                          <th>Matricule</th>
                          <th>Num de département</th>
                          <th>Distance</th>
                          <th>Date</th>
                          <th></th>
                          <th></th> 
                          <th></th> 
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result_demande_v as $demande) { ?>
                      <tr class="data-row">   
                          <td><?php echo $demande['id_demande']; ?></td> 
                          <td><?php echo $demande['matricule']; ?></td>
                          <td><?php echo $demande['num_departement']; ?></td>
                          <td><?php echo $demande['distance']; ?></td>
                          <td><?php echo $demande['date_deplacement']; ?></td>
                          <td></td>   
                          <td></td>                       
                          <td class="btn"><button onclick="showtraitementTable('<?php echo $demande['id_demande']; ?>')" class="traitement">Traitement<i class='bx bx-cog'></i></button></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <td colspan="9">Nombre de demande:<?php echo $rowt['total_elements']?></td>
                  </tfoot>
              </table>
          </div>
            <div id="myModal" class="modal">
            <div class="modal-content" id="modal-content">
              <span class="close">&times;</span>
              <div id="véhicule" class="tabular--wrapper">
                <h2>Véhicule Disponible</h2>
            <div class="table-container">
                <table>
                            <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Marque</th>
                                    <th>Modéle</th>
                                    <th>Puissance</th>
                                    <th>Année</th>
                                    <th>couleur</th>
                                    <th>Chauffeur</th>
                                    <th colspan="2">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($query_véhicule as $véhicule) { ?>
                              <form method="post" action="">
                              <input type="hidden" name="id_demande" class="id_demande">
                                <tr class="data-row">   
                                <td><?php echo $véhicule['matricule_v']; ?></td>
                                <td><?php echo $véhicule['marque']; ?></td>
                                <td><?php echo $véhicule['modele']; ?></td>
                                <td><?php echo $véhicule['puissance']; ?></td>   
                                <td><?php echo $véhicule['anne_v']; ?></td>                       
                                <td><?php echo $véhicule['couleur']; ?></td> 
                                <td><select name="matricule_chauff">
                                    <?php foreach ($result_mat as $chauffeur) { ?>
                                    <option value="<?php echo $chauffeur['matricule']; ?>"><?php echo $chauffeur['matricule']; ?></option>
                                    <?php } ?>
                                    </select>
                                    </td>
                                <td></td>            
                                <td class="btn"><button class="selection" id="selection" name="trait" value="<?php echo $véhicule['matricule_v']; ?>">Selectionner</button>
                                 </td>
                                
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <td colspan="9"></td>
                            </tfoot>
                </table>
                <footer><button class="en-attente" id="en-attente" name="en-attente">Refusé</button></footer>
                </form>
            </div>
              </div>
            </div>
            </div>
    </main>

    <!-- Scripts -->
    <!--JQUERY-->
  </body>
</html>
<?php
try {
    if(isset($_POST['trait'])){
        // Récupération des valeurs des champs du formulaire
        $matricule_chauff = $_POST['matricule_chauff'];
        $matricule_v = $_POST['trait'];
        $id_demande = $_POST['id_demande']; // Ceci est correct car c'est le nom du champ

        // Insertion dans la table 'traitement_cv'
        $sql_insert = "INSERT INTO traitement_cv (matricule_v, matricule_chauff) VALUES (:matricule_v, :matricule_chauff)";
        $stmt = $pdo->prepare($sql_insert);
        $stmt->bindParam(':matricule_v', $matricule_v);
        $stmt->bindParam(':matricule_chauff', $matricule_chauff);
        $stmt->execute();
    
        // Mise à jour de la table 'demande_v'
        $sql_update = "UPDATE demande_v SET flag = 1 WHERE id_demande = :id_demande";
        $stmt_d = $pdo->prepare($sql_update);
        $stmt_d->bindParam(':id_demande', $id_demande);
        $stmt_d->execute();


           // Mise à jour de la table 'demande_v'
           $sql_updatev = "UPDATE véhicule SET flag = 0 WHERE matricule_v= :matricule_v";
           $stmt_v = $pdo->prepare($sql_updatev);
           $stmt_v->bindParam(':matricule_v', $matricule_v);
           $stmt_dv->execute();
        echo '<script>
        Swal.fire({
            title: "Les informations ont été enregistrées avec succès.",
            icon: "success",
            confirmButtonText: "OK",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
        </script>';
      }

    if(isset($_POST['en-attente'])){
        // Récupération des valeurs des champs du formulaire
        $id_demande = $_POST['id_demande']; // Ceci est correct car c'est le nom du champ

        // Mise à jour de la table 'demande_v'
        $sql_update_d2 = "UPDATE demande_v SET flag = 2 WHERE id_demande = :id_demande";
        $stmt_d2 = $pdo->prepare($sql_update_d2);
        $stmt_d2->bindParam(':id_demande', $id_demande);
        $stmt_d2->execute();

        echo '<script>
        Swal.fire({
            title: "Les informations ont été enregistrées avec succès.",
            icon: "success",
            confirmButtonText: "OK",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
        </script>';
    }
} catch(PDOException $e) {
    // En cas d'erreur SQL
    echo "Erreur SQL: " . $e->getMessage();
}
?>

