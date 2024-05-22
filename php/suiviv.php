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
        $query_vehicules = "SELECT * FROM véhicule";
        $result_vehicules = $conn->query($query_vehicules);
        $vehicules_data = $result_vehicules->fetchAll(PDO::FETCH_ASSOC);


        //Requête pour récupérer toutes les données des véhicules 
        $suivi_query = "SELECT matricule_v,km_dep,km_ret FROM suivi_v";
        $result_suivi = $conn->query($suivi_query);
        $suivi_data = $result_suivi->fetchAll(PDO::FETCH_ASSOC);

        // Requete pour compter les rows
        $sqlt = "SELECT COUNT(*) as total_elements FROM véhicule";
        $resultt = $conn->query($sqlt);
        $rowt = $resultt->fetch(PDO::FETCH_ASSOC);

        // Si le formulaire de recherche est soumis
        if(isset($_POST["search"])) {
        $matricule_v = $_POST["search"];
            // Requête de recherche des véhicules par matricule
        $query_search = "SELECT * FROM véhicule WHERE matricule_v LIKE '%$matricule_v%'";
        $result_vehicules = $conn->query($query_search);
        }
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
    <script src="../js/suivires.js"></script>
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/suiviv.css">
</head>
<body>
    <div class="grid-container">
        <!-- Entete -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
            </div>
            <div class="header-right">
            
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
                    <a href="dashboardGest.html" target="_self">
                        <i class='bx bxs-dashboard icon'></i>
                        <span class="text nav-text">Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
            <a href="demandeGest.php" target="_self">
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
            <a href="Ordremiss.php" target="_self">
              <i class='bx bx-list-check icon'></i>
                    <span class="text nav-text">Ordres de Mission</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="suiviv.php" target="_self">
              <i class='bx bxs-car-mechanic icon'></i>
                    <span class="text nav-text">Suivi de Véhicule</span>

            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="RA" target="_self">
              <i class='bx bxs-car-crash icon'></i>
                    <span class="text nav-text">Rapport d'Accident</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="parametre" target="_self">
              <i class='bx bx-cog icon' ></i>
                <span class="text nav-text">Paramétres</span>
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
                    <input autocomplete="off"type="text" name="search" id="search" placeholder="Recherche par Matricule....">
                    <button type="submit"><i class='bx bx-search-alt'></i></button>
                </div>
            </form>  
            
            <!-- Tableau des véhicules -->
            <div class="table-container">
                <table>
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
                            <th>Actions</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                    $vidange = 0;
                    $chaine = 0;
                    $plaquette = 0;


                        foreach($vehicules_data as $row) { 
                        $km_actuel = $row['km_actuel'];
                        $seuil_v = $row['seuil_v'];
                        $seuil_pch = $row['seuil_pch'];
                        $km_init = $row['km_init'];
                        $seuil_plaquette = $row['seuil_plaquette'];
                        $vidange =$row['vidange'];
                        $chaine = $row['chaine'];
                        ?>
                        <?php
                        if($vidange >= $seuil_v){
                            $display='inline-block;'; //Afficher le boutton
                        }else{
                        $display='none;';//Masquer le boutton
                            }
                        if($chaine >= $seuil_pch){
                        $displayc='inline-block;'; //Afficher le boutton
                        }else{
                        $displayc='none;';//Masquer le boutton
                        }
                        if($km_actuel >= $seuil_plaquette){
                        $displayp='inline-block;';// Afficher le bouton
                        }else{
                        $displayp='none;';   
                        }

                            ?>
                        
                            <tr>
                                <td><?php echo $row['matricule_v']; ?></td>
                                <td><?php echo $row['marque']; ?></td>
                                <td><?php echo $row['modele']; ?></td>
                                <td><?php if ($row['flag'] == 1) { ?>
                                        <span> Active </span>
                                    <?php } else { ?>
                                        <span>Non active</span>
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['puissance']; ?></td>   
                                <td><?php echo $row['anne_v']; ?></td>                       
                                <td><?php echo $row['couleur']; ?></td>
                                <td><?php echo $row['km_actuel']; ?></td>
                                <td>
                                <button class="edit" title="Modifier" onclick="showEditTable('<?php echo $row['matricule_v']; ?>', 
                                '<?php echo $row['marque']; ?>', '<?php echo $row['modele']; ?>', '<?php echo $row['puissance']; ?>',
                                 '<?php echo $row['anne_v']; ?>', '<?php echo $row['couleur']; ?>', '<?php echo $row['km_actuel']; ?>')"><i class='bx bx-edit'></i></button>
                                <button class="suivi" title="Suivi" onclick="showSuiviForm('<?php echo $row['matricule_v']; ?>')"><i class='bx bx-receipt'></i></button>
                                <button class="di" title="Demande d'intervention"onclick="showDiForm('<?php echo $row['matricule_v']; ?>')" ><i class="bx bx-git-pull-request"></i></button>         
                                </td>
                                <td>   
                                <button class="obser" id="vidange" style="display: <?php echo $display; ?>;"><i class='bx bx-gas-pump'></i></button>
                                <button class="obser" id="chaine" style="display: <?php echo $displayc; ?>;"><i class='bx bx-cog' ></i></button>
                                <button class="obser" id="plaquette" style="display: <?php echo $displayp; ?>;"><i class='bx bx-wrench'></i></button>
                                </td>
                        </tr>
                        <?php  
                    }?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="9">Nombre de véhicules: <?php echo $rowt['total_elements']?></td>
                        <td id="ajout">Ajouter des Véhicules<button><i class='bx bx-plus' ></i></button></td>
                    </tr>
                    </tfoot>
                </table>
            </div>  















            <!--SECTION DES MODALS-->




            <!--Modal-1-Suivi-->
            <div id="myModal" class="modal">
            <div class="modal-content" id="modal-content">
            <div class="close"><i class='bx bx-x-circle'></i></div>    
            <div class="formulaire">
            <form method="post" action="">
                <header><h2>Suivi de véhicule</h2></header>
                <input type="hidden" name="matricule_v" class="matricule_v">
                <div class="input"><label>Kilométrage de départ:</label><input autocomplete="off"type="number" name="km_dep"  maxlength="5"></div>
                <div class="input"><label>Kilométrage de Retour:</label><input autocomplete="off"type="number" name="km_ret" maxlength="5"></label></div>
                <div class="input"><label>Consommation carburant:</label><input autocomplete="off"type="number" name="consom_car" maxlength="5"></label></div>
                <div class="input"><label>Date:</label><input autocomplete="off"type="date" name="date_s"></div>
                <footer>
                <button name="Terminer">Terminer</button>
                </footer>
            </form>   
            </div>
            </div>
            
            </div>
            <!--FIN-MODAL-Suivi-->
            
             
            


            <!--MODAL DE MODIFICATION-->
            <div id="edit" class="modal">
                <div class="modal-content" id="modal-edit">
                 <span class="close">&times;</span>
                 <h3>Modifie les véhicule</h3>
                 <div class="table-container">
                 <table>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                  <tbody>
                  <tr>
                    <form method="post" action="">
                    <td><input name="matricule_v" class="matricule_v"></td>
                    <td><input name="marque" id="marque"></td>
                    <td><input name="modele" id="modele"></td>
                    <td>
                    <select name="flag" id="flag">
                    <option value="1" <?php if ($row['flag'] == 1) echo 'selected="selected"'; ?>>Active</option>
                    <option value="0" <?php if ($row['flag'] == 0) echo 'selected="selected"'; ?>>Non active</option>
                    </select>
                    </td>
                    <td><input name="puissance" id="puissance"></td>   
                    <td><input name="anne_v" id="anne_v"></td>                       
                    <td><input name="couleur" id="couleur"></td>
                    <td><input name="km_actuel" id="km_actuel"></td>
                    <td><button id="edit-btn" type="submit" name="edit-btn"><i class='bx bx-check-double'></i></button></td>
                    </form>
                    </tr>                        
                </tbody>
              </table>
          </div>
        </div>
        </div>
            </div> 
            <!--MODAL-Modifier un véhcule-->
                                        
                 
             <!--Modal-3-DI-->
             <div id="demande-intervention" class="modal">
            <div class="modal-content" id="modal-di">
            <div class="close"><i class='bx bx-x-circle'></i></div>    
            <div class="formulaire">
            <form method="post" action="">
                <header><h2>Demande d'intervention</h2></header>
                <input type="hidden" name="matricule_v" class="matricule_v">
                <div class="input"><label>num° de DI:</label><input autocomplete="off"type="number" name="num"  maxlength="5"></div>
                <div class="input"><label>date de DI:</label><input autocomplete="off"type="date" name="date_i" ></label></div>
                <div class="input"><label>Nature:</label><select name="nature" id="nature" >
                    <option value="vidange">Vidange</option>
                    <option value="Changement de chaine" >Changement de Chaine</option>
                    <option value="Changement de plaquette de Frein">Changement de plaquette de frein</option> 
                    </select></div>
                <footer>
                <button name="di">Terminer</button>
                </footer>
            </form>   
            </div>
            </div>
            
            </div>
            <!--FIN-MODAL-Suivi-->


            <div id="add" class="modal">
            <div class="modal-content" id="modal-add">
            <div class="close"><i class='bx bx-x-circle'></i></div>    
            <div class="formulaire">
            <form method="post" action="">
                <header><h2>Ajouter noveau véhicule</h2></header>
                <div class="input"><label>matricule:</label><input autocomplete="off"type="number" name="matricule_v"  maxlength="5"></div>
                <div class="input"><label>marque:</label><input autocomplete="off"type="text" name="marque" ></label></div>
                <div class="input"><label>modele:</label><input autocomplete="off"type="text" name="modele" ></label></div>
                <div class="input"><label>état:</label><select name="flag">
                    <option value="active">Active</option>
                    <option value="non active" >Non Active</option>
                    </select></div>
                <div class="input"><label>année:</label><input autocomplete="off" type="date" name="anne_v"></label></div>
                <div class="input"><label>couleur:</label><input autocomplete="off"type="text" name="couleur"  maxlength="5"></div>
                <div class="input"><label>km initiale:</label><input autocomplete="off"type="text" name="km_init"  ></label></div>
                <div class="input"><label>seuil de vidange:</label><input autocomplete="off"type="number" name="seuil_v" ></label></div>
                <div class="input"><label>seuil de changement de chaine</label><input autocomplete="off"type="number" name="seuil_pch"  maxlength="5"></div>
                <div class="input"><label>seuil de changement de plaque de freins:</label><input autocomplete="off"type="number" name="seuil_plaquette" ></label></div>
                


                
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
    // Si le formulaire de recherche est soumis
    if(isset($_POST["search"])) {
        $matricule_v = $_POST["search"];
            // Requête de recherche des véhicules par matricule
        $query_search = "SELECT * FROM véhicule WHERE matricule_v LIKE '%$matricule_v%'";
        $result_vehicules = $conn->query($query_search);
        }

            //Si le formulaire de Suivi est soumis 
        if(isset($_POST["Terminer"])) {
            // Vérification si les champs sont vides
        if(empty($_POST['matricule_v']) || empty($_POST['km_dep']) || empty($_POST['km_ret']) || empty($_POST['consom_car']) ||
        empty($_POST['date_s'])) {
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
        $matricule_v = $_POST['matricule_v'];
        $km_dep = $_POST['km_dep'];
        $km_ret = $_POST['km_ret'];
        $consom_car = $_POST['consom_car'];
        $date_s = $_POST['date_s'];
        
        try {
            // Préparation et exécution de la requête d'insertion
            $sql_insert = "INSERT INTO suivi_v (matricule_v, km_dep, km_ret, consom_car, date_s) 
                    VALUES (:matricule_v, :km_dep, :km_ret, :consom_car, :date_s)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(':matricule_v', $matricule_v);
            $stmt->bindParam(':km_dep', $km_dep);
            $stmt->bindParam(':km_ret', $km_ret);
            $stmt->bindParam(':consom_car', $consom_car);
            $stmt->bindParam(':date_s', $date_s);
            $stmt->execute();
            // Mise à jour de la valeur km_actuel dans la table véhicule
            $sql_update_km = "UPDATE véhicule 
                              SET km_actuel = km_actuel + (:km_ret - :km_dep) WHERE matricule_v = :matricule_v";
            $stmt_update_km = $conn->prepare($sql_update_km);
            $stmt_update_km->bindParam(':matricule_v', $matricule_v);
            $stmt_update_km->bindParam(':km_dep', $km_dep);
            $stmt_update_km->bindParam(':km_ret', $km_ret);
            $stmt_update_km->execute();

            $sql_update_vidange = "UPDATE véhicule 
            SET vidange = vidange + (:km_ret - :km_dep) WHERE matricule_v = :matricule_v";
            $sql_update_vidange = $conn->prepare($sql_update_vidange);
            $sql_update_vidange->bindParam(':matricule_v', $matricule_v);
            $sql_update_vidange->bindParam(':km_dep', $km_dep);
            $sql_update_vidange->bindParam(':km_ret', $km_ret);
            $sql_update_vidange->execute();


            $sql_update_chaine = "UPDATE véhicule 
            SET chaine = chaine + (:km_ret - :km_dep) WHERE matricule_v = :matricule_v";
            $sql_update_chaine = $conn->prepare($sql_update_chaine);
            $sql_update_chaine->bindParam(':matricule_v', $matricule_v);
            $sql_update_chaine->bindParam(':km_dep', $km_dep);
            $sql_update_chaine->bindParam(':km_ret', $km_ret);
            $sql_update_chaine->execute();

            echo '<script>
            Swal.fire({
                title: "Les informations ont été enregistrées avec succès.",
                icon: "success",
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
          </script>';
    
        } catch (PDOException $e) {
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

        //Si le formulaire de modification est soumis
    if(isset($_POST["edit-btn"])) {
    // Vérification si les champs sont vides
    if(empty($_POST['matricule_v']) || empty($_POST['marque']) || empty($_POST['modele']) || empty($_POST['flag']) ||
    empty($_POST['puissance'])|| empty($_POST['anne_v'])|| empty($_POST['couleur'])|| empty($_POST['km_actuel'])) {
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
    } else {
        try {
            // Assurez-vous que $conn est accessible ici
            if(!isset($conn)) {
                echo '<script>
                Swal.fire({
                    title: "Connexion à la base de données non établie.",
                    icon: "warning",
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
              </script>';
            } else {
                // Préparation et exécution de la requête d'update
                $sql_update = "UPDATE véhicule 
                            SET marque = :marque, modele = :modele, flag = :flag, 
                                puissance = :puissance, anne_v = :anne_v, couleur = :couleur, km_actuel = :km_actuel
                            WHERE matricule_v = :matricule_v";
                $stmt = $conn->prepare($sql_update);
                // Liaison des paramètres
                $stmt->bindParam(':matricule_v', $_POST['matricule_v']);
                $stmt->bindParam(':marque', $_POST['marque']);
                $stmt->bindParam(':modele', $_POST['modele']);
                $stmt->bindParam(':flag', $_POST['flag']);
                $stmt->bindParam(':puissance', $_POST['puissance']);
                $stmt->bindParam(':anne_v', $_POST['anne_v']);
                $stmt->bindParam(':couleur', $_POST['couleur']);
                $stmt->bindParam(':km_actuel', $_POST['km_actuel']);
                $stmt->execute();
                echo '<script>
                Swal.fire({
                    title: "Les informations ont été mises à jour avec succès.",
                    icon: "success",
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
              </script>';
                
            }
        } catch (PDOException $e) {
            echo '<script>
            Swal.fire({
                title: "Erreur lors de la mise à jour des informations",
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

function showErrorAlert($message) {
    echo '<script>
    Swal.fire({
        title: "Erreur",
        text: "' . $message . '",
        icon: "error",
        confirmButtonText: "OK",
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
  </script>';
}


if (isset($_POST['di'])) {
    // Récupération des données du formulaire
    $matricule_v = $_POST['matricule_v'];
    $num = $_POST['num'];
    $date_i = $_POST['date_i'];
    $nature = $_POST['nature'];

    try {
        // Récupérer la valeur km_actuel du véhicule depuis la base de données
        $stmt_km = $conn->prepare("SELECT km_actuel,km_init,vidange,chaine FROM véhicule WHERE matricule_v = :matricule_v");
        $stmt_km->bindParam(':matricule_v', $matricule_v);
        $stmt_km->execute();
        $row_km = $stmt_km->fetch(PDO::FETCH_ASSOC);
        $km_actuel = $row_km['km_actuel'];
        $km_init = $row_km['km_init'];
        $vidange = $row_km['vidange'];
        $chaine = $row_km['chaine'] ;
        

        if ($nature == "Changement de plaquette de Frein") {
            // Ajout du code spécifique pour la vidange
            $km_init = $km_actuel + $km_init;
            $km_actuel = 0;
        }elseif($nature =="vidange"){
            $vidange = 0;
        }else{
            $chaine=0; 
        }
        // Préparation et exécution de la requête d'insertion
        
        $stmt = $conn->prepare("INSERT INTO demande_i (matricule_v, num, date_i, nature) VALUES (:matricule_v, :num, :date_i, :nature)");
        $stmt->bindParam(':matricule_v', $matricule_v);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':date_i', $date_i);
        $stmt->bindParam(':nature', $nature);
        $stmt->execute();



        // Mise à jour des valeurs km_actuel et km_init dans la table véhicule
        $stmt_update = $conn->prepare("UPDATE véhicule SET km_init = :km_init, km_actuel = :km_actuel, vidange = :vidange, chaine = :chaine WHERE matricule_v = :matricule_v");
        $stmt_update->bindParam(':km_init', $km_init);
        $stmt_update->bindParam(':km_actuel', $km_actuel);
        $stmt_update->bindParam(':matricule_v', $matricule_v);
        $stmt_update->bindParam(':vidange', $vidange);
        $stmt_update->bindParam(':chaine', $chaine);
        $stmt_update->execute();
        echo '<script>
        Swal.fire({
            title: "La demande d\'intervention a été ajoutée avec succès.",
            icon: "success",
            confirmButtonText: "OK",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
      </script>';
    } catch (PDOException $e) {
        echo '<script>
        Swal.fire({
            title: "Une erreur est survenue lors de l\'insertion",
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

            // Vérification si le formulaire a été soumis
                if (isset($_POST['add'])) {
                    if (empty($_POST['matricule_v']) || empty($_POST['marque']) || empty($_POST['modele']) || empty($_POST['flag']) ||
                     empty($_POST['anne_v']) || empty($_POST['couleur']) || empty($_POST['km_init']) || empty($_POST['seuil_v']) ||
                      empty($_POST['seuil_pch']) || empty($_POST['seuil_plaquette'])) {
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
            $matricule_v = $_POST['matricule_v'];
            $marque = $_POST['marque'];
            $modele = $_POST['modele'];
            $flag = ($_POST['flag'] == "active") ? 1 : 0;
            $anne_v = $_POST['anne_v'];
            $couleur = $_POST['couleur'];
            $km_init = $_POST['km_init'];
            $seuil_v = $_POST['seuil_v'];
            $seuil_pch = $_POST['seuil_pch'];
            $seuil_plaquette = $_POST['seuil_plaquette'];
    try {
        // Préparation de la requête d'insertion
        $requete = $conn->prepare("INSERT INTO véhicule (matricule_v, marque, modele, flag, anne_v, couleur, km_init, seuil_v, seuil_pch, seuil_plaquette) 
                                        VALUES (:matricule_v, :marque, :modele, :flag, :anne_v, :couleur, :km_init, :seuil_v, :seuil_pch, :seuil_plaquette)");
        
        // Liaison des paramètres
        $requete->bindParam(':matricule_v', $matricule_v);
        $requete->bindParam(':marque', $marque);
        $requete->bindParam(':modele', $modele);
        $requete->bindParam(':flag', $flag);
        $requete->bindParam(':anne_v', $anne_v);
        $requete->bindParam(':couleur', $couleur);
        $requete->bindParam(':km_init', $km_init);
        $requete->bindParam(':seuil_v', $seuil_v);
        $requete->bindParam(':seuil_pch', $seuil_pch);
        $requete->bindParam(':seuil_plaquette', $seuil_plaquette);
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
