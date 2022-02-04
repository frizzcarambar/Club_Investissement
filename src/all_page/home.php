<?php

$home_page = "<nav class=\"menu_bar\">
  <div class=\"logo\">
    Logo
  </div>
  <ul class=\"menu_nav\">
    <li><a href=\"#\">NewsLetters</a></li>
    <li><a href=\"#\">Calendrier</a></li>
    <li><a href=\"#\">Footer</a></li>
  </ul>
  <ul class=\"menu_connexion\">
    <button id=\"button_connexion\">";
if($_SESSION["connexion"] == null){
  $home_page .= "Connexion";
}
else{
  $home_page .= "<a href=". $this->router->getDeconnexionURL() .">Deconnexion</a>";
}
$home_page .="</button></ul></nav>";
?>
