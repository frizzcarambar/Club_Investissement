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
  $('body').prepend("<form action=\"index.php?action=verifyconnexion\" method=\"post\"><div class=\"container\"><div class=\"screen\"><div class=\"screen__content\"><form class=\"login\"><div class=\"login__field\"><i class=\"login__icon fas fa-user\"></i><input type=\"text\" class=\"login__input\" name=\"mail\" placeholder=\"Email\"></div><div class=\"login__field\"><i class=\"login__icon fas fa-lock\"></i><input type=\"password\" class=\"login__input\" name=\"password\" placeholder=\"Password\"></div><button class=\"button login__submit\"><span class=\"button__text\">Se connecter</span><i class=\"button__icon fas fa-chevron-right\"></i></button></form></div><div class=\"screen__background\"><span class=\"screen__background__shape screen__background__shape4\"></span><span class=\"screen__background__shape screen__background__shape3\"></span><span class=\"screen__background__shape screen__background__shape2\"></span><span class=\"screen__background__shape screen__background__shape1\"></span></div></div></div>");
  let quit = document.querySelector(".close");
  quit.addEventListener("click", function(){
    console.log("test");
    $("#form_connexion").remove();
    $("link").last().remove();
  });
});
