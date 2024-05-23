function showOr(id_or,nom_prenom,matricule,adress_admin,emplacement,raison,date_dep,date_ret,matricule_v) {
    $("#myModal").css("display", "block");
    $(".id_or").val(id_or);
    $("#nom_prenom").val(nom_prenom);
    $("#matricule").val(matricule);
    $("#adress_admin").val(adress_admin);
    $("#emplacement").val(emplacement);
    $("#raison").val(raison);
    $("#date_dep").val(date_dep);
    $("#date_ret").val(date_ret);
    $("#matricule_v").val(matricule_v);
  }

  function imprimerPage() {
    window.print();
}
// script.js

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

