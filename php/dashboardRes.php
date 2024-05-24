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


        // Requête pour récupérer le nombre total d'éléments dans demande_v où flag = 4
        $sqlt = "SELECT COUNT(*) as total_elements FROM demande_v WHERE flag = 4";
        $resultt = $pdo->query($sqlt);
        $rowt = $resultt->fetch(PDO::FETCH_ASSOC);

        //requete des véhicule active
        $sqlv = "SELECT COUNT(*) as active FROM véhicule WHERE flag = 1";
        $resultv = $pdo->query($sqlv);
        $rowv = $resultv->fetch(PDO::FETCH_ASSOC);

               // Requête pour récupérer le nombre total d'éléments dans demande_v où flag = 4
               $sqlu = "SELECT COUNT(*) as user FROM employe ";
               $resultu = $pdo->query($sqlu);
               $rou = $resultu->fetch(PDO::FETCH_ASSOC);
    
        // Requête pour compter les véhicules nécessitant un entretien
        $requete = $pdo->prepare("SELECT COUNT(*) AS nombre_de_lignes FROM véhicule WHERE vidange >= seuil_v OR chaine >= seuil_pch");
        $requete->execute();
        
        // Récupérer le nombre de lignes
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $nombreDeLignes = $resultat['nombre_de_lignes'];
 
    // Requêtes pour chaque table
    $query_demande_v = " 
    SELECT  
        YEAR(date_insertion) AS annee, 
        MONTH(date_insertion) AS mois, 
        COUNT(*) AS nombre_demandes_v 
    FROM  
        demande_v 
    GROUP BY  
        YEAR(date_insertion),  
        MONTH(date_insertion) 
    ORDER BY  
        YEAR(date_insertion),  
        MONTH(date_insertion); 
    "; 
 
    $query_demande_i = " 
    SELECT  
        YEAR(date_insertion) AS annee, 
        MONTH(date_insertion) AS mois, 
        COUNT(*) AS nombre_demandes_i 
    FROM  
        demande_i 
    GROUP BY  
        YEAR(date_insertion),  
        MONTH(date_insertion) 
    ORDER BY  
        YEAR(date_insertion),  
        MONTH(date_insertion); 
    "; 
 
    $query_bc = " 
    SELECT  
        YEAR(date_insertion) AS annee, 
        MONTH(date_insertion) AS mois, 
        COUNT(*) AS nombre_bc 
    FROM  
        bc 
    GROUP BY  
        YEAR(date_insertion),  
        MONTH(date_insertion) 
    ORDER BY  
        YEAR(date_insertion),  
        MONTH(date_insertion); 
    "; 
 
    // Exécution des requêtes et récupération des données 
    $demande_v = $pdo->query($query_demande_v)->fetchAll(); 
    $demande_i = $pdo->query($query_demande_i)->fetchAll(); 
    $bc = $pdo->query($query_bc)->fetchAll(); 
 
    // Fusion des résultats 
    $data = []; 
    foreach ($demande_v as $row) { 
        $data[$row['annee'] . '-' . $row['mois']]['annee'] = $row['annee']; 
        $data[$row['annee'] . '-' . $row['mois']]['mois'] = $row['mois']; 
        $data[$row['annee'] . '-' . $row['mois']]['nombre_demandes_v'] = $row['nombre_demandes_v']; 
    } 
 
    foreach ($demande_i as $row) { 
        $data[$row['annee'] . '-' . $row['mois']]['nombre_demandes_i'] = $row['nombre_demandes_i']; 
    } 
 
    foreach ($bc as $row) { 
        $data[$row['annee'] . '-' . $row['mois']]['nombre_bc'] = $row['nombre_bc']; 
    } 
 
    $data_json = json_encode(array_values($data)); 
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
  <script src="../js/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Custom JS -->
  <script src="../js/dashboardRes.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Page Gestionnaire</title>
  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/dashboardRes.css">
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
            <a href="../php/resdemande.php" target="_self">
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
            <a href="../php/Resordremiss.php" target="_self">
              <i class='bx bx-list-check icon'></i>
                    <span class="text nav-text">Ordres de Mission</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="../php/suivires.php" target="_self">
              <i class='bx bxs-car-mechanic icon'></i>
                    <span class="text nav-text">Liste Des véhicules</span>
            </a>
          <li class="sidebar-list-item">
            <a href="../php/users.php" target="_blank">
            <i class='bx bx-plus'></i>
                <span class="text nav-text">Gestion des utilsateurs</span>
            </a>
        </li>
        </ul>
      </aside>
    <!-- fin de main -->
    <!--nouveau Main-->
    <!--Demande de véhicule-->
    <main class="main-container">
      <div class="main-cards">
        <div class="card">
          <div class="card-inner">
            <h1>Demande de véhicule Reçu: <?php echo $rowt['total_elements']?></h1>
          </div>
        </div>
        <div class="card">
          <h1>Les véhicules Active :<?php echo $rowv['active']?></h1>
        </div>

        <div class="card">
            <div class="card-inner">
            <h1>Les véhicules Active :6</h1>
            </div>
          </div>
          <div class="card">
            <div class="card-inner">
            <h1>nombre de user :<?php echo $rou['user']?></h1>
            </div>
          </div>
      </div>
      <div class="charts">
        <div class="charts-card">
          <h2 class="chart-title">Demandes de Véhicule ,Demande d'intervention,Bon de commande : par Mois</h2>
          <div id="dv-chart"></div>
        </div>
      </div>
    </main>
  </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <!-- ApexCharts -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    // Récupérer les données JSON depuis PHP
    const data = <?php echo $data_json; ?>;

    // Récupérer les labels
    const labels = data.map(item => `${item.annee}-${item.mois}`);

    // Récupérer les séries de données
    const seriesData = {
        demande_v: data.map(item => item.nombre_demandes_v),
        demande_i: data.map(item => item.nombre_demandes_i),
        bc: data.map(item => item.nombre_bc)
    };

    // Initialiser le graphique
    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Demandes de Véhicule',
            data: seriesData.demande_v
            
        }, {
            name: 'Demandes d\'Intervention',
            data: seriesData.demande_i
        }, {
            name: 'Bons de Commande',
            data: seriesData.bc
        }],
        xaxis: {
            categories: labels,
        },
        yaxis: {
            title: {
                text: 'Nombre de demandes'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " demandes"
                }
            }
        }
    }

    var chart = new ApexCharts(document.querySelector("#dv-chart"), options);

    // Afficher le graphique
    chart.render();
</script>

<!-- HTML existant -->

    
</html>
