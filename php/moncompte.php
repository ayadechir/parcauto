<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;


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



$sql = "SELECT matricule FROM employe WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();

// Requête pour récupérer les données de la table employe
$sql_mat = "SELECT id_demande FROM demande_v WHERE matricule =:matricule";
$result_mat = $conn->query($sql_mat);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>profile</title>
  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/moncompte.css">
</head>
<body>
  <div class="grid-container">
    <!-- Entete -->
    <header class="header">
      <div class="menu-icon">
        <span class="material-icons-outlined">menu</span>
      </div>
      <div class="header-left">
      <h1>Bienvenue "<?php echo $username; ?>"</h1>
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
          <a href="moncompte.php" target="_self">
          <i class='bx bx-user icon'></i>
            <span class="text nav-text">Profile</span>
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="../php/demandeur.php" target="_self">
            <i class='bx bx-git-pull-request icon'></i>
            <span class="text nav-text">Demande de véhicule</span>
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="deconnexion.php" target="_self">
            <i class='bx bx-wrench icon'></i>
            <span class="text nav-text">Deconnexion</span>
          </a>
        </li>
      </ul>
    </aside>
    <main class="main-container">    
    <table>
                  <thead><!--header of table (title)-->
                      <tr>
                          <th colspan="5">Notification <i class='bx bxs-bell'></i></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr  class="data-row">   
                        <td colspan="5" style="background-color:crimson;color:aliceblue;"><h2>Votre Demande effectué 23/02/2024 a été refusée<i class='bx bx-x'></i></h2> </td>                  
                      </tr>
                      <tr class="data-row">   
                      <td colspan="5" style="background-color:lightgreen;
                      color:aliceblue;"><h2>Votre Demande effectué 23/12/2023 a été accéptée<i class='bx bx-check' ></i></h2>
                      <h3>Votre chauffeur:Hakim Mohammed   Votre véhicule: clio 12</h3>
                   </td>                      
                      </tr>
                   
                  </tbody>
                  <tfoot>
                  
                  </tfoot>
              </table>
  
    </main>

    <!-- Scripts -->
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>

