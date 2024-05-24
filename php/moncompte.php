<?php
session_start();
$userSession = isset($_SESSION['username']) ? $_SESSION['username'] : null;

$servername = "localhost";
$dbUsername = "root"; // Renommé pour éviter la confusion
$dbPassword = "";
$dbname = "parc_auto";

try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbUsername, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
    exit();
}

// Récupérer le matricule associé au username
$matricule = null;
if ($userSession) {
    $sql = "SELECT matricule FROM employe WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $userSession);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $matricule = $result['matricule'];
    }
}

// Récupérer les demandes associées au matricule
$demandes = [];
if ($matricule) {
    $sql = "SELECT * FROM demande_v WHERE matricule = :matricule";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':matricule', $matricule);
    $stmt->execute();
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Vérifier les traitements pour chaque demande
$traitements = [];
if ($demandes) {
    $sql = "SELECT * FROM traitement_cv WHERE id_demande IN (" . implode(',', array_column($demandes, 'id_demande')) . ")";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $traitements = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $traitements = array_column($traitements, null, 'id_demande');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Profile</title>
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
        <h1>Bienvenue "<?php echo htmlspecialchars($userSession); ?>"</h1>
      </div>
      <div class="header-right">
        <img src="../pictures/logo-naftal.png" alt="">
      </div>
    </header>
    <!-- Fin d'Entete -->

    <!-- Menu -->
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
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Numéro de demande</th>
              <th>De</th>
              <th>À</th>
              <th>Destination</th>
              <th>Distance</th>
              <th>Motif</th>
              <th>Date de demande</th>
              <th>Réponse</th>
              <th>Véhicule</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($demandes): ?>
              <?php foreach ($demandes as $demande): ?>
                <tr class="data-row">
                  <td><?php echo htmlspecialchars($demande['id_demande']); ?></td>
                  <td><?php echo htmlspecialchars($demande['date_deplacement']); ?></td>
                  <td><?php echo htmlspecialchars($demande['date_de_retour']); ?></td>
                  <td><?php echo htmlspecialchars($demande['destination']); ?></td>
                  <td><?php echo htmlspecialchars($demande['distance']); ?></td>
                  <td><?php echo htmlspecialchars($demande['raison_deplacement']); ?></td>
                  <td><?php echo htmlspecialchars($demande['date_insertion']); ?></td>
                  <td>
                    <?php 
                    if (isset($traitements[$demande['id_demande']])) {
                        echo "Accepté";
                    } else {
                        echo "En attente";
                    }
                    ?>
                  </td>
                  <td>
                    <?php 
                    if (isset($traitements[$demande['id_demande']])) {
                        echo htmlspecialchars($traitements[$demande['id_demande']]['matricule_v']);
                    } else {
                        echo "-";
                    }
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="10">Aucune demande trouvée.</td>
              </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="10"></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </main>

    <!-- Scripts -->
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  </div>
</body>
</html>
