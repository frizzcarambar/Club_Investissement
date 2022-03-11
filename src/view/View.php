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
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">
                    <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">";
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
    $this->renderSquelette();
  }

  public function makeInformationPage($data){
    $this->title = "IUP BFA CAEN INVEST CLUB";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/homeStyle.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">
                    ";

    include "all_page/home.php";
    $this->content = $home_page;
    $this->content .= "<br><table>";
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
