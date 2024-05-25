<?php 
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parc_auto";

try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<script>alert("La connexion a échoué : ' . $e->getMessage() . '")</script>';
}

// Requête pour récupérer toutes les données des véhicules par défaut
$query_vehicules = "SELECT * FROM véhicule";
$result_vehicules = $conn->query($query_vehicules);
$vehicules_data = $result_vehicules->fetchAll(PDO::FETCH_ASSOC);

// Requête pour compter les rows
$sqlt = "SELECT COUNT(*) as total_elements FROM véhicule";
$resultt = $conn->query($sqlt);
$rowt = $resultt->fetch(PDO::FETCH_ASSOC);

// Requête pour compter les demandes d'intervention par véhicule
$sql_di = "SELECT COUNT(*) as di, matricule_v FROM demande_i GROUP BY matricule_v";
$result_di = $conn->query($sql_di);
$di_data = $result_di->fetchAll(PDO::FETCH_ASSOC);

// Créer un tableau associatif pour les demandes d'intervention
$di_counts = [];
foreach ($di_data as $row_di) {
    $di_counts[$row_di['matricule_v']] = $row_di['di'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Gestionnaire - Bon de commande</title>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/suivires.js"></script>
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/suivires.css">
</head>
<body>
    <div class="grid-container">
        <!-- Entete -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left"></div>
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
                    <a href="dashboardRes.php" target="_self">
                        <i class='bx bxs-dashboard icon'></i>
                        <span class="text nav-text">Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="resdemande.php" target="_self">
                        <i class='bx bx-git-pull-request icon'></i>
                        <span class="text nav-text">Demande de véhicule</span>
                    </a>
                </li>
 
                <li class="sidebar-list-item">
                    <a href="resordremiss.php" target="_self">
                        <i class='bx bx-list-check icon'></i>
                        <span class="text nav-text">Ordres de Mission</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#" target="_self">
                        <i class='bx bxs-car-mechanic icon'></i>
                        <span class="text nav-text">Liste Des véhicules</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
            <a href="../php/users.php" target="_self">
            <i class='bx bx-plus'></i>
                <span class="text nav-text">Gestion des utilsateurs</span>
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
        <!-- Fin du menu -->
        <!-- Main -->
        <main class="main-container">
            <!-- Formulaire de recherche -->
            <form method="post" action="">
                <div class="search">
                    <input autocomplete="off" type="text" name="search" id="search" oninput="searchTable()" placeholder="Recherche par Matricule....">
                    <button type="submit"><i class='bx bx-search-alt'></i></button>
                </div>
            </form>

            <!-- Tableau des véhicules -->
            <div class="table-container">
                <table id="tableV">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Active</th>
                            <th>Puissance</th>
                            <th>Année</th>
                            <th>Couleur</th>
                            <th>km_actuel</th>
                            <th>km_initial</th>
                            <th>Demande d'intervention effectué</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicules_data as $row) { ?>
                        <tr>
                            <td><?php echo $row['matricule_v']; ?></td>
                            <td><?php echo $row['marque']; ?></td>
                            <td><?php echo $row['modele']; ?></td>
                            <td><?php echo $row['flag'] == 1 ? 'Active' : 'Non active'; ?></td>
                            <td><?php echo $row['puissance']; ?></td>
                            <td><?php echo $row['anne_v']; ?></td>
                            <td><?php echo $row['couleur']; ?></td>
                            <td><?php echo $row['km_actuel']; ?></td>
                            <td><?php echo $row['km_init']; ?></td>
                            <td><?php echo isset($di_counts[$row['matricule_v']]) ? $di_counts[$row['matricule_v']] : '0'; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">Nombre de véhicules: <?php echo $rowt['total_elements']; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </main>
        <!-- Scripts -->
    </div>
</body>
</html>
