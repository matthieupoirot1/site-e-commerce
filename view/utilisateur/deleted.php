<?php
$html_l = htmlspecialchars(routeur::myGet('login'));
echo <<<EOT
  <p>
    L'utilisateur de login $html_l a bien été supprimée !
  </p>
EOT;
require File::build_path(array("view","utilisateur","list.php"));