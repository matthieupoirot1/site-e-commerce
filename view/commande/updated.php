<?php
$c_html_id = htmlspecialchars($_GET['id_cmd']);
echo <<<EOT
  <p>
    La commande $c_html_id a bien été mise à jour ! 
  </p>
EOT;
require File::build_path(array("view","commande","list.php"));