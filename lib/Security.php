<?php
  class Security{
    
  private static $seed = "7a56Ervindzqd3Matthieu73fPierreref1cMateo4";
  
  static function chiffrer($texte_en_clair) {
      $texte_chiffre = hash('sha256', $texte_en_clair.self::$seed);
      return $texte_chiffre;
  }

  static public function getSeed() {
    return self::$seed;
  }
  
  static public function generateRandomHex() {
    // Generate a 32 digits hexadecimal number
    $numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
    $bytes = openssl_random_pseudo_bytes($numbytes); 
    $hex   = bin2hex($bytes);
    return $hex;
  }


}
  ?>

