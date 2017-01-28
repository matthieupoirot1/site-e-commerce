<?php 
class Session {
  
  public static function isUser($login) {
    return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
  }

  public static function isAdmin() {
    return (!empty($_SESSION['admin']) && $_SESSION['admin']);
  }
  
}