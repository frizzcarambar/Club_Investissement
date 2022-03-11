let connexion = $("#button_connexion");

$(document).click(function(){
  if(connexion.hasClass("active")){
    let conexion = document.getElementById("button_connexion");
    if(conexion.classList.contains("active")){
      let target = $(event.target);
      if(!target.closest("#form_connexion").length && $('#form_connexion').is(":visible")){
        $("#form_connexion").remove();
        $("link").last().remove();
        conexion.classList.remove("active");
      }
    }
  }
});

connexion.click(function(){
  $('head').append('<link rel="stylesheet" type="text/css" href="src/all_page/connexion.css">');
  setTimeout(function(){connexion.addClass("active")}, 1000);
  $('body').prepend("<form id=\"form_connexion\" action=\"index.php?action=verifyconnexion\" method=\"post\"><h1>Login</h1><input type=\"text\" id=\"Mail\" name=\"mail\" placeholder=\"Mail\"><input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Password\"><input type=\"submit\" value=\"Login\"/><span class=\"close material-icons\">close</span></form>");
  let quit = document.querySelector(".close");
  quit.addEventListener("click", function(){
    console.log("test");
    $("#form_connexion").remove();
    $("link").last().remove();
  });
});
