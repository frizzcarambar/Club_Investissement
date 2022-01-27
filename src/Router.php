<?php

session_start();

require_once("control/Controller.php");
require_once("view/View.php");
require_once("database/Database.php");
require_once("model/Users.php");
require_once("model/UsersBuilder.php");

class Router{
  function main(){
    if(!key_exists("connexion", $_SESSION))$_SESSION["connexion"] = null;
    if(!key_exists("feedback", $_SESSION))$_SESSION["feedback"] = null;
    $view = new View($this, $_SESSION["feedback"]);
    $storage = new Database();
    $controller = new Controller($view, $storage);
    if(isset($_GET["id"])){
      $controller->showInformation($_GET["id"]);
    }
    if(isset($_GET["action"])){
      if($_GET["action"] == "connexion"){
        $view->makeConnexionPage(new UsersBuilder(array("pseudo"=>"", "nom"=>"", "prenom"=>"", "password"=>""), $storage));
      }
      else if($_GET["action"] == "verifyconnexion"){
        $controller->verificationconnexion($_POST);
      }
      else if($_GET["action"] == "deconnexion"){
        unset($_SESSION['connexion']);
        $this->PostRedirect("index.php?action=connexion", "Vous êtes maintenant déconnecté");
      }
      else if($_GET["action"] == "verificationCompany"){
        $controller->verificationCompany($_POST["company"]);
      }
    }
    else{
      $controller->showInformation(null);
    }
  }

  function getConnexionURL(){
    return "index.php?action=connexion";
  }

  function getVerifyConnexionURL(){
    return "index.php?action=verifyconnexion";
  }

  function getDeconnexionURL(){
    return "index.php?action=deconnexion";
  }

  function getVerificationCompany(){
    return "index.php?action=verificationCompany";
  }

  function POSTredirect($url, $feedback){
    header("Location:".$url,true,303);
    $_SESSION["feedback"] = $feedback;
  }
}

 ?>
