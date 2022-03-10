<?php

$home_page = "<nav class=\"menu_bar\">
  <div class=\"menu-left\">
    <img class=\"logo\" alt=\"\" src=\"src/image/logo_club.png\">
  </div>
  <nav class=\"menu-right\">
  <nav class=\"menu-top\">
  <form action=".$this->router->getVerificationCompany()." method=\"post\">
    <div class=\"recherche\">
      <input type=\"text\" name=\"company\" placeholder=\"Search for Symbols or Company\">
      <input type=\"submit\" value=\"Rechercher\"/>
    </div>
  </form>
  <ul class=\"menu_connexion\">";
if($_SESSION["connexion"] == null){
  $home_page .= "<button id=\"button_connexion\">Connexion";
}
else{
  $home_page .= "<button id=\"button_deconnexion\"><a href=". $this->router->getDeconnexionURL() .">Deconnexion</a>";
}
$home_page .="</button></ul></nav>
  <ul class=\"menu_nav\">
    <li><a href=\"#\">NewsLetters</a></li>
    <li><a href=\"#\">Calendrier</a></li>
    <li><a href=\"#\">Footer</a></li>
  </ul>
  </nav>
  </nav>";

?>
