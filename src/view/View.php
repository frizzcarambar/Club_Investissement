<?php

class View{
  public $title;
  public $content;
  public $router;
  public $feedback;

  public function __construct(Router $router, $feedback){
    $this->router = $router;
    $this->feedback = $feedback;
  }

  public function renderSquelette(){
    include "view/squelette.php";
  }

  public function makeAccueilPage(){
    $this->title = "Test";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/home_style.css\" type=\"text/css\">";
    if($this->feedback!=null){
      $this->content = "<p>$this->feedback</p>";
    }
    include "all_page/home.php";
    $this->content .= $home_page;
    include "all_page/recherche.php";
    $this->content .= $recherche;
    $this->renderSquelette();
  }

  public function makeListPage(array $resultat_recherche){
    $this->title = "Test";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/home_style.css\" type=\"text/css\">
                    <link rel=\"stylesheet\" href=\"src/all_page/table.css\" type=\"text/css\">";
    if($this->feedback!=null){
      $this->content = "<p>$this->feedback</p>";
    }
    include "all_page/home.php";
    $this->content .= $home_page;
    include "all_page/recherche.php";
    $this->content .= $recherche;
    $this->content .= "<br><table>
                          <tr>
                            <th>Shortname</th>
                            <th>Exchange</th>
                            <th>Symbol</th>
                          </tr>";
    foreach($resultat_recherche as $value){
      $this->content .= "<tr><td>{$value["shortname"]}</td>><td>{$value["exchange"]}</td>><td>{$value["symbol"]}</td></tr>";
    }
    $this->content .= "</table>";
    $this->renderSquelette();
  }

  public function makeConnexionPage(UsersBuilder $data){
    $this->title = "Connexion";
    $this->style = "<link rel=\"stylesheet\" href=\"src/all_page/home_style.css\" type=\"text/css\">
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

  public function displayRedirectAccueil($feedback){
    $this->router->PostRedirect("index.php" , $feedback);
  }
}

 ?>
