<?php

class Controller{
  public $view;
  public $storage;

  function __construct(View $view, $storage){
    $this->view = $view;
    $this->storage = $storage;
  }

  public function showInformation($id = null){
    if($id==null){
      $requete = $this->storage->getDb()->prepare('SELECT title, image FROM newsletters LIMIT 3');
      $requete->execute();
      $resultats = $requete->fetchAll();
      $new_resultat = array();
      foreach($resultats as $resultat){
        foreach($resultat as $key => $value){
          if(is_int($key)){
            unset($resultat[$key]);
          }
        }
        $new_resultat[]=$resultat;
      }
      $new_resultat["News"]="News";
      $this->view->makeAccueilPage($new_resultat);
    }
    else{
      $opts = array('http'=>array('method'=>"GET",'header'=>"x-api-key: " . file_get_contents("src/control/API_Key.txt")));
      $context = stream_context_create($opts);
      $url ="https://yfapi.net/v6/finance/quote?region=US&lang=en&symbols=".$id;
      $raw = file_get_contents($url, false, $context);
      $json = json_decode($raw);
      $data = array('triggerable', 'fullExchangeName' , 'financialCurrency', 'regularMarketOpen', 'priceToBook',
          'regularMarketChangePercent', 'regularMarketPrice', 'regularMarketDayHigh', 'regularMarketDayRange', 'regularMarketDayLow', 'regularMarketPreviousClose', 'epsCurrentYear', 'currency', 'bid',
          'ask', 'regularMarketVolume', 'averageAnalystRating', 'marketCap', 'shortName', 'longName','messageBoardId', 'exchangeTimezoneName', 'exchangeTimezoneShortName', 'market', 'displayName', 'symbol');
      foreach($json->quoteResponse->result as $company){
        $tab = array();
        foreach($company as $key => $value){
          if(in_array($key, $data)){
            $tab[$key] = $value;
          }
        }
        ksort($tab);
        $this->view->makeInformationPage($tab);
      }
    }
  }

      public function verificationconnexion(array $data){
        $requete = $this->storage->getDb()->prepare('SELECT * FROM Users WHERE mail = :mail && password = :password');
        $requete->execute(array(':mail' => $data["mail"], ':password' => $data["password"]));
        $users = $requete->fetch();
        if($users){
          $_SESSION['connexion'] = $users["role"];
          $this->view->displayRedirectAccueil("Vous ??tes maintenant connect?? en tant que ".$user["role"]."");
        }
        else{
          $requete = $this->storage->getDb()->prepare('SELECT title, image FROM newsletters LIMIT 3');
          $requete->execute();
          $resultats = $requete->fetchAll();
          $new_resultat = array();
          foreach($resultats as $resultat){
            foreach($resultat as $key => $value){
              if(is_int($key)){
                unset($resultat[$key]);
              }
            }
            $new_resultat[]=$resultat;
          }
          $new_resultat["News"]="News";
          $this->view->makeConnexionPage(new UsersBuilder(array(), $this->storage, "Les informations entr??es sont invalides"), $new_resultat);
        }
      }

      public function cleanString($string){
          // on supprime : majuscules ; / ? : @ & = + $ , . ! ~ * ( ) les espaces multiples et les underscore
          $string = strtolower($string);
          $string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
          $string = preg_replace("/[\s-]+/", " ", $string);
          $string = preg_replace("/[\s_]/", " ", $string);
          return $string;
      }

      public function verificationCompany(string $company){
        if($_SESSION["connexion"]==null){
          $_SESSION["erreur"] = "Vous devez vous connecter pour effectuer une recherche";
          $this->showInformation();
        }
        else{
          $company = $this->cleanString($company);
          $requete = $this->storage->getDb()->prepare('SELECT * FROM company WHERE find_with = :find_with');
          $requete->execute(array(':find_with' => $company));
          $all_company = $requete->fetchAll();
          if($all_company){
            $this->view->makeAccueilPage($all_company);
          }
          else{
            $motRecherche = urlencode($company);
            /// Ajouter votre api-key de yahoo-finance dans le fichier src/control/API_Key
            $opts = array('http'=>array('method'=>"GET",'header'=>"x-api-key: " . file_get_contents("src/control/API_Key.txt")));
            $context = stream_context_create($opts);
            $url ="https://yfapi.net/v6/finance/autocomplete?region=US&lang=en&query=".$motRecherche;
            $raw = file_get_contents($url, false, $context);
            $json = json_decode($raw);
            //var_dump($json->ResultSet->Result);
            if(!empty($json->ResultSet->Result)) {
              foreach($json->ResultSet->Result as $value){
                $request = $this->storage->getDb()->prepare("INSERT INTO company (exch, name, symbol, find_with) VALUES (:exch, :name, :symbol, :find_with)");
                try{
                  $this->verifArray($value);
                  $data = array('exch' => $value->exch, 'name' => $value->name, 'symbol' => $value->symbol, 'find_with' => $company);
                }
                catch(Exception $e){
                  $data = array();
                  if(property_exists($value, "exch")){
                    $data['exch'] = $value->exch;
                  }
                  else{
                    $data['exch'] = "null";
                  }
                  if(property_exists($value, "name")){
                    $data['name'] = $value->name;
                  }
                  else{
                    $data['name'] = "null";
                  }
                  if(property_exists($value, "symbol")){
                    $data['symbol'] = $value->symbol;
                  }
                  else{
                    $data['symbol'] = "null";
                  }
                  $data["find_with"] = $company;
                }
                finally{
                  $request->execute($data);
                }
              }
              $requete->execute(array(':find_with' => $company));
              $all_company = $requete->fetchAll();
              $this->view->makeAccueilPage($all_company);
            }
            else{
              $_SESSION["erreur"] = "Aucune compagnie trouv??e";
              $this->view->makeAccueilPage(array());
            }
          }
        }
      }

      public function verifArray($json){
        if(!property_exists($json, "symbol")||!property_exists($json, "name")||!property_exists($json, "exch")){
          throw new Exception();
        }
      }

      public function showPortefeuille($action = null){
        if($action!=null){
          $requete = $this->storage->getDb()->prepare('SELECT * FROM action WHERE symbol=:symbol');
          $requete->execute(array('symbol'=>$action["symbol"]));
          $result = $requete->fetch();
          $action["symbol"] = strtoupper($action["symbol"]);
          if($action["action"]=="achat"){
            if($result){
              $requete = $this->storage->getDb()->prepare('UPDATE action SET nombre=:nombre, date_achat=:date_achat, prix_achat=:prix_achat WHERE symbol=:symbol');
              $new_prix_achat = (($action["prix"]*$action["nbr"]+$result["prix_achat"]*$result["nombre"])/($result["nombre"]+$action["nbr"]));
              $requete->execute(array('nombre'=>$action["nbr"]+$result["nombre"], 'date_achat'=>date("Y-m-d"), 'prix_achat'=>$new_prix_achat, 'symbol'=>$action["symbol"]));
              $result = $requete->fetch();
            }
            else{
              $requete = $this->storage->getDb()->prepare('INSERT INTO action (symbol, date_achat, prix_achat, nombre) VALUES (:symbol, :date_achat, :prix_achat, :nombre)');
              $requete->execute(array('symbol'=>$action["symbol"], 'date_achat'=>date("Y-m-d"), 'nombre'=>$action["nbr"], 'prix_achat'=>$action["prix"]));
            }
          }
          else{
            if($result && $result["nombre"]>=$action["nbr"]){
              if($result["nombre"]==$action["nbr"]){
                $requete = $this->storage->getDb()->prepare('DELETE FROM action WHERE symbol = :symbol');
                $requete->execute(array('symbol'=>$action["symbol"]));
              }
              else{
                $requete = $this->storage->getDb()->prepare('UPDATE action SET nombre=:nombre WHERE symbol=:symbol');
                $requete->execute(array('nombre'=>$result["nombre"]-$action["nbr"], 'symbol'=>$action["symbol"]));
              }
            }

          }
        }
        $data = array();
        $requete = $this->storage->getDb()->prepare('SELECT starting_money, current_money FROM portefeuille');
        $requete->execute();
        $resultat = $requete->fetch();
        $data["starting_money"] = floatval($resultat["starting_money"]);
        $data["current_money"] = floatval($resultat["current_money"]);
        if($action!=null){
          if($action["action"]=="vente"){$action["prix"]*=-1;}
          $new_money = $data["current_money"]-($action["nbr"]*$action["prix"]);
          $data["current_money"]=$new_money;
          $requete = $this->storage->getDb()->prepare('UPDATE portefeuille SET current_money= :new_money WHERE idPortefeuille = 1');
          $requete->execute(array('new_money'=>$new_money));
        }
        $requete = $this->storage->getDb()->prepare('SELECT symbol, prix_achat, nombre FROM action');
        $requete->execute();
        $all_action = $requete->fetchAll();
        $new_all_action = array();
        foreach($all_action as $action){
          $action = array_unique($action);
          $action["valeur_totale"] = $action["prix_achat"]*$action["nombre"];
          $new_all_action[] = $action;
        }
        $data["action"]=$new_all_action;
        $opts = array('http'=>array('method'=>"GET",'header'=>"x-api-key: " . file_get_contents("src/control/API_Key.txt")));
        $context = stream_context_create($opts);
        $compteur = 0;
        $argent_action = 0;
        foreach($new_all_action as $value){
          if($compteur==0){
            $url ="https://yfapi.net/v6/finance/quote?region=US&lang=en&symbols=".$value["symbol"];
            $compteur += 1;
          }
          else if($compteur==10){
            $raw = file_get_contents($url, false, $context);
            $json = json_decode($raw);
            foreach($json->quoteResponse->result as $company){
              $argent_action += $compagny["regularMarketPrice"];
            }
            $compteur = 0;
          }
          else{
            $url .= ",{$value["symbol"]}";
            $compteur += 1;
          }
        }
        if($compteur!=0){
          $raw = file_get_contents($url, false, $context);
          $json = json_decode($raw);
          foreach($json->quoteResponse->result as $company){
            $argent_action += $company->regularMarketPrice;
          }
        }
        $data["solde_total"] = $argent_action + $data["current_money"];
        $this->view->makePortefeuillePage($data);
        }

}
?>
