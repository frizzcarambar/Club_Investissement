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
    $view = new View($this);
    $storage = new Database();
    $controller = new Controller($view, $storage);
    if(isset($_GET["calendar"])){
      $view->makeCalendarPage();
    }
    else if(isset($_GET["portefeuille"]) && $_SESSION["connexion"]!=null){
      if(isset($_POST["ajout"])){
        $controller->showPortefeuille(array("action"=>"achat", "symbol"=>$_POST["symbol_action"], "nbr"=>$_POST["nbr_action"], "prix"=>$_POST["prix_action"]));
      }
      else if(isset($_POST["ajout"])){
        $controller->showPortefeuille(array("action"=>"vente", "symbol"=>$_POST["symbol_action"], "nbr"=>$_POST["nbr_action"], "prix"=>$_POST["prix_action"]));
      }
      else{
        $controller->showPortefeuille();
      }
    }
    else if(!isset($_GET["company"]) && !isset($_GET["action"])){
      $controller->showInformation(null);
    }
    else if(isset($_GET["company"])){
      $controller->showInformation($_GET["company"]);
    }
    else if(isset($_GET["action"])){
      if($_GET["action"] == "connexion"){
        $view->makeConnexionPage(new UsersBuilder(array("pseudo"=>"", "nom"=>"", "prenom"=>"", "password"=>""), $storage));
      }
      else if($_GET["action"] == "verifyconnexion"){
        $controller->verificationconnexion($_POST);
      }
      else if($_GET["action"] == "deconnexion"){
        unset($_SESSION['connexion']);
        $this->PostRedirect("index.php");
      }
      else if($_GET["action"] == "verificationCompany"){
        if(isset($_POST["companys"])){
          $controller->verificationCompany($_POST["companys"]);
        }
        else{
          $controller->showInformation();
        }
      }
    }
  }

  function getCompanyURL(){
    return "index.php";
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

  function getPortefeuilleURL(){
    return "index.php?portefeuille";
  }

  function POSTredirect($url, $list = null){
    header("Location:".$url,true,303);
  }
}

 ?>
