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
    $query_demande_v = "SELECT * FROM demande_v WHERE flag = 0";
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
    <link rel="stylesheet" href="../css/directeur.css">
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
            <a href="#" target="_self">
              <i class='bx bx-git-pull-request icon'></i>
                  <span class="text nav-text">Demande de véhicule</span>
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
            <h1>Les Demande de Véhicule</h1>
              <table>
                  <thead><!--header of table (title)-->
                      <tr>
                          <th>Numéro de Demande</th>
                          <th>Matricule</th>
                          <th>Nom et Prénom</th>
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
                          <td><?php echo $demande['nom_prenom']; ?></td>
                          <td><?php echo $demande['distance']; ?></td>
                          <td><?php echo $demande['date_deplacement']; ?></td>
                          <td></td>   
                          <td></td>          
                          <form method="post" action="">           
                          <td class="btn"><button class="acpt" name="acpt" value="<?php echo $demande['id_demande']; ?>">Accépter<i class='bx bx-check' ></i></button>
                          <button class="ref" name="ref" value="<?php echo $demande['id_demande']; ?>">Refuser<i class='bx bx-x'></i></button>
                          </form>  
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <td colspan="9">Nombre de demande:<?php echo $rowt['total_elements']?></td>
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
    if(isset($_POST['acpt'])){
        // Récupération des valeurs des champs du formulaire
        $id_demande = $_POST['acpt']; // Ceci est correct car c'est le nom du champ

        // Mise à jour de la table 'demande_v'
        $sql_update = "UPDATE demande_v SET flag = 1 WHERE id_demande = :id_demande";
        $stmt_d = $pdo->prepare($sql_update);
        $stmt_d->bindParam(':id_demande', $id_demande);
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

    if(isset($_POST['ref'])){
        // Récupération des valeurs des champs du formulaire
        $id_demande = $_POST['ref']; // Ceci est correct car c'est le nom du champ

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

