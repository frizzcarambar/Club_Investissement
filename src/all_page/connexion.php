<?php

$connexion_page ="<form id=\"form_connexion\" action=" .$this->router->getVerifyConnexionURL() . " method=\"post\">
    <h1>Login</h1>
    <input type=\"text\" id=\"Mail\" name=\"".$data::MAIL_REF."\" placeholder=\"Mail\">
    <input type=\"password\" id=\"password\" name=\"".$data::PASSWORD_REF."\" placeholder=\"Password\">
    <input type=\"submit\" value=\"Login\"/>
    <span class=\"close material-icons\">close</span>
"
?>
