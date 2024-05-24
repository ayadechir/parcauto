<?php
session_start();

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['username'])) {
    // Récupérer le nom d'utilisateur de la session
    $username = $_SESSION['username'];

    // Connexion à la base de données
    $servername = "localhost";
    $dbname = "parc_auto";
    $username_db = "root";
    $password_db = "";

    try {
        // Connexion à la base de données avec PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer le matricule associé à l'utilisateur
        $sql = "SELECT matricule,num_departement,nom,prenom FROM employe WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        // Récupérer le résultat de la requête
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si un résultat a été trouvé
        if($result) {
            $matricule = $result['matricule'];
            $num_departement=$result['num_departement'];
            $nom=$result['nom'];
            $prenom=$result['prenom'];
            } 
    } catch(PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
} else {
    echo "L'utilisateur n'est pas connecté.";
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
            <i class='bx bx-git-pull-request icon'></i>
            <span class="text nav-text">Profile</span>
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="../demandeur.php" target="_self">
            <i class='bx bx-user icon'></i>
            <span class="text nav-text">Demande de véhicule</span>
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="../php/deconnexion.php" target="_self">
          <i class='bx bx-log-out'></i>
            <span class="text nav-text">Deconnexion</span>
          </a>
        </li>
      </ul>
    </aside>
    <!-- fin de main -->
    <!--nouveau Main-->
    <!--Demande de véhicule-->
    <main class="main-container">    
    <form method="post" action="" onSubmit="return validateForm()">
      <div class="main">
        <h2>Demande de Véhicule</h2>
        <div class="input">
          <label>Avec chauffeur:</label>
            <select name="avec_chauffeur">
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
          </div>
          <input autocomplete="off" type="hidden" name="matricule" id="matricule" value="<?php echo $matricule; ?>">
          <input autocomplete="off" type="hidden" name="num_departement" id="num_departement" value="<?php echo $num_departement; ?>">
          <input autocomplete="off" type="hidden" name="nom_prenom" id="nom_prenom" value="<?php echo $nom . '_' . $prenom; ?>">
        <div class="input">
          <label>De:</label>
          <input autocomplete="off"type="date" name="date_deplacement">
        </div>
        <div class="input">
          <label>a:</label>
          <input autocomplete="off"type="date" name="date_de_retour">
        </div>
        <div class="input">
          <label>Distance:</label>
          <input autocomplete="off"type="number" name="distance">
        </div>
        <div class="input">
          <label>Destination:</label>
          <input autocomplete="off"type="text" name="destination" id="destination">
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
    <script>
// Fonction de validation du formulaire
function validateForm() {
    // Récupérer les valeurs des champs date de départ et date de retour
    var dateDepart = new Date(document.getElementsByName("date_deplacement")[0].value);
    var dateRetour = new Date(document.getElementsByName("date_de_retour")[0].value);

    // Vérifier si les années ne dépassent pas 4 chiffres
    if (isNaN(dateDepart.getFullYear()) || isNaN(dateRetour.getFullYear()) || dateDepart.getFullYear() < 1000 || dateDepart.getFullYear() > 3000 || dateRetour.getFullYear() < 1000 || dateRetour.getFullYear() > 3000) {
        // Afficher une alerte pour informer l'utilisateur de l'erreur
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'L\'année doit être comprise entre 1000 et 3000.'
        });
        // Empêcher l'envoi du formulaire
        return false;
    }

    // Vérifier si le mois est entre 1 et 12
    if (dateDepart.getMonth() < 0 || dateDepart.getMonth() > 11 || dateRetour.getMonth() < 0 || dateRetour.getMonth() > 11) {
        // Afficher une alerte pour informer l'utilisateur de l'erreur
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Le mois doit être compris entre 1 et 12.'
        });
        // Empêcher l'envoi du formulaire
        return false;
    }

    // Vérifier si le jour est entre 1 et 31
    if (dateDepart.getDate() < 1 || dateDepart.getDate() > 31 || dateRetour.getDate() < 1 || dateRetour.getDate() > 31) {
        // Afficher une alerte pour informer l'utilisateur de l'erreur
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Le jour doit être compris entre 1 et 31.'
        });
        // Empêcher l'envoi du formulaire
        return false;
    }

    // Si la date de départ est supérieure ou égale à la date de retour
    if (dateDepart >= dateRetour) {
        // Afficher une alerte pour informer l'utilisateur de l'erreur
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'La date de départ doit être antérieure à la date de retour.'
        });
        // Empêcher l'envoi du formulaire
        return false;
    }
    // Si la validation passe, permettre l'envoi du formulaire
    return true;
}
</script>

</body>
</html>

<?php
if (isset($_POST['Envoyer'])) {
  $matricule = $_POST['matricule'];
  $num_departement = $_POST['num_departement'];
  $nom_prenom = $_POST['nom_prenom'];
  $date_deplacement=$_POST['date_deplacement'];
  $distance = $_POST['distance'];
  $raison_deplacement = $_POST['raison_deplacement'];
  $destination = $_POST['destination'];
  $date_de_retour= $_POST['date_de_retour'];
  $avec_chauffeur=$_POST['avec_chauffeur'];

  if (empty($matricule) || empty($num_departement) ||empty($nom_prenom) ||empty($date_deplacement) || empty($date_de_retour) ||empty($distance) || empty($raison_deplacement)|| empty($destination)||  empty($avec_chauffeur)) {
    showErrorAlert("Veuillez remplir tous les champs.");
  } else {

      try {
        // Préparation et exécution de la requête d'insertion
        $sql = "INSERT INTO demande_v (matricule,nom_prenom, num_departement, date_deplacement,destination,date_de_retour, distance, raison_deplacement,avec_chauffeur)
                VALUES (:matricule,:nom_prenom , :num_departement, :date_deplacement,:destination,:date_de_retour, :distance, :raison_deplacement,:avec_chauffeur)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':num_departement', $num_departement); 
        $stmt->bindParam(':nom_prenom', $nom_prenom); 
        $stmt->bindParam(':date_deplacement', $date_deplacement);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':date_de_retour', $date_de_retour); 
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':raison_deplacement', $raison_deplacement);        
        $stmt->bindParam(':avec_chauffeur', $avec_chauffeur);
        $stmt->execute();
        showSuccessAlert("Votre demande a été enregistrée avec succès.");
      } catch (PDOException $e) {
        showErrorAlert("Une erreur est survenue lors de l'enregistrement : " . $e->getMessage());
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
