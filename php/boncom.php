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
                <?php
               // Assurez-vous que $nom et $prenom sont définis
               $nom = isset($nom) ? $nom : '';
               $prenom = isset($prenom) ? $prenom : '';
                ?>
                <label>Nom et Prénom  :<input type="text" name="nom_prenom" id="nom_prenom" value="<?php echo isset($nom) ? $nom . ' ' . $prenom : ''; ?>"></label>
                <label>Matricule  :
                <select autocomplete="off"type="number" name="matricule">
                </select></label>
                </div>
                <div class="input">
                    <label>adresse administratif :<input type="text" name="adress_admin" id="adress_admin"></label>
                    <label>Fonction:<input type="text" name="adress_admin"></label>
                </div>
                <div class="input">
                    <label>Moyen de déplacement:<input type="text" name="matricule_v"></label>
                    <label>Déstination:<input type="text" name="emplacement"></label>
                </div>
                <div class="motif">
                <label>Motif:</label><input type="text" name="raison" id="raison">
                </div>
                <div class="input">
                    <label>Date de déplacement:<input type="date" name="date_dep"></label>
                    <label>Date De Retour:<input type="date" name="date_ret"></label>
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