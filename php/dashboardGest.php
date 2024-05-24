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


    $sqlt = "SELECT COUNT(*) as total_elements FROM demande_v WHERE flag = 1";
    $resultt = $pdo->query($sqlt);
    $rowt = $resultt->fetch(PDO::FETCH_ASSOC);

    $sqltO = "SELECT COUNT(*) as total_or FROM ordre_mission";
    $resultO = $pdo->query($sqltO);
    $rowO = $resultO->fetch(PDO::FETCH_ASSOC);

    $requete = $pdo->prepare("SELECT COUNT(*) AS nombre_de_lignes FROM véhicule WHERE vidange >= seuil_v OR chaine >= seuil_pch");
    $requete->execute();
    
    // Récupérer le nombre de lignes
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    $nombreDeLignes = $resultat['nombre_de_lignes'];
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
    <script src="../js/dashboardGest.js"></script>
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
            <a href="#" target="_self">
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
            <a href="../php/bondecommande.php" target="_self">
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
          <a href="deconnexion.php" target="_self">
          <i class='bx bx-log-out'></i>
            <span class="text nav-text">Deconnexion</span>
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
              <h1>Demande de véhicule Reçu: <?php echo $rowt['total_elements']?></h1>
              <h1></h1>
            </div>
          </div>

          <div class="card">
            <div class="card-inner">
            <h1>Ordres Missions Efféctue: <?php echo $rowO['total_or']?></h1>
            <p id="compte-a-rebours"></p>
            
            </div>
            <h1></h1>
          </div>

          <div class="card">
          <h1>Nombre de Demande d'intervention a effectuer :<?php echo $nombreDeLignes?></h1>
        </div>
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