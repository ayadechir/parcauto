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
    <link rel="stylesheet" href="../css/boncom.css">

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
                    <a href="dashboardGest.html" target="_blank">
                        <i class='bx bxs-dashboard icon'></i>
                        <span class="text nav-text">Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="DV" target="_blank">
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
                    <a href="OM" target="_blank">
                        <i class='bx bx-list-check icon'></i>
                        <span class="text nav-text">Ordres de Mission</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="SV" target="_blank">
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
                        <span class="text nav-text">Rapport d'Accident</span>
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
        <main class="main-container">    
            <form method="post" action="">
                <h1>Bon de commande </h1>
                <h3>Veuillez Remplir Tous les champs!</h3>
                <div class="input">
                   <div class="input">
                     <label>Numéro de DI:<input type="number" id="num" name="num"></label>
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
                     <label>Quantité Demandée:<input type="number" id="quantite_dem" name="quantite_dem"><br></label>
                     <label>Quantité livrée:<input type="number" id="quantite_liv" name="quantite_liv"></label>
                  </div>
                  <div class="input">
                     <label>Observation :<input type="text" id="observation" name="observation"><br></label>
                    <label>Numéro bon de sortie :<input type="number" id="n_bonsortie" name="n_bonsortie"><br></label>
                  </div>
                  <div class="input">
                     <label>Date de livraison :<input type="date" id="date_livraison" name="date_livraison"><br></label>
                    
                  </div>
                
 
                 

                  

                 

                 
                 

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
    <script src="../js/boncom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</html>