
$(document).ready(function(){
  $("#openModalBtn").click(function(){
    $("#myModal").fadeIn();
  });

  $("#cancel").click(function(){
    $("#myModal").fadeOut();
  });
  $(".close").click(function(){
    $("#myModal").fadeOut();
  });
});


