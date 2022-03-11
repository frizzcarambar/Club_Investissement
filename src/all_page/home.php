<?php

$home_page = "<nav class=\"menu_bar\">
  <div class=\"menu-left\">
    <img class=\"logo\" alt=\"\" src=\"src/image/logo_club.png\">
    <a href=\"index.php\"></a>
  </div>
  <nav class=\"menu-right\">
  <nav class=\"menu-top\">
  <form action=".$this->router->getVerificationCompany()." method=\"post\">
    <div class=\"recherche\">
      <input type=\"text\" name=\"companys\" placeholder=\"Search for Symbols or Company\">
      <button name=\"recherche\" type=\"submit\"><span class=\"material-icons\">search</span></button>
    </div>
  </form>
  <ul class=\"menu_connexion\">";
if($_SESSION["connexion"] == null){
  $home_page .= "<button id=\"button_connexion\">Connexion</button>
                 </ul></nav>
                 <ul class=\"menu_nav\">
                  <li><a href=\"#\">NewsLetters</a></li>
                  <li><a href=\"index.php?calendar\">Calendrier</a></li>
                  <li><a href=\"#\">Footer</a></li>
                 </ul>
                 </nav>
                 </nav>";
}
else{
  $home_page .= "<button id=\"button_deconnexion\"><a href=". $this->router->getDeconnexionURL() .">Deconnexion</a></button>
                 </ul></nav>
                 <ul class=\"menu_nav\">
                  <li><a href=\"index.php?portfeuille\">Portfeuille</a></li>
                  <li><a href=\"#\">NewsLetters</a></li>
                  <li><a href=\"#\">Calendrier</a></li>
                  <li><a href=\"#\">Footer</a></li>
                 </ul>
                 </nav>
                 </nav>";
}
?>
