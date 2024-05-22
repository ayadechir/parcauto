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
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="dashboardGest.js"></script>
    <title>Page Gestionnaire</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/dashboardGest.css">
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
            <a href="TB" target="_blank">
              <i class='bx bxs-dashboard icon'></i>
                  <span class="text nav-text">Tableau de Bord</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="demandeGest.php" target="_blank">
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
            <a href="Ordremiss.php" target="_blank">
              <i class='bx bx-list-check icon'></i>
                    <span class="text nav-text">Ordres de Mission</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="suiviv.php" target="_blank">
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
                    <span class="text nav-text">Rappor d'Accident</span>
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
      <!-- fin de menu -->

      <!-- Main -->
      <!--Table de bord-->
      <main class="main-container" >
        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <h1>Demande de véhicule : <?php echo $rowt['total_elements']?></h1>
              <h1></h1>
            </div>
          </div>

          <div class="card">
            <div class="card-inner">
            <h1>Chronomètre d'un mois</h1>
            <p id="temps-restant"></p>
            <script>
            // Démarrer le chronomètre lorsque la page est chargée
            window.onload = demarrerChronometre;
          </script> 
            
            </div>
            <h1></h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3></h3>
            </div>
            <h1></h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3></h3>
            </div>
            <h1></h1>
          </div>

        </div>

        <div class="charts">

          <div class="charts-card">
            <h2 class="chart-title"></h2>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title"></h2>
            <div id="area-chart"></div>
          </div>

        </div>
      </main>
      <!--fin de tableau de bord-->


    <!-- Scripts -->
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  </body>
</html>