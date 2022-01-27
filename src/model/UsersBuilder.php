<?php
class UsersBuilder{
  private $data;
  private $error;
  private $db;
  public const MAIL_REF = "mail";
  public const PASSWORD_REF = "password";

  function __construct($data, $db, $error = null){
    $this->data = $data;
    $this->error = $error;
    $this->db = $db;
  }

  function getData(){
    return $this->data;
  }

  function getError(){
    return $this->error;
  }

  function newUsers(){
    $newusers = new Users(htmlspecialchars($this->data[self::MAIL_REF]), htmlspecialchars($this->data[self::PASSWORD_REF]));
    return $newusers;
  }

  function isValid($db){
    if($this->data[self::MAIL_REF] != null && $this->data[self::PASSWORD_REF] != null){
        if(in_array($this->data[self::MAIL_REF], $this->db->getDb()->query('SELECT mail FROM users ;')->fetch())){
          $this->error = "Un compte est déjà associé à cette adresse mail";
        return false;
      }
      return true;
    }
    else{
      $this->error = "Les informations saisies sont incorrect (tous les champs doivent être remplies).";
      return false;
    }
  }
}

?>
