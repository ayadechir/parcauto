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
    $query_ordremiss = "SELECT * FROM ordre_mission WHERE flag = 1";
    $stmt = $pdo->prepare($query_ordremiss);
    $stmt->execute();
    $query_ordremiss = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $sqlt = "SELECT COUNT(*) as total_elements FROM demande_v WHERE flag = 0";
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
    <link rel="stylesheet" href="../css/ordremissimp.css">
  </head>
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
            <a href="#" target="_self">
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
            <a href="RA" target="_self">
              <i class='bx bxs-car-crash icon'></i>
                    <span class="text nav-text">Rapport d'Accident</span>
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
                                <td><button class="obser" onclick="showOr('<?php echo $or['id_or']; ?>', 
                                '<?php echo $or['nom_prenom']; ?>', '<?php echo $or['matricule']; ?>','<?php echo $or['adress_admin']; ?>',
                                 '<?php echo $or['emplacement']; ?>', '<?php echo $or['raison']; ?>', '<?php echo $or['date_dep']; ?>',
                                 '<?php echo $or['date_ret']; ?>','<?php echo $or['matricule_v']; ?>')"name="print" id="print"><i class='bx bx-printer'></i></button></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                  <tfoot>
                      <td colspan="10">Nombre d'or':<?php echo $rowt['total_elements']?></td>
                  </tfoot>
              </table>
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
        $matricule_v = $_POST['trait'];
        $matricule_chauff = $_POST['matricule_chauff_' . $matricule_v];
        $id_demande = $_POST['id_demande']; // Ceci est correct car c'est le nom du champ

        // Insertion dans la table 'traitement_cv'
        $sql_insert = "INSERT INTO traitement_cv (matricule_v, matricule_chauff,id_demande) VALUES (:matricule_v, :matricule_chauff,:id_demande)";
        $stmt = $pdo->prepare($sql_insert);
        $stmt->bindParam(':matricule_v', $matricule_v);
        $stmt->bindParam(':matricule_chauff', $matricule_chauff);
        $stmt->bindParam(':id_demande', $id_demande);
        $stmt->execute();
    
        // Mise à jour de la table 'demande_v'
        $sql_update = "UPDATE demande_v SET flag = 3 WHERE id_demande = :id_demande";
        $stmt_d = $pdo->prepare($sql_update);
        $stmt_d->bindParam(':id_demande', $id_demande);
        $stmt_d->execute();


           // Mise à jour de la table 'demande_v'
           $sql_updatev = "UPDATE véhicule SET flag = 0 WHERE matricule_v= :matricule_v";
           $stmt_v = $pdo->prepare($sql_updatev);
           $stmt_v->bindParam(':matricule_v', $matricule_v);
           $stmt_v->execute();
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
        $sql_update_d2 = "UPDATE demande_v SET flag = 4 WHERE id_demande = :id_demande";
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

