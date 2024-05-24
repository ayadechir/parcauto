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

// Requête pour récupérer les données de la table employe
$sql_di = "SELECT num FROM demande_i";
$result_di = $conn->query($sql_di);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Page Gestionnaire</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/bondecommande.css">
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
                    <a href="../php/dashboardGest.php" target="_self">
                        <i class='bx bxs-dashboard icon'></i>
                        <span class="text nav-text">Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="../php/demandeGest.php" target="_selef">
                        <i class='bx bx-git-pull-request icon'></i>
                        <span class="text nav-text">Demande de véhicule</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#" target="_self">
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
          <a href="deconnexion.php" target="_self">
          <i class='bx bx-log-out'></i>
            <span class="text nav-text">Deconnexion</span>
          </a>
        </li>

            </ul>
        </aside>
        <main class="main-container">    
            <form method="post" action="">
                <h1>Bon de commande </h1>
                <h3>Veuillez Remplir Tous les champs!</h3>
                <label>Numéro de bc:<input name="num_bc" id="num_bc" type="number"></label>
                <div class="input">
                    <label>Numéro de DI:<select type="number" name="num" id="num">
                    <?php while($row = $result_di->fetch(PDO::FETCH_ASSOC))  { ?>
                    <option value="<?php echo $row ['num']?>"><?php echo $row ['num']?></button></option>
                    <?php } ?>
                    </select></label>
                    <label>Unité Naftal:<input type="number" id="unite_naftal" name="unite_naftal"></label>
                </div>
                <div class="input">
                    <label>Numéro de Magasin:<input type="number" id="n_magasin" name="n_magasin"></label>
                    <label> Date de BC :<input type="date" id="date_bc" name="date_bc"></label>
                </div>

                <div class="input">
                    <label>Code Article:<input type="number" id="codear" name="codear"></label>
                    <label>Déstination: <input type="text" id="designation" name="designation"></label>
                </div>
                
                <div class="input">
                    <label>Quantité Demandée:<input type="number" id="quantite_dem" name="quantite_dem"></label>
                    <label>Quantité livrée:<input type="number" id="quantite_liv" name="quantite_liv"></label>
                </div>
                <div class="input">
                    <label>Observation :<input type="text" id="observation" name="observation"></label>
                    <label>Numéro bon de sortie :<input type="number" id="n_bonsortie" name="n_bonsortie"></label>
                </div>
                <label>Date de livraison :<input type="date" id="date_livraison" name="date_livraison"></label>
                <footer>
                    <button type="submit" name="Enregistrer">Enregistrer</button>
                    <button onclick="imprimerPage()">Imprimer</button>
                </footer>
            </form>   
        </main>
    </div>
</body>
<!-- Scripts -->
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/bondecommande.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</html>

<?php
if(isset($_POST['Enregistrer'])){
    if(empty($_POST['num_bc']) || empty($_POST['num']) || empty($_POST['unite_naftal']) || empty($_POST['n_magasin']) || empty($_POST['date_bc']) ||
    empty($_POST['codear'])|| empty($_POST['designation'])|| empty($_POST['quantite_liv'])|| empty($_POST['n_bonsortie'])||
     empty($_POST['observation']) || empty($_POST['date_livraison'])){
        echo '<script>
        Swal.fire({
            title: "Veuillez remplir tous les champs.",
            icon: "warning",
            confirmButtonText: "OK",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
      </script>';
}else{
    $num_bc = $_POST['num_bc'];
    $num = $_POST['num'];
    $unite_naftal = $_POST['unite_naftal'];
    $n_magasin =  $_POST['n_magasin'];
    $date_bc = $_POST['date_bc'];
    $codear = $_POST['codear'];
    $designation = $_POST['designation'];
    $quantite_liv = $_POST['quantite_liv'];
    $n_bonsortie = $_POST['n_bonsortie'];
    $observation = $_POST['observation'];
    $date_livraison = $_POST['date_livraison'];
    try{
        // Préparation et exécution de la requête d'insertion
        $sql_insert = "INSERT INTO bc (num_bc, untite_naftal, date_bc, n_magasin, num) 
                VALUES (:num_bc, :unite_naftal, :date_bc, :n_magasin, :num)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindParam(':num_bc', $num_bc);
        $stmt->bindParam(':unite_naftal', $unite_naftal);
        $stmt->bindParam(':date_bc', $date_bc);
        $stmt->bindParam(':n_magasin', $n_magasin);
        $stmt->bindParam(':num', $num);
        $stmt->execute();

        $sql_insert2 = "INSERT INTO details_bc (codear, designation, quantite_liv, observation, n_bonsortie, date_livraison, num_bc) 
        VALUES (:codear, :designation, :quantite_liv, :observation, :n_bonsortie, :date_livraison, :num_bc)";
           $stmt2 = $conn->prepare($sql_insert2);
           $stmt2->bindParam(':num_bc', $num_bc);
           $stmt2->bindParam(':codear', $codear);
           $stmt2->bindParam(':designation', $designation);
           $stmt2->bindParam(':quantite_liv', $quantite_liv);
           $stmt2->bindParam(':observation', $observation);
           $stmt2->bindParam(':n_bonsortie', $n_bonsortie);
           $stmt2->bindParam(':date_livraison', $date_livraison);
           $stmt2->execute();

        // Success message
        echo '<script>
            Swal.fire({
                title: "Enregistrement effectué avec succès",
                icon: "success",
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "your_redirect_page.php";
                }
            });
          </script>';

        }catch (PDOException $e) {
            echo '<script>
            Swal.fire({
                title: "Erreur lors de l\'enregistrement",
                text: "' . $e->getMessage() . '",
                icon: "error",
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
          </script>';
        }
    }
}
?>
