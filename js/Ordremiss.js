function imprimerPage() {
    window.print();
}
$(document).ready(function() {
    $('#creer').click(function() {
        $('#form-container').show();
        $('#tabular--wrapper').hide();
    });
});
$(document).ready(function() {
    $('#imprime').click(function() {
        $('#tabular--wrapper').show();
        $('#form-container').hide();
    });
});
$(document).ready(function(){
    $(".print").click(function(){
      $("#myModal").fadeIn();
    });
    $(".close").click(function(){
      $("#myModal").fadeOut();
    });
  });

function showOr(id_or,nom_prenom,matricule,adress_admin,emplacement,raison,date_dep,date_ret,matricule_v) {
    $("#myModal").css("display", "block");
    $(".id_or").val(id_or);
    $("#nom_prenom_").val(nom_prenom);
    $("#matricule_").val(matricule);
    $("#adress_admin_").val(adress_admin);
    $("#emplacement_").val(emplacement);
    $("#raison_").val(raison);
    $("#date_dep_").val(date_dep);
    $("#date_ret_").val(date_ret);
    $("#matricule_v_").val(matricule_v);
  }



function formatDate(date) {
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}

function setDate() {
  const today = new Date();
  const formattedDate = formatDate(today);
  document.getElementById('dateInput').value = formattedDate;
}

document.addEventListener('DOMContentLoaded', setDate);


// Fonction de validation du formulaire
function validateForm() {
    // Récupérer les valeurs des champs date de départ et date de retour
    var dateDepart = new Date(document.getElementsByName("date_dep")[0].value);
    var dateRetour = new Date(document.getElementsByName("date_ret")[0].value);

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
