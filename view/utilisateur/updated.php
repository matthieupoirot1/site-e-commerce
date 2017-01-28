<?php
$login = htmlspecialchars(routeur::myGet('login'));
echo <<<EOT
  <p>
    L'utilisateur de login : $login a bien été mise à jour ! 
  </p>
EOT;
require File::build_path(array("view","utilisateur","list.php"));