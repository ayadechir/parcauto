$(document).ready(function(){
    $(".suivi").click(function(){
      $("#myModal").fadeIn();
    });
    $(".close").click(function(){
      $("#myModal").fadeOut();
    });
  });


  $(document).ready(function(){
    $(".edit").click(function(){
      $("#edit").fadeIn();
    });
    $(".close").click(function(){
      $("#edit").fadeOut();
    });
  });



  $(document).ready(function(){
    $(".di").click(function(){
      $("#demande-intervention").fadeIn();
    });
    $(".close").click(function(){
      $("#demande-intervention").fadeOut();
    });
  });



  $(document).ready(function(){
    $("#ajout").click(function(){
      $("#add").fadeIn();
    });
    $(".close").click(function(){
      $("#add").fadeOut();
    });
  });

//Afficher le formulaire de suivi associé  
function showSuiviForm(matricule_v) {
  // Afficher le formulaire de suivi avec l'identifiant unique
  $("#myModal").css("display", "block");
  $(".matricule_v").val(matricule_v);
}

//Afficher le tableau de modification
function showEditTable(matricule_v,marque,modele,puissance,annee,couleur,km_actuel) {
  $("#edit").css("display", "block");
  $(".matricule_v").val(matricule_v);
  $("#marque").val(marque);
  $("#modele").val(modele);
  $("#puissance").val(puissance);
  $("#anne_v").val(annee);
  $("#couleur").val(couleur);
  $("#km_actuel").val(km_actuel);
}

//Afficher le formulaire de suivi associé  
function showDiForm(matricule_v) {
  // Afficher le formulaire de suivi avec l'identifiant unique
  $("#demande-intervention").css("display", "block");
  $(".matricule_v").val(matricule_v);
}



function searchTable() {
  let input = document.getElementById("search").value.toLowerCase();
  let table = document.getElementById("tableV");
  let rows = table.rows;

  for (let i = 1; i < rows.length; i++) {
    let cells = rows[i].cells;
    let match = false;

    for (let j = 0; j < cells.length - 1; j++) {
      if (cells[j].innerText.toLowerCase().includes(input)) {
        match = true;
        break;
      }
    }

    if (match) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }
}


// Fonction de validation du formulaire
function validateForm() {
    // Récupérer les valeurs des champs kilométrage de départ et kilométrage de retour
    var kmDepart = parseInt(document.getElementsByName("km_dep")[0].value);
    var kmRetour = parseInt(document.getElementsByName("km_ret")[0].value);

    // Vérifier si le kilométrage de départ est supérieur ou égal au kilométrage de retour
    if (kmDepart >= kmRetour) {
        // Afficher une alerte pour informer l'utilisateur de l'erreur
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Le kilométrage de départ doit être inférieur au kilométrage de retour.'
        });
        // Empêcher l'envoi du formulaire
        return false;
    }
    // Si la validation passe, permettre l'envoi du formulaire
    return true;
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