<?php

class Controller{
  public $view;
  public $storage;

  function __construct(View $view, $storage){
    $this->view = $view;
    $this->storage = $storage;
  }

  public function showInformation($id){
    if($id===null){
      $this->view->makeAccueilPage();
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
        var_dump($data);
        $requete = $this->storage->getDb()->prepare('SELECT * FROM Users WHERE mail = :mail && password = :password');
        $requete->execute(array(':mail' => $data["mail"], ':password' => $data["password"]));
        $users = $requete->fetch();
        if($users){
          $_SESSION['connexion'] = $users["idUsers"];
          $this->view->displayRedirectAccueil("Vous êtes maintenant connecté");
        }
        else{
          $this->view->makeConnexionPage(new UsersBuilder(array(), $this->storage, "Les informations entrées sont invalides"));
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
        $company = $this->cleanString($company);
        $requete = $this->storage->getDb()->prepare('SELECT * FROM company WHERE find_with = :find_with');
        $requete->execute(array(':find_with' => $company));
        $all_company = $requete->fetchAll();
        if($all_company){
          $this->view->makeAccueilPage($all_company);
        }
        else{
          $motRecherche = urlencode($company);
          /// Ajouter votre X-RapidAPI-Key dans le fichier src/control/API_Key
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
            $this->view->displayRedirectAccueil("Found nothing");
          }
        }
      }

      public function verifArray($json){
        if(!property_exists($json, "symbol")||!property_exists($json, "name")||!property_exists($json, "exch")){
          throw new Exception();
        }
      }

}
?>
