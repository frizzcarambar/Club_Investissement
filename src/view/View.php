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

  public function makeAccueilPage($resultat_recherche = null){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/newsListe.css\" type=\"text/css\">";

    include "all_page/home.php";
    $this->content .= $home_page;
    if($_SESSION["connexion"]!=null && is_array($resultat_recherche) && !in_array("News", $resultat_recherche)){
      if($_SESSION["erreur"]!=null){$this->content .= "<span style=\"color:red\">{$_SESSION["erreur"]}</span>";}
      else{
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
    }
    else{
      if($_SESSION["erreur"]!=null){
        $this->content .= "<span style=\"color:red\">{$_SESSION["erreur"]}</span>";
      }
      $this->content .= "<br><h1>Dernières News</h1><ul class=\"liste_news\">";
      unset($resultat_recherche["News"]);
      foreach($resultat_recherche as $news){
        $this->content .= "<li>
                            <h3>{$news["title"]}</h3>
                            <img src=\"{$news["image"]}\" alt=\"\">
                          </li>";
      }
      $this->content .= "</ul>";
    }
    $this->content .= "</main><script src=\"src/all_page/home_script.js\"></script>";
    $this->renderSquelette();
  }

  public function makeConnexionPage(UsersBuilder $data, $resultat_recherche){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/newsListe.css\" type=\"text/css\">
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
    $this->content .= "<main><br><h1>Dernières News</h1><ul class=\"liste_news\">";
    unset($resultat_recherche["News"]);
    foreach($resultat_recherche as $news){
      $this->content .= "<li>
                          <h3>{$news["title"]}</h3>
                          <img src=\"{$news["image"]}\" alt=\"\">
                        </li>";
    }
    $this->content .= "</ul>";
    $this->content .= "</main><script src=\"src/all_page/home_script.js\"></script><script>$(\"#button_connexion\").addClass(\"active\");</script>";
    $this->renderSquelette();
  }

  public function makeInformationPage($data){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/informationAction.css\" type=\"text/css\">";

    include "all_page/home.php";
    $this->content = $home_page;
    $this->content .= "<br><div class=\"parent\">";
    if($data["regularMarketChangePercent"]>0){$this->content .= "<div class=\"bandeau\" style=\"background-color:green\"></div>";}
    else{$this->content .= "<div class=\"bandeau\" style=\"background-color:red\"></div>";}
    $this->content .= "<div class=\"info_Gauche\">
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
                             <ul>";
      if(array_key_exists("longName", $data)){$this->content .="<li><p>Long Name</p><span>{$data["longName"]}</span></li>";}
      if(array_key_exists("fullExchangeName", $data)){$this->content .="<li><p>Exchange Name</p><span>{$data["fullExchangeName"]}</span></li>";}
      if(array_key_exists("exchangeTimezoneName", $data)){$this->content .="<li><p>Exchange Time Zone</p><span>{$data["exchangeTimezoneName"]}</span></li>";}
      if(array_key_exists("marketCap", $data)){$this->content .="<li><p>VALORISATION</p><span>{$data["marketCap"]}</span></li>";}
      if(array_key_exists("regularMarketVolume", $data)){$this->content .="<li><p>VOLUME</p><span>{$data["regularMarketVolume"]}</span></li>";}
      if(array_key_exists("regularMarketDayRange", $data)){$this->content .="<li><p>regularDayRange</p><span>{$data["regularMarketDayRange"]}</span></li>";}
      $this->content .= "</ul>
                           </div>
                           <div class=\"graphique\" style=\"border-top: 1px solid black; border-bottom: 1px solid black;text-align:center\">
                              EMPLACEMENT POUR LE GRAPHIQUE DU COURS DE L'ACTION<br>
                              <img src=\"src/image/test.jpg\" alt=\"\"/>

                           </div>
                          </div>";
    $this->content .= "</main><script src=\"src/all_page/home_script.js\"></script>";
    $this->renderSquelette();
  }
  public function makeCalendarPage(){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/calendar.css\" type=\"text/css\">";
    include "all_page/home.php";
    $this->content .= $home_page;
    $this->content .="<iframe src=\"https://calendar.google.com/calendar/embed?height=600&wkst=2&bgcolor=%23d7324f&ctz=Europe%2FParis&showPrint=0&showCalendars=0&showNav=0&showDate=1&showTz=0&mode=WEEK&src=bXNobXY5a2Ixa3NyODZpaWpmZjF2aDNhcGdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23D50000\" style=\"border:solid 1px #777\" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe>";
    $this->content .= "</main><script src=\"src/all_page/home_script.js\"></script>";
    $this->renderSquelette();
  }

  public function makePortefeuillePage($data){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/portefeuille.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/TableauMyAction.css\" type=\"text/css\">";

    include "all_page/home.php";
    $this->content .= $home_page;
    $this->content .= "<h3> Votre portefeuille :</h3>";
    if($data["starting_money"]>$data["solde_total"]){$this->content .= "<div id=\"actif\" style=\"border: 3px solid #ff0000; background-color: #ffe6e6;\">";}
    else{$this->content .= "<div id=\"actif\" style=\"border: 3px solid #33cc33; background-color: #d6f5d6;\">";}
    $this->content .="<span id=\"solde\"><span>{$data["solde_total"]}</span>€</span>
                      <span id=\"liquidite\"><span>{$data["current_money"]}</span>€</span>
                      </div><br>";
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
    if($data["action"]!=null){
      $this->content .= "<br><table id=\"myAction\">
                          <tr>
                            <th>Action possédée</th>
                            <th>Prix Unitaire</th>
                            <th>Nombre d'action</th>
                            <th>Valeur totale d'achat</th>
                          </tr>";
      foreach($data["action"] as $value){
        $this->content .= "<tr>
                            <td>
                              <a href=\"index.php?company={$value["symbol"]}\"><b>{$value["symbol"]}</b></a>
                            </td>
                            <td>
                              {$value["prix_achat"]}
                            </td>
                            <td>
                              {$value["nombre"]}
                            </td>
                            <td>
                              {$value["valeur_totale"]}
                            </td>
                          </tr>";
      }
      $this->content .= "</table>";
    }
    $this->content .= "</main><script src=\"src/all_page/home_script.js\"></script>";
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
}

 ?>
