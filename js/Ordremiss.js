

// Fonction pour récupérer les informations (nom, prénom) associées au matricule sélectionné
function recupererInfos() {
    // Récupérer le matricule sélectionné
    var matricule = document.getElementById('matricule').value;

    // Effectuer une requête AJAX vers le serveur pour récupérer les informations associées au matricule
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Traitement de la réponse JSON
                var reponse = JSON.parse(xhr.responseText);
                // Mettre à jour les champs de nom et prénom avec les données récupérées
                document.getElementById('nom_prenom').value = reponse.nom + ' ' + reponse.prenom;
            } else {
                // Gérer les erreurs
                console.error('Erreur lors de la récupération des informations.');
            }
        }
    };
   xhr.open('POST', 'parcauto/php/Ordremiss.php'); 
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('matricule=' + matricule);
}

// Ajouter un événement onchange au champ de sélection (matricule)
document.getElementById('matricule').addEventListener('change', recupererInfos);




function imprimerPage() {
    window.print();
}
