// SIDEBAR TOGGLE
var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");

function openSidebar() {
  if(!sidebarOpen) {
    sidebar.classList.add("sidebar-responsive");
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if(sidebarOpen) {
    sidebar.classList.remove("sidebar-responsive");
    sidebarOpen = false;
  }
}
$(document).ready(function(){
  $(".traitement").click(function(){
    $("#myModal").fadeIn();
  });
  $(".close").click(function(){
    $("#myModal").fadeOut();
  });
});


//Afficher le formulaire de suivi associé  
function showtraitementTable(id_demande) {
  // Afficher le formulaire de suivi avec l'identifiant unique
  $("#myModal").css("display", "block");
  $(".id_demande").val(id_demande);
}

