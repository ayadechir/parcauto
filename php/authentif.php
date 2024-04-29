<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <title>Connexion</title>
    <link href="../css/style.css" rel="stylesheet" >
</head>
<body>
<img src="../pictures/logo-naftal.png">
<section class="container">
<form action="" method="post">
<h1>S'authentifier</h1>
<input autocomplete="off" type="text" id="username" name="username" placeholder="Nom d'utilisateur" >
<input autocomplete="off" type="password" id="password" name="mot_passe" placeholder="Mot de passe" >
<button type="submit" name="Connexion">Connexion</button>
</form>
</section>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</html>
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parc_auto";

try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<script>Swal.fire("Erreur", "La connexion a échoué : ' . $e->getMessage() . '", "error")</script>';
}

if (isset($_POST['Connexion'])) {
    if (!empty($_POST['username']) && !empty($_POST['mot_passe'])) {
        $username = htmlspecialchars($_POST['username']);
        $mot_passe = $_POST['mot_passe'];

        $recupUser = $conn->prepare('SELECT * FROM employe WHERE username=?');
        $recupUser->execute(array($username));

        if ($recupUser->rowCount() > 0) {
            $userData = $recupUser->fetch();
            if ($mot_passe === $userData['mot_passe']) { 
                $_SESSION['username'] = $username;
                $_SESSION['mot_passe'] = $userData['mot_passe'];
                $_SESSION['role'] = $userData['role'];
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'G'){
                    header('Location:dashboardGest.html');
                }elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'r'){
                    header('reponsabledash.html');
                }elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'chp'){
                    header('chefdeparc.html');
                }else{
                    header('Location:moncompte.php');
                }
                exit();
            
            } else {
                echo '<script>Swal.fire("Erreur", "Votre mot de passe ou nom d\'utilisateur est incorrect", "error")</script>';
            }
        } else {
            echo '<script>Swal.fire("Erreur", "Votre mot de passe ou nom d\'utilisateur est incorrect", "error")</script>';
        }
    } else {
        echo '<script>Swal.fire("Attention", "Veuillez compléter les champs", "warning")</script>';
    }
}
?>
