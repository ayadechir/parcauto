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
$query_demande_v = "SELECT * FROM demande_v";
$result_demande_v = mysqli_query($con, $query_demande_v);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
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
                    <?php while($row = mysqli_fetch_assoc($result_demande_v)) { ?>
                      <tr class="data-row">   
                          <td><?php echo $row ['id_demande'] ?></td> 
                          <td><?php echo $row['matricule']?></td>
                          <td><?php echo $row['num_departement']; ?></td>
                          <td><?php echo $row['distance']; ?></td>
                          <td><?php echo $row ['date_deplacement']?></td>
                          <td></td>   
                          <td></td>                       
                          <td><button id="openModalBtn" class="traitement">Traitement<i class='bx bx-cog'></i></button></td>
                          </tr>
                      <?php } ?>
                      
                  </tbody>
                  <tfoot>
                      <td colspan="9">Nombre de demande:</td>
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
                                    <th>Code de véhicule</th>
                                    <th>Matricule</th>
                                    <th>Marque</th>
                                    <th>Modéle</th>
                                    <th>active</th>
                                    <th>Puissance</th>
                                    <th>Année</th>
                                    <th>Num_dep</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="data-row">   
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>   
                                    <td></td>  
                                    <td></td>
                                    <td></td>            
                                    <td><button  class="button-style">Selectionner</button></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <td colspan="9">Nombre de demande:</td>
                            </tfoot>
                </table>
                    <div id="traitement">
                    <button id="cancel" class="button-style">Annulé  <i class='bx bxs-x-circle' ></i></button>
                    <button id="cancelw" class="button-style">Mettre en attente  <i class='bx bxs-hourglass'></i></button>
                    <button id="next" class="button-style">Suivant <i class='bx bxs-chevrons-right'></i></button>
                    </div>
            </div>
              </div>
            </div>
            </div>
    </main>

    <!-- Scripts -->
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/demandeGest.js"></script>
    

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  </body>
</html>
<?php mysqli_close($con); ?>