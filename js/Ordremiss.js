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