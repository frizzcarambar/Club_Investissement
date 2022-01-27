<?php
class Users{
  public $mail, $password;

  function __construct($mail, $password){
    $this->mail = $mail;
    $this->password = $password;
  }

  function getMail(){
    return $this->mail;
  }

  function getPassword(){
    return $this->password;
  }

}
?>
