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


