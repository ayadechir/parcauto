<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="refresh" content="30">-->
    <title>Page Gestionnaire - Bon de commande</title>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/suiviv.js"></script>
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/suiviv.css">
</head>
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
        $query_employe = "SELECT * FROM employe";
        $result_employe = $conn->query($query_employe);
        $employe_data = $result_employe->fetchAll(PDO::FETCH_ASSOC);


        //Requête pour récupérer toutes les données des véhicules 
        $suivi_query = "SELECT matricule_v,km_dep,km_ret FROM suivi_v";
        $result_suivi = $conn->query($suivi_query);
        $suivi_data = $result_suivi->fetchAll(PDO::FETCH_ASSOC);

        // Requete pour compter les rows
        $sqlt = "SELECT COUNT(*) as total_elements FROM employe";
        $resultt = $conn->query($sqlt);
        $rowt = $resultt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="refresh" content="30">-->
    <title>Page Gestionnaire - Bon de commande</title>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/users.js"></script>
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/users.css">
</head>
<body>
    <div class="grid-container">
        <!-- Entete -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <h2>Gestion des utilisateurs</h2>
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
            <a href="#BC" target="_self">
              <i class='bx bx-receipt icon'></i>
                    <span class="text nav-text">Bon de Commande</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="Resordremiss.php" target="_self">
              <i class='bx bx-list-check icon'></i>
                    <span class="text nav-text">Ordres de Mission</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="suivires.php" target="_self">
              <i class='bx bxs-car-mechanic icon'></i>
                    <span class="text nav-text">Liste des véhicules</span>

            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="ajoute" target="_blank">
            <i class='bx bx-plus'></i>
                <span class="text nav-text">Gestion des utilsateurs</span>
            </a>
        </li>
                <!-- Autres éléments du menu ici -->
            </ul>
        </aside>
        <!-- Fin du menu -->
        <!-- Main -->
        <main class="main-container">    
            <!-- Formulaire de recherche -->
            <form method="post" action="">
                <div class="search">
                    <input autocomplete="off"type="text" name="search" id="search" oninput="searchTable()"
                     placeholder="Recherche par Matricule....">
                    <button type="submit"><i class='bx bx-search-alt'></i></button>
                </div>
            </form>  
            
            <!-- Tableau des véhicules -->
            <div class="table-container">
                <table id="tableV">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Num de département</th> 
                            <th>Fonction</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                        foreach($employe_data as $row) { 
                        ?>
                            <tr>
                                <td><?php echo $row['matricule']; ?></td>
                                <td><?php echo $row['nom']; ?></td>
                                <td><?php echo $row['prenom']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td><?php echo $row['num_departement']; ?></td>   
                                <td><?php echo $row['fonction']; ?></td>   
                                
                        </tr>
                        <?php  
                    }?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">Nombre de véhicules: <?php echo $rowt['total_elements']?></td>
                        <td id="ajout">Ajouter des Véhicules<button><i class='bx bx-plus' ></i></button></td>
                    </tr>
                    </tfoot>
                </table>
            </div>  















            <!--SECTION DES MODALS-->

            <div id="add" class="modal">
            <div class="modal-content" id="modal-add">
            <div class="close"><i class='bx bx-x-circle'></i></div>    
            <div class="formulaire">
            <form method="post" action="">
                <header><h2>Ajouter noveau véhicule</h2></header>
                <div class="input"><label>matricule:</label><input autocomplete="off"type="number" name="matricule"  maxlength="5"></div>
                <div class="input"><label>nom:</label><input autocomplete="off"type="text" name="nom" ></label></div>
                <div class="input"><label>prenom:</label><input autocomplete="off"type="text" name="prenom" ></label></div>
                <div class="input"><label>Email:</label><input autocomplete="off" type="text" name="email"></label></div>
                <div class="input"><label>Role:</label><input autocomplete="off"type="text" name="role"  maxlength="5"></div>
                <div class="input"><label>Num de département:</label><input autocomplete="off"type="text" name="num_departement"  ></label></div>


                
                <footer>
                <button name="add">Ajouter</button>
                </footer>
            </form>   
            </div>
            </div>
            
            </div>


            
        </main>
        <!-- Scripts -->
    </div>
</body>
</html><?php


            // Vérification si le formulaire a été soumis
                if (isset($_POST['add'])) {
                    if (empty($_POST['matricule']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) ||
                     empty($_POST['role']) || empty($_POST['num_departement'])) {
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
                    }else {
             // Récupération des données du formulaire
            $matricule = $_POST['matricule'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $num_departement = $_POST['num_departement'];
    try {
        // Préparation de la requête d'insertion
        $requete = $conn->prepare("INSERT INTO employe (matricule,nom ,prenom,email,role,num_departement) 
                                        VALUES (:matricule,:nom ,:prenom,:email,:role,:num_departement)");
        
        // Liaison des paramètres
        $requete->bindParam(':matricule', $matricule);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':role', $role);
        $requete->bindParam(':num_departement', $num_departement);
        // Exécution de la requête
        $requete->execute();
        echo '<script>
        Swal.fire({
            title: "Nouveau véhicule ajouté avec succès.",
            icon: "success",
            confirmButtonText: "OK",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
      </script>';
    } catch(PDOException $e) {
        echo '<script>
        Swal.fire({
            title: "Erreur lors de l\'ajout du véhicule",
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
