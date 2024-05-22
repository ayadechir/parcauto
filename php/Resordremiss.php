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
    $query_or = "SELECT * FROM ordre_mission WHERE flag = 0";
    $stmt = $pdo->prepare($query_or);
    $stmt->execute();
    $result_or = $stmt->fetchAll(PDO::FETCH_ASSOC);



      // Requete pour compter les rows
      $sqlt = "SELECT COUNT(*) as total_elements FROM ordre_mission WHERE flag = 0";
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
    <link rel="stylesheet" href="../css/Resordremiss.css">
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
                    <span class="text nav-text">Rappor d'Accident</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="parametre" target="_self">
              <i class='bx bx-cog icon' ></i>
                <span class="text nav-text">Paramétres</span>
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
            <h1>Les Ordres de mission</h1>
              <table>
                  <thead><!--header of table (title)-->
                      <tr>
                          <th>Numéro d'OR</th>
                          <th>nom et prenom</th>
                          <th>Déestination</th>
                          <th>Motif</th>
                          <th>matricule de véhicule</th>
                          <th>Date de départ</th>
                          <th>Date de Retour</th> 
                          <th></th> 
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result_or as $or) { ?>
                        
                      <tr class="data-row">   
                          <td><?php echo $or['id_or']; ?></td> 
                          <td><?php echo $or['nom_prenom']; ?></td>
                          <td><?php echo $or['emplacement']; ?></td>
                          <td><?php echo $or['raison']; ?></td>   
                          <td><?php echo $or['matricule_v']; ?></td> 
                          <td><?php echo $or['date_dep']; ?></td> 
                          <td><?php echo $or['date_ret']; ?></td>     
                          <form method="post" action="">                 
                          <td class="btn"><button value="<?php echo $or['id_or']; ?>" class="valider" name="valider">Valider<i class='bx bx-check'></i></button></td>
                          </form> 
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <td colspan="9">Nombre d'Ordre de mission:<?php echo $rowt['total_elements']?></td>
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
    if(isset($_POST['valider'])){
        $id_or = $_POST['valider'];

        // Mise à jour de la table 'demande_v'
        $sql_update = "UPDATE ordre_mission SET flag = 1 WHERE id_or = :id_or";
        $stmt_d = $pdo->prepare($sql_update);
        $stmt_d->bindParam(':id_or', $id_or);
        $stmt_d->execute();

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

