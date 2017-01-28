<?php
$login = htmlspecialchars(routeur::myGet('login'));
$mail = htmlspecialchars(routeur::myGet('mail'));
echo <<<EOT
  <p>
    L'utilisateur de login : $login a bien été créé ! Un email à été envoyé à $mail, suivez le lien pour valider votre inscription.
  </p>
EOT;
require File::build_path(array("view","utilisateur","list.php"));