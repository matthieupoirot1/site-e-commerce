<?php
$lib = htmlspecialchars($_GET['libelle']);
echo <<<EOT
  <p>
    Le produit $lib a bien été supprimé !
  </p>
EOT;
require File::build_path(array("view","produit","list.php"));