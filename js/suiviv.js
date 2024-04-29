
$(document).ready(function(){
    $(".suivi").click(function(){
      $("#myModal").fadeIn();
    });
    $(".close").click(function(){
      $("#myModal").fadeOut();
    });
  });


  $(document).ready(function(){
    $(".vidange").click(function(){
      $("#vidange").fadeIn();
    });
    $(".close").click(function(){
      $("#vidange").fadeOut();
    });
  });

  function updateDate() {
    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1; // Les mois sont indexés à partir de 0
    var year = today.getFullYear();

    // Ajouter un zéro en tête si nécessaire pour avoir deux chiffres
    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + month;
    }

    var formattedDate = year + '-' + month + '-' + day;
    document.getElementById('date').value = formattedDate;
}

// Mettre à jour la date lors du chargement de la page
updateDate();

  




//Afficher le formulaire de suivi associé  
function showSuiviForm(matricule_v) {
  // Afficher le formulaire de suivi avec l'identifiant unique
  $("#myModal").css("display", "block");
  $("#matricule_v").val(matricule_v);
}

//Afficher le formulaire de Di vidange
function showDiVidangeForm(matricule_v) {
  $("#vidange").css("display", "block");
  $("#matricule_v").val(matricule_v);
}
