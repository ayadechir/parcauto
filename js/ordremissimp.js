function showOr(matricule_v,marque,modele,puissance,annee,couleur,km_actuel) {
    $("#print").css("display", "block");
    $(".matricule_v").val(matricule_v);
    $("#marque").val(marque);
    $("#modele").val(modele);
    $("#puissance").val(puissance);
    $("#anne_v").val(annee);
    $("#couleur").val(couleur);
    $("#km_actuel").val(km_actuel);
  }