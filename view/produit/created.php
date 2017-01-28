<?php
$lib = htmlspecialchars($_POST['libelle']);
echo <<<EOT
  <p>
    L'artéfact $lib a bien été créée !
  </p>
EOT;
require File::build_path(array("view","produit","list.php"));