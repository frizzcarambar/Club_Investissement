<?php

class View{
  public $title;
  public $content;
  public $router;

  public function __construct(Router $router){
    $this->router = $router;
  }

  public function renderSquelette(){
    include "view/squelette.php";
  }

  public function makeAccueilPage(array $resultat_recherche = null){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">";
    include "all_page/home.php";
    $this->content .= $home_page;
    if($resultat_recherche!=null){
      $this->content .= "<br><table>
                            <tr>
                              <th>Name</th>
                              <th>Exchange</th>
                              <th>Symbol</th>
                            </tr>";
      foreach($resultat_recherche as $value){
        $this->content .= "<tr><td><a href=\"index.php?company={$value["symbol"]}\"><b>{$value["name"]}</b></a></td>><td>{$value["exch"]}</td>><td>{$value["symbol"]}</td></tr>";
      }
      $this->content .= "</table>";
    }
    $this->content .= "<script src=\"src/all_page/home_script.js\"></script>";
    $this->renderSquelette();
  }

  public function makeConnexionPage(UsersBuilder $data){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/connexion.css\" type=\"text/css\">
                    ";
    include "all_page/home.php";
    $this->content = $home_page;
    include "all_page/connexion.php";
    $this->content = $this->content . $connexion_page;
    if($data->getError() != null){
      $this->content = $this->content . "<p>" . $data->getError() . "</p>";
    }
    $this->content = $this->content . "</form>";
    $this->content .= "<script src=\"src/all_page/home_script.js\"></script>";
    $this->renderSquelette();
  }

  public function makeInformationPage($data){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/tableau_portefeuille.css\" type=\"text/css\">";

    include "all_page/home.php";
    $this->content = $home_page;
    $this->content .= "<br><div class=\"parent\">
                           <div class=\"bandeau\" style=\"background-color:red\"> </div>
                           <div class=\"info_Gauche\">
                              <h3> {$data["shortName"]} ({$data["symbol"]}) </h3>
                              <span> {$data["regularMarketPrice"]} {$data["currency"]} </span>
                              <br>
                              <span>" . round($data["regularMarketChangePercent"], 2). " % </span>
                           </div>
                           <div class=\"info_Droite\">
                              <ul>
                                <li> <p> OUVERTURE </p> <span> {$data["regularMarketOpen"]} </span> </li>
                                <li> <p> CLOTURE VEILLE </p> <span> {$data["regularMarketPreviousClose"]} </span> </li>
                                <li> <p> PLUS HAUT </p> <span> {$data["regularMarketDayHigh"]} </span> </li>
                                <li> <p> PLUS BAS </p> <span> {$data["regularMarketDayLow"]} </span> </li>
                              </ul>
                           </div>
                           <div class=\"info_Bas\">
                             <ul>
                               <li> <p> Long Name </p> <span> {$data["longName"]} </span> </li>
                               <li> <p> Exchange Name </p> <span> {$data["fullExchangeName"]} </span> </li>
                               <li> <p> Exchange Time Zone </p> <span> {$data["exchangeTimezoneName"]} </span> </li>
                               <li> <p> VALORISATION </p> <span> {$data["marketCap"]} </span> </li>
                               <li> <p> VOLUME  </p> <span> {$data["regularMarketVolume"]} </span> </li>
                               <li> <p> regularDayRange </p> <span> {$data["regularMarketDayRange"]} </span> </li>
                             </ul>
                           </div>
                           <div class=\"graphique\">
                              <p> </p>
                           </div>
                       </div> <table>";
    foreach($data as $key => $value){
      $this->content .= "<tr>
                          <td>
                            {$key}
                          </td>
                          <td>
                            {$value}
                          </td>
                        </tr>";
    }
    $this->content .= "</table>";
    $this->content .= "<script src=\"src/all_page/home_script.js\"></script>";
    $this->renderSquelette();
  }
  public function makeCalendarPage(array $resultat_recherche = null){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/calendar.css\" type=\"text/css\">";
    include "all_page/home.php";
    $this->content .= $home_page;
    $this->content .="<iframe src=\"https://calendar.google.com/calendar/embed?height=600&wkst=2&bgcolor=%23d7324f&ctz=Europe%2FParis&showPrint=0&showCalendars=0&showNav=0&showDate=1&showTz=0&mode=WEEK&src=bXNobXY5a2Ixa3NyODZpaWpmZjF2aDNhcGdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23D50000\" style=\"border:solid 1px #777\" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe>";
    $this->content .= "<script src=\"src/all_page/home_script.js\"></script>";
    $this->renderSquelette();
  }

  public function makePortefeuillePage($data){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">";

    include "all_page/home.php";
    $this->content .= $home_page;
    $this->content .= "<h2 style=\"margin-top:25px\">Votre portefeuille :</h2><br>
                       <p>Votre solde de début: {$data["starting_money"]}</p>
                       <p>Votre solde actuel: {$data["current_money"]}</p>
                       <p>Progression de " . $data["current_money"]/$data["starting_money"]*100 ."%.</p><br>";
    if($_SESSION["connexion"] == "admin" || $_SESSION["connexion"] == "analyst"){
      $this->content .=
        "<form action=".$this->router->getPortefeuilleURL()." method=\"post\">
          <div>Ajouter des action au portefeuille</div>
          <input type=\"text\" name=\"symbol_action\" placeholder=\"Symbol de l'entreprise\" required>
          <input type=\"text\" name=\"nbr_action\" placeholder=\"Nombre d'action\" required>
          <input type=\"text\" name=\"prix_action\" placeholder=\"Prix de l'action\" required>
          <button name=\"ajout\" type=\"submit\">Ajouter</button>
        </form>
        <form action=".$this->router->getPortefeuilleURL()." method=\"post\">
          <div>Vendre des action du portefeuille</div>
          <input type=\"text\" name=\"symbol_action\" placeholder=\"Symbol de l'entreprise\" required>
          <input type=\"text\" name=\"nbr_action\" placeholder=\"Nombre d'action\" required>
          <input type=\"text\" name=\"prix_action\" placeholder=\"Prix de l'action\" required>
          <button name=\"vendre\" type=\"submit\">Vendre</button>
        </form>";

    }

    $this->content .= "<script src=\"src/all_page/home_script.js\"></script>";
    $this->renderSquelette();
  }


  public function makeDebugPage($variable) {
    $this->renderNav();
	 $this->title = 'Debug';
	 $this->content = '<ptextboxid
{
    height:200px;
    font-size:14pt;
}re>'.htmlspecialchars(var_export($variable, true)).'</pre>';
   $this->renderSquelette();
  }

  public function displayRedirectAccueil(){
    $this->router->PostRedirect("index.php");
  }

  public function displayRedirectAccueilWithList($list){
    $this->router->PostRedirectWithList("index.php" , $list);
  }
}

 ?>
