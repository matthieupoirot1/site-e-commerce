<?php
$html_id = htmlspecialchars($_GET['id_cmd']);
echo <<<EOT
  <p>
    La commande d'ID $html_id a bien été supprimée !
  </p>
EOT;
require File::build_path(array("view","utilisateur","list.php"));