<?php
$prenom = htmlspecialchars(routeur::myGet('prenom'));
echo <<<EOT
  <p>
    Bienvenue sur notre site $prenom ! 
  </p>
  <p>
    <a href="index.php">Découvrir nos produits</a>
  </p>
EOT;
