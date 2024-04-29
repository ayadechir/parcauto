<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Page Demandeur -Demande de véhicule-</title>
  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/demandeur.css">
</head>
<body>
  <div class="grid-container">
    <!-- Entete -->
    <header class="header">
      <div class="menu-icon">
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
          <a href="moncompte.php" target="_blank">
            <i class='bx bx-git-pull-request icon'></i>
            <span class="text nav-text">Mon compte</span>
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="OM" target="_blank">
            <i class='bx bx-user icon'></i>
            <span class="text nav-text">Demande de véhicule</span>
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="DI" target="_blank">
            <i class='bx bx-wrench icon'></i>
            <span class="text nav-text">Deconnexion</span>
          </a>
        </li>
      </ul>
    </aside>
    <!-- fin de main -->
    <!--nouveau Main-->
    <!--Demande de véhicule-->
    <main class="main-container">    
      <form method="post" action="">
      <div class="main">
        <h2>Demande de Véhicule</h2>
        <div class="input">
          <label>Avec chauffeur:</label>
            <select name="avec_chauffeur">
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
          </div>
        <div class="input">
          <label>De:</label>
          <input autocomplete="off"type="date" name="date_deplacement">
        </div>
        <div class="input">
          <label>a:</label>
          <input autocomplete="off"type="date" name="date_deplacement">
        </div>
        <div class="input">
          <label>Distance:</label>
          <input autocomplete="off"type="number" name="distance">
        </div>
        <div class="input">
          <label>Destination:</label>
          <input autocomplete="off"type="text" name="raison_deplacement" id="raison">
        </div>
        <div class="input">
          <label>Motif:</label>
          <input autocomplete="off"type="text" name="raison_deplacement" id="raison">
        </div>
        <footer>
          <button type="submit" name="Envoyer">Envoyer</button>
      </footer>
      </div>

      </form>   

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

<?php
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

if (isset($_POST['Envoyer'])) {
  $matricule = $_POST['matricule'];
  $num_departement = $_POST['num_departement'];
  $date_deplacement = $_POST['date_deplacement'];
  $distance = $_POST['distance'];
  $raison_deplacement = $_POST['raison_deplacement'];
  $avec_chauffeur=$_POST['avec_chauffeur'];

  if (empty($matricule) || empty($num_departement) || empty($date_deplacement) || empty($distance) || empty($raison_deplacement)|| empty($avec_chauffeurvec)) {
    showErrorAlert("Veuillez remplir tous les champs.");
  } else {
    // Vérifier si le véhicule existe dans la table véhicule
    $stmt = $conn->prepare("SELECT COUNT(*) FROM departement WHERE num_departement = ?");
    $stmt->execute([$num_departement]);
    $countv = $stmt->fetchColumn();

    if ($countv > 0) {
      try {
        // Préparation et exécution de la requête d'insertion
        $sql = "INSERT INTO demande_v (matricule, num_departement, date_deplacement, distance, raison_deplacement,avec_chauffeur)
                VALUES (:matricule, :num_departement, :date_deplacement, :distance, :raison_deplacement,:avec_chauffeur)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':num_departement', $num_departement); 
        $stmt->bindParam(':date_deplacement', $date_deplacement);
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':raison_deplacement', $raison_deplacement);        
        $stmt->bindParam(':avec_chauffeur', $avec_chauffeur);
        $stmt->execute();
        showSuccessAlert("Votre demande a été enregistrée avec succès.");
      } catch (PDOException $e) {
        showErrorAlert("Une erreur est survenue lors de l'enregistrement : " . $e->getMessage());
      }
    } else {
      showErrorAlert("Le matricule ou le numéro de departement est faux");
    }
  }
}

function showErrorAlert($message) {
  echo '<script>Swal.fire("Erreur", "' . $message . '", "error")</script>';
}

function showSuccessAlert($message) {
  echo '<script>Swal.fire("Succès", "' . $message . '", "success")</script>';
}
?>
